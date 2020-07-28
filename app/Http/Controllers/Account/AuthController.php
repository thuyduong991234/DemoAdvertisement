<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function username()
    {
        return 'login_id';
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'login_id' => 'required|email|exists:accounts,login_id',
            'login_pw' => 'required|string'
        ]);

        if($validator->fails())
        {
            return response($validator->errors(),422);
        }
        $credentials = $request->only('login_id', 'login_pw');

        if($token = auth('account')->attempt($credentials))
        {
            $payload = auth()->payload();
            return response(["message" => "Login successfully!",
                "guard" => "account",
                "token" => $token,
                "exp" => date("Y-m-d H:i:s", $payload('exp')),
                //'expires_in' => $this->guard()->factory()->getTTL() * 60
            ], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout()
    {
        auth()->logout();
        return response(["message" => "Logout successfully!"],200);
    }
}
