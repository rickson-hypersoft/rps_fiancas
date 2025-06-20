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
                <h5>Meu financeiro</h5>
                <div class="card">
                    <div class="card-body mb-1 pb-1">
                        <div class="row g-2 align-items-end">
                            {{-- Formulário de pesquisa --}}
                            <form action="{{ route('financial.financial_movi.index') }}" method="GET"
                                class="col-md-10 row g-2 align-items-end">

                                <div class="col-md-3">
                                    <label for="id_conta" class="form-label mb-1">Conta</label>
                                    <select class="form-select form-select-sm" name="id_conta" id="id_conta">
                                        <option value="">Todos</option>
                                        @foreach ($contas as $conta)
                                            <option value="{{ $conta['id'] }}"
                                                {{ request()->query('id_conta') == $conta['id'] ? 'selected' : '' }}>
                                                {{ $conta['descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @php
                                    $hoje = \Carbon\Carbon::now();
                                    $dataInicial = $hoje->copy()->startOfMonth()->format('Y-m-d');
                                    $dataFinal = $hoje->copy()->endOfMonth()->format('Y-m-d');
                                @endphp

                                <div class="col-md-2">
                                    <label for="data_inicial" class="form-label mb-1">Data Inicial</label>
                                    <input id="data_inicial" class="form-control form-control-sm" name="data_inicial"
                                        type="date"
                                        value="{{ old('data_inicial', request()->query('data_inicial', $dataInicial)) }}">
                                </div>

                                <div class="col-md-2">
                                    <label for="data_final" class="form-label mb-1">Data Final</label>
                                    <input id="data_final" class="form-control form-control-sm" name="data_final"
                                        type="date"
                                        value="{{ old('data_final', request()->query('data_final', $dataFinal)) }}">
                                </div>

                                <div class="col-md-3">
                                    <label for="id_categoria" class="form-label mb-1">Categoria</label>
                                    <select class="form-select form-select-sm" name="id_categoria" id="id_categoria">
                                        <option value="">Todos</option>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria['id'] }}"
                                                {{ request()->query('id_categoria') == $categoria['id'] ? 'selected' : '' }}>
                                                {{ $categoria['descricao'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 d-grid">
                                    <button type="submit" class="btn btn-primary btn-sm">Pesquisar</button>
                                </div>
                            </form>

                            {{-- Formulário de exportação XLSX --}}
                            <form method="GET" action="{{ route('financial.financial_movi.export') }}"
                                class="col-md-2 d-grid">
                                {{-- Mantendo os filtros na exportação --}}
                                <input type="hidden" name="id_conta" value="{{ request('id_conta') }}">
                                <input type="hidden" name="id_categoria" value="{{ request('id_categoria') }}">
                                <input type="hidden" name="data_inicial"
                                    value="{{ request('data_inicial') ?? $dataInicial }}">
                                <input type="hidden" name="data_final" value="{{ request('data_final') ?? $dataFinal }}">
                                <input type="hidden" name="search" value="{{ request('search') }}">

                                <button type="submit" class="btn btn-success btn-sm">Exportar XLSX</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-3 col-sm-6 mb-2">
                        <div class="card card-border-shadow-secondary h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial bg-label-secondary rounded"><i
                                                class="icon-base ti tabler-calendar icon-28px"></i></span>
                                    </div>
                                    <h4 class="mb-0">R$ {{ number_format($valores['saldoAnterior'], 2, ',', '.') }}</h4>
                                </div>
                                <p class="mb-1">Saldo Anterior</p>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 mb-2">
                        <div class="card card-border-shadow-primary h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial bg-label-primary rounded"><i
                                                class="icon-base ti tabler-moneybag icon-28px"></i></span>
                                    </div>
                                    <h4 class="mb-0">R$ {{ number_format($valores['entradas'], 2, ',', '.') }}</h4>

                                </div>
                                <p class="mb-1">Entradas</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 mb-2">
                        <div class="card card-border-shadow-danger h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial bg-label-danger rounded"><i
                                                class="icon-base ti tabler-moneybag icon-28px"></i></span>
                                    </div>
                                    <h4 class="mb-0">R$ {{ number_format($valores['saidas'], 2, ',', '.') }}</h4>
                                </div>
                                <p class="mb-1">Saídas</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 mb-2">
                        <div class="card card-border-shadow-success h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial bg-label-success rounded"><i
                                                class="icon-base ti tabler-moneybag icon-28px"></i></span>
                                    </div>
                                    <h4 class="mb-0">R$ {{ number_format($valores['saldoAtual'], 2, ',', '.') }}</h4>
                                </div>
                                <p class="mb-1">Saldo Atual</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-0 mt-5">
                    <div class="card-header">
                        <h5>Listagem das Movimentações</h5>
                        <hr>
                        <div class="row align-items-center pt-3">
                            <div class="col-sm-7 col-12 mb-1">
                                <form action="{{ route('financial.financial_movi.index') }}" method="GET">
                                    <label for="pesquisar" class="form-label">Pesquisar</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg"
                                            placeholder="Pesquisar pela conta" id="pesquisar"
                                            value="{{ request('search') }}" name="search"
                                            aria-label="Pesquisar pela conta" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-primary waves-effect" type="submit"
                                            id="button-addon2">
                                            <i class="icon-base ti tabler-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-5" style="text-align: right">
                                <a href="{{ route('financial.financial_movi.create') }}"
                                    class="btn btn-primary btn-lg waves-effect waves-light">Adicionar</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table" style="height: 250px;">
                            <table class="table-sm table-borderless table-striped table-hover table"
                                style="font-size: 18px;">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">Documento</th>
                                        <th>Conta</th>
                                        <th class="d-none d-lg-table-cell">Data</th>
                                        <th class="d-none d-lg-table-cell">Histórico</th>
                                        <th class="d-none d-lg-table-cell">Valor</th>
                                        <th class="d-none d-lg-table-cell">Tipo</th>
                                        <th class="text-center" style="width: 100px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="ViewNiveisLTableItens">
                                    @foreach ($movimentacoes as $movimentacao)
                                        <tr>
                                            <td style="width: 10px">{{ $movimentacao['id'] }}</td>
                                            <td>{{ collect($contas)->firstWhere('id', $movimentacao['id_conta'])['descricao'] ?? 'Conta não encontrada' }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($movimentacao['data'])->format('d/m/Y') }}</td>
                                            <td>{{ $movimentacao['historico'] }}</td>
                                            <td>R$ {{ number_format($movimentacao['valor'], 2, ',', '.') }}</td>
                                            <td><span
                                                    class="badge bg-label-{{ $movimentacao['tipo'] == 'Crédito' ? 'primary' : 'danger' }} me-1">{{ $movimentacao['tipo'] }}</span>
                                            </td>
                                            <td>
                                                <div class="dropdown" style="text-align: center;">
                                                    <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                                        data-bs-toggle="dropdown">
                                                        <i class="icon-base ti tabler-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item waves-effect"
                                                            href="{{ route('financial.financial_movi.edit', $movimentacao['id']) }}"><i
                                                                class="icon-base ti tabler-pencil me-1"></i> Editar</a>
                                                        <a class="dropdown-item waves-effect btn-excluir"
                                                            href="javascript:void(0);"
                                                            data-id="{{ $movimentacao['id'] }}"
                                                            data-route="{{ route('financial.financial_movi.delete', ['financeiro_movi' => '__id__']) }}">
                                                            <i class="icon-base ti tabler-trash me-1"></i> Excluir
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @php
                            $firstItem = $pagination['from'];
                            $lastItem = $pagination['to'];
                            $total = $pagination['total'];
                            $currentPage = $pagination['current_page'];
                            $lastPage = $pagination['last_page'];
                        @endphp

                        @if ($total > 0 && $lastPage > 1)
                            <div class="mt-25 float-end">
                                <div class="d-flex justify-content-between align-items-center mt-3 px-4 py-2"
                                    style="background: #eee; border-radius: 5rem;">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-excluir').forEach(function(btn) {
                console.log(btn)
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const route = this.dataset.route.replace('__id__', id);

                    Swal.fire({
                        title: 'Tem certeza que deseja excluir?',
                        html: `
                        <form id="form-excluir" action="${route}" method="POST">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').getAttribute('content')}">
                            <input type="hidden" name="_method" value="DELETE">
                            <p class="mt-3">Essa ação não poderá ser desfeita.</p>

                            <div style="display: flex; justify-content: center; gap: 10px; margin-top: 20px;">
                                <button type="button" class="swal2-cancel swal2-styled" onclick="Swal.close()">Cancelar</button>
                                <button type="submit" class="swal2-confirm swal2-styled" style="background-color:#d33;">Excluir</button>
                            </div>
                        </form>
                    `,
                        showConfirmButton: false,
                        showCancelButton: false,
                    });
                });
            });
        });
    </script>
@endsection
