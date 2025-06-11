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
                        <h4 class="mb-0">{{ $statusContagem['Todos'] }}</h4>
                    </div>
                    <p class="mb-1">Todos</p>

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
                        <h4 class="mb-0">{{ $statusContagem['Ativos'] }}</h4>

                    </div>
                    <p class="mb-1">Ativos</p>
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
                       <h4 class="mb-0">{{ $statusContagem['Cancelados'] }}</h4>
                    </div>
                    <p class="mb-1">Cancelados</p>
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
                        <h4 class="mb-0">{{ $statusContagem['Em renovação'] }}</h4>
                    </div>
                    <p class="mb-1">Em renovação</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <div class="row align-items-center pt-3">
                            <!-- Campo de pesquisa -->
                            <div class="col-12 mb-3">
                                <form method="GET">
                                    <label for="pesquisar" class="form-label">Pesquisar</label>
                                    <div class="input-group">
                                        <input type="text" id="pesquisar" name="search" class="form-control form-control-lg" placeholder="Número do Contrato, Nome, CPF do Inquilino, Razão Social ou CNPJ">
                                        <button class="btn btn-outline-primary btn-lg" type="submit">
                                            <i class="icon-base ti tabler-search"></i>
                                        </button>
                                    </div>
                                </form>

                                <!-- Filtros + botões -->
                                <div class="col-12 mb-1">
                                    <form method="GET">
                                        <div class="row align-items-end g-3">
                                            <div class="col-md-2 col-6">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select form-select-lg" name="status" id="status">
                                                    <option value="Todos">Todos</option>
                                                    <option value="Ativos">Ativos</option>
                                                    <option value="Exonerados - Aluguel">Exonerados - Aluguel</option>
                                                    <option value="Exonerados - Taxa">Exonerados - Taxa</option>
                                                    <option value="Aguardando Cancelamento">Aguardando Cancelamento</option>
                                                    <option value="Em Cancelamento">Em Cancelamento</option>
                                                    <option value="Cancelados">Cancelados</option>
                                                    <option value="Suspensos">Suspensos</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2 col-6">
                                                <label for="data" class="form-label">Data de criação</label>
                                                <select name="created_at" class="form-select form-select-lg" id="data">
                                                    <option>Hoje</option>
                                                    <option>Últimos 7 dias</option>
                                                    <option>Últimos 30 dias</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2 col-6">
                                                <label for="corretor" class="form-label">Corretor</label>
                                                <select class="form-select form-select-lg" id="corretor">
                                                    <option>Todos</option>
                                                    <!-- ... -->
                                                </select>
                                            </div>


                                            <div class="col-md-3 col-6">
                                                <label for="pendencias" class="form-label">Pendências</label>
                                                <select name="pendences" class="form-select form-select-lg" id="pendencias">
                                                    <option value="todos">Todos</option>
                                                    <option value="Necessário anexar o contrato de aluguel">Necessário anexar o contrato de aluguel</option>
                                                    <option value="Necessário anexar a vistoria">Necessário anexar a vistoria</option>
                                                </select>
                                            </div>

                                            <div class="col-md-1 col-6">
                                                <button type="submit" class="btn btn-primary btn-lg w-100">Pesquisar</button>
                                            </div>

                                            <div class="col-md-2 col-6">
                                                <button type="button" class="btn btn-success btn-lg w-100">Exportar detalhado</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
                                    @foreach ($contratos as $contrato)
                                    @if($contrato['contrato_status'] == 'Ativo')
                                        <tr>
                                        <td><a href="{{route('assets.asset', ['id' => $contrato['id']])}}" class="text-success">{{$contrato['id']}}</a></td>
                                        <td>{{$contrato['pessoa_nome']}}</td>
                                        <td>{{$contrato['pessoa_doc']}}</td>
                                        <td>{{$contrato['imovel_aluguel']}}</td>
                                        <td>
                                            <span class="badge text-bg-success">{{$contrato['contrato_status']}}</span>
                                        </td>
                                        <td>Corretor</td>
<td>{{ \Carbon\Carbon::parse($contrato['data'])->format('d/m/Y') }}</td>
<td>{{ \Carbon\Carbon::parse($contrato['data_ultima_atualizacao'])->format('d/m/Y') }}</td>
                                       <td class="text-center">
    @php
        $faltando = [];

        if (empty($proposta->anexo_contrato)) {
            $faltando[] = 'Necessário anexar o contrato de aluguel';
        }

        if (empty($proposta->anexo_vistoria)) {
            $faltando[] = 'Necessário anexar a vistoria';
        }

        $tooltip = implode('<br>', $faltando);
    @endphp

    @if (empty($faltando))
        {{-- Tudo ok, exibe check verde --}}
        <i class="ti ti-circle-check text-success"></i>
    @else
        {{-- Faltando anexos, exibe alerta com tooltip --}}
        <i class="menu-icon icon-base ti tabler-alert-hexagon text-danger"
           data-bs-toggle="tooltip"
           data-bs-html="true"
           data-bs-placement="bottom"
           title="{!! $tooltip !!}"></i>
    @endif
</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="9" class="text-center">Não existe contratos ativos</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
