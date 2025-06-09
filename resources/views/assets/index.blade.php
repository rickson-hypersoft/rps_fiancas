@extends('dashboard')
@section('content')
<div class="col-12 mb-6">
    <h3>Relatórios de Contratos</h3>
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-primary"><i class="icon-base ti tabler-truck icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">42</h4>
                    </div>
                    <p class="mb-1">On route vehicles</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">+18.2%</span>
                        <small class="text-body-secondary">than last week</small>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-warning"><i class="icon-base ti tabler-alert-triangle icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">8</h4>
                    </div>
                    <p class="mb-1">Vehicles with errors</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">-8.7%</span>
                        <small class="text-body-secondary">than last week</small>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-danger h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-danger"><i class="icon-base ti tabler-git-fork icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">27</h4>
                    </div>
                    <p class="mb-1">Deviated from route</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">+4.3%</span>
                        <small class="text-body-secondary">than last week</small>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card card-border-shadow-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-info"><i class="icon-base ti tabler-clock icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">13</h4>
                    </div>
                    <p class="mb-1">Late vehicles</p>
                    <p class="mb-0">
                        <span class="text-heading fw-medium me-2">-2.5%</span>
                        <small class="text-body-secondary">than last week</small>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <div class="row align-items-center pt-5">
                            <div class="col-sm-12 col-12 mb-1">
                                <form action="" method="GET">
                                    <label for="pesquisar" class="form-label">Pesquisar</label>
                                    <div class="input-group">
                                        <input type="text" id="pesquisar" class="form-control form-control-lg" placeholder="Número do Contrato, Nome, CPF do Inquilino, Razão Social ou CNPJ" name="search" value="" aria-label="Número do Contrato, Nome, CPF do Inquilino, Razão Social ou CNPJ" aria-describedby="button-addon2">
                                        <button class="btn btn-outline-primary waves-effect" type="submit" id="button-addon2">
                                            <i class="icon-base ti tabler-search"></i>
                                        </button>

                                    </div>
                                </form>
                            </div>

                            <div class="col-sm-12 col-12 mb-1">
                                <form action="" method="GET">
                                    <div class="row align-items-end">
                                        <div class="col-md-2 col-12 mb-4">
                                            <label for="exampleFormControlSelect1" class="form-label">Status</label>
                                            <select class="form-select form-select-lg " id="exampleFormControlSelect1" aria-label="Default select example">
                                                <option value="1">Todos</option>
                                                <option value="2">Ativos</option>
                                                <option value="3">Exonerados - Aluguel</option>
                                                <option value="3">Exonerados - Taxa</option>
                                                <option value="3">Aguardando Cancelamento</option>
                                                <option value="3">Em Cancelamento</option>
                                                <option value="3">Cancelados</option>
                                                <option value="3">Suspensos</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-12 mb-4">
                                            <label for="exampleFormControlSelect1" class="form-label">Data de criação</label>
                                            <select class="form-select form-select-lg " id="exampleFormControlSelect1" aria-label="Default select example">
                                                <option selected="">Open this select menu</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-12 mb-4">
                                            <label for="exampleFormControlSelect1" class="form-label">Corretor</label>
                                            <select class="form-select form-select-lg " id="exampleFormControlSelect1" aria-label="Default select example">
                                                <option selected="">Open this select menu</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-12 mb-4">
                                            <label for="exampleFormControlSelect1" class="form-label">Pendências</label>
                                            <select class="form-select form-select-lg " id="exampleFormControlSelect1" aria-label="Default select example">
                                                <option selected="">Open this select menu</option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-12 mb-4">
                                            <button type="submit" class="btn btn-primary btn-lg">Pesquisar</button>
                                        </div>
                                        <div class="col-md-2 col-12 mb-4 text-end">
                                            <button class="btn btn-success btn-lg">Exportar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive" style="height: 250px;">
                            <table class="table table-sm table-borderless table-striped table-hover" style="font-size: 18px;">
                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th>Inquilino</th>
                                        <th>Documento</th>
                                        <th>Valor locatício</th>
                                        <th>Status</th>
                                        <th>Corretor</th>
                                        <th>Data de criação</th>
                                        <th>Última atualização</th>
                                        <th class="text-center" style="width: 100px">Pendências</th>
                                    </tr>
                                </thead>
                                <tbody id="ViewNiveisLTableItens">
                                    <tr>
                                        <td>90</td>
                                        <td>RICKSON LUCAS</td>
                                        <td>160.549.566-20</td>
                                        <td>R$ 200,00</td>
                                        <td>
                                            <span class="badge">Ativo</span>
                                        </td>
                                        <td>Corretor</td>
                                        <td>08/06/2025</td>
                                        <td>08/06/2025</td>
                                        <td>
                                            <i class="menu-icon icon-base ti tabler-alert-hexagon text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Necessário anexar o contrato de aluguel
                                            Necessário anexar a vistoria"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="mt-25 float-end">
                            <div class="d-flex justify-content-between align-items-center mt-3 py-2 px-4" style="background: #eee; border-radius: 5rem;">
                                <div class="mx-2">
                                    <span>1 a 5 de 7</span>
                                </div>

                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm mb-0">
                                        <li class="page-item first disabled">
                                            <a class="page-link waves-effect" href="http://localhost:8001/imobiliaria/financeiro/conta?page=1" aria-label="Primeira página">
                                                <i class="icon-base ti tabler-chevrons-left icon-sm"></i>
                                            </a>
                                        </li>

                                        <li class="page-item prev disabled">
                                            <a class="page-link waves-effect" href="http://localhost:8001/imobiliaria/financeiro/conta?page=1" aria-label="Página anterior">
                                                <i class="icon-base ti tabler-chevron-left icon-sm"></i>
                                            </a>
                                        </li>

                                        <li class="page-item next ">
                                            <a class="page-link waves-effect" href="http://localhost:8001/imobiliaria/financeiro/conta?page=2" aria-label="Próxima página">
                                                <i class="icon-base ti tabler-chevron-right icon-sm"></i>
                                            </a>
                                        </li>

                                        <li class="page-item last ">
                                            <a class="page-link waves-effect" href="http://localhost:8001/imobiliaria/financeiro/conta?page=2" aria-label="Última página">
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
</div>
@endsection
