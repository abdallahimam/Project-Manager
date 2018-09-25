<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Validator;

class UsersApi extends Controller
{
    /**
     * method login
     */
    public function login() {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return response(['status' => 'error', 'message' => 'Invalid input data.']);
        } else {
            if (auth()->attempt(['email' => request('email'), 'password' => request('password')])) {
                $user = auth()->user();
                $user->api_token = str_random(100);
                $user->save();
                return response(['status' => 'success', 'user' => $user, 'token' => $user->api_token]);
            } else {
                return response(['status' => 'error', 'message' => 'the entered data invalid.']);
            }
        }
        return response(['_method' => 'GET', '_function' => 'login']);
    }
}
