<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;

Route::get('/register', [AuthController::class, 'register_show']);
Route::get('/login', [AuthController::class, 'login_show']);

Route::post('/register', [AuthController::class, 'register'])->name('register.action');
Route::post('/login', [AuthController::class, 'login'])->name('login.action');

Route::get('/', [MainController::class, 'index'])->name('index');
