<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function create(){
        return inertia('UserAccount/Create');
    }

    public function store(Request $request){
       $user = User::create( $request->validate([
            'name' =>'required',
            'email' =>'required|unique:users|email',
            'password' =>'required|min:8|confirmed',
         ]));

         Auth::login($user);
         event(new Registered($user));
         return redirect()->route('listing.index')->with('success','Account Created Successfully');
    }
}
