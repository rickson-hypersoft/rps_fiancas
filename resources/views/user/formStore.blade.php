@extends('dashboard')
@section('content')
<div class="col-md-12">
    <div class="card mb-6">
        <div class="card-header">
            <h6>
                Cadastrar Usuário
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

            <form action="{{route('user.store')}}" method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                @csrf
                <div class="row gy-4 gx-6 mb-6">
                    <div class="col-md-4 form-control-validation fv-plugins-icon-container">
                        <label for="usuario" class="form-label">Usuário</label>
                        <input value="{{ old('usuario') }}" class="form-control form-control-lg" type="text" id="usuario" name="usuario" maxlength="30">
                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                    </div>
                    <div class="col-md-4 form-control-validation fv-plugins-icon-container">
                        <label for="senha" class="form-label">Senha</label>
                        <input value="{{ old('senha') }}" class="form-control form-control-lg" maxlength="255" type="text" id="senha" name="senha" maxlength="100">
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
    <label for="nivel" class="form-label">Nível</label>
    <select class="form-select form-select-lg" name="nivel" id="nivel" aria-label="Default select example">
        <option value="">Selecionar o nível</option>
        <option value="Administrador" {{ old('nivel') == 'Administrador' ? 'selected' : '' }}>Administrador</option>
        <option value="Corretor" {{ old('nivel') == 'Corretor' ? 'selected' : '' }}>Corretor</option>
        <option value="Financeiro" {{ old('nivel') == 'Financeiro' ? 'selected' : '' }}>Financeiro</option>
    </select>
</div>

<div class="col-md-4">
    <label for="categoria" class="form-label">Categoria</label>
    <select class="form-select form-select-lg" id="categoria" name="categoria" aria-label="Default select example">
        <option value="">Selecionar categoria</option>
        <option value="Fianças" {{ old('categoria') == 'Fianças' ? 'selected' : '' }}>Fianças</option>
        <option value="Imobiliária" {{ old('categoria') == 'Imobiliária' ? 'selected' : '' }}>Imobiliária</option>
    </select>
</div>
                    <div class="col-md-4" id="imobiliaria-select-wrapper" style="display: none;">
                        <label for="imobiliaria_id" class="form-label">Imobiliária</label>
                        <select class="form-select form-select-lg" name="imobiliaria_id" id="imobiliaria_id">
                            <option value="">Carregando...</option>
                        </select>
                    </div>
                    <hr>
                    <h6 class="m-0 pb-2 pt-2">Permissões</h6>
                    <div class="col-md-3" id="editar-empresa-wrapper">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="editar-empresa" name="permissoes[]" checked value="1">
                            <label class="form-check-label" for="editar-empresa">Editar Empresa</label>
                        </div>
                    </div>
                    <div class="col-md-3" id="cadastro-imobiliarias-wrapper">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="cadastro-imobiliarias" name="permissoes[]" checked value="2">
                            <label class="form-check-label" for="cadastro-imobiliarias">Cadastro de Imobiliárias</label>
                        </div>
                    </div>
                    <div class="col-md-3" id="cadastro-usuarios-wrapper">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="cadastro-usuarios" name="permissoes[]" checked value="3">
                            <label class="form-check-label" for="cadastro-usuarios">Cadastro de Usuários</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="financeiro-adicionar" name="permissoes[]" checked value="4">
                            <label class="form-check-label" for="financeiro-adicionar">Financeiro Adicionar</label>
                        </div>
                    </div>
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
                        <a href="{{route('user.index')}}" class="btn btn-label-secondary waves-effect">Cancelar</a>
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

    form.addEventListener('submit', function (e) {
        button.disabled = true;
        button.innerText = 'Salvando...';
    });

    IMask(document.getElementById('cpf'), {
        mask: '000.000.000-00'
    });
    IMask(document.getElementById('telefone'), {
        mask: '00 0000-0000'
    });

    document.addEventListener('DOMContentLoaded', function () {
        const categoriaSelect = document.getElementById('categoria');
        const permissoesParaDesabilitar = [
            document.getElementById('editar-empresa'),
            document.getElementById('cadastro-imobiliarias'),
            document.getElementById('cadastro-usuarios'),
        ];

        const permissoesParaNaoMostrar = [
            document.getElementById('editar-empresa-wrapper'),
            document.getElementById('cadastro-imobiliarias-wrapper'),
            document.getElementById('cadastro-usuarios-wrapper'),
        ];

        function verificarCategoria() {
            const isFianca = categoriaSelect.value === 'Fianças';
            permissoesParaDesabilitar.forEach(el => {
                el.disabled = !isFianca;
                if (!isFianca) {
                    el.checked = false;
                } else {
                    el.checked = true;
                }
            });
            permissoesParaNaoMostrar.forEach(el => {
                el.disabled = !isFianca;
                if (!isFianca) {
                    el.classList.add('d-none'); // corrige aqui
                } else {
                    el.classList.remove('d-none'); // garante que volte a aparecer
                }
            });
        }

        // Verifica no carregamento da página
        verificarCategoria();

        // Escuta a mudança
        categoriaSelect.addEventListener('change', verificarCategoria);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const categoriaSelect = document.getElementById('categoria');
        const imobiliariaWrapper = document.getElementById('imobiliaria-select-wrapper');
        const imobiliariaSelect = document.getElementById('imobiliaria_id');

        async function loadImobiliarias() {
            imobiliariaSelect.innerHTML = '<option>Carregando...</option>';
            try {
                const response = await fetch('/adm/imobiliarias/listagem');
                const data = await response.json();

                if (data.length === 0) {
                    imobiliariaSelect.innerHTML = '<option value="">Nenhuma imobiliária encontrada</option>';
                    return;
                }

                imobiliariaSelect.innerHTML = '<option value="">Selecione uma imobiliária</option>';
                data.data.forEach(imob => {
                    const option = document.createElement('option');
                    option.value = imob.id;
                    option.text = imob.razao;
                    imobiliariaSelect.appendChild(option);
                });
            } catch (error) {
                imobiliariaSelect.innerHTML = '<option value="">Erro ao carregar</option>';
                console.error('Erro ao buscar imobiliárias:', error);
            }
        }

        function toggleImobiliariaSelect() {
            if (categoriaSelect.value === 'Imobiliária') {
                imobiliariaWrapper.style.display = 'block';
                loadImobiliarias();
            } else {
                imobiliariaWrapper.style.display = 'none';
                imobiliariaSelect.innerHTML = ''; // limpa opções
            }
        }

        toggleImobiliariaSelect();

        categoriaSelect.addEventListener('change', toggleImobiliariaSelect);
    });
</script>
@endsection
@endsection
