<?php

declare(strict_types = 1);

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Financial\FinancialAccountController;
use App\Http\Controllers\Financial\FinancialCategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Propostal\PropostalController;
use App\Http\Controllers\RealEstateSector\RealEstateSectorUserController;
use App\Http\Controllers\RealEstateSector\UserRealEstateSectorController;
use App\Http\Controllers\RealEstateSectorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth.token'])->group(function () {
    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/minha-conta', [ProfileController::class, 'index'])->name('my-profile');
    Route::put('/minha-conta/atualizar/{usuario}', [ProfileController::class, 'update'])->name('update.my-profile');
});

// Fianças
Route::middleware(['auth.token', 'check.category:Fianças'])->group(function () {
    Route::get('/adm/empresa', [CompanyController::class, 'index'])->name('company.index');
    Route::put('/adm/empresas/{empresa}', [CompanyController::class, 'update'])->name('company.store');
    Route::get('/adm/imobiliarias', [RealEstateSectorController::class, 'index'])->name('realestatesector.index');
    Route::get('/adm/imobiliarias/listagem', [RealEstateSectorController::class, 'listAll'])->name('realestatesector.listAll');
    Route::get('/adm/imobiliarias/setup/{setup}', [RealEstateSectorController::class, 'setup'])->name('realestatesector.setup');
    Route::get('/adm/imobiliarias/cadastrar', [RealEstateSectorController::class, 'create'])->name('realestatesector.create');
    Route::post('/adm/imobiliarias/cadastrar', [RealEstateSectorController::class, 'store'])->name('realestatesector.store');
    Route::get('/adm/imobiliarias/editar/{imobiliaria}', [RealEstateSectorController::class, 'edit'])->name('realestatesector.edit');
    Route::put('/adm/imobiliarias/editar/{imobiliaria}', [RealEstateSectorController::class, 'update'])
        ->name('realestatesector.update');
    Route::delete('/adm/imobiliarias/excluir/{imobiliaria}', [RealEstateSectorController::class, 'delete'])
        ->name('realestatesector.delete');

    Route::post('/adm/imobiliarias/cadastrar/setup/{imobiliaria}', [RealEstateSectorController::class, 'storeSetup'])->name('setup.store');
    Route::post('/adm/imobiliarias/editar/setup/{imobiliaria}/{setup}', [RealEstateSectorController::class, 'updateSetup'])->name('setup.update');
    Route::get('/adm/usuarios', [UserController::class, 'index'])->name('user.index');
    Route::get('/adm/usuarios/cadastrar', [UserController::class, 'create'])->name('user.create');
    Route::post('/adm/usuarios/cadastrar', [UserController::class, 'store'])->name('user.store');
    Route::get('/adm/usuarios/editar/{usuario}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/adm/usuarios/editar/{usuario}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/adm/usuarios/excluir/{usuario}', [UserController::class, 'delete'])->name('user.delete');

    // Imobiliárias
    Route::get('/imobiliaria/imobiliarias/{imobiliaria}', [RealEstateSectorUserController::class, 'index'])->name('realestatesector.realestatesectors.index');
    Route::put('/imobiliaria/imobiliarias/{imobiliaria}/editar', [RealEstateSectorUserController::class, 'update'])->name('realestatesector.realestatesectors.update');

    Route::get('/imobiliaria/usuarios', [UserRealEstateSectorController::class, 'index'])->name('realestatesector.users.index');
    Route::get('/imobiliaria/usuarios/cadastrar', [UserRealEstateSectorController::class, 'create'])->name('realestatesector.users.create');
    Route::post('/imobiliaria/usuarios/cadastrar', [UserRealEstateSectorController::class, 'store'])->name('realestatesector.users.store');
    Route::get('/imobiliaria/usuarios/editar/{usuario}', [UserRealEstateSectorController::class, 'edit'])->name('realestatesector.users.edit');
    Route::put('/imobiliaria/usuarios/editar/{usuario}', [UserRealEstateSectorController::class, 'update'])->name('realestatesector.users.update');
});

// Imobiliárias
Route::middleware(['auth.token', 'check.category:Imobiliária'])->group(function () {
    Route::get('/acesso-negado', function () {
        return view('errors.permission_denied');
    })->name('permission_denied');

    Route::get('/imobiliaria/imobiliarias/{imobiliaria}', [RealEstateSectorUserController::class, 'index'])
        ->name('realestatesector.realestatesectors.index');
    Route::put('/imobiliaria/imobiliarias/{imobiliaria}/editar', [RealEstateSectorUserController::class, 'update'])
        ->name('realestatesector.realestatesectors.update');

    Route::get('/imobiliaria/usuarios', [UserRealEstateSectorController::class, 'index'])
        ->name('realestatesector.users.index');
    Route::get('/imobiliaria/usuarios/cadastrar', [UserRealEstateSectorController::class, 'create'])
        ->name('realestatesector.users.create');
    Route::post('/imobiliaria/usuarios/cadastrar', [UserRealEstateSectorController::class, 'store'])
        ->name('realestatesector.users.store');
    Route::get('/imobiliaria/usuarios/editar/{usuario}', [UserRealEstateSectorController::class, 'edit'])
        ->name('realestatesector.users.edit');
    Route::put('/imobiliaria/usuarios/editar/{usuario}', [UserRealEstateSectorController::class, 'update'])
        ->name('realestatesector.users.update');

    Route::get('/imobiliaria/financeiro/conta', [FinancialAccountController::class, 'index'])
        ->name('financial.financial_account.index');
    Route::get('/imobiliaria/financeiro/conta/cadastrar', [FinancialAccountController::class, 'create'])
        ->middleware('check.permission:4')
        ->name('financial.financial_account.create');
    Route::get('/imobiliaria/financeiro/conta/editar/{financeiro_conta}', [FinancialAccountController::class, 'edit'])
        ->name('financial.financial_account.edit')->middleware('check.permission:5');
    Route::post('/imobiliaria/financeiro/conta/cadastrar', [FinancialAccountController::class, 'store'])
        ->name('financial.financial_account.store')->middleware('check.permission:4');
    Route::put('/imobiliaria/financeiro/conta/editar/{financeiro_conta}', [FinancialAccountController::class, 'update'])
        ->name('financial.financial_account.update')->middleware('check.permission:5');
    Route::delete('/imobiliaria/financeiro/conta/excluir/{financeiro_conta}', [FinancialAccountController::class, 'delete'])
        ->name('financial.financial_account.delete')->middleware('check.permission:5');

    Route::get('/imobiliaria/financeiro/categoria', [FinancialCategoryController::class, 'index'])
        ->name('financial.financial_category.index');
    Route::get('/imobiliaria/financeiro/categoria/cadastrar', [FinancialCategoryController::class, 'create'])
        ->name('financial.financial_category.create')->middleware('check.permission:4');
    Route::get('/imobiliaria/financeiro/categoria/editar/{financeiro_categoria}', [FinancialCategoryController::class, 'edit'])
        ->name('financial.financial_category.edit')->middleware('check.permission:5');
    Route::post('/imobiliaria/financeiro/categoria/cadastrar', [FinancialCategoryController::class, 'store'])
        ->name('financial.financial_category.store')->middleware('check.permission:4');
    Route::put('/imobiliaria/financeiro/categoria/editar/{financeiro_categoria}', [FinancialCategoryController::class, 'update'])
        ->name('financial.financial_category.update')->middleware('check.permission:5');

    Route::delete('/imobiliaria/financeiro/categoria/excluir/{financeiro_categoria}', [FinancialCategoryController::class, 'delete'])
        ->name('financial.financial_category.delete')->middleware('check.permission:5');

    Route::get('/propostas', [PropostalController::class, 'index'])
        ->name('propostal.index');

    Route::post('/propostas/cancelar/{id}', [PropostalController::class, 'delete'])
        ->name('propostal.delete');

    Route::get('/propostas/criar-proposta', [PropostalController::class, 'create'])
        ->name('propostal.create')
        ->middleware('check.permission:11');
    Route::post('/propostas/criar-proposta', [PropostalController::class, 'store'])
        ->name('propostal.store')
        ->middleware('check.permission:11');

    Route::get('/propostas/{id}', [PropostalController::class, 'find'])
        ->name('propostal.find');
});
