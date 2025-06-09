<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;

class NotificationController extends Controller
{
    public function index(Request $request) : Response
    {
        return inertia(
            'Notification/index',
            [
                'notifications' => $request->user()->notifications()->paginate(10)
            ]
        );
    }
}
