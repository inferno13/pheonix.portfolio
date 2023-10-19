<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MarketingTransactionResource;
use App\Models\Transactions\BonusTransaction;
use Illuminate\Http\Request;

class MarketingTransactionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth('sanctum')->user();
        $wallet_id = $user->wallet->id;
        return MarketingTransactionResource::collection(BonusTransaction::where('wallet_id', $wallet_id)->orderBy('created_at', 'desc')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
