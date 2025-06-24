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
                        <h5>Listagem de Imobiliárias</h5>
                        <hr>
                        <div class="row align-items-center pt-5">
                            <div class="col-sm-7 col-12 mb-1">
                                <form action="{{ route('realestatesector.index') }}" method="GET">
                                    <label for="pesquisar" class="form-label">Pesquisar</label>
                                    <div class="input-group">
                                        <input type="text" id="pesquisar" class="form-control form-control-lg"
                                            placeholder="Pesquisar por razão, fantásia ou CNPJ" name="search"
                                            value="{{ request('search') }}"
                                            aria-label="Pesquisar por razão, fantásia ou CNPJ"
                                            aria-describedby="button-addon2">
                                        <button class="btn btn-outline-primary waves-effect" type="submit"
                                            id="button-addon2">
                                            <i class="icon-base ti tabler-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-sm-5" style="text-align: right">
                                <a href="{{ route('realestatesector.create') }}"
                                    class="btn btn-lg btn-primary waves-effect waves-light">Adicionar Imobiliária</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table" style="height: 250px;">
                            <table class="table-sm table-borderless table-striped table-hover table"
                                style="font-size: 18px;">
                                <thead>
                                    <tr>
                                        <th class="align-middle">Razão</th>
                                        <th class="align-middle">Fantásia</th>
                                        <th class="d-none d-lg-table-cell align-middle">CRECI</th>
                                        <th class="d-none d-xl-table-cell align-middle">CNPJ</th>
                                        <th class="text-center align-middle" style="width: 100px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="ViewNiveisLTableItens">
                                    @foreach ($realEstateSectors as $realEstateSector)
                                        <tr>
                                            <td class="align-middle">{{ $realEstateSector['razao'] }}</td>
                                            <td class="align-middle">{{ $realEstateSector['fantasia'] }}</td>
                                            <td class="d-none d-lg-table-cell align-middle">{{ $realEstateSector['creci'] }}
                                            </td>
                                            <td class="d-none d-xl-table-cell align-middle">{{ $realEstateSector['cnpj'] }}
                                            </td>

                                            <td>
                                                <div class="dropdown" style="text-align: center;">
                                                    <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                                        data-bs-toggle="dropdown">
                                                        <i class="icon-base ti tabler-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a href="javascript:void(0);"
                                                            class="dropdown-item waves-effect open-setup-modal"
                                                            data-bs-toggle="modal" data-bs-target="#modalToggle"
                                                            data-id="{{ $realEstateSector['id'] }}">
                                                            <i class="icon-base ti tabler-settings me-1"></i> Configurações
                                                        </a>
                                                        <a class="dropdown-item waves-effect"
                                                            href="{{ route('realestatesector.edit', $realEstateSector['id']) }}"><i
                                                                class="icon-base ti tabler-pencil me-1"></i> Editar</a>
                                                        <a class="dropdown-item waves-effect btn-excluir"
                                                            href="javascript:void(0);"
                                                            data-id="{{ $realEstateSector['id'] }}"
                                                            data-route="{{ route('realestatesector.delete', ['imobiliaria' => '__id__']) }}">
                                                            <i class="icon-base ti tabler-trash me-1"></i> Excluir
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
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

    <!-- Modal 1-->
    <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;"
        aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex w-100">
                    <h5 class="modal-title" id="modalToggleLabel">Configurações Imobiliária</h5>
                    <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-add ms-auto" data-bs-toggle="modal"
                        data-bs-target="#modalToggle2">Adicionar configuração</a>
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive text-nowrap" id="setup-info">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal 2-->
    <div class="modal fade" id="modalToggle2" aria-labelledby="modalToggleLabel2" tabindex="-1" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalToggleLabel2">Modal 2</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-configuracao" method="POST" action="">
                        @csrf
                        <!-- Aqui será preenchido via JS -->
                        <input type="hidden" name="id" id="form-id">
                        <div class="mb-3">
                            <label for="form-taxa" class="form-label">Taxa</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">R$</span>
                                <input name="taxa" style="text-align: right" id='form-taxa' type="text"
                                    class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="ativo" class="form-label">Ativo</label>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="user-status-switch" checked
                                    name="ativo">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-secondary waves-effect waves-light"
                                data-bs-target="#modalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">
                                Voltar
                            </a>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('scripts')
    <script>
        IMask(document.getElementById('form-taxa'), {
            mask: Number,
            scale: 2,
            thousandsSeparator: '.', // CORRIGIDO: separador de milhar brasileiro
            padFractionalZeros: true, // Garante que sempre haja duas casas decimais
            normalizeZeros: true,
            radix: ',', // separador decimal brasileiro
            mapToRadix: ['.'],
            min: 0,
            max: 1000000,
            autofix: true,
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.open-setup-modal').forEach(function(el) {
                el.addEventListener('click', function() {
                    const setupId = this.dataset.id;

                    document.getElementById('setup-info').innerHTML = `
                    <div class="d-flex align-items-center">
                        <div class="spinner-border text-primary me-2" role="status" style="width: 0.8rem; height: 0.8rem;"></div>
                        <strong>Carregando configurações...</strong>
                    </div>
                `;

                    fetch(`/fianca/adm/imobiliarias/setup/${setupId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Erro ao buscar dados');
                            }
                            return response.json();
                        })
                        .then(data => {
                            let html = '';

                            if (data.length === 0) {
                                html =
                                    `<p class="text-muted text-center my-3">Ainda não possui configurações salvas.</p>`;
                            } else {
                                let rows = '';

                                data.forEach(item => {
                                    rows += `
                <tr>
                    <td>
                        <span class="fw-medium">${item.taxa}</span>
                    </td>
                    <td>
                        <span class="badge bg-label-${item.ativo ? 'success' : 'danger'} me-1">
                            ${item.ativo ? 'Ativo' : 'Inativo'}
                        </span>
                    </td>
                    <td style="text-align: right;">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="icon-base ti tabler-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a
                                    data-bs-target="#modalToggle2"
                                    data-bs-toggle="modal"
                                    data-bs-dismiss="modal"
                                    class="btn-edit dropdown-item waves-effect"
                                    href="javascript:void(0);"
                                    data-id="${item.id}"
                                    data-imobiliaria="${item.id_imobiliaria}"
                                    data-taxa="${item.taxa_original}"
                                    data-ativo="${item.ativo}"
                                >
                                    <i class="icon-base ti tabler-pencil me-1"></i> Editar
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            `;
                                });

                                html = `
            <table class="table table-sm table-striped table-hover" style="font-size: 18px;">
                <thead>
                    <tr>
                        <th>Taxa</th>
                        <th>Status</th>
                        <th style="text-align: right;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    ${rows}
                </tbody>
            </table>
        `;
                            }

                            document.getElementById('setup-info').innerHTML = html;
                        })
                        .catch(error => {
                            console.error(error);
                            document.getElementById('setup-info').innerHTML =
                                '<p class="text-danger">Erro ao carregar setup.</p>';
                        });
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form-configuracao');
            const modalTitle = document.getElementById('modalToggleLabel2');

            let currentImobiliariaId = null;

            document.body.addEventListener('click', function(e) {
                const openBtn = e.target.closest('.open-setup-modal');
                if (openBtn) {
                    currentImobiliariaId = openBtn.dataset.id;
                }
            });

            // Botão de adicionar
            document.querySelector('.btn-add').addEventListener('click', function(e) {
                if (!currentImobiliariaId) return;

                form.action = '/fianca/adm/imobiliarias/cadastrar/setup/' +
                    currentImobiliariaId; // Rota de criação
                modalTitle.textContent = 'Adicionar Configuração';
                form.reset(); // Limpa o formulário
                document.getElementById('form-id').value = '';
            });

            // Botões de editar
            document.body.addEventListener('click', function(e) {
                if (e.target.closest('.btn-edit')) {
                    const btn = e.target.closest('.btn-edit');
                    const id = btn.dataset.id;
                    const imobiliaria = btn.dataset.imobiliaria;
                    const taxa = btn.dataset.taxa;
                    const ativo = btn.dataset.ativo;
                    const switchAtivo = document.getElementById(' user-status-switch')

                    form.action = '/fianca/adm/imobiliarias/editar/setup/' + imobiliaria + '/' + id;
                    modalTitle.textContent = 'Editar Configuração';

                    document.getElementById('form-id').value = id;
                    document.getElementById('form-taxa').value = taxa;
                    document.getElementById('user-status-switch').checked = (ativo === "1" || ativo ===
                        "true" || ativo === 1 || ativo === true);

                }
            });
        });

        document.querySelectorAll('.btn-excluir').forEach(function(btn) {
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
    </script>
@endsection
@endsection
