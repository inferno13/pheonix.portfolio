<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Telegram;
use Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if (Gate::allows('isAdmin') || (int)$id === (int)$user->id) {
            return new UserResource(User::findOrFail($id));
        }
        return abort(403);
    }

    public function me() {
        $user = auth('sanctum')->user();
        return new UserResource($user);
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
        $user = User::findOrFail($id);
        $user->update([
            'surname' => $request['surname'],
            'country_id' => $request['country'],
            'name' => $request['name'],
            'patronymic' => $request['patronymic'],
            'password' => Hash::make($request['password'])
        ]);
        
        if ($user->telegram) {
            $telegram = $user->telegram;
            $telegram->name = $request['telegram'];
            $telegram->save();
        }
        else {
            Telegram::create([
                'user_id' => $user->id,
                'name' => $request['telegram']
            ]);
        }
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }
        $user->save();
        return new UserResource($user);
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
