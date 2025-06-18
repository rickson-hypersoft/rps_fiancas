@extends('dashboard')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>
                    Editar Usuário
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

                <form action="{{ route('realestatesector.users.update', $user['id']) }}" method="POST"
                    class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                    @csrf
                    @method('PUT')
                    <div class="row gy-4 gx-6">
                        <input class="form-control form-control-lg" type="text" id="id_imobiliaria" name="id_imobiliaria"
                            hidden value="{{ old('id_imobiliaria', $user['id_imobiliaria'] ?? '') }}">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                        <div class="col-md-4 form-control-validation fv-plugins-icon-container">
                            <label for="usuario" class="form-label">Usuário</label>
                            <input class="form-control form-control-lg" type="text" id="usuario" name="usuario"
                                maxlength="30" value="{{ old('usuario', $user['usuario'] ?? '') }}">
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="col-md-4 form-control-validation fv-plugins-icon-container">
                            <label for="nome" class="form-label">Nome</label>
                            <input class="form-control form-control-lg" type="text" name="nome" maxlength="50"
                                id="nome" value="{{ old('nome', $user['nome'] ?? '') }}">
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control form-control-lg" type="text" id="email" name="email"
                                maxlength="150" value="{{ old('email', $user['email'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="cpf" class="form-label">CPF</label>
                            <input class="form-control form-control-lg" type="text" id="cpf" name="cpf"
                                maxlength="18" value="{{ old('cpf', $user['cpf'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control form-control-lg" id="telefone" name="telefone"
                                maxlength="16" value="{{ old('telefone', $user['telefone'] ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="nivel" class="form-label">Nivel</label>
                            <select class="form-select form-select-lg" name="nivel" id="nivel"
                                aria-label="Default select example">
                                <option selected="">Selecionar o nível</option>
                                <option {{ ($user['nivel'] ?? '') == 'Administrador' ? 'selected' : '' }}
                                    value="Administrador">Administrador</option>
                                <option {{ ($user['nivel'] ?? '') == 'Corretor' ? 'selected' : '' }} value="Corretor">
                                    Corretor</option>
                                <option {{ ($user['nivel'] ?? '') == 'Financeiro' ? 'selected' : '' }} value="Financeiro">
                                    Financeiro</option>
                            </select>
                        </div>

                        <hr>
                        <h6 class="m-0 pb-2 pt-2">Permissões</h6>
                        @php
                            if ($permissoes) {
                                $permissoesArray = explode('|', trim($permissoes, '|'));
                            } else {
                                $permissoesArray = [];
                            }
                        @endphp

                        <div class="col-md-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="permissoes[]"
                                    id="financeiro-adicionar" {{ in_array('4', $permissoesArray) ? 'checked' : '' }}
                                    value="4">
                                <label class="form-check-label" for="financeiro-adicionar">Financeiro Adicionar</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="permissoes[]" id="financeiro-alterar"
                                    {{ in_array('5', $permissoesArray) ? 'checked' : '' }} value="5">
                                <label class="form-check-label" for="financeiro-alterar">Financeiro Alterar</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="permissoes[]"
                                    id="financeiro-excluir" {{ in_array('6', $permissoesArray) ? 'checked' : '' }}
                                    value="6">
                                <label class="form-check-label" for="financeiro-excluir">Financeiro Excluir</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="permissoes[]" id="aceitar-termos"
                                    {{ in_array('7', $permissoesArray) ? 'checked' : '' }} value="7">
                                <label class="form-check-label" for="aceitar-termos">Aceitar Termos</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="permissoes[]"
                                    id="acesso-comissoes" {{ in_array('8', $permissoesArray) ? 'checked' : '' }}
                                    value="8">
                                <label class="form-check-label" for="acesso-comissoes">Acesso a Comissões</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="permissoes[]"
                                    id="acesso-renovacoes" {{ in_array('9', $permissoesArray) ? 'checked' : '' }}
                                    value="9">
                                <label class="form-check-label" for="acesso-renovacoes">Acesso a Renovações</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="permissoes[]"
                                    id="acesso-simulador" {{ in_array('10', $permissoesArray) ? 'checked' : '' }}
                                    value="10">
                                <label class="form-check-label" for="acesso-simulador">Acesso ao simulador</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="permissoes[]" id="criar-proposta"
                                    {{ in_array('11', $permissoesArray) ? 'checked' : '' }} value="11">
                                <label class="form-check-label" for="criar-proposta">Criar proposta</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="permissoes[]" id="contratos"
                                    {{ in_array('12', $permissoesArray) ? 'checked' : '' }} value="12">
                                <label class="form-check-label" for="contratos">Contratos</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="permissoes[]"
                                    id="notificacao-movimento-cobranca"
                                    {{ in_array('13', $permissoesArray) ? 'checked' : '' }} value="13">
                                <label class="form-check-label" for="notificacao-movimento-cobranca">Notificação de
                                    movimentação de cobrança</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="permissoes[]"
                                    id="notificacao-movimentacao-contrato"
                                    {{ in_array('14', $permissoesArray) ? 'checked' : '' }} value="14">
                                <label class="form-check-label" for="notificacao-movimentacao-contrato">Notificação de
                                    movimentação de contrato</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="permissoes[]"
                                    id="notificacao-movimentacao-padrao"
                                    {{ in_array('15', $permissoesArray) ? 'checked' : '' }} value="15">
                                <label class="form-check-label" for="notificacao-movimentacao-padrao">Notificação de
                                    movimentação padrão</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="permissoes[]"
                                    id="notificacao-movimentacao-exoneracao"
                                    {{ in_array('16', $permissoesArray) ? 'checked' : '' }} value="16">
                                <label class="form-check-label" for="notificacao-movimentacao-exoneracao">Notificação de
                                    movimentação de exoneração</label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary waves-effect waves-light me-3">Gravar</button>
                            <a href="{{ route('realestatesector.users.index') }}"
                                class="btn btn-label-secondary waves-effect">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        const form = document.querySelector('form');
        const button = form.querySelector('.btn-primary');

        form.addEventListener('submit', function(e) {
            button.disabled = true;
            button.innerText = 'Salvando...';
        });

        IMask(document.getElementById('cpf'), {
            mask: '000.000.000-00'
        });
        IMask(document.getElementById('telefone'), {
            mask: '(00) 0 0000-0000'
        });
    </script>
@endsection
@endsection
