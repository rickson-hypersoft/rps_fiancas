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
                <div class="card-body  mb-1 pb-1">
                    <form action="{{route('financial.financial_movi.index')}}" class="row">
                        <div class="mb-4 col-md-3">
                            <label for="largeInput" class="form-label">Conta</label>
                            <select class="form-select form-select-lg" name="id_conta" id="id_conta">
                                <option value="">Todos</option>
                                @foreach ($contas as $conta)
                                <option value="{{ $conta['id'] }}" {{ request()->query('id_conta') == $conta['id'] ? 'selected' : '' }}>
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

                        <div class="mb-4 col-md-2">
                            <label for="data_inicial" class="form-label">Data Inicial</label>
                            <input id="data_inicial" class="form-control form-control-lg" name="data_inicial" type="date" value="{{ old('data_inicial', request()->query('data_inicial', $dataInicial)) }}">
                        </div>

                        <div class="mb-4 col-md-2">
                            <label for="data_final" class="form-label">Data Final</label>
                            <input id="data_final" class="form-control form-control-lg" name="data_final" type="date" value="{{ old('data_final', $dataFinal) }}">
                        </div>
                        <div class="mb-4 col-md-3">
                            <label for="largeInput" class="form-label">Categoria</label>
                            <select class="form-select form-select-lg" name="id_categoria" id="id_categoria">
                                <option value="">Todos</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{$categoria['id']}}" {{ request()->query('id_categoria') == $categoria['id'] ? 'selected' : '' }}>{{$categoria['descricao']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-lg mt-5">Pesquisar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-3 col-sm-6 mb-2">
                    <div class="card card-border-shadow-secondary h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <div class="avatar me-4">
                                    <span class="avatar-initial rounded bg-label-secondary"><i class="icon-base ti tabler-calendar icon-28px"></i></span>
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
                                    <span class="avatar-initial rounded bg-label-primary"><i class="icon-base ti tabler-moneybag icon-28px"></i></span>
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
                                    <span class="avatar-initial rounded bg-label-danger"><i class="icon-base ti tabler-moneybag icon-28px"></i></span>
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
                                    <span class="avatar-initial rounded bg-label-success"><i class="icon-base ti tabler-moneybag icon-28px"></i></span>
                                </div>
                                <h4 class="mb-0">R$ {{ number_format($valores['saldoAtual'], 2, ',', '.') }}</h4>
                            </div>
                            <p class="mb-1">Saldo Atual</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-0">
                <div class="card-header">
                    <h5>Listagem das Movimentações</h5>
                    <hr>
                    <div class="row align-items-center pt-5">
                        <div class="col-sm-7 col-12 mb-1">
                            <form action="{{route('financial.financial_movi.index')}}" method="GET">
                                <label for="pesquisar" class="form-label">Pesquisar</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" placeholder="Pesquisar pela conta" id="pesquisar" value="{{request('search')}}" name="search" aria-label="Pesquisar pela conta" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-primary waves-effect" type="submit" id="button-addon2">
                                        <i class="icon-base ti tabler-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                          <div class="col-sm-5" style="text-align: right">
                        <a href="{{route('financial.financial_movi.create')}}" class="btn btn-primary btn-lg waves-effect waves-light">Adicionar</a>
                    </div>
                    </div>
            </div>
            <div class="card-body mt-5">
                <div class="table table-responsive" style="height: 250px;">
                    <table class="table table-sm table-borderless table-striped table-hover" style="font-size: 18px;">
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
                                <td style="width: 10px">{{$movimentacao['id']}}</td>
                                <td>{{
                                    collect($contas)->firstWhere('id', $movimentacao['id_conta'])['descricao'] ?? 'Conta não encontrada'
                                    }}</td>
                                <td>{{ \Carbon\Carbon::parse($movimentacao['data'])->format('d/m/Y') }}</td>
                                <td>{{$movimentacao['historico']}}</td>
                                <td>R$ {{ number_format($movimentacao['valor'], 2, ',', '.') }}</td>
                                <td><span class="badge bg-label-{{$movimentacao['tipo'] == 'Crédito' ? 'primary' : 'danger'}} me-1">{{$movimentacao['tipo']}}</span></td>
                                <td>
                                    <div class="dropdown" style="text-align: center;">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="icon-base ti tabler-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect" href="{{route('financial.financial_movi.edit', $movimentacao['id'])}}"><i class="icon-base ti tabler-pencil me-1"></i> Editar</a>
                                            <a class="dropdown-item waves-effect btn-excluir" href="javascript:void(0);" data-id="{{$movimentacao['id']}}" data-route="{{ route('financial.financial_movi.delete', ['financeiro_movi' => '__id__']) }}">
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
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-excluir').forEach(function (btn) {
            console.log(btn)
            btn.addEventListener('click', function () {
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
