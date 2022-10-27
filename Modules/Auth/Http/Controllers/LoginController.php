<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate(
            [

                'email' => [
                    'required',
                    Rule::exists('users', 'email')->where(function ($q) {
                        return $q->whereNull('deleted_at');
                    })
                ],
                'password' => 'required|min:8',
            ]
        );
        $credentials = request()->only(['email', 'password']);
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {

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
