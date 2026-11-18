<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->middleware('throttle:login')->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::get('/', [TeacherController::class, 'index'])->name('home');
    Route::resource('teachers', TeacherController::class)->except('show');
});
