<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Clients\WestWallet;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\DepositTransactionResource;
use App\Http\Resources\DepositMethodResource;
use App\Models\DepositMethod;
use App\Models\Transactions\DepositTransaction;
use Illuminate\Http\Request;

class DepositMethodController extends Controller
{

    protected $client = '';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new WestWallet(
            config('services.westwallet.public'),
            config('services.westwallet.private')
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DepositMethodResource::collection(DepositMethod::all());
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
        $depositMethod = DepositMethod::findOrFail($id);
        return new DepositMethodResource($depositMethod);
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
