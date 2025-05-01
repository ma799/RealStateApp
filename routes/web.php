<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;


Route::get('/',[IndexController::class,'index']);
Route::get('/show',[IndexController::class,'show']);

Route::resource('listing',ListingController::class)->only(['show','index']);

Route::get('/login',[AuthController::class,'create'])->name('login');
Route::post('/login',[AuthController::class,'store'])->name('login.store');
Route::delete('/login',[AuthController::class,'create'])->name('login');//Problem
Route::delete('/logout',[AuthController::class,'destroy'])->name('logout');

Route::resource('user-account',UserAccountController::class)->only('create','store');

Route::prefix('realtor')->name('realtor.')->middleware('auth')
->group(function () {
    Route::put('listing/{listing}/restore',[RealtorListingController::class,'restore'])->name('listing.restore')->withTrashed();   //best practice to be ar the top of the resource
    Route::resource('listing',RealtorListingController::class)->except(['show'])->withTrashed();
    Route::resource('listing.image',RealtorListingImageController::class)->only(['create','store','destroy']);
    });