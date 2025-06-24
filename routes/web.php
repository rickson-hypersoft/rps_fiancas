<?php

declare(strict_types = 1);

use App\Http\Controllers\ActivationController;
use App\Http\Controllers\Assets\AssetsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Financial\FinancialAccountController;
use App\Http\Controllers\Financial\FinancialCategoryController;
use App\Http\Controllers\Financial\FinancialMoviController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Payments\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Propostal\PropostalController;
use App\Http\Controllers\RealEstateSector\RealEstateSectorUserController;
use App\Http\Controllers\RealEstateSector\UserRealEstateSectorController;
use App\Http\Controllers\RealEstateSectorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('fianca')->group(function (): void {

Route::redirect('/', '/login');

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth.token'])->group(function (): void {
    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/minha-conta', [ProfileController::class, 'index'])->name('my-profile');
    Route::put('/minha-conta/atualizar/{usuario}', [ProfileController::class, 'update'])->name('update.my-profile');
});

Route::get('/termos/{imobiliaria}/{filename}', [PropostalController::class, 'downloadTermo'])
     ->name('propostas.download-termo');

// Fianças
Route::middleware(['auth.token', 'check.category:Fianças'])->group(function (): void {
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
Route::middleware(['auth.token', 'check.category:Imobiliária'])->group(function (): void {
    Route::get('/acesso-negado', fn () => view('errors.permission_denied'))->name('permission_denied');

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
        ->name('financial.financial_account.create')
        ->middleware('check.permission:4');

    Route::post('/imobiliaria/financeiro/conta/cadastrar', [FinancialAccountController::class, 'store'])
        ->name('financial.financial_account.store')
        ->middleware('check.permission:4');

    Route::get('/imobiliaria/financeiro/conta/editar/{financeiro_conta}', [FinancialAccountController::class, 'edit'])
        ->name('financial.financial_account.edit')
        ->middleware('check.permission:5');

    Route::put('/imobiliaria/financeiro/conta/editar/{financeiro_conta}', [FinancialAccountController::class, 'update'])
        ->name('financial.financial_account.update')
        ->middleware('check.permission:5');

    Route::delete('/imobiliaria/financeiro/conta/excluir/{financeiro_conta}', [FinancialAccountController::class, 'delete'])
        ->name('financial.financial_account.delete')
        ->middleware('check.permission:6');

    Route::get('/imobiliaria/financeiro/categoria', [FinancialCategoryController::class, 'index'])
        ->name('financial.financial_category.index');

    Route::get('/imobiliaria/financeiro/categoria/cadastrar', [FinancialCategoryController::class, 'create'])
        ->name('financial.financial_category.create')
        ->middleware('check.permission:4');

    Route::post('/imobiliaria/financeiro/categoria/cadastrar', [FinancialCategoryController::class, 'store'])
        ->name('financial.financial_category.store')
        ->middleware('check.permission:4');

    Route::get('/imobiliaria/financeiro/categoria/editar/{financeiro_categoria}', [FinancialCategoryController::class, 'edit'])
        ->name('financial.financial_category.edit')
        ->middleware('check.permission:5');

    Route::put('/imobiliaria/financeiro/categoria/editar/{financeiro_categoria}', [FinancialCategoryController::class, 'update'])
        ->name('financial.financial_category.update')
        ->middleware('check.permission:5');

    Route::delete('/imobiliaria/financeiro/categoria/excluir/{financeiro_categoria}', [FinancialCategoryController::class, 'delete'])
        ->name('financial.financial_category.delete')
        ->middleware('check.permission:6');

    Route::get('/imobiliaria/financeiro/movimentacao', [FinancialMoviController::class, 'index'])
        ->name('financial.financial_movi.index');
    Route::get('/imobiliaria/financeiro/movimentacao/cadastrar', [FinancialMoviController::class, 'create'])
        ->name('financial.financial_movi.create');
    Route::get('/imobiliaria/financeiro/movimentacao/editar/{financeiro_movi}', [FinancialMoviController::class, 'edit'])
        ->name('financial.financial_movi.edit');

    Route::post('/imobiliaria/financeiro/movimentacao/cadastrar', [FinancialMoviController::class, 'store'])
        ->name('financial.financial_movi.store');
    Route::put('/imobiliaria/financeiro/movimentacao/editar/{financeiro_movi}', [FinancialMoviController::class, 'update'])
        ->name('financial.financial_movi.update');
    Route::delete('/imobiliaria/financeiro/movimentacao/deletar/{financeiro_movi}', [FinancialMoviController::class, 'delete'])
        ->name('financial.financial_movi.delete');

    Route::get('/imobiliaria/financeiro/movimentacao/export', [FinancialMoviController::class, 'export'])->name('financial.financial_movi.export');



    Route::prefix('propostas')->group(function (): void {
        Route::get('/listagem', [PropostalController::class, 'index'])
            ->name('propostal.index');

        Route::get('/criar', [PropostalController::class, 'create'])->name('propostal.create');
        Route::get('/criar/{id}', [PropostalController::class, 'create'])->name('propostal.create.step1');

        Route::post('/salvar-step1', [PropostalController::class, 'saveStep1'])->name('propostal.save.step1');
        Route::post('/salvar-step1/{id}', [PropostalController::class, 'saveStep1'])->name('propostal.edit.step1');

        Route::get('/step2/{id}', [PropostalController::class, 'step2'])->name('propostal.step2');
        Route::post('/salvar-step2/{id}', [PropostalController::class, 'saveStep2'])->name('propostal.save.step2');

        Route::get('/step3/{id}', [PropostalController::class, 'step3'])->name('propostal.step3');
        Route::post('/salvar-step3/{id}', [PropostalController::class, 'saveStep3'])->name('propostal.save.step3');

        Route::get('/step4/{id}', [PropostalController::class, 'step4'])->name('propostal.step4');
        Route::post('/salvar-step4/{id}', [PropostalController::class, 'saveStep4'])->name('propostal.save.step4');

        Route::get('/step5/{id}', [PropostalController::class, 'step5'])->name('propostal.step5');
        Route::post('/salvar-step5/{id}', [PropostalController::class, 'saveStep5'])->name('propostal.save.step5');

        Route::post('/cancelar/{id}', [PropostalController::class, 'delete'])
            ->name('propostal.delete');

        Route::post('/atualizar/status/{id}', [PropostalController::class, 'updateStatus'])
            ->name('propostal.updateStatus');

        Route::get('/resumo/{id}', [PropostalController::class, 'resume'])->name('propostal.resume');
        Route::post('/email', [PropostalController::class, 'sendNotification'])->name('propostal.send');
        Route::post('/whatsapp', [PropostalController::class, 'sendWhatsApp'])->name('propostal.send');

        Route::get('/alteracao/{id}', [PropostalController::class, 'salvarMotivoAlteracao'])->name('propostal.alter');;
        Route::get('/{id}/gerar-termo', [PropostalController::class, 'gerarTermoPDF'])->name('propostas.gerar-termo');
    });

    // Contratos
    Route::get('/contratos', [AssetsController::class, 'index'])
        ->name("assets.index");
    Route::get('/contratos/find/{id}', [AssetsController::class, 'find'])
        ->name("assets.asset");
    Route::get('/contratos/edit/{idContrato}', [AssetsController::class, 'edit'])
        ->name("assets.edit");
    Route::post('/upload/{idContrato}', [AssetsController::class, 'uploadAnexo'])->name('assets.upload');
    Route::get('/anexos/baixar/{idContrato}/{tipo}', [AssetsController::class, 'baixarAnexo']);
    Route::get('/contratos/export-detalhado', [AssetsController::class, 'exportDetalhado'])->name('assets.export.detalhado');

    // Ativação
    Route::prefix('ativacao')->group(function (): void {
        Route::get('/login/{linkHash}', [ActivationController::class, 'login'])->name('activation.login');

        Route::post('/login', [ActivationController::class, 'verifyLogin'])->name('activation.verify.login');

        Route::get('/{linkHash}', [ActivationController::class, 'index'])
            ->name('activation.index')
            ->middleware('verify.contract.link');

        Route::get('/faceId/{linkHash}', [ActivationController::class, 'faceId'])->name('activation.faceId')->middleware('verify.contract.link');

        Route::get('/term/{linkHash}', [ActivationController::class, 'term'])->name('activation.term')->middleware('verify.contract.link');

        Route::get('/term/active/{linkHash}', [ActivationController::class, 'activeTerm'])->name('activation.term_active')->middleware('verify.contract.link');
    });

    // Pagamentos
    Route::prefix('pagamentos')->group(function (): void {
        Route::get('/checkout/{linkHash}', [CheckoutController::class, 'index'])
            ->name('checktou.index')->middleware('verify.contract.link');
        ;

        Route::get('/checkout/pix/{linkHash}', [CheckoutController::class, 'carregarFormPix'])->name('checkout.pix')->middleware('verify.contract.link');
        ;
        Route::post('/checkout/pix/{linkHash}', [CheckoutController::class, 'criarPagamentoPix'])->name('checkout.save.pix')->middleware('verify.contract.link');
        ;

        Route::get('/checkout/boleto/{linkHash}', [CheckoutController::class, 'carregarFormBoleto'])->name('checkout.boleto')->middleware('verify.contract.link');
        ;
        Route::post('/checkout/boleto/{linkHash}', [CheckoutController::class, 'criarPagamentoBoleto'])->name('checkout.save.boleto')->middleware('verify.contract.link');
        ;

        Route::get('/checkout/cartao/{linkHash}', [CheckoutController::class, 'carregarFormCartao'])->name('checkout.cartao')->middleware('verify.contract.link');
        ;
        Route::post('/checkout/cartao/{linkHash}', [CheckoutController::class, 'criarPagamentoCartao'])->name('checkout.save.cartao')->middleware('verify.contract.link');
        ;

        Route::post('/checkout/cancelar/{idPagamento}/{linkHash}', [CheckoutController::class, 'cancelarPagamento'])->name('checkout.canceled')->middleware('verify.contract.link');

        Route::get('/confirmacao/cartao/{linkHash}/{idPagamento}', [CheckoutController::class, 'cartaoConfirmacao'])
            ->name('checkout.confirmation.cart')
            ->middleware('verify.contract.link');
    });
});
});