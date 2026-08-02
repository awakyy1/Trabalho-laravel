<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\CommentController;
use App\Http\Controllers\Student\SubmissionController;
use App\Http\Controllers\Student\TeamController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [TeamController::class, 'index'])->name('dashboard');
    Route::resource('teams', TeamController::class)->only(['index', 'create', 'store', 'show']);
    Route::resource('submissions', SubmissionController::class)->only(['store', 'show']);
    Route::post('comments', CommentController::class)->name('comments.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
