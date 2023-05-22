<?php

use App\Http\Controllers\{
    CommentController,
    HistoryController,
    LikeController,
    MainController,
    VideoController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('layouts.main');
    })->name('dashboard');
});

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/main/{channel}/videos' , [MainController::class, 'channelVideos'])->name('main.channels.videos');

Route::resource('/videos', VideoController::class);
Route::get('/video/search', [VideoController::class, 'search'])->name('video.search');
Route::post('/view', [VideoController::class, 'addView'])->name('view'); // for the ajax request

Route::post('/like', [LikeController::class, 'likeVideo'])->name('like'); // for the ajax request

Route::post('/comment', [CommentController::class, 'saveComment'])->name('comment'); // for the ajax request
Route::get('/comment/{id}/edit', [CommentController::class, 'edit'])->name('comment.edit');
Route::patch('/comment/{id}', [CommentController::class, 'update'])->name('comment.update');
Route::get('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');

Route::get('/history', [HistoryController::class , 'index'])->name('history');
Route::delete('/history/{id}', [HistoryController::class , 'destroy'])->name('history.destroy');
Route::delete('/history', [HistoryController::class , 'clear'])->name('history.clear');
