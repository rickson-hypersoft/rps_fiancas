@extends('dashboard')
@section('content')
<div class="col-12 mb-6">
    <div id="wizard-validation" class="bs-stepper mt-2 linear">
        <div class="bs-stepper-header">
            <div class="step active" data-target="#criar-proposta">
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
            <div class="step" data-target="#analise-credito">
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
            <div class="step" data-target="#dados-complementares">
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
                        <span class="bs-stepper-title">Resumo da proposta</span>
                        <span class="bs-stepper-subtitle">Resumo dos dados da proposta</span>
                    </span>
                </button>
            </div>

            <div class="line">
                <i class="icon-base ti tabler-chevron-right"></i>
            </div>
            <div class="step" data-target="#proposta-enviada">
                <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                    <span class="bs-stepper-circle">5</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Proposta enviada</span>
                        <span class="bs-stepper-subtitle">Aguarde a análise</span>
                    </span>
                </button>
            </div>
        </div>

        <div class="bs-stepper-content">
            <form id="wizard-validation-form" onsubmit="return false">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                @csrf
                <!-- Account Details -->
                @include('propostal.components.create-propostal', ['user' => session('user')])

                <!-- Personal Info -->
                @include('propostal.components.analys-credit', ['setups' => $setups])

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
                                        <div class="table-responsive">
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

                <!-- Social Links -->
                <div id="dados-complementares" class="content fv-plugins-bootstrap5 fv-plugins-framework">
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
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const form = document.getElementById('wizard-validation-form');
    const formData = new FormData(form);

    IMask(document.getElementById('pessoa_doc'), {
        mask: '000.000.000-00'
    });
    IMask(document.getElementById('imovel_cep'), {
        mask: '00000-000'
    });

    document.getElementById('imovel_cep').addEventListener('blur', function () {
        const cep = this.value.replace(/\D/g, '');

        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    const statusEl = document.getElementById('cep-status');

                    if (!data.erro) {
                        formData.append('imovel_estado', data.uf);
                        formData.append('imovel_cidade', data.localidade);

                        // Atualiza a escrita na div
                        statusEl.textContent = `${data.localidade} - ${data.uf}`;
                    } else {
                        statusEl.textContent = 'CEP não encontrado';
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar o CEP:', error);
                    document.getElementById('cep-status').textContent = 'Erro ao buscar o CEP';
                });
        } else {
            document.getElementById('cep-status').textContent = 'CEP inválido';
        }
    });

    function carregarDadosProposta(id) {
        fetch(`/propostas/${id}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data) {
                    let imovelAluguel = data.imovel_aluguel
                    const card = document.querySelector('#card_status_propostal');
                    const text = document.querySelector('#text_status_propostal');
                    const colorText = document.querySelector('#color_text_imovel_aluguel');
                    const icon = document.querySelector('#icon_status_propostal'); // <i> precisa ter esse ID
                    const badge = document.querySelector('#badge_status_propostal'); // <span> precisa ter esse ID

                    if (imovelAluguel < 1500) {
                        colorText.className = 'fw-bold text-success';
                        text.textContent = 'Crédito aprovado!';
                        card.className = 'content-header mb-4 p-5 bg-success text-white';
                        icon.className = 'menu-icon icon-base ti tabler-check';
                        badge.textContent = 'Simulação';

                    } else if (imovelAluguel >= 1500 && imovelAluguel <= 2500) {
                        colorText.className = 'fw-bold text-warning';
                        text.textContent = 'Crédito pendente de análise!';
                        card.className = 'content-header mb-4 p-5 text-white';
                        card.style.backgroundColor = '#FFA600';
                        badge.textContent = 'Simulação';
                        icon.className = 'menu-icon icon-base ti tabler-clock';
                    }
                    else {
                        text.textContent = 'Crédito reprovado para fiança!';
                        card.className = 'content-header mb-4 p-5 bg-secondary text-white';
                        icon.className = 'menu-icon icon-base ti tabler-x';
                        badge.textContent = 'Reprovado';
                        badge.className = 'badge bg-label-secondary';
                        colorText.className = 'fw-bold text-secondary';
                    }

                    const valorTotal =
                        parseFloat(data.imovel_aluguel || 0) +
                        parseFloat(data.imovel_condominio || 0) +
                        parseFloat(data.imovel_taxas || 0);

                    const valorParcela = valorTotal / 12;

                    document.querySelector('#valor_total_vista').textContent = `${formatarReais(valorTotal)}`;
                    document.querySelector('#valor_parcelado').textContent = `${formatarReais(valorParcela)}`;

                    document.querySelector('#imovel_aluguel_text').textContent = formatarReais(data.imovel_aluguel);
                    document.querySelector('#imovel_condominio_text').textContent = formatarReais(data.imovel_condominio);
                    document.querySelector('#imovel_taxas_text').textContent = formatarReais(data.imovel_taxas);
                    document.querySelector('#pessoa_nome_text').textContent = data.pessoa_nome;
                    document.querySelector('#pessoa_doc_text').textContent = data.pessoa_doc;
                    document.querySelector('#imovel_tipo_text').textContent = data.imovel_tipo;
                    document.querySelector('#imovel_cidade_text').textContent = data.imovel_cidade;
                    document.querySelector('#imovel_estado_text').textContent = data.imovel_estado;
                }
            })
            .catch(error => {
                console.error('Erro ao carregar dados da proposta:', error);
            });
    }

    function formatarReais(valor) {
        const numero = parseFloat(valor);
        if (isNaN(numero)) return 'Valor inválido';
        return numero.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }

    let propostaId = null;
    document.getElementById('btn-simular-credito').addEventListener('click', function (e) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        e.preventDefault(); // Impede a navegação imediata

        const requiredFields = [
            'id_imobiliaria',
            'pessoa_tipo',
            'pessoa_doc',
            'pessoa_nome',
            'imovel_cep',
            'imovel_aluguel',
            'imovel_condominio',
            'imovel_taxas'
        ];

        const missingFields = [];

        requiredFields.forEach(field => {
            let value;
            if (field === 'pessoa_tipo') {
                value = document.querySelector('input[name="pessoa_tipo"]:checked')?.value || '';
            } else {
                const el = document.getElementById(field);
                value = el ? el.value.trim() : '';
            }

            if (!value) {
                missingFields.push(field);
            }
        });

        if (missingFields.length > 0) {
            Swal.fire('Atenção', `Preencha todos os campos obrigatórios.`, 'warning'
            );
            return;
        }

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

        formData.append('id_imobiliaria', document.getElementById('id_imobiliaria').value);
        formData.append('pessoa_tipo', document.querySelector('input[name="pessoa_tipo"]:checked')?.value || '');
        formData.append('imovel_tipo', document.querySelector('input[name="imovel_tipo"]:checked')?.value || '');
        formData.append('pessoa_doc', document.getElementById('pessoa_doc').value);
        formData.append('pessoa_nome', document.getElementById('pessoa_nome').value);
        formData.append('imovel_cep', document.getElementById('imovel_cep').value);
        formData.append('imovel_aluguel', document.getElementById('imovel_aluguel').value ?? 0);
        formData.append('imovel_condominio', document.getElementById('imovel_condominio').value ?? 0);
        formData.append('imovel_taxas', document.getElementById('imovel_taxas').value ?? 0);
        formData.append('id', propostaId ?? null);

        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        fetch('/propostas/criar-proposta', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(async data => {
                Swal.close();

                if (!data.success) {
                    const mensagens = data.message;
                    let mensagemFinal = '';
                    if (typeof mensagens === 'object') {
                        for (let campo in mensagens) {
                            mensagemFinal += `${mensagens[campo].join(', ')}\n`;
                        }
                    } else {
                        mensagemFinal = mensagens;
                    }
                    Swal.close();
                    Swal.fire('Erro', mensagemFinal, 'error');
                    return;
                }

                propostaId = data.data.id; // Salva o ID retornado
                localStorage.setItem('proposta_id', propostaId); // Ou sessionStorage

                await carregarDadosProposta(propostaId);

                // Avança para o próximo step do wizard
                document.querySelector('.btn-next').click();
            })
            .catch(error => {
                Swal.close();
                console.error('Erro ao criar proposta:', error);
                Swal.fire('Erro', 'Não foi possível criar a proposta.', 'error');
            });
    });

    document.getElementById('btn-analise-credito').addEventListener('click', function (e) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        e.preventDefault(); // Impede a navegação imediata

        const requiredFields = [
            'setup'
        ];

        const missingFields = [];

        requiredFields.forEach(field => {
            let value;

            const el = document.getElementById(field);
            value = el ? el.value.trim() : '';


            if (!value) {
                missingFields.push(field);
            }
        });

        if (missingFields.length > 0) {
            Swal.fire('Atenção', `Preencha todos os campos obrigatórios.`, 'warning'
            );
            return;
        }

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

        formData.append('proposta_total_valor', document.getElementById('valor_total_vista').textContent);
        formData.append('proposta_total_parc', 12);
        formData.append('proposta_setup_valor', document.getElementById('setup').value);
        formData.append('proposta_setup_parc', 3);

        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        fetch('/propostas/criar-proposta', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(async data => {
                Swal.close();

                if (!data.success) {
                    const mensagens = data.message;
                    let mensagemFinal = '';
                    if (typeof mensagens === 'object') {
                        for (let campo in mensagens) {
                            mensagemFinal += `${mensagens[campo].join(', ')}\n`;
                        }
                    } else {
                        mensagemFinal = mensagens;
                    }
                    Swal.close();
                    Swal.fire('Erro', mensagemFinal, 'error');
                    return;
                }

                propostaId = data.data.id; // Salva o ID retornado
                localStorage.setItem('proposta_id', propostaId); // Ou sessionStorage

                // Avança para o próximo step do wizard
                document.querySelector('.btn-next').click();
            })
            .catch(error => {
                Swal.close();
                console.error('Erro ao criar proposta:', error);
                Swal.fire('Erro', 'Não foi possível criar a proposta.', 'error');
            });
    });
</script>
@endsection
@endsection
