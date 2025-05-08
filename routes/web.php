<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\RealtorListingOfferAcceptController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\VerificationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/',[IndexController::class,'index']);
Route::get('/show',[IndexController::class,'show']);

Route::resource('listing',ListingController::class)->only(['show','index']);
Route::resource('listing.offer', ListingOfferController::class)
   ->middleware('auth')
   ->only(['store']);

Route::get('/login',[AuthController::class,'create'])->name('login');
Route::post('/login',[AuthController::class,'store'])->name('login.store');
Route::delete('/login',[AuthController::class,'create'])->name('login');//Problem
Route::delete('/logout',[AuthController::class,'destroy'])->name('logout');
Route::resource('user-account',UserAccountController::class)->only('create','store');

//  Email verification routes
// Route::get('/email/verify',function(){
//       return inertia('Auth/VerifyEmail');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//       $request->fulfill();
   
//       return redirect()->route('listing.index')->with('success','Email verified successfully !');
//   })->middleware(['auth', 'signed'])->name('verification.verify');

//   Route::post('/email/verification-notification', function (Request $request) {
//       $request->user()->sendEmailVerificationNotification();
   
//       return back()->with('success', 'Verification link sent!');
//   })->middleware(['auth', 'throttle:6,1'])->name('verification.send');


  Route::name('verification.')->prefix('email')->group(
    function(){
        Route::get('verify',[VerificationController::class,'notice'])->name('notice');
        Route::get('verify/{id}/{hash}',[VerificationController::class,'verify'])->name('verify');
        Route::post('verification-notification',[VerificationController::class,'send'])->name('send')->middleware(['throttle:6,1']);
    }
  )->middleware('auth');

// Notification routes
Route::resource('notification',NotificationController::class)->middleware('auth')->only(['index']);
Route::put('notification/{notification}/seen',NotificationSeenController::class)
->name('notification.seen')->middleware('auth');

// Realtor routes
Route::prefix('realtor')->name('realtor.')->middleware(['auth','verified'])
->group(function () {
    Route::put('listing/{listing}/restore',[RealtorListingController::class,'restore'])->name('listing.restore')->withTrashed();   //best practice to be ar the top of the resource
    Route::resource('listing',RealtorListingController::class)->withTrashed();
    Route::put('offer/{offer}/accept')->name('offer.accept')->uses(RealtorListingOfferAcceptController::class);
    Route::resource('listing.image',RealtorListingImageController::class)->only(['create','store','destroy']);
    });