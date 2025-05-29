@extends('dashboard')
@section('content')
<div class="col-md-12">
    <div class="card mb-6">
        <div class="card-header">
            <h6>
                {{$method == 'PUT' ? 'Editar Categoria' : 'Cadastrar Categoria'}}
            </h6>
            <hr>
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

            <form action="{{ $action }}" method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                @csrf
                @if($method === 'PUT')
                @method('PUT')
                @endif
                <div class="row gy-4 gx-6 mb-6">
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

                    @if($method === 'PUT')
                    <div class="col-md-4">
                        <label for="ativo" class="form-label">Ativo</label>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="user-status-switch" name="ativo" {{ $financialCategory['ativo'] ? 'checked' : '' }}>
                        </div>
                    </div>
                    @endif

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-3 waves-effect waves-light">Gravar</button>
                        <a href="{{route('financial.financial_category.index')}}" class="btn btn-label-secondary waves-effect">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
