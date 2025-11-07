@extends('dashboard')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible mb-4" role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h5>{{ $propostal['pessoa_nome'] }}</h5>
                        <span class="text-success">Número do Contrato: {{ $propostal['id'] }}</span>
                        <hr>
                        <span>
                            <span class="badge badge-center rounded-pill bg-success bg-glow"></span> Fiança disponível: R$
                            @php
                                $raw = $propostal['imovel_aluguel'] ?? '0';

                                // Mantém só dígitos, vírgula e ponto (remove R$, espaços, etc.)
                                $clean = preg_replace('/[^\d,\.]/', '', $raw); // ex: "1.200,00"

                                // Remove milhar (.) e troca vírgula por ponto
                                $normalized = str_replace(['.', ','], ['', '.'], $clean); // "1200.00"

                                $valor = (float) $normalized; // 1200.00
                                $fiancaDisponivel = $valor * 40;
                            @endphp
                            {{ number_format($fiancaDisponivel, 2, ',', '.') }}</span>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="table-responsive table" style="height: 250px;">
                            <h6 class="mb-4">Inadimplências do contrato</h6>
                            <table class="table-sm table-borderless table-striped table-hover table"
                                style="font-size: 18px;">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th class="d-none d-lg-table-cell">Status</th>
                                        <th class="d-none d-xl-table-cell">Valor original</th>
                                        <th>Vencimento original</th>
                                        <th>Comunicação em</th>
                                        <th>Valor atualizado</th>
                                        <th>Pagamento</th>
                                        {{-- <th class="text-center" style="width: 100px">Ações</th> --}}
                                    </tr>
                                </thead>
                                <tbody id="ViewNiveisLTableItens">
                                    @foreach ($deliquencies[0] as $delinquencie)
                                        @php
                                            $offcanvasId = 'offcanvas-' . $delinquencie['id'];

                                            $statusBadge = '';
                                            switch ($delinquencie['status']) {
                                                case 'Pendência Cancelada':
                                                    $statusBadge = 'danger';
                                                    break;
                                                case 'Acordo':
                                                    $statusBadge = 'success';
                                                    break;
                                                case 'Pendência Negada':
                                                    $statusBadge = 'dark';
                                                    break;
                                                case 'Pendência Aberta':
                                                    $statusBadge = 'warning';
                                                    break;
                                                default:
                                                    $statusBadge = 'secondary';
                                                    break;
                                            }
                                        @endphp
                                        <tr>
                                            <td>
                                                <button class="btn btn-primary waves-effect waves-light" type="button"
                                                    data-bs-toggle="offcanvas"
                                                    data-bs-target="#offcanvasBackdrop-{{ $offcanvasId }}"
                                                    aria-controls="offcanvasBackdrop-{{ $offcanvasId }}">
                                                    {{ $delinquencie['id'] }}
                                                </button>
                                            </td>
                                            <td class="d-none d-lg-table-cell"><span
                                                    class="badge bg-label-{{ $statusBadge }} rounded">{{ $delinquencie['status'] }}</span>
                                            </td>
                                            <td>
                                                R$ {{ number_format($delinquencie['valor_original'], 2, ',', '.') }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($delinquencie['vencimento_original'])->format('d/m/Y') }}
                                            </td>
                                            <td></td>
                                            <td>
                                                R$ {{ number_format($delinquencie['valor_aprovado'], 2, ',', '.') }}
                                            </td>
                                            <td> {{ \Carbon\Carbon::parse($delinquencie['data_pagamento'])->format('d/m/Y') }}
                                            </td>
                                            {{-- <td>
                                                Ações
                                            </td> --}}
                                        </tr>

                                        {{-- Offcanvas exclusivo para este item --}}
                                        <div class="offcanvas offcanvas-end m-0 p-0" tabindex="-1"
                                            id="offcanvasBackdrop-{{ $offcanvasId }}"
                                            aria-labelledby="offcanvasBackdropLabel" aria-modal="true" role="dialog"
                                            style="width: 700px !important">
                                            <div class="offcanvas-header mb-0 pb-0">
                                                <button type="button" class="btn-close text-reset"
                                                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body p-0">
                                                <div class="card">
                                                    <div class="card-header">
                                                        @php
                                                            $statusClass = match ($delinquencie['status']) {
                                                                'Pendência Aberta' => 'bg-warning',
                                                                'Pendência Cancelada' => 'bg-danger',
                                                                'Pendência Negada' => 'bg-dark',
                                                                'Acordo' => 'bg-success',
                                                                default => 'bg-secondary',
                                                            };
                                                        @endphp
                                                        <span class="badge {{ $statusClass }}">
                                                            {{ $delinquencie['status'] }}
                                                        </span>
                                                        <h3>Código da Inadimplência: {{ $delinquencie['id'] }}</h3>

                                                        <div class="d-flex gap-2">
                                                            @if ($delinquencie['status'] !== 'Pendência Cancelada' && $delinquencie['status'] !== 'Pendência Negada')
                                                                <a href="{{ route('delinquencies.delete', $delinquencie['id']) }}"
                                                                    class="btn btn-outline-secondary">
                                                                    Cancelar inadimplência
                                                                </a>
                                                            @endif
                                                            <button class="btn btn-outline-secondary">Alterar forma de
                                                                pagamento</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="nav-align-top nav-tabs-shadow">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button type="button" class="nav-link waves-effect active"
                                                                role="tab" data-bs-toggle="tab"
                                                                data-bs-target="#navs-top-home-{{ $delinquencie['id'] }}"
                                                                aria-controls="navs-top-home-{{ $delinquencie['id'] }}"
                                                                aria-selected="true">
                                                                Detalhes
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button type="button" class="nav-link waves-effect"
                                                                role="tab" data-bs-toggle="tab"
                                                                data-bs-target="#navs-top-profile-{{ $delinquencie['id'] }}"
                                                                aria-controls="navs-top-profile-{{ $delinquencie['id'] }}"
                                                                aria-selected="false" tabindex="-1">
                                                                Movimentações
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button type="button" class="nav-link waves-effect"
                                                                role="tab" data-bs-toggle="tab"
                                                                data-bs-target="#navs-top-messages-{{ $delinquencie['id'] }}"
                                                                aria-controls="navs-top-messages-{{ $delinquencie['id'] }}"
                                                                aria-selected="false" tabindex="-1">
                                                                Comprovantes
                                                            </button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade active show"
                                                            id="navs-top-home-{{ $delinquencie['id'] }}" role="tabpanel">
                                                            <div class="row">
                                                                <div class="col-sm-4 col-12 card-header border py-2">
                                                                    <span>Data da comunicação</span>
                                                                    <h6>{{ \Carbon\Carbon::parse($delinquencie['vencimento_original'])->format('d/m/Y') }}
                                                                    </h6>
                                                                </div>
                                                                <div class="col-sm-4 col-12 card-header border py-2">
                                                                    <span>Valor original</span>
                                                                    <h6>R$
                                                                        {{ number_format($delinquencie['valor_original'], 2, ',', '.') }}
                                                                    </h6>
                                                                </div>
                                                                <div class="col-sm-4 col-12 card-header border py-2">
                                                                    <span>Forme de Pagamento</span>
                                                                    <h6>{{ $delinquencie['forma_pagamento'] }}</h6>
                                                                </div>
                                                                <div class="col-sm-4 col-12 card-header border py-2">
                                                                    <span>Tipo</span>
                                                                    <h6>{{ $delinquencie['tipo_conta'] }}</h6>
                                                                </div>
                                                                <div class="col-sm-4 col-12 card-header border py-2">
                                                                    <span>Valor aprovado</span>
                                                                    <h6>R$
                                                                        {{ number_format($delinquencie['valor_original'], 2, ',', '.') }}
                                                                    </h6>
                                                                </div>
                                                                <div class="col-sm-4 col-12 card-header border py-2">
                                                                    <span>Tipo da inadimplência</span>
                                                                    <h6>{{ $delinquencie['tipo_inadimplencia'] }}</h6>
                                                                </div>
                                                                <div class="col-sm-6 col-12 card-header border py-2">
                                                                    <span>Data do Pagamento</span>
                                                                    <h6>{{ \Carbon\Carbon::parse($delinquencie['data_pagamento'])->format('d/m/Y') }}
                                                                    </h6>
                                                                </div>
                                                                <div class="col-sm-6 col-12 card-header border py-2"">
                                                                    <span>Valor Atualizado</span>
                                                                    <h6>R$
                                                                        {{ number_format($delinquencie['valor_aprovado'], 2, ',', '.') }}
                                                                </div>
                                                                <div class="col-12 card-header border py-2"">
                                                                    <h4>Observação
                                                                    </h4>
                                                                    <span>Adicionadas na abertura da inadimplência</span>
                                                                    <textarea style="width: 100%" name="" disabled id="" cols="30" rows="10">
                                                                        {{ trim($delinquencie['observacao']) ?? 'Sem descrição' }}
                                                                    </textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane fade"
                                                            id="navs-top-profile-{{ $delinquencie['id'] }}"
                                                            role="tabpanel">
                                                            <form
                                                                action="{{ route('delinquencies.adicionar_movimentacao') }}"
                                                                method="POST" class="form-movimentacao mb-2"
                                                                data-id="{{ $delinquencie['id'] }}">
                                                                @csrf
                                                                <h5>Movimentações</h5>
                                                                <label
                                                                    for="mensagem-{{ $delinquencie['id'] }}">Mensagem</label>
                                                                <textarea class="form-control" name="mensagem" id="mensagem-{{ $delinquencie['id'] }}" rows="3"
                                                                    placeholder="Envie mensagem sobre alterações ou informações relevantes"></textarea>
                                                                <button class="btn btn-secondary mt-2">Enviar</button>
                                                            </form>


                                                            <p class="mb-0 mt-4">
                                                                @foreach ($delinquencie['histories'] as $history)
                                                                    <div class="card mb-2">
                                                                        <div class="card-body">
                                                                            <div
                                                                                class="d-flex align-items-center mb-3 pb-1">
                                                                                <a href="javascript:;"
                                                                                    class="d-flex align-items-center">
                                                                                    <div class="text-heading h5 mb-0 me-2">
                                                                                        {{ $history['usuario']['nome'] }}
                                                                                    </div>
                                                                                </a>
                                                                                <div class="ms-auto">
                                                                                    <ul
                                                                                        class="list-inline d-flex align-items-center mb-0">
                                                                                        <li class="list-inline-item">
                                                                                            {{ \Carbon\Carbon::parse($history['data'])->format('d/m/Y') }}
                                                                                            -
                                                                                            {{ $history['hora'] }}
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <p class="mb-3 pb-1">
                                                                                {{ $history['historico'] }}
                                                                            </p>

                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </p>
                                                        </div>

                                                        <div class="tab-pane fade"
                                                            id="navs-top-messages-{{ $delinquencie['id'] }}"
                                                            role="tabpanel">
                                                            @foreach ($delinquencie['attachments'] as $attachment)
                                                                <div class="card btn-download-anexo mb-2"
                                                                    @if ($delinquencie['imovel_situacao'] == 'Desocupado') data-tipo="{{ $attachment['movi_sub'] }}"
                                                             @else
                                                             data-tipo="{{ $attachment['movi_sub'] }}" @endif
                                                                    data-id="{{ $delinquencie['id'] }}">
                                                                    <div class="card-body">
                                                                        <i class="ti tabler-file-type-pdf"></i>
                                                                        <span>{{ $attachment['movi_sub'] }}</span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{--
                        @php
                            $firstItem = $pagination['from'];
                            $lastItem = $pagination['to'];
                            $total = $pagination['total'];
                            $currentPage = $pagination['current_page'];
                            $lastPage = $pagination['last_page'];
                        @endphp

                        @if ($total > 0 && $lastPage > 1)
                            <div class="mt-25 float-end">
                                <div class="d-flex justify-content-between align-items-center bg-light mt-3 px-4 py-2"
                                    style="border-radius: 5rem;">
                                    <div class="mx-2">
                                        <span>{{ $firstItem }} a {{ $lastItem }} de {{ $total }}</span>
                                    </div>

                                    <nav aria-label="Page navigation">
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item first {{ $currentPage == 1 ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ url()->current() . '?page=1' }}"
                                                    aria-label="Primeira página">
                                                    <i class="icon-base ti tabler-chevrons-left icon-sm"></i>
                                                </a>
                                            </li>

                                            <li class="page-item prev {{ $currentPage == 1 ? 'disabled' : '' }}">
                                                <a class="page-link"
                                                    href="{{ url()->current() . '?page=' . max(1, $currentPage - 1) }}"
                                                    aria-label="Página anterior">
                                                    <i class="icon-base ti tabler-chevron-left icon-sm"></i>
                                                </a>
                                            </li>

                                            <li class="page-item next {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                                <a class="page-link"
                                                    href="{{ url()->current() . '?page=' . min($lastPage, $currentPage + 1) }}"
                                                    aria-label="Próxima página">
                                                    <i class="icon-base ti tabler-chevron-right icon-sm"></i>
                                                </a>
                                            </li>

                                            <li class="page-item last {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ url()->current() . '?page=' . $lastPage }}"
                                                    aria-label="Última página">
                                                    <i class="icon-base ti tabler-chevrons-right icon-sm"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        @endif
                        --}}
                    </div>
                </div>

                <div class="card mt-5">
                    @foreach ($deliquencies[0] as $delinquencie)
                        @foreach ($delinquencie['histories'] as $history)
                            <div class="card-body pb-0">
                                <div class="card-body m-0 p-0">
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:;" class="d-flex align-items-center">
                                            <div class="text-heading h5 mb-0 me-2">
                                                {{ $history['usuario']['nome'] }}
                                            </div>
                                        </a>
                                        <div class="ms-auto">
                                            <ul class="list-inline d-flex align-items-center mb-0">
                                                <li class="list-inline-item">
                                                    {{ \Carbon\Carbon::parse($history['data'])->format('d/m/Y') }}
                                                    -
                                                    {{ $history['hora'] }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="mb-1 pb-1">
                                        {{ $history['historico'] }}
                                    </p>

                                </div>
                                <hr>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.btn-download-anexo').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const tipo = this.dataset.tipo;
                const idContrato = this.dataset.id;

                fetch(`/fianca/inadimplencias/anexos/baixar/${idContrato}/${tipo}`)
                    .then(res => {
                        if (!res.ok) throw new Error('Erro ao abrir o anexo');
                        window.open(
                            `/fianca/inadimplencias/anexos/baixar/${idContrato}/${tipo}`,
                            '_blank');
                    })
                    .catch(error => {
                        Swal.fire('Erro', 'Arquivo não encontrado.', 'error');
                    });
            });
        });
    })


    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".form-movimentacao").forEach(function(form) {
            form.addEventListener("submit", function(e) {
                e.preventDefault();

                let id = form.getAttribute("data-id");
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    "content");

                let formData = new FormData(form);
                let mensagem = formData.get("mensagem");

                fetch(form.getAttribute("action"), {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": token,
                            "Accept": "application/json",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            id: id,
                            mensagem: mensagem
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            let openedCanvas = document.querySelector(
                                '.offcanvas.show');
                            if (openedCanvas) {
                                let bsOffcanvas = bootstrap.Offcanvas
                                    .getInstance(openedCanvas);
                                bsOffcanvas.hide();
                            }

                            Swal.fire({
                                icon: "success",
                                title: "Sucesso!",
                                text: "Movimentação adicionada.",
                                timer: 2000,
                                showConfirmButton: false,
                                willClose: () => {
                                    location.reload();
                                }
                            });
                            form.reset();
                        } else {
                            let openedCanvas = document.querySelector(
                                '.offcanvas.show');
                            if (openedCanvas) {
                                let bsOffcanvas = bootstrap.Offcanvas
                                    .getInstance(openedCanvas);
                                bsOffcanvas.hide();
                            }

                            Swal.fire({
                                icon: "error",
                                title: "Erro!",
                                text: "Não foi possível adicionar a movimentação."
                            });
                        }
                    })
                    .catch(() => {
                        let openedCanvas = document.querySelector(
                            '.offcanvas.show');
                        if (openedCanvas) {
                            let bsOffcanvas = bootstrap.Offcanvas
                                .getInstance(openedCanvas);
                            bsOffcanvas.hide();
                        }

                        Swal.fire({
                            icon: "error",
                            title: "Erro!",
                            text: "Falha na comunicação com o servidor."
                        });
                    });
            });
        });
    });
</script>
