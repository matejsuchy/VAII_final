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

//INDEX
Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Auth::routes();

// PROFILE
Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');

Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');

Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');

// FEEDBACK
Route::get('/feedback', [App\Http\Controllers\FeedbackController::class, 'index'])->name('feedback.index');

Route::get('/feedback/{feedback}', [App\Http\Controllers\FeedbackController::class, 'getFeedbackById'])->name('feedback.show');

Route::put('/feedback', [App\Http\Controllers\FeedbackController::class, 'update'])->name('feedback.update');

Route::delete('/feedback/{feedback}', [App\Http\Controllers\FeedbackController::class, 'destroy']);

Route::post('/feedback', [App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback.store');

// RECORDS
Route::get('/records/{record}', [App\Http\Controllers\RecordController::class, 'show'])->name('records.show');

Route::get('/records', [App\Http\Controllers\RecordController::class, 'index'])->name('records.index');

// INFO
Route::get('/info',  function () {
    return view('info');
})->name('info');

// CONTACT
Route::get('/contact', function () {
    return view('contact');
})->name('contact');