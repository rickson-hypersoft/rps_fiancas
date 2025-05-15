<?php

declare(strict_types=1);

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RealEstateSectorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth.token'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/minha-conta', [ProfileController::class, 'index'])->name('my-profile');
    Route::put('/minha-conta/atualizar/{usuario}', [ProfileController::class, 'update'])->name('update.my-profile');

    Route::get('/empresa', [CompanyController::class, 'index'])->name('company.index');
    Route::put('/empresas/{empresa}', [CompanyController::class, 'update'])->name('company.store');

    Route::get('/imobiliarias', [RealEstateSectorController::class, 'index'])->name('realestatesector.index');
    Route::get('/imobiliarias/listagem', [RealEstateSectorController::class, 'listAll'])->name('realestatesector.listAll');
    Route::get('/imobiliarias/setup/{setup}', [RealEstateSectorController::class, 'setup'])->name('realestatesector.setup');
    Route::get('/imobiliarias/cadastrar', [RealEstateSectorController::class, 'create'])->name('realestatesector.create');
    Route::post('/imobiliarias/cadastrar', [RealEstateSectorController::class, 'store'])->name('realestatesector.store');
    Route::get('/imobiliarias/editar/{imobiliaria}', [RealEstateSectorController::class, 'edit'])->name('realestatesector.edit');

    Route::get('/imobiliarias/{imobiliaria}/editar', [RealEstateSectorController::class, 'dataRealEstateSector'])->name('realestatesector.dataEdit');

    Route::put('/imobiliarias/editar/{imobiliaria}', [RealEstateSectorController::class, 'update'])
        ->name('realestatesector.update');

    Route::put('/imobiliarias/{imobiliaria}/editar', [RealEstateSectorController::class, 'updateData'])->name('realestatesector.updateData');

    Route::post('/imobiliarias/cadastrar/setup/{imobiliaria}', [RealEstateSectorController::class, 'storeSetup'])->name('setup.store');
    Route::post('/imobiliarias/editar/setup/{imobiliaria}/{setup}', [RealEstateSectorController::class, 'updateSetup'])->name('setup.update');

    Route::get('/usuarios', [UserController::class, 'index'])->name('user.index');
    Route::get('/usuarios/cadastrar', [UserController::class, 'create'])->name('user.create');
    Route::post('/usuarios/cadastrar', [UserController::class, 'store'])->name('user.store');
    Route::get('/usuarios/editar/{usuario}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/usuarios/editar/{usuario}', [UserController::class, 'update'])->name('user.update');

    Route::get('/imobiliaria/usuarios', [UserController::class, 'realEstateSectorUserIndex'])->name('realestatesector.users.index');
    Route::get('/imobiliaria/usuarios/cadastrar', [UserController::class, 'realEstateSectorUserCreate'])->name('realestatesector.users.create');
    Route::get('/imobiliaria/usuarios/editar/{usuario}', [UserController::class, 'realEstateSectorUserEdit'])->name('realestatesector.users.edit');
});