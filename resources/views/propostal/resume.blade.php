@extends('dashboard')
@section('content')
<div class="col-12">
<div id="resumo" class="content fv-plugins-bootstrap5 fv-plugins-framework">
    <div class="row g-6 pt-5 mb-5 pb-5 justify-content-center">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="d-flex align-items-start">
                <div class="badge bg-label-primary p-2 me-3 rounded">
                    <i class="icon-base ti tabler-file icon-lg"></i>
                </div>
                <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                    <div class="me-2">
                        <h6 class="mb-0">Resumo da proposta</h6>
                        <small class="text-body">Solicitação {{$resume['id']}}</small>
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
                        @php
                             $status = $resume['proposta_status'];

                            $badge = match ($status) {
                                'Negado'   => 'dark',
                                'Aprovado' => 'success',
                                'Pendente' => 'warning',
                                'Cancelado'=> 'danger',
                                default    => 'secondary',
                            };
                        @endphp
                        <span class="badge text-bg-{{$badge}}">{{$resume['proposta_status']}}</span>
                    </div>

                    <!--
                    <button id="propostal-canceled" class="btn btn-outline-secondary">Cancelar proposta</button>
                    -->
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
                                {{$resume['proposta_total_valor']}}
                            </p>
                            <p style="text-align: right" id="proposta_setup_valor_resumo">
                                {{$resume['proposta_setup_valor']}}
                            </p>
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
                                <p id="imovel_tipo_resumo">
                                     {{$resume['imovel_tipo']}}
                                </p>
                                <p style="text-align: right" id="imovel_aluguel_resumo">
                                     {{$resume['imovel_aluguel']}}
                                </p>
                                <p style="text-align: right" id="imovel_condominio_resumo">
                                     {{$resume['imovel_condominio']}}
                                </p>
                                <p style="text-align: right" id="imovel_taxas_resumo">
                                     {{$resume['imovel_taxas']}}
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
                                     {{$resume['proposta_total_valor']}}
                                </p>
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
                            <p id="imovel_cep_resumo">
                                {{$resume["imovel_cep" ]}}
                            </p>
                        </div>
                        <div>
                            <p class="fw-bold">Endereço</p>
                            <p id="imovel_endereco_completo">
                                {{$resume["endereco_completo" ]}}
                            </p>
                        </div>
                        <div>
                            <p class="fw-bold">Complemento</p>
                            <p id="imovel_complemento_resumo">
                                {{$resume["imovel_complemento" ]}}
                            </p>
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
                                <p id="pessoa_nome_resumo">
                                    {{$resume["pessoa_nome" ]}}
                                </p>
                            </div>
                            <div>
                                <p class="fw-bold">CPF</p>
                                <p id="pessoa_doc_resumo">
                                    {{$resume["pessoa_doc" ]}}
                                </p>
                            </div>
                            <div>
                                <p class="fw-bold">Telefone</p>
                                <p id="pessoa_telefone_resumo">
                                    {{$resume["pessoa_telefone" ]}}
                                </p>
                            </div>
                            <div>
                                <p class="fw-bold">Data Nascimento</p>
                                <p id="data_nascimento_resumo">
                                    {{$resume["data_nascimento" ]}}
                                </p>
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

        <div class="col-lg-8 d-flex justify-content-between mt-5">
            <a href="{{route('propostal.index')}}" class="btn btn-label-secondary btn-prev waves-effect">
                <i class="icon-base ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
                <span class="align-middle d-sm-inline-block d-none">Voltar</span>
            </a>
        </div>
    </div>
</div>
@endsection
