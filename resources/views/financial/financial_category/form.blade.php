@extends('dashboard')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <form action="{{ $action }}" method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework mb-0" novalidate="novalidate">
                @csrf
                @if($method === 'PUT')
                @method('PUT')
                @endif
                <div class="d-flex justify-content-between align-items-center">
                    <h5>
                        {{$method == 'PUT' ? 'Editar Categoria' : 'Cadastrar Categoria'}}
                    </h5>
                    @if($method === 'PUT')
                    <div class="form-check form-switch mb-0">
                        <input class="form-check-input" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Ativar/Desativar" type="checkbox" id="user-status-switch" name="ativo" {{ $financialCategory['ativo'] ? 'checked' : '' }}>
                    </div>
                    @endif
                </div>
                <hr class="mt-0 pt-0">
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
                    <label for="descricao" class="form-label">Descrição</label>
                    <input value="{{ old('descricao', $financialCategory['descricao'] ?? '') }}" type="text" class="form-control form-control-lg" id="descricao" name="descricao" maxlength="100">
                </div>

                <div class="col-md-4">
                    <label for="tipo" class="form-label">Tipo</label>
                    <select class="form-select form-select-lg" name="tipo" id="tipo" aria-label="Default select example">
                        <option value="">Selecionar Tipo</option>
                        <option value="D" {{ old('tipo', $financialCategory['tipo'] ?? '' )=='Débito' ? 'selected' : '' }}>
                            Débito
                        </option>
                        <option value="C" {{ old('tipo', $financialCategory['tipo'] ?? '' )=='Crédito' ? 'selected' : '' }}>
                            Crédito
                        </option>
                        <option value="E" {{ old('tipo', $financialCategory['tipo'] ?? '' )=='Escolher' ? 'selected' : '' }}>
                            Escolher
                        </option>
                    </select>
                </div>

                <!--
                    <div class="col-md-4">
                        <label for="sistema" class="form-label">Sistema</label>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="sistema" name="sistema" {{ isset($financialCategory['sistema']) && $financialCategory['sistema'] ? 'checked' : '' }}>
                        </div>
                    </div>
                    -->

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-3 waves-effect waves-light">{{$method == 'PUT' ? 'Salvar alteração' : 'Gravar'}}</button>
                    <a href="{{route('financial.financial_category.index')}}" class="btn btn-label-secondary waves-effect">Cancelar</a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection