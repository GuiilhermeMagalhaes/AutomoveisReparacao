<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarcacaoController;



Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/criarmarcacao', [MarcacaoController::class, 'createMarcacao'])->name('criarmarcacao')->middleware('auth');

Route::post('/criarmarcacao', [MarcacaoController::class, 'storeMarcacao'])->name('criarmarcacao.store')->middleware('auth');

Route::get('/marcacoes-cliente', [MarcacaoController::class, 'listarMarcacoesCliente'])->name('clientemarcacoes')->middleware('auth');

Route::patch('/cliente/marcacoes/{id}/cancelar', [MarcacaoController::class, 'cancelarMarcacao'])
    ->name('clientemarcacao.cancelar')
    ->middleware('auth');

//users routes:

Route::get('/register', [RegisterController::class, 'show'])->name('register');
    
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'show'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.store');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');