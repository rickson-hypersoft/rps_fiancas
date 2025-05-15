@extends('dashboard')
@section('content')
<div class="col-md-12">
    <div class="card mb-6">
        <!-- Account -->
        <div class="card-body pt-4">
             @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

         @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                    <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

            <form action="{{route('company.store', $company['id'])}}" method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                @csrf
                @method('PUT')
                <div class="row gy-4 gx-6 mb-6">
                    <div class="col-md-4 form-control-validation fv-plugins-icon-container">
                        <label for="razao" class="form-label">Razão</label>
                        <input class="form-control" type="text" id="razao" name="razao" value="{{$company['razao']}}" autofocus="" maxlength="100">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 form-control-validation fv-plugins-icon-container">
                        <label for="fantasia" class="form-label">Fantasia</label>
                        <input class="form-control" type="text" name="fantasia" maxlength="100" id="fantasia" value="{{$company['fantasia']}}">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input class="form-control" type="text" id="cnpj" name="cnpj" value="{{$company['cnpj']}}" maxlength="18">
                    </div>
                    <div class="col-md-4">
                        <label for="endereco" class="form-label">Endereco</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" value="{{$company['endereco']}}" maxlength="100">
                    </div>
                    <div class="col-md-4">
                        <label for="numero" class="form-label">Numero</label>
                        <input type="text" class="form-control" id="numero" name="numero" maxlength="30" value="{{$company['numero']}}">
                    </div>
                    <div class="col-md-4">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input class="form-control" type="text" id="bairro" name="bairro" maxlength="100" value="{{$company['bairro']}}">
                    </div>
                    <div class="col-md-4">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" maxlength="100" value="{{$company['cidade']}}">
                    </div>
                    <div class="col-md-4">
                        <label for="uf" class="form-label">UF</label>
                        <input type="text" value="{{$company['uf']}}" class="form-control" id="uf" name="uf" maxlength="2">
                    </div>
                    <div class="col-md-4">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" value="{{$company['cep']}}" id="cep" name="cep" maxlength="11">
                    </div>
                    <div class="col-md-4">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" class="form-control" value="{{$company['complemento']}}" id="complemento" name="complemento" maxlength="100">
                    </div>
                    <div class="col-md-4">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" value="{{$company['telefone']}}" class="form-control" id="telefone" name="telefone" maxlength="16">
                    </div>
                    <div class="col-md-4">
                        <label for="contato" class="form-label">Contato</label>
                        <input type="text" class="form-control" value="{{$company['contato']}}" id="contato" name="contato" maxlength="100">
                    </div>
                    <div class="col-md-4">
                        <label for="cargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control" value="{{$company['cargo']}}" id="cargo" name="cargo" maxlength="100">
                    </div>
                    <div class="col-md-4">
                        <label for="representante" class="form-label">Representante</label>
                        <input type="text" class="form-control" value="{{$company['representante']}}" id="representante" name="representante" maxlength="100">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" class="form-control" value="{{$company['email']}}" id="email" name="email" maxlength="150">
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-3 waves-effect waves-light">Salvar atualização</button>
                    <button type="reset" class="btn btn-label-secondary waves-effect">Cancelar</button>
                </div>
                <input type="hidden">
            </form>
        </div>
        <!-- /Account -->
    </div>

    <!--
    <div class="card">
        <h5 class="card-header">Delete Account</h5>
        <div class="card-body">
            <div class="mb-6 col-12 mb-0">
                <div class="alert alert-warning">
                    <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
                    <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
            </div>
            <form id="formAccountDeactivation" onsubmit="return false" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                <div class="form-check my-8">
                    <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation">
                    <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                </div>
                <button type="submit" class="btn btn-danger deactivate-account waves-effect waves-light" disabled="">
                    Deactivate Account
                </button>
                <input type="hidden">
            </form>
        </div>
    </div>
-->
</div>
@endsection
