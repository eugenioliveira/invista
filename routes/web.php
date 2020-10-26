<?php

use App\Http\Controllers\AllotmentController;
use App\Http\Controllers\LotsController;
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
    Route::get('/allotment/create', [AllotmentController::class, 'create'])
        ->name('allotment.create');

    // Formulário de edição
    Route::get('/allotment/edit/{allotment}', [AllotmentController::class, 'edit'])
        ->name('allotment.edit');

    //======================================================================

    //======================================================================
    // ROTAS REFERENTES À LOTES
    //======================================================================

    // Lista de lotes
    Route::get('/allotment/{allotment}/lots', [LotsController::class, 'index'])
        ->name('lots.index');

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
