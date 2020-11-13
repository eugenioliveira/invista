<?php

use App\Http\Controllers\AllotmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LotsController;
use App\Http\Controllers\LotsImportController;
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
    Route::get('/allotments', [AllotmentController::class, 'index'])
        ->middleware('can:view_allotments')
        ->name('allotments.index');

    // Formulário de criação
    Route::get('/allotments/create', [AllotmentController::class, 'create'])
        ->middleware('can:create_allotment')
        ->name('allotment.create');

    // Formulário de edição
    Route::get('/allotments/edit/{allotment}', [AllotmentController::class, 'edit'])
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

    // Página inicial do sistema
    Route::get('/brokers', function () {
        return view('home');
    })->name('brokers.index');

    // Página inicial do sistema
    Route::get('/clients', function () {
        return view('home');
    })->name('clients.index');

    // Página inicial do sistema
    Route::get('/sales', function () {
        return view('home');
    })->name('sales.index');


});
