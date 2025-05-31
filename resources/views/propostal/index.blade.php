@extends('dashboard')
@section('content')
<div class="col-12 mb-6">
    <h4>Análise em andamento</h4>
    <div class="nav-align-top nav-tabs-shadow">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item p-3" role="presentation">
                <button type="button" class="nav-link waves-effect active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pendente" aria-controls="navs-pendente" aria-selected="true">
                    Imóvel com Contrato Pendente
                </button>
            </li>
            <li class="nav-item p-3" role="presentation">
                <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-rascunhos" aria-controls="navs-rascunhos" aria-selected="false" tabindex="-1">
                    Rascunhos
                </button>
            </li>
            <li class="nav-item p-3" role="presentation">
                <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-cancelados" aria-controls="navs-cancelados" aria-selected="false" tabindex="-1">
                    Cancelados
                </button>
            </li>
            <li class="nav-item p-3" role="presentation">
                <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab" data-bs-target="#navs-excluidos" aria-controls="navs-excluidos" aria-selected="false" tabindex="-1">
                    Reprovados
                </button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="p-5 bordered" style="border-radius: 10px;">
                <form action="">
                    <div class="row align-items-end">
                        <div class="col-6">
                            <div>
                                <label for="largeInput" class="form-label">Pesquisar</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text " id="basic-addon-search31"><i class="icon-base ti tabler-search"></i></span>
                                    <input type="text" class="form-control form-control-lg" placeholder="Número da proposta, nome/razão social, CPF/CNPJ ou Tag" aria-label="Número da proposta, nome/razão social, CPF/CNPJ ou Tag" aria-describedby="basic-addon-search31">
                                </div>
                            </div>
                        </div>
                        <div class="col-2">
                            <div>
                                <label for="largeSelect" class="form-label">Status</label>
                                <select id="largeSelect" class="form-select form-select-lg">
                                    <option value="1">Todos</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div>
                                <label for="largeSelect" class="form-label">Criado em:</label>
                                <input class="form-control form-control-lg" type="date" id="html5-date-input">
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-primary btn-lg waves-effect waves-light mb-0">
                                <span class="icon-xs icon-base ti tabler-search me-2"></span>Pesquisar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade active show" id="navs-pendente" role="tabpanel">
                <div class="table-responsive text-nowrap mt-4 pt-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Contrato</th>
                                <th>Inquilino</th>
                                <th>Documento</th>
                                <th>Valor locatício</th>
                                <th>Tag</th>
                                <th>Status</th>
                                <th>Data de criação</th>
                                <th>Última atualização</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td>
                                    <a href="" class="text-success">1</a>
                                </td>
                                <td>RICKSON LUCAS</td>
                                <td>
                                    160.549.566-20
                                </td>
                                <td>R$ 1.500,00</td>
                                <td></td>
                                <td><span class="badge bg-label-warning me-1">Pendente Analise</span></td>
                                <td>28/05/2025</td>
                                <td>28/05/2025</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="icon-base ti tabler-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i> Cancelar proposta</a>
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-pencil me-1"></i> Alteração imobiliária</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="" class="text-success">2</a>
                                </td>
                                <td>PAULO HENIRQUE</td>
                                <td>
                                    151.635.576-88
                                </td>
                                <td>R$ 1.000,00</td>
                                <td></td>
                                <td><span class="badge bg-label-success me-1">Aprovado</span></td>
                                <td>26/05/2025</td>
                                <td>26/05/2025</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="icon-base ti tabler-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i> Cancelar proposta</a>
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-pencil me-1"></i> Alteração imobiliária</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="" class="text-success">3</a>
                                </td>
                                <td>JOSE CARLOS COSTA</td>
                                <td>
                                    329.024.148-38
                                </td>
                                <td>R$ 900,00</td>
                                <td></td>
                                <td><span class="badge bg-label-secondary me-1">Em análise de estorno</span></td>
                                <td>06/01/2025</td>
                                <td>06/01/2025</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="icon-base ti tabler-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i> Cancelar proposta</a>
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-pencil me-1"></i> Alteração imobiliária</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="" class="text-success">4</a>
                                </td>
                                <td>GILMAR BATISTA</td>
                                <td>
                                    213.069.118-85
                                </td>
                                <td>R$ 2.200,00</td>
                                <td></td>
                                <td><span class="badge bg-label-secondary me-1">Em análise de estorno</span></td>
                                <td>06/01/2025</td>
                                <td>06/01/2025</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="icon-base ti tabler-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i> Cancelar proposta</a>
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-pencil me-1"></i> Alteração imobiliária</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="" class="text-success">5</a>
                                </td>
                                <td>GILMAR BATISTA</td>
                                <td>
                                    213.069.118-85
                                </td>
                                <td>R$ 1.700,00</td>
                                <td></td>
                                <td><span class="badge bg-label-secondary me-1">Em análise de estorno</span></td>
                                <td>06/01/2025</td>
                                <td>06/01/2025</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="icon-base ti tabler-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i> Cancelar proposta</a>
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-pencil me-1"></i> Alteração imobiliária</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="navs-rascunhos" role="tabpanel">
                <div class="p-4 bg-label-secondary" style="border-radius: 10px;">
                    <p class="m-0 p-0">Propostas em rascunho por mais de 30 dias serão automaticamente cancelados. Mas não se preocupe, você poderá criar novas propostas para esses clientes a qualquer momento! Assim, sua imobiliária terá acesso mais fácil às propostas mais quentes e focará nas melhores oportunidades</p>
                </div>

                <div class="table-responsive text-nowrap mt-4 pt-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Contrato</th>
                                <th>Inquilino</th>
                                <th>Documento</th>
                                <th>Valor locatício</th>
                                <th>Tag</th>
                                <th>Status</th>
                                <th>Data de criação</th>
                                <th>Última atualização</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td>
                                    <a href="" class="text-success">6</a>
                                </td>
                                <td></td>
                                <td>
                                    14.483.179/0001-90
                                </td>
                                <td>R$ 1.500,00</td>
                                <td></td>
                                <td><span class="badge bg-label-secondary me-1">Rascunho</span></td>
                                <td>28/05/2025</td>
                                <td>28/05/2025</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="icon-base ti tabler-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i> Cancelar proposta</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="" class="text-success">7</a>
                                </td>
                                <td></td>
                                <td>
                                    05.975.981/0001-06
                                </td>
                                <td>R$ 3.100,00</td>
                                <td></td>
                                <td><span class="badge bg-label-secondary me-1">Rascunho</span></td>
                                <td>28/05/2025</td>
                                <td>28/05/2025</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="icon-base ti tabler-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i> Cancelar proposta</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="navs-cancelados" role="tabpanel">
                <div class="table-responsive text-nowrap mt-4 pt-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Contrato</th>
                                <th>Inquilino</th>
                                <th>Documento</th>
                                <th>Valor locatício</th>
                                <th>Tag</th>
                                <th>Status</th>
                                <th>Data de criação</th>
                                <th>Última atualização</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td>
                                    <a href="" class="text-success">8</a>
                                </td>
                                <td></td>
                                <td>
                                    14.483.179/0001-90
                                </td>
                                <td>R$ 1.500,00</td>
                                <td></td>
                                <td><span class="badge bg-label-danger me-1">Cancelado</span></td>
                                <td>28/05/2025</td>
                                <td>28/05/2025</td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="" class="text-success">9</a>
                                </td>
                                <td></td>
                                <td>
                                    05.975.981/0001-06
                                </td>
                                <td>R$ 3.100,00</td>
                                <td></td>
                                <td><span class="badge bg-label-danger me-1">Cancelado</span></td>
                                <td>28/05/2025</td>
                                <td>28/05/2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane fade" id="navs-excluidos" role="tabpanel">
                <div class="table-responsive text-nowrap mt-4 pt-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Contrato</th>
                                <th>Inquilino</th>
                                <th>Documento</th>
                                <th>Valor locatício</th>
                                <th>Tag</th>
                                <th>Status</th>
                                <th>Data de criação</th>
                                <th>Última atualização</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td>
                                    <a href="" class="text-success">8</a>
                                </td>
                                <td></td>
                                <td>
                                    14.483.179/0001-90
                                </td>
                                <td>R$ 1.500,00</td>
                                <td></td>
                                <td><span class="badge bg-label-danger me-1">Reprovados</span></td>
                                <td>28/05/2025</td>
                                <td>28/05/2025</td>
                            </tr>

                            <tr>
                                <td>
                                    <a href="" class="text-success">9</a>
                                </td>
                                <td></td>
                                <td>
                                    05.975.981/0001-06
                                </td>
                                <td>R$ 3.100,00</td>
                                <td></td>
                                <td><span class="badge bg-label-danger me-1">Reprovados</span></td>
                                <td>28/05/2025</td>
                                <td>28/05/2025</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
