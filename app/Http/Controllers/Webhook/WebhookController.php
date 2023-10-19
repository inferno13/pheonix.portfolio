<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Transactions\DepositTransaction;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class WebhookController extends Controller
{
    private $allowed_ips = array('89.109.44.207', '139.28.31.82', '5.189.219.250');
    protected $client = '';
    private $mapTickerToId = array(
        'BTC' => 'bitcoin',
        'USDT' => 'tether',
        'USDTTRC' => 'tether',
        'DOGE' => 'dogecoin',
        'TRX' => 'tron',
        'ETH' => 'ethereum',
        'XRP' => 'ripple',
        'LTC' => 'litecoin'
    );
    public function __construct()
    {
        $this->client = new CoinGeckoClient();
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }

    public function address(Request $request) {
        if (!in_array($this->getIp(), $this->allowed_ips)) {
            return abort(403);
        }
        $transaction = DepositTransaction::findOrFail((int)$request['label']);
        if ($transaction->status === 'completed') {
            return 'ok';
        }
        $transaction->update([
            'dest_tag' => $request['dest_tag'],
            'westwallet_id' => $request['id'],
            'amount' => $request['amount'],
            'status' => $request['status']
        ]);
        $transaction->save();
        if ($transaction->status == 'completed') {
            $cur_id = $this->mapTickerToId[$request['currency']];
            $exchange = $this->client->simple()->getPrice($cur_id, 'usd')[$cur_id]['usd'];
            $amount_in_usd = $request['amount'] * $exchange;
            $user = $transaction->user;
            $wallet = $user->wallet;
            $wallet->incrementBalance($amount_in_usd); 
        }
    } 
}
