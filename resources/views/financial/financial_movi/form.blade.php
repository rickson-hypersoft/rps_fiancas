@extends('dashboard')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <form action="{{route('financial.financial_movi.store')}}" method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework mb-0" novalidate="novalidate">
                @csrf
        </div>
        <div class="card-body">
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


            <div class="row gy-4 gx-6">
                <div class="col-md-4">
                    <label for="data" class="form-label">Data de Lançamento</label>
                   <input type="date" class="form-control form-control-lg" name="data" id="data" value="">
                </div>

                 <div class="col-md-4">
                    <label for="valor" class="form-label">Valor</label>
                     <div class="input-group input-group-merge input-group-lg">
                        <span class="input-group-text">
                            <i class="ti tabler-currency-dollar"></i>
                        </span>
                        <input name="valor" style="text-align: right" id="valor" type="number" class="form-control form-control-lg" value="" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>

               <div class="col-md-4">
                    <label for="conta" class="form-label">Conta</label>
                    <select class="form-select form-select-lg" name="id_conta" id="conta" aria-label="Default select example">
                        <option value="">Todos</option>
                        @foreach ($contas as $conta)
                        <option value="{{$conta['id']}}">{{$conta['descricao']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select class="form-select form-select-lg" name="id_categoria" id="categoria" aria-label="Default select example">
                        <option value="">Todos</option>
                        @foreach ($categorias as $categoria)
                        <option value="{{$categoria['id']}}">{{$categoria['descricao']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="tipo" class="form-label">Tipo</label>
                    <select class="form-select form-select-lg" name="tipo" id="tipo" aria-label="Default select example">
                        <option value="">Selecionar Tipo</option>
                        <option value="D">
                            Débito
                        </option>
                        <option value="C">
                            Crédito
                        </option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="historico" class="form-label">Histórico</label>
                  <textarea class="form-control" name="historico" id="historico" rows="3"></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-3 waves-effect waves-light">Salvar alteração</button>
                    <a href="" class="btn btn-label-secondary waves-effect">Cancelar</a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
