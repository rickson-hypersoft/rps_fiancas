@extends('dashboard')
@section('content')
    <div id="resumo" class="content fv-plugins-bootstrap5 active fv-plugins-framework">
        <div class="row g-6 justify-content-center mb-5 pb-5 pt-5">
            <div class="col-lg-8 m-0 px-0.5">
                <div class="d-flex align-items-start">
                    <div class="badge bg-label-primary me-3 rounded p-2">
                        <i class="icon-base ti tabler-file icon-lg"></i>
                    </div>
                    <div class="d-flex justify-content-between w-100 align-items-center gap-2">
                        <div class="me-2">
                            <h6 class="mb-0">Resumo da proposta</h6>
                            <small class="text-body">Solicitação <span id="proposta_id">{{ $proposta['id'] }}</span></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($proposta['facial_score_total'] && session('user')['nivel'] == 'Administrador')
            @php
                $facialScoreTotal = $proposta['facial_score_total'] ?? null;
                $facialMatches = [];

                if (!empty($proposta['facial_matches'])) {
                    $facialMatches = json_decode($proposta['facial_matches'], true) ?? [];
                }
            @endphp

            <div class="row g-6 justify-content-center mt-5">
                <div class="col-lg-8 m-0 px-0.5">
                    <div class="card">
                        <div class="card-body mb-0">
                            <div class="d-flex justify-content-between align-items-end">
                                <div>
                                    <p class="fw-bold mb-2 p-0">Facial não aprovada</p>
                                    <a href="{{ route('propostal.aprovarFacial', ['id' => $proposta['id']]) }}"
                                        class="btn btn-sm btn-success text-white">Aprovar facial</a>
                                    <a class="btn btn-sm btn-secondary text-white" data-bs-toggle="modal"
                                        data-bs-target="#modalCancelarProposta" id="propostal-canceled">Cancelar
                                        Proposta</a>
                                </div>
                                <div>
                                    <a href="{{ route('propostal.reenviarLinkFacial', ['id' => $proposta['id']]) }}"
                                        class="btn btn-sm btn-info text-white">Reenviar link para validação
                                        facial</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body mt-0">
                            <div class="mb-3">
                                <p class="fw-bold mb-1">Score da pontuação total</p>
                                <p class="mb-0">
                                    @if ($facialScoreTotal !== null)
                                        {{ number_format($facialScoreTotal, 2, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>

                            @if (!empty($facialMatches))
                                <div class="mt-3">
                                    <p class="fw-bold mb-2">Detalhamento dos matches</p>
                                    <div class="table-responsive">
                                        <table class="table-sm mb-0 table">
                                            <thead>
                                                <tr>
                                                    <th>Match</th>
                                                    <th>Score</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($facialMatches as $nomeMatch => $dadosMatch)
                                                    <tr>
                                                        <td>{{ $nomeMatch }}</td>
                                                        <td>
                                                            @if (isset($dadosMatch['score']) && $dadosMatch['score'] !== null)
                                                                {{ number_format($dadosMatch['score'], 2, ',', '.') }}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                $status = $dadosMatch['status'] ?? '-';
                                                            @endphp
                                                            <span
                                                                class="@if ($status === 'sucesso') text-success
                                                        @elseif($status === 'falha') text-danger
                                                        @else text-muted @endif">
                                                                {{ ucfirst($status) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted mb-0 mt-2">Nenhuma informação de match disponível.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalCancelarProposta" tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCancelarPropostaTitle">
                                Qual o motivo do cancelamento desta proposta
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formCancelarProposta" method="POST" action="">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-4">
                                        <label for="motivo" class="form-label">Selecionar motivo</label>
                                        <select id="motivo" class="form-select form-select-lg" name="motivo">
                                            <option value="Processo de locação interrompido">
                                                Processo de locação interrompido
                                            </option>
                                            <option value="Cliente interessado em outra forma de garantia">
                                                Cliente interessado em outra forma de
                                                garantia
                                            </option>
                                            <option value="Cliente interessado em outro imóvel">
                                                Cliente interessado em outro imóvel
                                            </option>
                                            <option value="Proposta transferida para outra pessoa">
                                                Proposta transferida para outra pessoa
                                            </option>
                                            <option value="Cliente não respondeu às tentativas de contato">
                                                Cliente não respondeu às tentativas de
                                                contato
                                            </option>
                                            <option value="Imóvel já locado para outro interessado">
                                                Imóvel já locado para outro interessado
                                            </option>
                                            <option value="Cliente visitou o imóvel, mas desistiu">
                                                Cliente visitou o imóvel, mas desistiu
                                            </option>
                                            <option value="Imóvel fora do orçamento do cliente">
                                                Imóvel fora do orçamento do cliente
                                            </option>
                                            <option value="Questões financeiras do cliente">
                                                Questões financeiras do cliente
                                            </option>
                                            <option value="Inquilino não concordou com o modelo de garantia">
                                                Inquilino não concordou com o modelo de
                                                garantia
                                            </option>
                                            <option value="Desacordo entre inquilino e proprietário">
                                                Desacordo entre inquilino e proprietário
                                            </option>
                                            <option value="Imobiliária cancelou para cadastrar uma nova proposta no CPF">
                                                Imobiliária cancelou para cadastrar uma nova
                                                proposta no CPF
                                            </option>
                                            <option value="Pontuação facial não aprovada">
                                                Pontuação facial não aprovada
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-4">
                                    <div class="col mb-4">
                                        <label for="exampleFormControlTextarea1" class="form-label">Explicar motivo
                                            (opcional)</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="motivo_opicional"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">
                                    Fechar
                                </button>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Confirmar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <div class="row g-6 justify-content-center mt-5">
            <div class="col-lg-8 m-0 px-0.5">
                <div class="card">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            @php
                                $status = $proposta['proposta_status'];
                                $badgeColor = 'secondary';

                                if ($status == 'Aprovado') {
                                    $badgeColor = 'success';
                                }
                                if ($status == 'Pendente') {
                                    $badgeColor = 'warning';
                                }
                                if ($status == 'Pendente Análise') {
                                    $badgeColor = 'warning';
                                }
                                if ($status == 'Reprovado') {
                                    $badgeColor = 'dark';
                                }
                                if ($status == 'Cancelado') {
                                    $badgeColor = 'danger';
                                }
                            @endphp
                            <p class="fw-bold mb-2 p-0">Status da proposta</p>
                            <span class="badge text-bg-{{ $badgeColor }}"><span
                                    id="contrato_status_resumo">{{ $proposta['proposta_status'] }}</span></span>

                        </div>

                        @if ($proposta['proposta_status'] == 'Pendente Análise' && session('user')['nivel'] == 'Administrador')
                            <a href="{{ route('propostal.aprovarPropostaManual', ['id' => $proposta['id']]) }}"
                                class="btn btn-sm btn-outline-success text-success">Aprovar Proposta</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-6 justify-content-center mt-5">
            <div class="col-lg-8 m-0 px-0.5">
                <div class="card">
                    <div class="card-body">
                        <div class="content-header">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-0">Dados do plano</h6>
                                @if ($proposta['proposta_status'] !== 'Reprovado')
                                    @if (
                                        (in_array($proposta['proposta_status'], ['Rascunho', 'Alteração Imobiliária']) &&
                                            $proposta['contrato_status'] == 'Pendente') ||
                                            $proposta['contrato_status'] == null)
                                        <a href="{{ route('propostal.step2', ['id' => $proposta['id']]) }}"
                                            class="text-success">Editar Dados</a>
                                    @endif
                                @endif
                            </div>
                            <hr>
                        </div>

                        <div class="card-body d-flex justify-content-between m-0 p-0">
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

        <div class="row g-6 justify-content-center mt-5">
            <div class="col-lg-8 m-0 px-0.5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Dados da locação</h6>
                            @if ($proposta['proposta_status'] !== 'Reprovado')
                                @if (
                                    (in_array($proposta['proposta_status'], ['Rascunho', 'Alteração Imobiliária']) &&
                                        $proposta['contrato_status'] == 'Pendente') ||
                                        $proposta['contrato_status'] == null)
                                    <a href="{{ route('propostal.create.step1', ['id' => $proposta['id']]) }}"
                                        class="text-success">Editar Dados</a>
                                @endif
                            @endif
                        </div>
                        <hr>

                        <div class="card-body m-0 p-0">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p>Tipo de imóvel</p>
                                    <p>Valor do aluguel</p>
                                    <p>Valor do condomínio</p>
                                    <p>Outras taxas</p>
                                </div>
                                <div>
                                    <p id="imovel_tipo_resumo"> {{ $proposta['imovel_tipo'] }}</p>
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

        <div class="row g-6 justify-content-center mt-5">
            <div class="col-lg-8 m-0 px-0.5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Endereço do imóvel</h6>
                            @if ($proposta['proposta_status'] !== 'Reprovado')
                                @if (
                                    (in_array($proposta['proposta_status'], ['Rascunho', 'Alteração Imobiliária']) &&
                                        $proposta['contrato_status'] == 'Pendente') ||
                                        $proposta['contrato_status'] == null)
                                    <a href="{{ route('propostal.step3', ['id' => $proposta['id']]) }}"
                                        class="text-success">Editar
                                        Dados</a>
                                @endif
                            @endif
                        </div>
                        <hr>

                        <div class="card-body m-0 p-0">
                            <div>
                                <p class="fw-bold">CEP</p>
                                <p id="imovel_cep_resumo">{{ $proposta['imovel_cep'] }}</p>
                            </div>
                            <div>
                                <p class="fw-bold">Endereço</p>
                                <p id="imovel_endereco_completo">
                                    {{ $proposta['imovel_endereco'] == null ? 'Não possui endereço preenchido' : $proposta['endereco_completo'] }}
                                </p>
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

        <div class="row g-6 justify-content-center mt-5">
            <div class="col-lg-8 m-0 px-0.5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Dados do inquilino</h6>
                            @if ($proposta['proposta_status'] !== 'Reprovado')
                                @if (
                                    (in_array($proposta['proposta_status'], ['Rascunho', 'Alteração Imobiliária']) &&
                                        $proposta['contrato_status'] == 'Pendente') ||
                                        $proposta['contrato_status'] == null)
                                    <a href="{{ route('propostal.create.step1', ['id' => $proposta['id']]) }}"
                                        class="text-success">Editar Dados</a>
                                @endif
                            @endif
                        </div>
                        <hr>

                        <div class="card-body m-0 p-0">
                            <div class="card-body m-0 p-0">
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
                                    <p id="data_nascimento_resumo">
                                        {{ \Carbon\Carbon::parse($proposta['data_nascimento'])->format('d/m/Y') }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $permissoes = explode('|', session('user')['permissoes']);
            $possuiPermissao = false;
            if (in_array(17, $permissoes)) {
                $possuiPermissao = true;
            }
        @endphp

        @if ($possuiPermissao)
            <div class="row g-6 justify-content-center mt-5">
                <div class="col-lg-8 m-0 px-0.5">
                    <div class="card p-4">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#accordionTwo" aria-expanded="false" aria-controls="accordionTwo">
                                    Informações do Inquilino
                                </button>
                            </h2>

                            <div id="accordionTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample"
                                style="">
                                <div class="accordion-body">
                                    <div class="table-responsive text-nowrap7">
                                        <table class="table-borderless table-sm table">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th class="text-center">Classe</th>
                                                    <th>Faixa</th>
                                                    <th>Descrição</th>
                                                    <th>Pontos</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @if (!isset($checkScore['message']))
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($scoreData['data'])->format('d/m/Y') }}
                                                            {{ $scoreData['hora'] }}</td>
                                                        <td class="text-center">{{ $scoreData['score_classe'] }}</td>
                                                        <td>{{ $scoreData['score_faixa_titulo'] }}</td>
                                                        <td>{{ $scoreData['score_faixa_descricao'] }}</td>
                                                        <td>{{ $scoreData['score_pontos'] }}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="5">{{ $checkScore['message'] }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    @if ($scoreData['acoes_valor_total'])
                                        <hr>
                                        <div class="table-responsive text-nowrap7">
                                            <table class="table-borderless table-sm table">
                                                <thead>
                                                    <tr>
                                                        <th>Última Ocorrência</th>
                                                        <th>Valor Ação Total</th>
                                                        <th>Quantidade de Ações</th>
                                                        <th>Renda Presumida</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @if (!isset($checkScore['message']))
                                                        <tr>
                                                            <td>{{ \Carbon\Carbon::parse($scoreData['acoes_ult_ocorrencia'])->format('d/m/Y') }}
                                                            </td>
                                                            <td>
                                                                R$
                                                                {{ number_format($scoreData['acoes_valor_total'], 2, ',', '.') }}
                                                            </td>
                                                            <td>{{ $scoreData['acoes_qtd'] }}</td>
                                                            <td>
                                                                {{ !empty(trim($scoreData['renda_presumida'] ?? ''))
                                                                    ? 'R$ ' . number_format($scoreData['renda_presumida'], 2, ',', '.')
                                                                    : 'Sem informação' }}
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td colspan="3">{{ $checkScore['message'] }}</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif

        <div class="row g-6 justify-content-center mt-2">
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
                                <div class="accordion-body mb-0 mt-0 pb-0 pt-0">
                                    {{ \Carbon\Carbon::parse($history['data'])->format('d/m/Y') }} {{ $history['hora'] }}
                                    - {{ $history['historico'] }}
                                    <hr>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 d-flex justify-content-between mb-5 mt-5">
                <a href="{{ route('propostal.index') }}" class="btn btn-label-secondary btn-prev waves-effect">
                    <i class="icon-base ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
                    <span class="d-sm-inline-block d-none align-middle">Voltar</span>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modalCancelar = new bootstrap.Modal(
                document.getElementById("modalCancelarProposta")
            );
            const form = document.getElementById("formCancelarProposta");

            // Envio do formulário
            form.addEventListener("submit", function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                const propostaId = "{{ $proposta['id'] }}";

                fetch(`/fianca/propostas/cancelar/${propostaId}`, {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector(
                                'input[name="_token"]'
                            ).value,
                        },
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        modalCancelar.hide();

                        Swal.fire({
                            icon: "success",
                            title: "Proposta cancelada com sucesso!",
                            confirmButtonText: "Voltar para listagem",
                        }).then(() => {
                            window.location.href = "{{ route('propostal.index') }}";
                        });
                    })
                    .catch((error) => {
                        console.error(error);
                        Swal.fire(
                            "Erro",
                            "Ocorreu um erro ao cancelar a proposta.",
                            "error"
                        );
                    });
            });
        });
    </script>
@endsection
