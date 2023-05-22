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
        $videos_in_history = auth()->user()->history->sortByDesc('pivot.created_at');
        $title = __('سجل المشاهدة');

        return view('history.index', compact('videos_in_history', 'title'));
    }

    public function destroy($id)
    {

        auth()->user()->history()->wherePivot('id', $id)->detach();

        return back()->with('success', __('تم حذف المقطع من سجل المشاهدة'));
    }

    public function clear()
    {
        auth()->user()->history()->detach();

        return back()->with('success', __('تم حذف جميع المقاطع من سجل المشاهدة'));
    }
}
