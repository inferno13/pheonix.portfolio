<?php

namespace App\Models;

use App\Models\Transactions\MarketingTransaction;
use App\Models\Transactions\SubscriptionTransaction;
use App\Support\Generators\InviteCodeGenerator;
use App\Support\Generators\TransferAddressGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use AuthenticationLoggable;
    use InteractsWithMedia;

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('500x500')
            ->width(500)
            ->height(500);
    }

    public function quick_bonus() {
        return $this->belongsTo(QuickBonus::class);
    }

    public function telegram() {
        return $this->hasOne(Telegram::class);
    }

    public function roles() {
        return $this->hasMany(UserRole::class);
    }

    public function getRoleNames() {
        return $this->roles->map(function ($role) {
            return $role->role->name;
         })->toArray();
    }

    public function assignRole($name)
    {
        $role = UserRole::create([
            'user_id' => $this->id,
            'role_id' => Role::whereName($name)->first()->id
        ]);
        return $this->roles()->save($role);
    }

    public function addSponsor($invite_code) {
        // create partner
        $sponsor = User::where('invite_code', trim($invite_code))->first();

        if (!is_null($sponsor)) {
            Partner::create([
                'parent_id' => $sponsor->id,
                'child_id' => $this->id,
                'level' => 1
            ]);
        }
    }

    public static function create($data) {
        $values = array_merge(array(
            'country_id' => Country::whereCode('RU')->first()->id,
            'transfer_address' => TransferAddressGenerator::get(),
            'invite_code' => InviteCodeGenerator::get(),
            'password' => Hash::make('pheonixtech_1')
        ), $data);
        $user = static::query()->create($values);
        Wallet::create([
            'user_id' => $user->id
        ]);
        $user->assignRole('user');
        return $user;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'surname',
        'invite_code',
        'patronymic',
        'email',
        'transfer_address',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function isSubscribed()
    {
        return $this->wallet->subscriptionTransactions()->count() > 0;
    }

    public function subscriptions()
    {
        return $this->wallet->subscriptionTransactions;
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function hasSubscriptionWithQuickBonus()
    {
        return SubscriptionTransaction::where('wallet_id', $this->wallet->id)
            ->where('expires_at', '>=', Carbon::now())
            ->whereHas('product', function($query) {
                return $query->whereBonus(1);
            })
            ->count() > 0;
    }

    public function getQuickBonus()
    {
        $hasSubscriptionWithQuickBonus = $this->hasSubscriptionWithQuickBonus();
        if (!$hasSubscriptionWithQuickBonus) {
            return;
        }
        $quickBonus = QuickBonus::where('user_id', $this->id)->first();
        $neverReceived = $quickBonus->status === 'created';
        if (!$neverReceived) {
            return;
        }
        $quickBonusDate = Carbon::parse($quickBonus->created_at);
        $quickBonusValue = Campaign::quick_bonus_value_time();
        $quickBonusValueTime = Carbon::parse($quickBonus->created_at)
            ->addDays($quickBonusValue);
        
        $now = Carbon::now();
        $isOnTime = $now <= $quickBonusValueTime;
        if (!$isOnTime) {
            return;
        }
        $quick_bonus_value_target = (integer)Campaign::quick_bonus_value_target();
        $currentSum = MarketingTransaction::where('wallet_id', $this->wallet->id)
            ->whereDate('created_at', '<=', $quickBonusValueTime)
            ->whereDate('created_at', '>=', $quickBonusDate)
            ->sum('amount');
        if ($quick_bonus_value_target > $currentSum) {
            return;
        }
        $quick_bonus_value_interest = (double)Campaign::quick_bonus_value_interest();
        return $currentSum * $quick_bonus_value_interest;
    }

    public function maxMarketingLevel()
    {
        $maxLevel = SubscriptionTransaction::where('wallet_id', 1)
            ->join('products', 'products.id', '=', 'subscription_transactions.product_id')
            ->orderBy('marketing', 'DESC')->first();
        return $maxLevel ? $maxLevel->marketing : 0;
    }


    public function isAdmin()
    {
        return $this->roles()->where('name', 'Admin')->exists();
    }

    public function isUser()
    {
        return $this->roles()->where('name', 'User')->exists();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    private function getPartnersValue($partners)
    {
        $partners_value = 0;
        foreach ($partners as $partner) {
            $partners_value += $partner->child()->first()
                ->wallet
                ->subscriptionTransactions()
                ->whereMonth('created_at', Carbon::now()->month)
                ->sum('amount');
        }
        return $partners_value;
    }

    public function pull_status()
    {
        $marketing = $this->marketing();
        $first_partners = $marketing['first_partners'];
        $first_pull_value = $marketing['first_pull_value'];
        $second_partners = $marketing['second_partners'];
        $second_pull_value = $marketing['second_pull_value'];
        $first_and_second_pull_value = $first_pull_value + $second_pull_value;

        if ($first_pull_value >= Campaign::first_pull_target()) {
            if ($second_partners >= Campaign::second_partners_count_target()) {
                return 3;
            }
            if ($first_partners >= Campaign::first_partners_count_target()) {
                return 2;
            }
            if ($first_pull_value >= Campaign::first_pull_target() && $first_and_second_pull_value > Campaign::first_and_second_pull_target()) {
                return 1;
            }
        }
        return 0;
    }

    public function hasMonthlyBonus()
    {
        return MonthlyBonus::where('user_id', $this->id)->whereMonth('created_at', Carbon::now()->month)->count() > 0;
    }

    public function marketing()
    {
        $first_partners = $this->partners()
            ->where('level', 1)
            ->whereMonth('created_at', Carbon::now()->month)
            ->get();
        $second_partners = $this->partners()
            ->where('level', 2)
            ->whereMonth('created_at', Carbon::now()->month)
            ->get();
        $first_partners_count = $first_partners->count();
        $second_partners_count = $second_partners->count();

        $first_partners_value = $this->getPartnersValue($first_partners);

        $second_partners_value = $this->getPartnersValue($second_partners);

        return [
            'first_partners' => $first_partners_count,
            'first_pull_value' => $first_partners_value,
            'second_partners' => $second_partners_count,
            'second_pull_value' => $second_partners_value,
        ];
    }

    public function sponsor()
    {
        return $this->hasOne(Partner::class, 'child_id');
    }

    public function partners()
    {
        return $this->hasMany(Partner::class, 'parent_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
