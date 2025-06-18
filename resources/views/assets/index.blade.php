@extends('dashboard')
@section('content')
<div class="col-12 mb-6">

    <h3>Relatórios de Contratos</h3>
    <div class="row">
        <div class="col-lg-3 col-sm-6 mb-2">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-primary"><i class="icon-base ti tabler-ticket icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">{{ $statusContagem['Todos'] }}</h4>
                    </div>
                    <p class="mb-1">Todos</p>

                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 mb-2">
            <div class="card card-border-shadow-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-success"><i class="icon-base ti tabler-check icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">{{ $statusContagem['Ativos'] }}</h4>

                    </div>
                    <p class="mb-1">Ativos</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 mb-2">
            <div class="card card-border-shadow-danger h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar me-4">
                            <span class="avatar-initial rounded bg-label-danger"><i class="icon-base ti tabler-ban icon-28px"></i></span>
                        </div>
                        <h4 class="mb-0">{{ $statusContagem['Cancelados'] }}</h4>
                    </div>
                    <p class="mb-1">Cancelados</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6 mb-2">
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
                                        <input type="text" id="pesquisar" name="search" class="form-control form-control-lg" placeholder="Número do Contrato, Nome, CPF do Inquilino, Razão Social ou CNPJ" value="{{request('search')}}">
                                        <button class="btn btn-outline-primary btn-lg" type="submit">
                                            <i class="icon-base ti tabler-search"></i>
                                        </button>
                                    </div>
                                </form>

                                <!-- Filtros + botões -->
                                <div class="col-12 mb-1">
                                    <form method="GET">
                                        <div class="row align-items-end g-3">
                                            <div class="col-md-2 col-12">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select form-select-lg" name="status" id="status">
                                                    <option value="">Todos</option>
                                                    <option value="Ativo" {{ request('status')=='Ativo' ? 'selected' : '' }}>Ativos</option>
                                                    <option value="Exonerados - Aluguel" {{ request('status')=='Exonerados - Aluguel' ? 'selected' : '' }}>Exonerados - Aluguel</option>
                                                    <option value="Exonerados - Taxa" {{ request('status')=='Exonerados - Taxa' ? 'selected' : '' }}>Exonerados - Taxa</option>
                                                    <option value="Aguardando Cancelamento" {{ request('status')=='Aguardando Cancelamento' ? 'selected' : '' }}>Aguardando Cancelamento</option>
                                                    <option value="Em Cancelamento" {{ request('status')=='Em Cancelamento' ? 'selected' : '' }}>Em Cancelamento</option>
                                                    <option value="Cancelado" {{ request('status')=='Cancelado' ? 'selected' : '' }}>Cancelados</option>
                                                    <option value="Suspenso" {{ request('status')=='Suspenso' ? 'selected' : '' }}>Suspensos</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <label for="data" class="form-label">Data de criação</label>
                                                <select name="created_at" class="form-select form-select-lg" id="data">
                                                    <option>Hoje</option>
                                                    <option>Últimos 7 dias</option>
                                                    <option>Últimos 30 dias</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <label for="corretor" class="form-label">Corretor</label>
                                                <select class="form-select form-select-lg" id="corretor">
                                                    <option>Todos</option>
                                                    <!-- ... -->
                                                </select>
                                            </div>


                                            <div class="col-md-3 col-12">
                                                <label for="pendencias" class="form-label">Pendências</label>
                                                <select name="pendences" class="form-select form-select-lg" id="pendencias">
                                                    <option value="">Todos</option>
                                                    <option {{ request('pendences')=='contrato' ? 'selected' : '' }} value="contrato">Necessário anexar o contrato de aluguel</option>
                                                    <option {{ request('pendences')=='vistoria' ? 'selected' : '' }} value="vistoria">Necessário anexar a vistoria</option>
                                                </select>
                                            </div>

                                            <div class="col-md-1 col-12">
                                                <button type="submit" class="btn btn-primary btn-lg w-100">Pesquisar</button>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <button type="button" class="btn btn-outline-success btn-lg w-100">Exportar detalhado</button>
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
                                    @if($contrato['contrato_status'] != 'Pendente')
                                    <tr>
                                        <td><a href="{{route('assets.asset', ['id' => $contrato['id']])}}" class="text-success">{{$contrato['id']}}</a></td>
                                        <td>{{$contrato['pessoa_nome']}}</td>
                                        <td>{{$contrato['pessoa_doc']}}</td>
                                        <td>{{$contrato['imovel_aluguel']}}</td>
                                        <td>
                                            @php
                                            $badge = '';
                                            switch($contrato['contrato_status']) {
                                            case 'Ativo':
                                            $bagde = 'success';
                                            break;
                                            case 'Cancelado':
                                            $bagde = 'danger';
                                            break;
                                            }
                                            @endphp
                                            <span class="badge badge-sm badge bg-label-{{$bagde}}">{{$contrato['contrato_status']}}</span>
                                        </td>
                                        <td>Corretor</td>
                                        <td>{{ \Carbon\Carbon::parse($contrato['data'])->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($contrato['data_ultima_atualizacao'])->format('d/m/Y') }}</td>
                                        <td class="text-center">
                                            @php
                                            $faltando = [];

                                            if (empty($contrato['anexo_contrato'])) {
                                            $faltando[] = 'Necessário anexar o contrato de aluguel';
                                            }

                                            if (empty($contrato['anexo_vistoria'])) {
                                            $faltando[] = 'Necessário anexar a vistoria';
                                            }

                                            $tooltip = implode('<br>', $faltando);
                                            @endphp

                                            @if (empty($faltando))
                                            {{-- Tudo ok, exibe check verde --}}
                                            <i class="menu-icon icon-base ti tabler-circle-check text-success"></i>
                                            @else
                                            {{-- Faltando anexos, exibe alerta com tooltip --}}
                                            <i class="menu-icon icon-base ti tabler-alert-hexagon text-danger" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="bottom" title="{!! $tooltip !!}"></i>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
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
                       <div class="d-flex justify-content-between align-items-center mt-3 py-2 px-4" style="background: #eee; border-radius: 5rem;">
                           <div class="mx-2">
                               <span>{{ $firstItem }} a {{ $lastItem }} de {{ $total }}</span>
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
                   @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
