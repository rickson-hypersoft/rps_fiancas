@extends('dashboard')
@section('content')
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
                    <h6>Listagem de Imobiliárias</h6>
                    <hr>
                    <div class="row align-items-center pt-5">
                        <div class="col-sm-7 col-12 mb-1">
                            <label for="pesquisar" class="form-label">Pesquisar</label>
                            <input id="pesquisar" type="text" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar..." autocomplete="off" spellcheck="false">
                        </div>
                        <div class="col-sm-5 mt-4" style="text-align: right">
                            <a href="{{route('realestatesector.create')}}" class="btn btn-primary waves-effect waves-light">Adicionar Imobiliária</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table table-responsive" style="height: 250px;">
                        <table class="table table-sm table-borderless table-striped table-hover" style="font-size: 18px;">
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
                                    <td class="align-middle">{{$realEstateSector['razao']}}</td>
                                    <td class="align-middle">{{$realEstateSector['fantasia']}}</td>
                                    <td class="d-none d-lg-table-cell align-middle">{{$realEstateSector['creci']}}</td>
                                    <td class="d-none d-xl-table-cell align-middle">{{$realEstateSector['cnpj']}}</td>

                                    <td>
                                        <div class="dropdown" style="text-align: right;">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="icon-base ti tabler-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="javascript:void(0);" class="dropdown-item waves-effect open-setup-modal" data-bs-toggle="modal" data-bs-target="#modalToggle" data-id="{{ $realEstateSector['id'] }}">
                                                    <i class="icon-base ti tabler-settings me-1"></i> Configurações
                                                </a>
                                                <a class="dropdown-item waves-effect" href="{{route('realestatesector.edit', $realEstateSector['id'])}}"><i class="icon-base ti tabler-pencil me-1"></i> Editar</a>
                                                <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i> Excluir</a>
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

                    <div class="mt-25 float-end">
                        <div class="d-flex justify-content-between align-items-center mt-3 py-2 px-4" style="background: #eee; border-radius: 5rem;">
                            <div class="mx-2">
                                @if($total > 0)
                                <span>{{ $firstItem }} a {{ $lastItem }} de {{ $total }}</span>
                                @else
                                <span>Nenhum registro encontrado.</span>
                                @endif
                            </div>

                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item first {{ $currentPage == 1 ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ url()->current() . '?page=1' }}" aria-label="Primeira página">
                                            <i class="icon-base ti tabler-chevrons-left icon-sm"></i>
                                        </a>
                                    </li>

                                    <li class="page-item prev {{ $currentPage == 1 ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ url()->current() . '?page=' . max(1, $currentPage - 1) }}" aria-label="Página anterior">
                                            <i class="icon-base ti tabler-chevron-left icon-sm"></i>
                                        </a>
                                    </li>

                                    <li class="page-item next {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ url()->current() . '?page=' . min($lastPage, $currentPage + 1) }}" aria-label="Próxima página">
                                            <i class="icon-base ti tabler-chevron-right icon-sm"></i>
                                        </a>
                                    </li>

                                    <li class="page-item last {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ url()->current() . '?page=' . $lastPage }}" aria-label="Última página">
                                            <i class="icon-base ti tabler-chevrons-right icon-sm"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal 1-->
<div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex w-100">
                <h5 class="modal-title" id="modalToggleLabel">Configurações Imobiliária</h5>
                <a href="javascript:void(0);" class="btn btn-sm btn-primary ms-auto btn-add" data-bs-toggle="modal" data-bs-target="#modalToggle2">Adicionar configuração</a>
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
<div class="modal fade" id="modalToggle2" aria-labelledby="modalToggleLabel2" tabindex="-1" style="display: none;" aria-hidden="true">
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
                        <input type="text" class="form-control" name="taxa" id="form-taxa">
                    </div>
                    <div class="col-md-6">
                        <label for="ativo" class="form-label">Ativo</label>
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" id="user-status-switch" checked name="ativo">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary waves-effect waves-light" data-bs-target="#modalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">
                            Voltar
                        </a>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.open-setup-modal').forEach(function (el) {
            el.addEventListener('click', function () {
                const setupId = this.dataset.id;

                document.getElementById('setup-info').innerHTML = `
                    <div class="d-flex align-items-center">
                        <div class="spinner-border text-primary me-2" role="status" style="width: 0.8rem; height: 0.8rem;"></div>
                        <strong>Carregando configurações...</strong>
                    </div>
                `;

                fetch(`/adm/imobiliarias/setup/${setupId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro ao buscar dados');
                        }
                        return response.json();
                    })
                    .then(data => {
                        let html = '';

                        if (data.length === 0) {
                            html = `<p class="text-muted text-center my-3">Ainda não possui configurações salvas.</p>`;
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
                                    data-taxa="${item.taxa}"
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
                        document.getElementById('setup-info').innerHTML = '<p class="text-danger">Erro ao carregar setup.</p>';
                    });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form-configuracao');
        const modalTitle = document.getElementById('modalToggleLabel2');

        let currentImobiliariaId = null;

        document.body.addEventListener('click', function (e) {
            const openBtn = e.target.closest('.open-setup-modal');
            if (openBtn) {
                currentImobiliariaId = openBtn.dataset.id;
            }
        });

        // Botão de adicionar
        document.querySelector('.btn-add').addEventListener('click', function (e) {
            if (!currentImobiliariaId) return;
            console.log(currentImobiliariaId);

            form.action = '/adm/imobiliarias/cadastrar/setup/' + currentImobiliariaId; // Rota de criação
            modalTitle.textContent = 'Adicionar Configuração';
            form.reset(); // Limpa o formulário
            document.getElementById('form-id').value = '';
        });

        // Botões de editar
        document.body.addEventListener('click', function (e) {
            if (e.target.closest('.btn-edit')) {
                const btn = e.target.closest('.btn-edit');
                const id = btn.dataset.id;
                const imobiliaria = btn.dataset.imobiliaria;
                const taxa = btn.dataset.taxa;
                const ativo = btn.dataset.ativo;
                const switchAtivo = document.getElementById(' user-status-switch')

                form.action = '/adm/imobiliarias/editar/setup/' + imobiliaria + '/' + id;
                modalTitle.textContent = 'Editar Configuração';

                document.getElementById('form-id').value = id;
                document.getElementById('form-taxa').value = taxa;
                document.getElementById('user-status-switch').checked = (ativo === "1" || ativo === "true" || ativo === 1 || ativo === true);

            }
        });
    });
</script>

@endsection
