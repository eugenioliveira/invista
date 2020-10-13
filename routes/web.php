<?php

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

Route::middleware('auth:sanctum')->group(function() {

    // Página inicial do sistema
    Route::get('/', function () {
        return view('home.index');
    })->name('home');

    // Página inicial do sistema
    Route::get('/allotments', function () {
        return view('home');
    })->name('allotments.index');

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
