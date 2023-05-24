<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() // get the notifications from the database
    {
        $notifications = auth()->user()->notifications->sortByDesc('created_at')->take(4);
        $items = array_values($notifications->toArray()); // convert the notifications collection to array to send it in the response sorted by created_at

        return response()->json(['notifications' => $items]);
    }
}
