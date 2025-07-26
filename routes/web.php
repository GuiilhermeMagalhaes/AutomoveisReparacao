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

Route::get('/gestor/marcacoes', [App\Http\Controllers\GestorController::class, 'listarMarcacoesGestor'])->name('gestormarcacoes')->middleware('auth');    

Route::patch('/gestor/marcacoes/{id}/atribuir', [MarcacaoController::class, 'atribuirMecanico'])
    ->name('gestor.atribuirMecanico')
    ->middleware('auth');
    




//users routes:

Route::get('/register', [RegisterController::class, 'show'])->name('register');
    
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'show'])->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.store');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/gestor/utilizadores', [App\Http\Controllers\GestorController::class, 'listarUtilizadores'])->name('gestor.utilizadores')->middleware('auth');

Route::patch('/gestor/utilizadores/{id}/tornar-mecanico', [App\Http\Controllers\GestorController::class, 'tornarMecanico'])->name('gestor.utilizadores.tornarMecanico')->middleware('auth');

Route::get('/gestor/mecanicos', [App\Http\Controllers\GestorController::class, 'listarMecanicos'])->name('gestor_mecanicos')->middleware('auth');

Route::patch('/gestor/mecanicos/{id}/atribuir-oficina', [App\Http\Controllers\GestorController::class, 'atribuirOficina'])
    ->name('gestor.atribuirOficina')
    ->middleware('auth');

Route::delete('/gestor/mecanicos/{id}/remover', [App\Http\Controllers\GestorController::class, 'removerMecanico'])
->name('gestor.removerMecanico')
->middleware('auth');


Route::get('/mecanico/marcacoes', [App\Http\Controllers\MecanicoController::class, 'verMarcacoes'])
    ->name('mecanico_marcacoes')
    ->middleware('auth');

Route::patch('/mecanico/marcacoes/{id}/concluir', [App\Http\Controllers\MecanicoController::class, 'concluirMarcacao'])
    ->name('mecanico_concluir')
    ->middleware('auth');