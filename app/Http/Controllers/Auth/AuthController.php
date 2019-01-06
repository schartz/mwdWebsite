<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //extract data from request
        $data = $request->all();

        //validate
        $validator = Validator::make($data, [
            'name' => 'required|min:3|max:255|string',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|min:6|string|confirmed'

        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        //create user record in database
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);


        //return response to user
        return response()->json('Created user with id of '. $user->id, 200);
    }

    public function login(Request $request)
    {
        // extract data from the request
        $data = $request->all();

        //validate the data
        $validator = Validator::make($data, [
            'email' => 'required|email|string',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //do login for user
        $loginResult = Auth::attempt($data);

        if(!$loginResult) {
            return response()->json('Email and password combination does not match to any of our records.', 422);
        }

        //generate a token for this logged in user
        $user = $request->user();
        $tokenCreateResult = $user->createToken('AuthToken');
        $token = $tokenCreateResult->token;
        $token->save();

        // return the token
        return response()->json([
            'access_token' => $tokenCreateResult->accessToken,
            'token_type' => 'Bearer'
        ], 200);

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json('Successfully logged out', 200);
    }

    public function me(Request $request)
    {
        return $request->user();
    }
}
