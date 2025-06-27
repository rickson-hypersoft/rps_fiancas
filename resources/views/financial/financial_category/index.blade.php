@extends('dashboard')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <div class="card mb-0">
                    <div class="card-header">
                        <h5>Listagem de Categorias</h5>
                        <hr>
                        <div class="row align-items-center pt-5">
                            <div class="col-sm-7 col-12 mb-1">
                                <form id="form-financeiro" action="{{ route('financial.financial_category.index') }}" method="GET">
                                    <label for="pesquisar" class="form-label">Pesquisar</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg"
                                            placeholder="Pesquisar pela descrição" id="pesquisar"
                                            value="{{ request('search') }}" name="search"
                                            aria-label="Pesquisar pela descrição" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-primary waves-effect" type="submit"
                                            id="btn-financeiro">
                                            <i class="icon-base ti tabler-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-sm-5" style="text-align: right">
                                <a href="{{ route('financial.financial_category.create') }}"
                                    class="btn btn-primary btn-lg waves-effect waves-light">Adicionar Categoria</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive table" style="height: 250px;">
                            <table class="table-sm table-borderless table-striped table-hover table"
                                style="font-size: 18px;">
                                <thead>
                                    <tr>
                                        <th>Descrição</th>
                                        <th>Tipo</th>
                                        <th class="d-none d-lg-table-cell">Ativo</th>
                                        <th class="text-center" style="width: 100px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="ViewNiveisLTableItens">
                                    @if ($financialCategories)
                                        @foreach ($financialCategories as $financialCategory)
                                            <tr>
                                                <td>{{ $financialCategory['descricao'] }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-label-{{ $financialCategory['tipo'] == 'Crédito' ? 'danger' : 'primary' }}">
                                                        {{ $financialCategory['tipo'] }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge bg-label-{{ $financialCategory['ativo'] ? 'success' : 'danger' }} me-1">
                                                        {{ $financialCategory['ativo'] ? 'Ativo' : 'Inativo' }}
                                                    </span>
                                                </td>
                                                @if ($financialCategory['sistema'] == 1)
                                                    <td>
                                                        <div class="dropdown" style="text-align: center;">
                                                            <button type="button"
                                                                class="btn dropdown-toggle hide-arrow p-0"
                                                                data-bs-toggle="dropdown">
                                                                <i class="icon-base ti tabler-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item waves-effect"
                                                                    href="{{ route('financial.financial_category.edit', $financialCategory['id']) }}"><i
                                                                        class="icon-base ti tabler-pencil me-1"></i>
                                                                    Editar</a>
                                                                <a class="dropdown-item waves-effect btn-excluir"
                                                                    href="javascript:void(0);"
                                                                    data-id="{{ $financialCategory['id'] }}"
                                                                    data-route="{{ route('financial.financial_category.delete', ['financeiro_categoria' => '__id__']) }}">
                                                                    <i class="icon-base ti tabler-trash me-1"></i> Excluir
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="4">Não possui contas cadastradas</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        @php
                            $firstItem = $pagination['from'];
                            $lastItem = $pagination['to'];
                            $total = $pagination['total'];
                            $currentPage = $pagination['current_page'];
                            $lastPage = $pagination['last_page'];
                        @endphp

                        @if ($total > 0 && $lastPage > 1)
                            <div class="mt-25 float-end">
                                <div class="d-flex justify-content-between align-items-center bg-light mt-3 px-4 py-2"
                                    style="border-radius: 5rem;">
                                    <div class="mx-2">
                                        <span>{{ $firstItem }} a {{ $lastItem }} de {{ $total }}</span>
                                    </div>

                                    <nav aria-label="Page navigation">
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item first {{ $currentPage == 1 ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ url()->current() . '?page=1' }}"
                                                    aria-label="Primeira página">
                                                    <i class="icon-base ti tabler-chevrons-left icon-sm"></i>
                                                </a>
                                            </li>

                                            <li class="page-item prev {{ $currentPage == 1 ? 'disabled' : '' }}">
                                                <a class="page-link"
                                                    href="{{ url()->current() . '?page=' . max(1, $currentPage - 1) }}"
                                                    aria-label="Página anterior">
                                                    <i class="icon-base ti tabler-chevron-left icon-sm"></i>
                                                </a>
                                            </li>

                                            <li class="page-item next {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                                <a class="page-link"
                                                    href="{{ url()->current() . '?page=' . min($lastPage, $currentPage + 1) }}"
                                                    aria-label="Próxima página">
                                                    <i class="icon-base ti tabler-chevron-right icon-sm"></i>
                                                </a>
                                            </li>

                                            <li class="page-item last {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ url()->current() . '?page=' . $lastPage }}"
                                                    aria-label="Última página">
                                                    <i class="icon-base ti tabler-chevrons-right icon-sm"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
         document.addEventListener('DOMContentLoaded', function () {
        const formFinanceiro = document.getElementById('form-financeiro');
        const inputFinanceiro = document.getElementById('pesquisar');
        const btnFinanceiro = document.getElementById('btn-financeiro');

        // Bloqueia Enter no campo de busca
        inputFinanceiro.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                formFinanceiro.submit();
                inputFinanceiro.disabled= true;
                 btnFinanceiro.disabled = true;
                 btnFinanceiro.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
            }
        });

        // Ao submeter o formulário, desativa o botão
        formFinanceiro.addEventListener('submit', function () {
            btnFinanceiro.disabled = true;
            btnFinanceiro.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
        });
    });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-excluir').forEach(function(btn) {
                console.log(btn)
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const route = this.dataset.route.replace('__id__', id);

                    Swal.fire({
                        title: 'Tem certeza que deseja excluir?',
                        html: `
                        <form id="form-excluir" action="${route}" method="POST">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').getAttribute('content')}">
                            <input type="hidden" name="_method" value="DELETE">
                            <p class="mt-3">Essa ação não poderá ser desfeita.</p>

                            <div style="display: flex; justify-content: center; gap: 10px; margin-top: 20px;">
                                <button type="button" class="swal2-cancel swal2-styled" onclick="Swal.close()">Cancelar</button>
                                <button type="submit" class="swal2-confirm swal2-styled" style="background-color:#d33;">Excluir</button>
                            </div>
                        </form>
                    `,
                        showConfirmButton: false,
                        showCancelButton: false,
                    });
                });
            });
        });
    </script>
@endsection
