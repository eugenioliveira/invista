<?php

use App\Http\Controllers\AllotmentController;
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

    // Página inicial do sistema
    Route::get('/', function () {

        return view('home.index', [
            'allotmentCount' => \App\Models\Allotment::count()
        ]);

    })->name('home');

    //======================================================================
    // ROTAS REFERENTES À LOTEAMENTOS
    //======================================================================

    // Lista de loteamentos
    Route::get('/allotments', [AllotmentController::class, 'index'])
        ->name('allotments.index');

    // Formulário de criação
    Route::get('/allotments/create', [AllotmentController::class, 'create'])
        ->name('allotment.create');

    // Formulário de edição
    Route::get('/allotments/edit/{allotment}', [AllotmentController::class, 'edit'])
        ->name('allotment.edit');

    //======================================================================

    //======================================================================
    // ROTAS REFERENTES À LOTES
    //======================================================================

    // Lista de lotes
    Route::get('/allotments/{allotment}/lots', [LotsController::class, 'index'])
        ->name('lots.index');

    // Formulário de criação
    Route::get('/allotments/{allotment}/lot/create', [LotsController::class, 'create'])
        ->name('lot.create');

    // Formulário de edição
    Route::get('/allotments/lot/{lot}/edit', [LotsController::class, 'edit'])
        ->name('lot.edit');

    // Importação de lotes
    Route::get('/allotments/{allotment}/lots/import', [LotsImportController::class, 'create'])
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
