<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SubscriptionTransactionResource;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Transactions\SubscriptionTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function buy($id)
    {
        $product = Product::findOrFail($id);
        $user = auth('sanctum')->user();
        $transaction = SubscriptionTransaction::create([
            'product_id' => $product->id,
            'wallet_id' => $user->wallet->id,
            'amount' => $product->price,
            'status' => 'completed',
            'product_key' => Str::uuid(),
            'expires_at' => Carbon::now()->addMonths($product->period),
        ]);
        $user->wallet->decrementBalance($transaction);
        return new SubscriptionTransactionResource($transaction);
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
        $product = Product::findOrFail($id);
        return new ProductResource($product);
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
