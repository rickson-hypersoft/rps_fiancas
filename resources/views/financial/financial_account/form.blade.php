@extends('dashboard')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    {{ $method == 'PUT' ? 'Editar Conta' : 'Cadastrar Conta' }}
                </h5>

                @if($method === 'PUT')
                <div class="form-check form-switch mb-0">
                    <input class="form-check-input" type="checkbox" id="user-status-switch" name="ativo" {{ $financialAccount['ativo'] ? 'checked' : '' }}>
                </div>
                @endif
            </div>
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

            <form action="{{ $action }}" method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework mb-0" novalidate="novalidate">
                @csrf
                @if($method === 'PUT')
                @method('PUT')
                @endif
                <div class="row gy-4 gx-6">
                    <div class="col-md-4 form-control-validation fv-plugins-icon-container">
                        <label for="tipo_conta" class="form-label">Tipo Conta</label>
                        <select class="form-select form-select-lg" name="tipo_conta" id="tipo_conta" aria-label="Default select example">
                            <option value="Conta Caixa" {{ old('tipo_conta', $financialAccount['tipo_conta'] ?? '' )=='Conta Caixa' ? 'selected' : '' }}>
                                Conta Caixa
                            </option>
                            <option value="Conta Bancária" {{ old('tipo_conta', $financialAccount['tipo_conta'] ?? '' )=='Conta Bancária' ? 'selected' : '' }}>
                                Conta Bancária
                            </option>
                            <option value="Outros" {{ old('tipo_conta', $financialAccount['tipo_conta'] ?? '' )=='Outros' ? 'selected' : '' }}>
                                Outros
                            </option>
                        </select>
                    </div>

                    @php
                    $tipoConta = old('tipo_conta', $financialAccount['tipo_conta'] ?? '');
                    $mostrarBanco = $tipoConta === 'Conta Bancária';
                    @endphp

                    <div class="col-md-4">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input value="{{ old('descricao', $financialAccount['descricao'] ?? '') }}" type="text" class="form-control form-control-lg" id="descricao" name="descricao" maxlength="100">
                    </div>

                    <div class="col-md-4" style="{{ $mostrarBanco ? '' : 'display: none;' }}">
                        <label for="banco_titular" class="form-label">Titular</label>
                        <input value="{{ old('banco_titular', $financialAccount['banco_titular'] ?? '') }}" type="text" class="form-control form-control-lg" id="banco_titular" name="banco_titular" maxlength="100">
                    </div>

                    <div class="col-md-4" style="{{ $mostrarBanco ? '' : 'display: none;' }}">
                        <label for="banco_cnpj" class="form-label">CNPJ</label>
                        <input value="{{ old('banco_cnpj', $financialAccount['banco_cnpj'] ?? '') }}" type="text" class="form-control form-control-lg" id="banco_cnpj" name="banco_cnpj" maxlength="100">
                    </div>

                    <div class="col-md-4" style="{{ $mostrarBanco ? '' : 'display: none;' }}">
                        <label for="banco" class="form-label">Código do Banco</label>
                        <input value="{{ old('banco', $financialAccount['banco'] ?? '') }}" type="text" class="form-control form-control-lg" id="banco" name="banco" maxlength="3">
                    </div>

                    <div class="col-md-4" style="{{ $mostrarBanco ? '' : 'display: none;' }}">
                        <label for="banco_agencia" class="form-label">Agência</label>
                        <input value="{{ old('banco_agencia', $financialAccount['banco_agencia'] ?? '') }}" type="text" class="form-control form-control-lg" id="banco_agencia" name="banco_agencia" maxlength="100">
                    </div>

                    <div class="col-md-4" style="{{ $mostrarBanco ? '' : 'display: none;' }}">
                        <label for="banco_conta" class="form-label">Conta</label>
                        <input value="{{ old('banco_conta', $financialAccount['banco_conta'] ?? '') }}" type="text" class="form-control form-control-lg" id="banco_conta" name="banco_conta" maxlength="100">
                    </div>

                    <div class="col-md-4" style="{{ $mostrarBanco ? '' : 'display: none;' }}">
                        <label for="banco_finalidade" class="form-label">Finalidade</label>
                        <select class="form-select form-select-lg" name="banco_finalidade" id="banco_finalidade" aria-label="Default select example">
                            <option value="">Selecionar finalidade</option>
                            <option value="Inadimplência e Comissão" {{ old('banco_finalidade', $financialAccount['banco_finalidade'] ?? '' )=='Inadimplência e Comissão' ? 'selected' : '' }}>
                                Inadimplência e Comissão
                            </option>
                            <option value="Inadimplência" {{ old('banco_finalidade', $financialAccount['banco_finalidade'] ?? '' )=='Inadimplência' ? 'selected' : '' }}>
                                Inadimplência
                            </option>
                            <option value="Comissão" {{ old('banco_finalidade', $financialAccount['banco_finalidade'] ?? '' )=='Comissão' ? 'selected' : '' }}>
                                Comissão
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4" style="{{ $mostrarBanco ? '' : 'display: none;' }}">
                        <label for="banco_pix" class="form-label">PIX</label>
                        <input value="{{ old('banco_pix', $financialAccount['banco_pix'] ?? '') }}" type="text" class="form-control form-control-lg" id="banco_pix" name="banco_pix" maxlength="100">
                    </div>



                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-3 waves-effect waves-light">{{$method == 'PUT' ? 'Salvar alterações' : 'Gravar'}}</button>
                        <a href="{{route('financial.financial_account.index')}}" class="btn btn-label-secondary waves-effect">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script>
    IMask(document.getElementById('banco_cnpj'), {
        mask: '00.000.000/0000-00'
    });

    function toggleBancoFields() {
        const tipoConta = document.getElementById('tipo_conta').value;

        // IDs dos campos que devem aparecer apenas para "Conta Bancária"
        const bancoFieldsIds = [
            'banco_titular',
            'banco_cnpj',
            'banco',
            'banco_agencia',
            'banco_conta',
            'banco_finalidade',
            'banco_pix'
        ];

        bancoFieldsIds.forEach(function (id) {
            const element = document.getElementById(id);
            if (element) {
                const parent = element.closest('.col-md-4') || element.parentElement;
                if (tipoConta === 'Conta Bancária') {
                    parent.style.display = 'block';
                } else {
                    parent.style.display = 'none';
                }
            }
        });
    }

    toggleBancoFields();
    document.getElementById('tipo_conta').addEventListener('change', toggleBancoFields);

</script>
@endsection
@endsection