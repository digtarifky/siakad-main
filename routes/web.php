<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('student.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('student', StudentController::class);