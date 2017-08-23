<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Tymon\JWTAuth\Exception\JWTException;
use JWTAuth;

class UserController extends Controller
{
    public function signin(Request $request) {
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required'
    		]);
        $credentials = $request->only('email', 'password');
    	try {
    		if(!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'These credentials do not match our records.'
                    ], 401);
            }
    	} catch (JWTException $e) {
    		return response()->json([
                'error' => 'could not create token!'
                ], 500);
    	}
        return response()->json([
            'token' => $token
            ], 200);
    }
}
