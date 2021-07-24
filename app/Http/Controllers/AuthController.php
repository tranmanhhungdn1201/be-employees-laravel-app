<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $token_validity = 1;

        $this->guard()->factory()->setTTL($token_validity);
        if(!$token = $this->guard()->attempt($validator->validate())) {
            return response()->json(['error' => $token], 401);
        }

        return $this->responseWithToken($token);
    }

    public function logout() {
        $this->guard()->logout();

        return response()->json(['message' => 'User logged out successfully']);
    }

    public function refresh() {
        return $this->responseWithToken($this->guard()->refresh());
    }

    protected function responseWithToken($token) {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'token_validity' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    protected function guard() {
        return Auth::guard();
    }
}
