<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
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
}
