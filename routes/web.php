<?php

use App\Http\Controllers\AllotmentsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\CompanyAddressController;
use App\Http\Controllers\CompanyShareholdersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LotsController;
use App\Http\Controllers\LotsImportController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PersonAddressController;
use App\Http\Controllers\PersonDetailController;
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

    // Atualizar informações de usuários
    Route::get('/user/{user}/edit', [UsersController::class, 'edit'])
        ->middleware('can:edit,user')
        ->name('user.edit');

    //======================================================================

    //======================================================================
    // ROTAS REFERENTES À PESSOAS FÍSICAS
    //======================================================================

    // Listagem de pessoas físicas
    Route::get('/people', [PeopleController::class, 'index'])
        ->middleware('can:view_people')
        ->name('people.index');

    // Formulário de cadastro de pessoa física
    Route::get('/person/create', [PeopleController::class, 'create'])
        ->middleware('can:create_person')
        ->name('person.create');

    // Formulário de edição de pessoa física
    Route::get('/person/{person}/edit', [PeopleController::class, 'edit'])
        ->middleware('can:edit,person')
        ->name('person.edit');

    // Formulário de edição de endereço de pessoa física
    Route::get('/person/{person}/address', PersonAddressController::class)
        ->middleware('can:edit,person')
        ->name('person.address');

    // Formulário de edição de detalhes de pessoa física
    Route::get('/person/{person}/detail', PersonDetailController::class)
        ->middleware('can:edit,person')
        ->name('person.detail');

    //======================================================================

    //======================================================================
    // ROTAS REFERENTES À PESSOAS JURÍDICAS
    //======================================================================

    // Listagem de pessoas jurídicas
    Route::get('/companies', [CompaniesController::class, 'index'])
        ->middleware('can:view_companies')
        ->name('companies.index');

    // Formulário de criação de pessoa jurídica
    Route::get('/company/create', [CompaniesController::class, 'create'])
        ->middleware('can:create_company')
        ->name('companies.create');

    // Formulário de edição de pessoa jurídica
    Route::get('/company/{company}/edit', [CompaniesController::class, 'edit'])
        ->middleware('can:edit,company')
        ->name('company.edit');

    // Formulário de edição de sócios da pessoa jurídica
    Route::get('/company/{company}/shareholders', CompanyShareholdersController::class)
        ->middleware('can:edit,company')
        ->name('company.shareholders');

    // Formulário de edição de endereço de pessoa jurídica
    Route::get('/company/{company}/address', CompanyAddressController::class)
        ->middleware('can:edit,company')
        ->name('company.address');
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
