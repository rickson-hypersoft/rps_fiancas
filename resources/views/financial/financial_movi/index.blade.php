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
            <h5>Meu financeiro</h5>
            <div class="card">
                <div class="card-body  mb-1 pb-1">
                    <form action="" class="row">
                        <div class="mb-4 col-md-3">
                            <label for="largeInput" class="form-label">Conta</label>
                            <select class="form-select form-select-lg" name="status" id="status">
                                <option value="">Todos</option>
                                 @foreach ($contas as $conta)
                        <option value="{{$conta['id']}}">{{$conta['descricao']}}</option>
                        @endforeach
                            </select>
                        </div>
                        <div class="mb-4 col-md-2">
                            <label for="largeInput" class="form-label">Data Inicial</label>
                            <input id="largeInput" class="form-control form-control-lg" type="date">
                        </div>
                        <div class="mb-4 col-md-2">
                            <label for="largeInput" class="form-label">Data Final</label>
                            <input id="largeInput" class="form-control form-control-lg" type="date">
                        </div>
                        <div class="mb-4 col-md-3">
                            <label for="largeInput" class="form-label">Categoria</label>
                            <select class="form-select form-select-lg" name="status" id="status">
                                <option value="">Todos</option>
                                 @foreach ($categorias as $categoria)
                        <option value="{{$categoria['id']}}">{{$categoria['descricao']}}</option>
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
                                <h4 class="mb-0">R$ 182.452,69</h4>
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
                                <h4 class="mb-0"></h4>

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
                                <h4 class="mb-0"></h4>
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
                                <h4 class="mb-0"></h4>
                            </div>
                            <p class="mb-1">Saldo Atual</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-0">
                <div class="card-header">
                    <hr>
                    <div class="row align-items-center pt-5">
                        <div class="col-sm-7 col-12 mb-1">
                            <form action="" method="GET">
                                <label for="pesquisar" class="form-label">Pesquisar</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" placeholder="Pesquisar pela descrição" id="pesquisar" value="{{request('search')}}" name="search" aria-label="Pesquisar pela descrição" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-primary waves-effect" type="submit" id="button-addon2">
                                        <i class="icon-base ti tabler-search"></i>
                                    </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-5 mt-4" style="text-align: right">
                        <a href="{{route('financial.financial_movi.create')}}" class="btn btn-primary btn-lg waves-effect waves-light">Adicionar</a>
                    </div>
                </div>
            </div>
            <div class="card-body mt-5">
                <div class="table table-responsive" style="height: 250px;">
                    <table class="table table-sm table-borderless table-striped table-hover" style="font-size: 18px;">
                        <thead>
                            <tr>
                                <th>Documento</th>
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
                                    <td>{{$movimentacao['id_conta']}}</td>
                                    <td>{{$movimentacao['data']}}</td>
                                    <td>{{$movimentacao['historico']}}</td>
                                    <td>{{$movimentacao['tipo']}}</td>
                                    <td>
                                        <a href="">Link</a>
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

@endsection
