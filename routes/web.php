<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;


Route::get('/', function () {
    return view('home');
})->name('home');



//users routes:

Route::get('/register', [RegisterController::class, 'show'])->name('register');
    
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'show'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.store');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');