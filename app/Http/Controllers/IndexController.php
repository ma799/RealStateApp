<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(){
        // dd(Auth::user());
        return inertia(
            'Index/index'
            ,['message' => 'hello from laravel']
        );
    }
    public function show(){
        return inertia('Index/show');
    }
}
