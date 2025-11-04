<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/login", [UserController::class, 'login'])->name('users.login');
Route::get("/register", [UserController::class, 'register'])->name('users.register');

Route::get('/', function () {
    return view('welcome');
});
