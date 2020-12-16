<?php

use App\Http\Controllers\AllotmentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LotsController;
use App\Http\Controllers\LotsImportController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    //======================================================================
    // PÁGINA INICIAL
    //======================================================================
    Route::get('/', [HomeController::class, 'index'])->name('home');

    //======================================================================
    // ROTAS REFERENTES À LOTEAMENTOS
    //======================================================================

    // Lista de loteamentos
    Route::get('/allotments', [AllotmentsController::class, 'index'])
        ->middleware('can:view_allotments')
        ->name('allotments.index');

    // Formulário de criação
    Route::get('/allotments/create', [AllotmentsController::class, 'create'])
        ->middleware('can:create_allotment')
        ->name('allotment.create');

    // Formulário de edição
    Route::get('/allotments/edit/{allotment}', [AllotmentsController::class, 'edit'])
        ->middleware('can:edit_allotment')
        ->name('allotment.edit');

    //======================================================================

    //======================================================================
    // ROTAS REFERENTES À LOTES
    //======================================================================

    // Lista de lotes
    Route::get('/allotments/{allotment}/lots', [LotsController::class, 'index'])
        ->middleware('can:view_lots')
        ->name('lots.index');

    // Formulário de criação
    Route::get('/allotments/{allotment}/lot/create', [LotsController::class, 'create'])
        ->middleware('can:create_lot')
        ->name('lot.create');

    // Formulário de edição
    Route::get('/allotments/lot/{lot}/edit', [LotsController::class, 'edit'])
        ->middleware('can:edit_lot')
        ->name('lot.edit');

    // Importação de lotes
    Route::get('/allotments/{allotment}/lots/import', [LotsImportController::class, 'create'])
        ->middleware('can:import_lots')
        ->name('lots.import');

    //======================================================================

    //======================================================================
    // ROTAS REFERENTES À USUÁRIOS (CORRETORES, ADMINS, SUPERVISORES)
    //======================================================================

    // Listagem de usuários
    Route::get('/users', [UsersController::class, 'index'])
        ->middleware('can:view_users')
        ->name('users.index');

    // Criar usuários
    Route::get('/users/create', [UsersController::class, 'create'])
        ->middleware('can:create_user')
        ->name('users.create');

    // Atualizar informações de usuários de usuários
    Route::get('/user/{user}/edit', [UsersController::class, 'edit'])
        ->middleware('can:edit,user')
        ->name('user.edit');

    //======================================================================

    // Página inicial do sistema
    Route::get('/clients', function () {
        return view('home');
    })->name('clients.index');

    // Página inicial do sistema
    Route::get('/sales', function () {
        return view('home');
    })->name('sales.index');


});
