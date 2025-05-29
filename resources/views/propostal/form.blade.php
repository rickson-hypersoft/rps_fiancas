@extends('dashboard')
@section('content')
<div class="col-12 mb-6">
    <small class="fw-medium">Validation</small>
    <div id="wizard-validation" class="bs-stepper mt-2 linear">
        <div class="bs-stepper-header">
            <div class="step active" data-target="#account-details-validation">
                <button type="button" class="step-trigger" aria-selected="true">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label mt-1">
                        <span class="bs-stepper-title">Criar proposta de fianças</span>
                        <span class="bs-stepper-subtitle">Preencha os dados abaixo</span>
                    </span>
                </button>
            </div>

            <div class="line">
                <i class="icon-base ti tabler-chevron-right"></i>
            </div>
            <div class="step" data-target="#personal-info-validation">
                <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Análise de crédito</span>
                        <span class="bs-stepper-subtitle">Aguarde a análise</span>
                    </span>
                </button>
            </div>

            <div class="line">
                <i class="icon-base ti tabler-chevron-right"></i>
            </div>
            <div class="step" data-target="#social-links-validation">
                <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                    <span class="bs-stepper-circle">3</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Dados complementares</span>
                        <span class="bs-stepper-subtitle">Dados osbre o endereço</span>
                    </span>
                </button>
            </div>

            <div class="line">
                <i class="icon-base ti tabler-chevron-right"></i>
            </div>
            <div class="step" data-target="#resumo">
                <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                    <span class="bs-stepper-circle">4</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Social Links</span>
                        <span class="bs-stepper-subtitle">Add social links</span>
                    </span>
                </button>
            </div>

            <div class="line">
                <i class="icon-base ti tabler-chevron-right"></i>
            </div>
            <div class="step" data-target="#proposta-enviada">
                <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                    <span class="bs-stepper-circle">4</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Social Links</span>
                        <span class="bs-stepper-subtitle">Add social links</span>
                    </span>
                </button>
            </div>
        </div>

        <div class="bs-stepper-content">
            <form id="wizard-validation-form" onsubmit="return false">
                <!-- Account Details -->
                <div id="account-details-validation" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="content-header mb-4 p-5 bg-primary">
                        <h4 class="mb-0 text-center fw-bold text-white">Proposta de fiança</h4>
                    </div>
                    <div class="row g-6 justify-content-center">
                        <div class="col-lg-8 m-0 px-0.5">
                            <div class="card">
                                <div class="card-body mb-0 pb-0">
                                    <div class="content-header mb-4">
                                        <h6 class="mb-0">Dados do inquilino</h6>
                                        <hr>
                                    </div>

                                    <div class="row pb-5">
                                        <div class="col-md mb-md-0 mb-3">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content" for="pessoa_fisica">
                                                    <input name="customRadioTemp" class="form-check-input" type="radio" value="" id="pessoa_fisica">
                                                    <span class="custom-option-header p-0">
                                                        <span class="h6 mb-0">Pessoa Física</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md mb-md-0 mb-3">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content" for="pessoa_juridica">
                                                    <input name="customRadioTemp" class="form-check-input" type="radio" value="" id="pessoa_juridica">
                                                    <span class="custom-option-header p-0">
                                                        <span class="h6 mb-0">Pessoa Jurídica</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-5">
                                        <small class="mb-3">PRIMEIRO INQUILINO</small>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="cpf">CPF</label>
                                                <input type="text" name="cpf" id="cpf" class="form-control form-control-lg" placeholder="___.___.___-__">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="nome">Nome</label>
                                                <input type="text" name="nome" id="nome" class="form-control form-control-lg">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="content-header mb-4 mt-5">
                                        <h6 class="mb-0">Dados do imóvel</h6>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-md-0 mb-5">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content" for="residencial">
                                                    <input name="customRadioSvg" class="form-check-input" type="radio" value="" id="residencial">
                                                    <span class="custom-option-header p-0">
                                                        <span class="h6 mb-0">Residencial</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-md-0 mb-5">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content" for="comercial">
                                                    <input name="customRadioSvg" class="form-check-input" type="radio" value="" id="comercial">
                                                    <span class="custom-option-header p-0">
                                                        <span class="h6 mb-0">Comercial</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row mt-5 mb-4 align-items-center">
                                            <div class="col-md-4">
                                                <label class="form-label" for="cep">CEP</label>
                                                <input type="text" name="cep" id="cep" class="form-control form-control-lg" placeholder="_____-___">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                            <div class="pt-4 col-md-3">
                                                <i class="menu-icon icon-base ti tabler-map"></i> CEP não encontrado
                                            </div>
                                        </div>

                                    </div>

                                    <div class="content-header mb-4 mt-5">
                                        <h6 class="mb-0">Valores</h6>
                                        <hr>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4 mb-4 form-control-validation fv-plugins-icon-container">
                                            <label class="form-label" for="formValidationUsername">Valor Aluguel</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">R$</span>
                                                <input type="text" class="form-control form-control-lg" placeholder="100" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-4 form-control-validation fv-plugins-icon-container">
                                            <label class="form-label" for="formValidationUsername">Valor Condominio</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">R$</span>
                                                <input type="text" class="form-control form-control-lg" placeholder="100" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mb-4 form-control-validation fv-plugins-icon-container">
                                            <label class="form-label" for="formValidationUsername">Taxas</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">R$</span>
                                                <input type="text" class="form-control form-control-lg" placeholder="100" aria-label="Amount (to the nearest dollar)">
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end mb-5">
                                            <button id="btn-simular-credito" class="btn btn-primary btn-next-simular waves-effect waves-light">
                                                <span class="align-middle d-sm-inline-block d-none me-sm-2">Simular Crédito</span>
                                                <i class="icon-base ti tabler-arrow-right icon-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Personal Info -->
                <div id="personal-info-validation" class="content fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="content-header mb-4 p-5" style="background-color: #FFA600;">
                        <h4 class="mb-0 text-center fw-bold text-white">Crédito pendente de análise</h4>
                    </div>
                    <div class="row g-6 justify-content-center">
                        <div class="col-lg-8 m-0 px-0.5">
                            <div class="card">
                                <div class="card-header pb-1">
                                    <div class="d-flex align-middle justify-content-between mb-1">
                                        <small>VALOR SOLICITADO DE ALUGUEL</small>
                                        <span class="badge bg-label-secondary">Simulação</span>
                                    </div>
                                </div>
                                <div class="card-body mb-0">
                                    <h4 class="fw-bold text-warning"><i class="menu-icon icon-base ti tabler-clock"></i> R$ 1.500,00</h4>
                                    <div class="d-flex gap-5 p-4" style="background-color: #F2F4F8; border-radius: 10px;">
                                        <div class="p-2">
                                            <span class="fw-bold">Valor de condomínio</span>
                                            <p class="m-0">R$ 0,00</p>
                                        </div>
                                        <div class="p-2">
                                            <span class="fw-bold">Taxas inclusas</span>
                                            <p class="m-0">R$ 0,00</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pt-1">
                                    <span class="small fw-bold mb-0" style="font-size: 16px;">DETALHAMENTO</span>

                                    <div class="demo-inline-spacing p-0 m-0">
                                        <p class="m-0 p-0">O inquilino RICKSON LUCAS do CPF 160.549.566-20 está pendente de uma análise manual para uma locação com garantia de um imóvel Residencial, na cidade de Iturama - MG</p>
                                    </div>

                                    <d class="d-flex mt-5 gap-2">
                                        <a href="#" class="btn btn-text-success waves-effect"><i class="menu-icon icon-base ti tabler-pencil"></i> Editar dados</a>
                                        <a href="#" class="btn btn-text-success waves-effect"><i class="menu-icon icon-base ti tabler-refresh"></i> Fazer nova simulação</a>
                                    </d>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-6 mt-5 justify-content-center">
                        <div class="col-lg-8 m-0 px-0.5">
                            <div class="card" style="border: 1px solid green;">
                                <div class="card-header pb-1">
                                    <div class="d-flex align-middle justify-content-between mb-1">
                                        <small style="font-size: 16px;">Taxa de 15%, Custo de saída 5x e Cobertura total de 40x</small>
                                    </div>
                                    <hr>
                                    <small class="text-success fw-bold" style="font-size: 20px;">12x de R$ 225,00</small>
                                    <smal style="font-size: 16px;">ou R$ 2.700 à vista</smal>
                                    <hr>
                                </div>
                                <div class="card-body mb-0">
                                    <h6 class="fw-bold">Defina a taxa de setup e o tipo de pagamento</h6>
                                    <div class="col-12">
                                        <label for="setup" class="form-label">Setup</label>
                                        <select class="form-select form-select-lg" name="setup" id="setup" aria-label="Default select example">
                                            <option value="">Selecionar setup</option>
                                            <option value="R$ 260,00 em até 3x de R$ 86,81">
                                                R$ 260,00 em até 3x de R$ 86,81
                                            </option>
                                            <option value="R$ 260,00 em até 3x de R$ 86,81">
                                                R$ 260,00 em até 3x de R$ 86,81
                                            </option>
                                            <option value="R$ 260,00 em até 3x de R$ 86,81">
                                                R$ 260,00 em até 3x de R$ 86,81
                                            </option>
                                            <option value="R$ 260,00 em até 3x de R$ 86,81">
                                                R$ 260,00 em até 3x de R$ 86,81
                                            </option>
                                            <option value="R$ 260,00 em até 3x de R$ 86,81">
                                                R$ 260,00 em até 3x de R$ 86,81
                                            </option>
                                            <option value="R$ 260,00 em até 3x de R$ 86,81">
                                                R$ 260,00 em até 3x de R$ 86,81
                                            </option>
                                            <option value="R$ 260,00 em até 3x de R$ 86,81">
                                                R$ 260,00 em até 3x de R$ 86,81
                                            </option>
                                            <option value="R$ 260,00 em até 3x de R$ 86,81">
                                                R$ 260,00 em até 3x de R$ 86,81
                                            </option>
                                            <option value="R$ 260,00 em até 3x de R$ 86,81">
                                                R$ 260,00 em até 3x de R$ 86,81
                                            </option>
                                        </select>
                                        <p class="mt-2 mb-4">Se trata do valor para realizar a ativação deste produto</p>

                                        <div style="border: 1px solid #387BA8; border-radius: 10px">
                                            <div class="card-body" style="background-color: #F2F4F8; border-radius: 10px">
                                                <p>A escolha do parcelamento fica na tela de pgamentos visível à pessoa inquilina. O repasse para a imobiliária da taxa setup é feito a vista, mesmo qe a pessoa inquilina pague parcelado.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end mb-5 mt-5">
                                <button class="btn btn-primary btn-next waves-effect waves-light">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-2">Avançar</span>
                                    <i class="icon-base ti tabler-arrow-right icon-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div id="social-links-validation" class="content fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="content-header mb-4 p-5 bg-primary">
                        <h4 class="mb-0 text-center fw-bold text-white">Dados complementares</h4>
                    </div>
                    <div class="row g-6 justify-content-center">
                        <div class="col-lg-8 m-0 px-0.5">
                            <div class="card">
                                <div class="card-body mb-0 pb-0">
                                    <div class="content-header mb-4">
                                        <h6 class="mb-0">Endereço do imóvel a ser alugado</h6>
                                        <hr>
                                    </div>

                                    <div class="row mt-5">
                                        <div class="col-md-4 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="cep">CEP</label>
                                                <input type="text" name="cep" id="cep" class="form-control form-control-lg" placeholder="_____-__">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="endereco">Endereço</label>
                                                <input type="text" name="endereco" id="endereco" class="form-control form-control-lg">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="bairro">Bairro</label>
                                                <input type="text" name="bairro" id="bairro" class="form-control form-control-lg">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="estado">Estado</label>
                                                <input type="text" name="estado" id="estado" class="form-control form-control-lg">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="cidade">Cidade</label>
                                                <input type="text" name="cidade" id="cidade" class="form-control form-control-lg">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="numero">Número</label>
                                                <input type="text" name="numero" id="numero" class="form-control form-control-lg">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="complemento">Complemento</label>
                                                <input type="text" name="complemento" id="complemento" class="form-control form-control-lg">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="numero">Subtipo do imóvel</label>
                                                <select class="form-select form-select-lg" name="banco_finalidade" id="banco_finalidade" aria-label="Default select example">
                                                    <option value="">Selecionar finalidade</option>
                                                    <option value="Inadimplência e Comissão">
                                                        Inadimplência e Comissão
                                                    </option>
                                                    <option value="Inadimplência">
                                                        Inadimplência
                                                    </option>
                                                    <option value="Comissão">
                                                        Comissão
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="tag">Tag</label>
                                                <input type="text" name="tag" id="tag" class="form-control form-control-lg">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="content-header mb-4 mt-5">
                                        <h6 class="mb-0">Contato do inquilino (Pagador)</h6>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="nome">Nome</label>
                                                <input type="text" name="nome" id="nome" class="form-control form-control-lg">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="cpf">CPF</label>
                                                <input type="text" name="cpf" id="cpf" class="form-control form-control-lg">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="data_nacimento">Data nascimento</label>
                                                <input type="text" name="data_nacimento" id="data_nacimento" class="form-control form-control-lg">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="email">E-mail</label>
                                                <input type="text" name="email" id="email" class="form-control form-control-lg">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="telefone">Telefone</label>
                                                <input type="text" name="telefone" id="telefone" class="form-control form-control-lg">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="numero">Subtipo do imóvel</label>
                                                <select class="form-select form-select-lg" name="banco_finalidade" id="banco_finalidade" aria-label="Default select example">
                                                    <option value="">Selecionar finalidade</option>
                                                    <option value="Inadimplência e Comissão">
                                                        Inadimplência e Comissão
                                                    </option>
                                                    <option value="Inadimplência">
                                                        Inadimplência
                                                    </option>
                                                    <option value="Comissão">
                                                        Comissão
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-control-validation fv-plugins-icon-container">
                                                <label class="form-label" for="numero">Observações</label>
                                                <textarea id="basic-default-message" class="form-control form-control-lg" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row gy-6">
                                        <div class="col-12 d-none">
                                            <div class="card">
                                                <h5 class="card-header">Basic</h5>
                                                <div class="card-body">
                                                    <form action="/upload" class="dropzone needsclick dz-clickable" id="dropzone-basic">
                                                        <div class="dz-message needsclick">
                                                            Drop files here or click to upload
                                                            <span class="note needsclick">(This is just a demo dropzone. Selected files are
                                                                <span class="fw-medium">not</span> actually uploaded.)</span>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="content-header mb-4 mt-5">
                                                <h6 class="mb-0">Documentos</h6>
                                            </div>
                                            <form action="/upload" class="dropzone needsclick dz-clickable" id="dropzone-multi">
                                                <div class="dz-message needsclick">
                                                    Arraste para cá ou clique para selecionar arquivos
                                                    <span class="note needsclick">Envie até 6 arquivos</span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-between mb-5 mt-5">
                                <button class="btn btn-label-secondary btn-prev waves-effect">
                                    <i class="icon-base ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Voltar</span>
                                </button>
                                <button id="button-dados" class="btn btn-primary btn-next waves-effect waves-light">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-2">Salvar</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="resumo" class="content fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="row g-6 pt-5 mb-5 mb-5 pb-5 justify-content-center">
                        <div class="col-lg-8 m-0 px-0.5">
                            <div class="d-flex align-items-start">
                                <div class="badge rounded bg-label-primary p-2 me-3 rounded">
                                    <i class="icon-base ti tabler-file icon-lg"></i>
                                </div>
                                <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                                    <div class="me-2">
                                        <h6 class="mb-0">Resumo da proposta</h6>
                                        <small class="text-body">Solicitação 1</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-6 mt-5 justify-content-center">
                        <div class="col-lg-8 m-0 px-0.5">
                            <div class="card">
                                <div class="card-body d-flex justify-content-between">
                                    <div>
                                        <p class="mb-2 p-0 fw-bold">Status da proposta</p>
                                        <span class="badge text-bg-secondary">Rascunho</span>
                                    </div>

                                    <button class="btn btn-outline-secondary">Cancelar proposta</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-6 mt-5 justify-content-center">
                        <div class="col-lg-8 m-0 px-0.5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="content-header">
                                        <h6 class="mb-0">Dados do plano</h6>
                                        <hr>
                                    </div>

                                    <div class="card-body p-0 m-0 d-flex justify-content-between">
                                        <div>
                                            <p>Plano</p>
                                            <p>Tipo de pagador</p>
                                            <p>Valor da taxa</p>
                                            <p>Valor do setup</p>
                                        </div>
                                        <div>
                                            <p>Up</p>
                                            <p>Tradicional</p>
                                            <p>R$ 2.700,00</p>
                                            <p>R$ 260,00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-6 mt-5 justify-content-center">
                        <div class="col-lg-8 m-0 px-0.5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="content-header">
                                        <h6 class="mb-0">Dados da locação</h6>
                                        <hr>
                                    </div>

                                    <div class="card-body p-0 m-0">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p>Tipo de imóvel</p>
                                                <p>Valor do aluguel</p>
                                                <p>Valor do condomínio</p>
                                                <p>Outras taxas</p>
                                            </div>
                                            <div>
                                                <p>Reidencial</p>
                                                <p>R$ 1.500,00</p>
                                                <p>R$ 0,00</p>
                                                <p>R$ 0,00</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <p>Total</p>
                                            </div>
                                            <div>
                                                <p>R$ 1.500,00</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-6 mt-5 justify-content-center">
                        <div class="col-lg-8 m-0 px-0.5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="content-header">
                                        <h6 class="mb-0">Endereço do imóvel</h6>
                                        <hr>
                                    </div>

                                    <div class="card-body p-0 m-0">
                                        <div>
                                            <p class="fw-bold">CEP</p>
                                            <p>382800-000</p>
                                        </div>
                                        <div>
                                            <p class="fw-bold">Endereço</p>
                                            <p>Av. Filadelfo Rodrigues de Lima, 78, Alto da Boa Vista, Iturama - MG</p>
                                        </div>
                                        <div>
                                            <p class="fw-bold">Complemento</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-6 mt-5 justify-content-center">
                        <div class="col-lg-8 m-0 px-0.5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="content-header">
                                        <h6 class="mb-0">Dados do inquilino</h6>
                                        <hr>
                                    </div>

                                    <div class="card-body p-0 m-0">
                                        <span class="badge text-bg-primary">Pagador</span>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>CPF</th>
                                                    <th>Telefone</th>
                                                    <th>Data nasicmento</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <span class="fw-medium">Rickson Lucas</span>
                                                    </td>
                                                    <td>160.549.566-20</td>
                                                    <td>34999911156</td>
                                                    <td>12/06/2003</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-6 mt-2 justify-content-center">
                        <div class="col-lg-8 m-0 px-0.5">
                            <div class="accordion mt-4" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
                                            Historico
                                        </button>
                                    </h2>

                                    <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            28/05/2025 14:09 - Criada Solicitação #1 do tipo residencial, no produto Up, com setuo de R$ 260,00 e valor de aluguel R$ 1.500,00, valor do condomínio R$ 0,00 valor das taxas R$ 0,00, totalizando R$ 1.500,00. O imóvel está situado no endereço, , , Iturama - MG, cujo CEP é 38280-000
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-6 pt-5 mb-5 mb-5 pb-5">
                        <div class="col-10 d-flex justify-content-end mb-5 mt-5">
                            <button class="btn btn-primary btn-next waves-effect waves-light">
                                <span class="align-middle d-sm-inline-block d-none me-sm-2">Enviar proposta</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div id="proposta-enviada" class="content fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="content-header mb-4 p-5" style="background-color: #FFA600;">
                        <h4 class="mb-0 text-center fw-bold text-white">Proposta enviada</h4>
                    </div>
                    <div class="row g-6 justify-content-center">
                        <div class="col-lg-8 m-0 px-0.5">
                            <div class="card">
                                <div class="card-header pb-1">
                                    <div class="d-flex align-middle justify-content-between mb-1">
                                        <small>PRÓXIMOS PASSOS</small>
                                        <span class="badge bg-label-secondary">Proposta</span>
                                    </div>
                                </div>
                                <div class="card-body mb-0">
                                    <h4 class="fw-bold text-warning">A proposta está em análise manual pelo nosso time interno.</h4>
                                    <p>Estaremos em contato através da nossa plataforma e por e-mail para dar retorno em até 30 minutos.</p>
                                    <hr>
                                    <small>REGISTRO</small>
                                    <p>Proposta #1</p>
                                    <a href="#" class="btn btn-text-success waves-effect">Ver detalhes da proposta</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('btn-simular-credito').addEventListener('click', function (e) {
        e.preventDefault(); // Impede a navegação imediata

        // Exibe o SweetAlert de carregamento
        Swal.fire({
            title: 'Aguarde...',
            text: 'Análise de crédito em andamento',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Simula um tempo de carregamento (ex: 2 segundos), depois vai para o próximo passo
        setTimeout(function () {
            // Aqui você pode chamar a função ou trigger do wizard que avança o passo
            // Exemplo genérico para um plugin de stepper:
            // stepper.next(); ou $('.btn-next').click(); se quiser simular o clique real

            // Se estiver usando um plugin de steps, chame ele aqui diretamente
            // Exemplo genérico (ajuste conforme seu stepper):
            document.querySelector('.btn-next').click(); // ou chame sua função de avanço aqui

            Swal.close(); // Fecha o loading
        }, 2000); // tempo simulado, ajuste conforme necessário
    });

    document.getElementById('btn-dados').addEventListener('click', function (e) {
        e.preventDefault(); // Impede a navegação imediata

        // Exibe o SweetAlert de carregamento
        Swal.fire({
            title: 'Aguarde...',
            text: 'Análise de crédito em andamento',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Simula um tempo de carregamento (ex: 2 segundos), depois vai para o próximo passo
        setTimeout(function () {
            // Aqui você pode chamar a função ou trigger do wizard que avança o passo
            // Exemplo genérico para um plugin de stepper:
            // stepper.next(); ou $('.btn-next').click(); se quiser simular o clique real

            // Se estiver usando um plugin de steps, chame ele aqui diretamente
            // Exemplo genérico (ajuste conforme seu stepper):
            document.querySelector('.btn-next').click(); // ou chame sua função de avanço aqui

            Swal.close(); // Fecha o loading
        }, 2000); // tempo simulado, ajuste conforme necessário
    });
</script>
@endsection
@endsection