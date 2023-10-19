<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\Models\Partner;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('sanctum')->user();
        return PartnerResource::collection(Partner::where('parent_id', $user->id)->orderBy('created_at', 'asc')->paginate(10));
    }

    public function getMaxLevel() {
        $user = auth('sanctum')->user();
        $max_level = Partner::where('parent_id', $user->id)->max('level');
        return response()->json(['max_level' => $max_level]);
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
        $user = auth('sanctum')->user();
        return PartnerResource::collection(Partner::where('parent_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->where('level', $id)
            ->paginate(10)
        );
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
