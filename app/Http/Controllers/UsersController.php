<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function listUsers()
    {
        $users = User::all();

        return $users;
    }
}
