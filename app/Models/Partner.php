<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id', 'child_id', 'level'
    ];

    public function parent() {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function child() {
        return $this->belongsTo(User::class, 'child_id');
    }

    public static function create($data)
    {
        $parentOfParent = self::where('child_id', $data['parent_id'])->first();
        if ($parentOfParent) {
            self::create([
                'parent_id' => $parentOfParent->parent_id,
                'child_id' => $data['child_id'],
                'level' => $parentOfParent->level + 1
            ]);
        }
        $partner = static::query()->create($data);
        return $partner;
    }
}
