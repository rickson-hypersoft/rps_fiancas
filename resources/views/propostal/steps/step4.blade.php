<div id="resumo" class="content fv-plugins-bootstrap5 active fv-plugins-framework">
    <div class="row g-6 pt-5 mb-5 pb-5 justify-content-center">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="d-flex align-items-start">
                <div class="badge rounded bg-label-primary p-2 me-3">
                    <i class="icon-base ti tabler-file icon-lg"></i>
                </div>
                <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                    <div class="me-2">
                        <h6 class="mb-0">Resumo da proposta</h6>
                        <small class="text-body">Solicitação <span id="proposta_id">{{ $proposta['id'] }}</span></small>
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
                        <span class="badge text-bg-secondary"><span
                                id="contrato_status_resumo">{{ $proposta['proposta_status'] }}</span></span>
                    </div>

                    <button id="propostal-canceled" class="btn btn-outline-secondary">Cancelar proposta</button>
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
                            <!--<p>Tipo de pagador</p>-->
                            <p>Valor da taxa</p>
                            <p>Valor do setup</p>
                        </div>
                        <div>
                            <!--<p id="proposta_tipo_pagador_resumo"></p>-->
                            <p style="text-align: right" id="proposta_total_valor_resumo">
                                {{ $proposta['proposta_total_valor'] }}</p>
                            <p style="text-align: right" id="proposta_setup_valor_resumo">
                                {{ $proposta['proposta_setup_valor'] }}</p>
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
                                <p id="imovel_tipo_resumo"></p>
                                <p style="text-align: right" id="imovel_aluguel_resumo">
                                    {{ $proposta['imovel_aluguel'] }}</p>
                                <p style="text-align: right" id="imovel_condominio_resumo">
                                    {{ $proposta['imovel_condominio'] }}</p>
                                <p style="text-align: right" id="imovel_taxas_resumo">{{ $proposta['imovel_taxas'] }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>Total</p>
                            </div>
                            <div>
                                <p style="text-align: right" id="proposta_total_valor_total">
                                    {{ $proposta['proposta_total_valor'] }}</p>
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
                            <p id="imovel_cep_resumo">{{ $proposta['imovel_cep'] }}</p>
                        </div>
                        <div>
                            <p class="fw-bold">Endereço</p>
                            <p id="imovel_endereco_completo">{{ $proposta['endereco_completo'] }}</p>
                        </div>
                        <div>
                            <p class="fw-bold">Complemento</p>
                            <p id="imovel_complemento_resumo">{{ $proposta['imovel_complemento'] }}</p>
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
                        <div class="card-body p-0 m-0">
                            <div>
                                <p class="fw-bold">Nome</p>
                                <p id="pessoa_nome_resumo">{{ $proposta['pessoa_nome'] }}</p>
                            </div>
                            <div>
                                <p class="fw-bold">CPF</p>
                                <p id="pessoa_doc_resumo">{{ $proposta['pessoa_doc'] }}</p>
                            </div>
                            <div>
                                <p class="fw-bold">Telefone</p>
                                <p id="pessoa_telefone_resumo">{{ $proposta['pessoa_telefone'] }}</p>
                            </div>
                            <div>
                                <p class="fw-bold">Data Nascimento</p>
                                <p id="data_nascimento_resumo">{{ $proposta['data_nascimento'] }}</p>
                            </div>
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
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
                            Histórico
                        </button>
                    </h2>

                    <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample"
                        style="">
                        @foreach ($histories as $history)
                             <div class="accordion-body">
                            {{$history['data']}} - {{$history['historico']}}
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 d-flex justify-content-between mb-5 mt-5">
            <a href="{{ route('propostal.step3', ['id' => $proposta['id']]) }}"
                class="btn btn-label-secondary btn-prev waves-effect">
                <i class="icon-base ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Voltar</span>
            </a>
            <a href="{{ route('propostal.step5', ['id' => $proposta['id']]) }}"
                class="btn btn-primary btn-next waves-effect waves-light">
                <span class="align-middle d-sm-inline-block d-none me-sm-2">Enviar proposta</span>
                <i class="icon-base ti tabler-arrow-right icon-xs"></i>
            </a>
        </div>
    </div>
</div>
