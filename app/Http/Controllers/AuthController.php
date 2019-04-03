<?php

namespace Journey\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Journey\User;

class AuthController extends Controller
{
    /**
     * Register user request then persist if input is valid 
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), User::$registrationRules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        $request['password'] = Hash::make($request['password']);
        
        $user = User::create($request->toArray());

        $token = $user->createToken('Journey Password Grant Client')->accessToken;

        $response = ['token' => $token];

        return response()->json($response, 201);
    }

    /**
     * Inspect request to properly login user to the application's APIs
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Journey Password Grant Client')->accessToken;

                $response = ['token' => $token];

                return response()->json($response, 200);
            } else {
                $response = 'Password Mismatch';
                
                return response()->json($response, 422);
            }
        } else {
            $response = 'User doesn\'t exist';
            
            return response()->json($response, 422);
        }
    }

    /**
     * Revoke access token upon user request to act as logout
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $requestLogout = $request->user()->token()->revoke();

        if ($requestLogout) {
            return response()->json("You've been successfully logged out.");
        }

        return response()->json("Failed to log out from the application. Please try again.", 422);
    }
}