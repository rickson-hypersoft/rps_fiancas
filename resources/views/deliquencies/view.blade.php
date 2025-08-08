@extends('dashboard')
@section('content')
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
                                $fiancaDisponivel = $propostal['imovel_aluguel'] * 40;
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
                                            <td>{{ $delinquencie['status'] }}</td>
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
                                                        <span class="badge bg-warning">
                                                            {{ $delinquencie['status'] }}
                                                        </span>
                                                        <h3>{{ $delinquencie['id'] }}</h3>

                                                        <div class="d-flex">
                                                            <button class="btn btn-outline-secondary">Cancelar
                                                                inadimplêmcia</button>
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
                                                                data-bs-target="#navs-top-home"
                                                                aria-controls="navs-top-home" aria-selected="true">
                                                                Detalhes
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button type="button" class="nav-link waves-effect"
                                                                role="tab" data-bs-toggle="tab"
                                                                data-bs-target="#navs-top-profile"
                                                                aria-controls="navs-top-profile" aria-selected="false"
                                                                tabindex="-1">
                                                                Movimentações
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button type="button" class="nav-link waves-effect"
                                                                role="tab" data-bs-toggle="tab"
                                                                data-bs-target="#navs-top-messages"
                                                                aria-controls="navs-top-messages" aria-selected="false"
                                                                tabindex="-1">
                                                                Comprovantes
                                                            </button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade active show" id="navs-top-home"
                                                            role="tabpanel">
                                                            <div class="row">
                                                                <div class="col-sm-4 col-12 card-header border py-2">
                                                                    <span>Data da comunicação</span>
                                                                    <h6>{{ $delinquencie['vencimento_original'] }}</h6>
                                                                </div>
                                                                <div class="col-sm-4 col-12 card-header border py-2">
                                                                    <span>Valor original</span>
                                                                    <h6>{{ $delinquencie['valor_original'] }}</h6>
                                                                </div>
                                                                <div class="col-sm-4 col-12 card-header border py-2">
                                                                    <span>Forme de Pagamento</span>
                                                                    <h6>TED</h6>
                                                                </div>
                                                                <div class="col-sm-4 col-12 card-header border py-2">
                                                                    <span>Tipo</span>
                                                                    <h6>TED</h6>
                                                                </div>
                                                                <div class="col-sm-4 col-12 card-header border py-2">
                                                                    <span>Valor aprovado</span>
                                                                    <h6>TED</h6>
                                                                </div>
                                                                <div class="col-sm-4 col-12 card-header border py-2">
                                                                    <span>Tipo da inadimplência</span>
                                                                    <h6>TED</h6>
                                                                </div>
                                                                <div class="col-sm-6 col-12 card-header border py-2">
                                                                    <span>Data do Pagamento</span>
                                                                    <h6>TED</h6>
                                                                </div>
                                                                <div class="col-sm-6 col-12 card-header border py-2"">
                                                                    <span>Valor Atualizado</span>
                                                                    <h6>TED</h6>
                                                                </div>
                                                                <div class="col-12 card-header border py-2"">
                                                                    <h4>Observação
                                                                    </h4>
                                                                    <span>Adicionadas na abertura da inadimplência</span>
                                                                    <textarea name="" disabled id="" cols="30" rows="10">
                                                                        Sem descrição
                                                                    </textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                                                            <p>
                                                                Donut dragée jelly pie halvah. Danish gingerbread bonbon
                                                                cookie wafer candy oat cake ice
                                                                cream. Gummies halvah tootsie roll muffin biscuit icing
                                                                dessert gingerbread. Pastry ice cream
                                                                cheesecake fruitcake.
                                                            </p>
                                                            <p class="mb-0">
                                                                Jelly-o jelly beans icing pastry cake cake lemon drops.
                                                                Muffin muffin pie tiramisu halvah
                                                                cotton candy liquorice caramels.
                                                            </p>
                                                        </div>

                                                        <div class="tab-pane fade" id="navs-top-messages"
                                                            role="tabpanel">
                                                            <p>
                                                                Oat cake chupa chups dragée donut toffee. Sweet cotton candy
                                                                jelly beans macaroon gummies
                                                                cupcake gummi bears cake chocolate.
                                                            </p>
                                                            <p class="mb-0">
                                                                Cake chocolate bar cotton candy apple pie tootsie roll ice
                                                                cream apple pie brownie cake. Sweet
                                                                roll icing sesame snaps caramels danish toffee. Brownie
                                                                biscuit dessert dessert. Pudding jelly
                                                                jelly-o tart brownie jelly.
                                                            </p>
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
            </div>
        </div>
    </div>
@endsection
