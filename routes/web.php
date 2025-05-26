<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\CommentController;
use App\Http\Controllers\Student\TeamController;
use App\Http\Controllers\Student\SubmissionController;



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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('teams',    App\Http\Controllers\TeamFrontController::class);
    Route::resource('submissions', App\Http\Controllers\SubmissionFrontController::class);

    Route::get('/dashboard', [TeamController::class, 'index'])->name('dashboard');
    Route::resource('teams', TeamController::class)->only(['index','create','store','show']);
    Route::resource('submissions', SubmissionController::class)->only(['create','store','show']);
    Route::resource('teams', TeamController::class)->only(['index','create','store','show']);

    Route::resource('submissions', SubmissionController::class)->only(['create','store','show']);

    Route::post('comments', CommentController::class)->name('comments.store');
});

require __DIR__.'/auth.php';
