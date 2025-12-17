<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\EmployeController;


Route::middleware('auth.check')->group(function () {
    Route::get('/register', [AuthController::class, 'register_show'])->name('register.show');
    Route::get('/login', [AuthController::class, 'login_show'])->name('login.show');

    Route::post('/register', [AuthController::class, 'register'])->name('register.action');
    Route::post('/login', [AuthController::class, 'login'])->name('login.action');
});

Route::middleware(['auth.identify', 'auth.employer'])->group(function () {
    Route::get('/employee', [EmployeController::class, 'index'])->name('employer.index');
    Route::get('/employee/quest', [EmployeController::class, 'quest'])->name('employer.quest');
    Route::post('/employee/quest', [EmployeController::class, 'store_quest'])->name('quest.store');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth.identify', 'auth.worker'])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('main.index');
    Route::get('/quest', [MainController::class, 'quest'])->name('main.quest');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


