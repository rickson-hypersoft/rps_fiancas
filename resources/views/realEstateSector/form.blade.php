@extends('dashboard')
@section('content')
<div class="col-md-12">
    <div class="card mb-6">
        <div class="card-header">
            <h6>
                {{$method == 'PUT' ? 'Editar Imobiliária' : 'Cadastrar Imobiliária'}}
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
                    <div class="col-md-4 form-control-validation fv-plugins-icon-container">
                        <label for="razao" class="form-label">Razão</label>
                        <input class="form-control form-control-lg" type="text" id="razao" name="razao" maxlength="100" value="{{ old('razao', $realEstateSector['razao'] ?? '') }}">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 form-control-validation fv-plugins-icon-container">
                        <label for="fantasia" class="form-label">Fantasia</label>
                        <input class="form-control form-control-lg" type="text" name="fantasia" maxlength="100" id="fantasia" value="{{ old('fantasia', $realEstateSector['fantasia'] ?? '') }}">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="creci" class="form-label">CRECI</label>
                        <input class="form-control form-control-lg" type="text" id="creci" name="creci" maxlength="18" value="{{ old('creci', $realEstateSector['creci'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input class="form-control form-control-lg" type="text" id="cnpj" name="cnpj" maxlength="18" value="{{ old('cnpj', $realEstateSector['cnpj'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="endereco" class="form-label">Endereco</label>
                        <input type="text" class="form-control form-control-lg" id="endereco" name="endereco" maxlength="100" value="{{ old('endereco', $realEstateSector['endereco'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="numero" class="form-label">Numero</label>
                        <input type="text" class="form-control form-control-lg" id="numero" name="numero" maxlength="30" value="{{ old('numero', $realEstateSector['numero'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input class="form-control form-control-lg" type="text" id="bairro" name="bairro" maxlength="100" value="{{ old('bairro', $realEstateSector['bairro'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control form-control-lg" id="cidade" name="cidade" maxlength="100" value="{{ old('cidade', $realEstateSector['cidade'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="uf" class="form-label">UF</label>
                        <input type="text" class="form-control form-control-lg" id="uf" name="uf" maxlength="2" value="{{ old('uf', $realEstateSector['uf'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control form-control-lg" id="cep" name="cep" maxlength="11" value="{{ old('cep', $realEstateSector['cep'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" class="form-control form-control-lg" id="complemento" name="complemento" maxlength="100" value="{{ old('complemento', $realEstateSector['complemento'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control form-control-lg" id="telefone" name="telefone" maxlength="16" value="{{ old('telefone', $realEstateSector['telefone'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="contato" class="form-label">Contato</label>
                        <input type="text" class="form-control form-control-lg" id="contato" name="contato" maxlength="100" value="{{ old('contato', $realEstateSector['contato'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="cargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control form-control-lg" id="cargo" name="cargo" maxlength="100" value="{{ old('cargo', $realEstateSector['cargo'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="representante" class="form-label">Representante</label>
                        <input type="text" class="form-control form-control-lg" id="representante" name="representante" maxlength="100" value="{{ old('representante', $realEstateSector['representante'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" class="form-control form-control-lg" id="email" name="email" maxlength="150" value="{{ old('email', $realEstateSector['email'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="tipo_pagamento" class="form-label">Tipo Pagamento</label>
                        <input type="text" class="form-control form-control-lg" id="tipo_pagamento" name="tipo_pagamento" maxlength="30" value="{{ old('tipo_pagamento', $realEstateSector['tipo_pagamento'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="taxa_padrao" class="form-label">Taxa Padrão</label>
                        <input type="text" class="form-control form-control-lg" id="taxa_padrao" name="taxa_padrao" value="{{ old('taxa_padrao', $realEstateSector['taxa_padrao'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="custo_saida" class="form-label">Custo Saída</label>
                        <input type="text" class="form-control form-control-lg" id="custo_saida" name="custo_saida" value="{{ old('custo_saida', $realEstateSector['custo_saida'] ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="cobertura_total" class="form-label">Cobertura Total</label>
                        <input type="text" class="form-control form-control-lg" id="cobertura_total" name="cobertura_total" value="{{ old('cobertura_total', $realEstateSector['cobertura_total'] ?? '') }}">
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-3 waves-effect waves-light">Gravar</button>
                        <a href="{{route('realestatesector.index')}}" class="btn btn-label-secondary waves-effect">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const taxa = this.getAttribute('data-taxa');
                const ativo = this.getAttribute('data-ativo');

                document.getElementById('setup_id').value = id;
                document.getElementById('setup_taxa').value = taxa;
                document.getElementById('setup_ativo').checked = ativo == '1' || ativo === true;

                // Atualizar action do form
                const form = document.getElementById('setup_form');
                form.action = `/adm/imobiliarias/editar/${id}`;
            });
        });
    });
</script>

@section('scripts')
<script>
    IMask(document.getElementById('cnpj'), {
        mask: '00.000.000/0000-00'
    });
    IMask(document.getElementById('cep'), {
        mask: '00000-000'
    });
    IMask(document.getElementById('telefone'), {
        mask: '(00) 0 0000-0000'
    });
</script>
@endsection
@endsection
