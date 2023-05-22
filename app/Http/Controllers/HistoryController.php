<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::find(auth()->id());
        $videos_in_history = $user->history()->get();
        $title = __('سجل المشاهدة');

        return view('history.index', compact('videos_in_history', 'title'));
    }
}
