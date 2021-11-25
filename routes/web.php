<?php

use App\Http\Controllers\AllotmentsController;
use App\Http\Controllers\AllotmentsPaymentPlansController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\CompanyAddressController;
use App\Http\Controllers\CompanyShareholdersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LotsController;
use App\Http\Controllers\LotsImportController;
use App\Http\Controllers\PaymentPlansController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PersonAddressController;
use App\Http\Controllers\PersonDetailController;
use App\Http\Controllers\ProposalReportController;
use App\Http\Controllers\ProposalsController;
use App\Http\Controllers\UsersController;
use App\Models\Proposal;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationsController;

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
        ->can('view_allotments')
        ->name('allotments.index');

    // Formulário de criação
    Route::get('/allotments/create', [AllotmentsController::class, 'create'])
        ->can('create_allotment')
        ->name('allotment.create');

    // Formulário de edição
    Route::get('/allotments/edit/{allotment}', [AllotmentsController::class, 'edit'])
        ->can('edit_allotment')
        ->name('allotment.edit');

    // Planos de pagamento
    Route::get('/allotments/{allotment}/payment-plans', AllotmentsPaymentPlansController::class)
        ->can('edit_allotment')
        ->name('allotment.payment-plans');

    //======================================================================
    // ROTAS REFERENTES À LOTES
    //======================================================================

    // Lista de lotes
    Route::get('/allotments/{allotment}/lots', [LotsController::class, 'index'])
        ->can('view_lots')
        ->name('lots.index');

    // Formulário de criação
    Route::get('/allotments/{allotment}/lot/create', [LotsController::class, 'create'])
        ->can('create_lot')
        ->name('lot.create');

    // Formulário de edição
    Route::get('/allotments/lot/{lot}/edit', [LotsController::class, 'edit'])
        ->can('edit_lot')
        ->name('lot.edit');

    // Importação de lotes
    Route::get('/allotments/{allotment}/lots/import', [LotsImportController::class, 'create'])
        ->can('import_lots')
        ->name('lots.import');

    //======================================================================
    // ROTAS REFERENTES À USUÁRIOS (CORRETORES, ADMINS, SUPERVISORES)
    //======================================================================

    // Listagem de usuários
    Route::get('/users', [UsersController::class, 'index'])
        ->can('view_users')
        ->name('users.index');

    // Criar usuários
    Route::get('/users/create', [UsersController::class, 'create'])
        ->can('create_user')
        ->name('users.create');

    // Atualizar informações de usuários
    Route::get('/user/{user}/edit', [UsersController::class, 'edit'])
        ->can('edit', 'user')
        ->name('user.edit');

    //======================================================================
    // ROTAS REFERENTES À PESSOAS FÍSICAS
    //======================================================================

    // Listagem de pessoas físicas
    Route::get('/people', [PeopleController::class, 'index'])
        ->can('view_people')
        ->name('people.index');

    // Formulário de cadastro de pessoa física
    Route::get('/person/create', [PeopleController::class, 'create'])
        ->can('create_person')
        ->name('person.create');

    // Formulário de edição de pessoa física
    Route::get('/person/{person}/edit', [PeopleController::class, 'edit'])
        ->can('edit', 'person')
        ->name('person.edit');

    // Formulário de edição de endereço de pessoa física
    Route::get('/person/{person}/address', PersonAddressController::class)
        ->can('edit', 'person')
        ->name('person.address');

    // Formulário de edição de detalhes de pessoa física
    Route::get('/person/{person}/detail', PersonDetailController::class)
        ->can('edit', 'person')
        ->name('person.detail');

    //======================================================================
    // ROTAS REFERENTES À PESSOAS JURÍDICAS
    //======================================================================

    // Listagem de pessoas jurídicas
    Route::get('/companies', [CompaniesController::class, 'index'])
        ->can('view_companies')
        ->name('companies.index');

    // Formulário de criação de pessoa jurídica
    Route::get('/company/create', [CompaniesController::class, 'create'])
        ->can('create_company')
        ->name('companies.create');

    // Formulário de edição de pessoa jurídica
    Route::get('/company/{company}/edit', [CompaniesController::class, 'edit'])
        ->can('edit', 'company')
        ->name('company.edit');

    // Formulário de edição de sócios da pessoa jurídica
    Route::get('/company/{company}/shareholders', CompanyShareholdersController::class)
        ->can('edit', 'company')
        ->name('company.shareholders');

    // Formulário de edição de endereço de pessoa jurídica
    Route::get('/company/{company}/address', CompanyAddressController::class)
        ->can('edit', 'company')
        ->name('company.address');

    //======================================================================
    // ROTAS REFERENTES À RESERVAS
    //======================================================================

    // Listar todas as reservas
    Route::get('/reservations', [ReservationsController::class, 'index'])
        ->can('view_reservations')
        ->name('reservations.index');

    // Formulário de realização de reserva
    Route::get('/lots/{lot}/reserve', [ReservationsController::class, 'create'])
        ->can('make_reservation')
        ->can('create', [Reservation::class, 'lot'])
        ->name('lot.reserve');

    // Cancelamento de uma reserva
    Route::get('/reservation/{reservation}/cancel', [ReservationsController::class, 'cancel'])
        ->can('make_reservation')
        ->name('reservation.cancel');

    //======================================================================
    // ROTAS REFERENTES À PROPOSTAS
    //======================================================================

    // Listagem de propostas
    Route::get('/proposals', [ProposalsController::class, 'index'])
        ->can('view_proposals')
        ->name('proposals.index');

    // Formulário de lançamento de proposta
    Route::get('/lots/{lot}/propose', [ProposalsController::class, 'create'])
        ->can('propose')
        ->can('create', [Proposal::class, 'lot'])
        ->name('lot.propose');

    // Geração de propostas em PDF
    Route::get('/proposal/{proposal}', [ProposalReportController::class, 'show'])
        ->can('view_proposals')
        ->name('proposal.show');

    //======================================================================
    // ROTAS REFERENTES À PLANOS DE PAGAMENTO
    //======================================================================

    // Listagem de planos de pagamento
    Route::get('/payment-plans', [PaymentPlansController::class, 'index'])
        ->can('manage_payment_plans')
        ->name('payment-plans.index');

    // Criação de um plano de pagamento
    Route::get('/payment-plans/create', [PaymentPlansController::class, 'create'])
        ->can('manage_payment_plans')
        ->name('payment-plans.create');

    // Alteração de dados de um plano de pagamento
    Route::get('/payment-plans/{plan}/edit', [PaymentPlansController::class, 'edit'])
        ->can('manage_payment_plans')
        ->name('payment-plans.edit');

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
