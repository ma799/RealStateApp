<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return inertia('Index/Index');
    
// });


Route::get('/',[IndexController::class,'index']);
Route::get('/show',[IndexController::class,'show']);
Route::resource('listing',ListingController::class)->except(['show','index'])->middleware('auth');
Route::resource('listing',ListingController::class)->only(['show','index']);

Route::get('/login',[AuthController::class,'create'])->name('login');
Route::post('/login',[AuthController::class,'store'])->name('login.store');
Route::delete('/login',[AuthController::class,'create'])->name('login');//Problem
Route::delete('/logout',[AuthController::class,'destroy'])->name('logout');

Route::resource('user-account',UserAccountController::class)->only('create','store');