<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate(
            request(),
            [

                'email' => [
                    'required',
                    Rule::exists('users', 'email')->where(function ($q) {
                        return $q->whereNull('deleted_at')->where('is_active', 1);
                    })
                ],
                'password' => 'required|min:8',
            ]
        );
        $credentials = request()->only(['email', 'password']);
        if (Auth::attempt($credentials, true)) {
            $user = Auth::user();
            $user->setAppends(['all_permissions']);
            $token = $user->createToken('User Token');

            return ['user' => $user, 'token' => $token];
        } else {
            return response()->json([
                'message' => trans('auth.failed'),
            ], 401);
        }
    }
}
