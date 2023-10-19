<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SwitchUserController extends Controller
{
    public function switch($id) {
        Auth::loginUsingId($id);
        return ['ok' => true];
    }

    public function logout() {
        $user_id = Session::get('user_id');
        Auth::loginUsingId($user_id);
        return ['ok' => true];
    }
}
