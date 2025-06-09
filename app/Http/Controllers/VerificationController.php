<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function notice()
    {
        return inertia('Auth/VerifyEmail');
    }
    
    public function verify(EmailVerificationRequest $request, $id, $hash)
    {
        $request->fulfill();

        return redirect()->route('listing.index')->with('success', 'Email verified successfully!');
    }
    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Verification link sent!');
    }
}
