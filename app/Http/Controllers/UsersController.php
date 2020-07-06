<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    

    public function getUsers(){
        $users = User::where('id', '>=', 1)->get();
        return response()->json($users);
    }

    public function getCurrentUser(){
        $user = User::find(Auth::user())->first();
        return response()->json($user);
    }
}
