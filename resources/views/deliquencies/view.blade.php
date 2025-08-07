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
                        <span class="text-success">Contrato: {{ $propostal['id'] }}</span>
                        <hr>
                        <span><span class="badge badge-center rounded-pill bg-success bg-glow"></span> Fiança disponível: R$
                            {{ $propostal['imovel_aluguel'] * 40 }}</span>
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
                                        <th class="text-center">Valor atualizado</th>
                                        <th class="text-center">Pagamento</th>
                                        <th class="text-center" style="width: 100px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="ViewNiveisLTableItens">
                                    @foreach ($deliquencies as $delinquencie)
                                        @php
                                            $offcanvasId = 'offcanvas-' . $delinquencie['id'];
                                        @endphp
                                        <tr>
                                            <td>
                                                <button class="btn btn-primary waves-effect waves-light" type="button"
                                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasBackdrop"
                                                    aria-controls="offcanvasBackdrop">
                                                    {{ $delinquencie['id'] }}

                                                </button>
                                            </td>
                                            <td>{{ $delinquencie['status'] }}</td>
                                            <td>{{ $delinquencie['valor_original'] }}</td>
                                            <td>{{ $delinquencie['vencimento_original'] }}</td>
                                            <td></td>
                                            <td>{{ $delinquencie['valor_aprovado'] }}</td>
                                            <td>{{ $delinquencie['conta_bancaria_id'] }}</td>
                                            <td>
                                                Ações
                                            </td>
                                        </tr>

                                        {{-- Offcanvas exclusivo para este item --}}
                                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBackdrop"
                                            aria-labelledby="offcanvasBackdropLabel" aria-modal="true" role="dialog">
                                            <div class="offcanvas-header">
                                                <h5 id="{{ $offcanvasId }}-label" class="offcanvas-title">Detalhes da
                                                    Dívida #{{ $delinquencie['id'] }}</h5>
                                                <button type="button" class="btn-close text-reset"
                                                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body">
                                                <p>Status: {{ $delinquencie['status'] }}</p>
                                                <p>Valor Original: R$
                                                    {{ number_format($delinquencie['valor_original'], 2, ',', '.') }}</p>
                                                <p>Vencimento: {{ $delinquencie['vencimento_original'] }}</p>
                                                <p>Valor Aprovado: R$
                                                    {{ number_format($delinquencie['valor_aprovado'], 2, ',', '.') }}</p>
                                                <p>Conta Bancária: {{ $delinquencie['conta_bancaria_id'] }}</p>

                                                <button type="button" class="btn btn-primary w-100 mb-2">Ação</button>
                                                <button type="button" class="btn btn-secondary w-100"
                                                    data-bs-dismiss="offcanvas">Fechar</button>
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
