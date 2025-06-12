@extends('dashboard')
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>
                Cadastrar Usuário
            </h5>
            <hr>
        </div>
        <div class="card-body pb-3">
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

            <form action="{{route('realestatesector.users.store')}}" method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                @csrf
                <div class="row gy-4 gx-6">
                    <div class="col-md-4 form-control-validation fv-plugins-icon-container">
                        <label for="usuario" class="form-label">Usuário</label>
                        <input value="{{ old('usuario') }}" class="form-control form-control-lg" type="text" id="usuario" name="usuario" maxlength="30">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 form-control-validation fv-plugins-icon-container">
                        <label for="senha" class="form-label">Senha</label>
                        <input value="{{ old('senha') }}" class="form-control form-control-lg" type="password" name="senha" maxlength="50" id="senha">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 form-control-validation fv-plugins-icon-container">
                        <label for="nome" class="form-label">Nome</label>
                        <input value="{{ old('nome') }}" class="form-control form-control-lg" type="text" name="nome" maxlength="50" id="nome">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>

                    <div class="col-md-4">
                        <label for="email" class="form-label">E-mail</label>
                        <input value="{{ old('email') }}" class="form-control form-control-lg" type="text" id="email" name="email" maxlength="150">
                    </div>

                    <div class="col-md-4">
                        <label for="cpf" class="form-label">CPF</label>
                        <input value="{{ old('cpf') }}" class="form-control form-control-lg" type="text" id="cpf" name="cpf" maxlength="18">
                    </div>
                    <div class="col-md-4">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input value="{{ old('telefone') }}" type="text" class="form-control form-control-lg" id="telefone" name="telefone" maxlength="16">
                    </div>
                    <div class="col-md-4">
                        <label for="nivel" class="form-label">Nivel</label>
                        <select class="form-select form-select-lg" name="nivel" id="nivel" aria-label="Default select example">
                            <option selected="">Selecionar o nível</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Corretor">Corretor</option>
                            <option value="Financeiro">Financeiro</option>
                        </select>
                    </div>
                    <hr>
                    <h6 class="m-0 pb-2 pt-2">Permissões</h6>
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="financeiro-alterar" name="permissoes[]" checked value="5">
                            <label class="form-check-label" for="financeiro-alterar">Financeiro Alterar</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="financeiro-excluir" name="permissoes[]" checked value="6">
                            <label class="form-check-label" for="financeiro-excluir">Financeiro Excluir</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="aceitar-termos" name="permissoes[]" checked value="7">
                            <label class="form-check-label" for="aceitar-termos">Aceitar Termos</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="acesso-comissoes" name="permissoes[]" checked value="8">
                            <label class="form-check-label" for="acesso-comissoes">Acesso a Comissões</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="acesso-renovacoes" name="permissoes[]" checked value="9">
                            <label class="form-check-label" for="acesso-renovacoes">Acesso a Renovações</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="acesso-simulador" name="permissoes[]" checked value="10">
                            <label class="form-check-label" for="acesso-simulador">Acesso ao simulador</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="criar-proposta" name="permissoes[]" checked value="11">
                            <label class="form-check-label" for="criar-proposta">Criar proposta</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="contratos" name="permissoes[]" checked value="12">
                            <label class="form-check-label" for="contratos">Contratos</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="notificacao-movimento-cobranca" name="permissoes[]" checked value="13">
                            <label class="form-check-label" for="notificacao-movimento-cobranca">Notificação de movimentação de cobrança</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="notificacao-movimentacao-contrato" name="permissoes[]" checked value="14">
                            <label class="form-check-label" for="notificacao-movimentacao-contrato">Notificação de movimentação de contrato</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="notificacao-movimentacao-padrao" name="permissoes[]" checked value="15">
                            <label class="form-check-label" for="notificacao-movimentacao-padrao">Notificação de movimentação padrão</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="notificacao-movimentacao-exoneracao" name="permissoes[]" checked value="16">
                            <label class="form-check-label" for="notificacao-movimentacao-exoneracao">Notificação de movimentação de exoneração</label>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-3 waves-effect waves-light">Gravar</button>
                        <a href="{{route('realestatesector.users.index')}}" class="btn btn-label-secondary waves-effect">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')
<script>
    IMask(document.getElementById('cpf'), {
        mask: '000.000.000-00'
    });
    IMask(document.getElementById('telefone'), {
        mask: '(00) 0 0000-0000'
    });
</script>
@endsection

@endsection