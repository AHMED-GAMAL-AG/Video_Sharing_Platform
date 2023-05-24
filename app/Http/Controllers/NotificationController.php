<?php

namespace App\Http\Controllers;

use App\Models\Alert;
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

        $alert = Alert::where('user_id', auth()->user()->id)->first(); // select the user's alert from the database
        $alert->alert = 0; // when click on the notification icon the alert column will be 0
        $alert->save();

        return response()->json(['notifications' => $items]);
    }

    public function allNotifications()
    {
        $notifications = auth()->user()->notifications->sortByDesc('created_at');
        $title = __('جميع الإشعارات :');

        return view('notifications.show', compact('notifications', 'title'));
    }
}
