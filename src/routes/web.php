<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Auth::routes();

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');

Route::get('/feedback', [App\Http\Controllers\FeedbackController::class, 'index'])->name('feedback.index');

Route::get('/feedback/{feedback}', [App\Http\Controllers\FeedbackController::class, 'getFeedbackById'])->name('feedback.show');

Route::put('/feedback', [App\Http\Controllers\FeedbackController::class, 'update'])->name('feedback.update');

Route::delete('/feedback/{feedback}', [App\Http\Controllers\FeedbackController::class, 'destroy']);


Route::post('/feedback', [App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback.store');

Route::get('/records/{record}', [App\Http\Controllers\RecordController::class, 'show'])->name('records.show');

Route::get('/records', [App\Http\Controllers\RecordController::class, 'index'])->name('records.index');

Route::get('/info',  function () {
    return view('info');
})->name('info');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');