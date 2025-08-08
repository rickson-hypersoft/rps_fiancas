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
                        <h5>Inadimplências</h5>
                        <hr>
                        <div class="row align-items-center pt-5">
                            <div class="col-12 mb-1">
                                <form id="form-financeiro" action="" method="GET">
                                    <div class="row">
                                        <div class="col-sm-2 col-12 mb-4">
                                            <label for="imovel" class="form-label">Imóvel</label>
                                            <div class="input-group">
                                                <input type="text" id="imovel" class="form-control form-control-lg"
                                                    placeholder="Pesquisar pelo imóvel" name="imovel"
                                                    value="{{ request('imovel') }}" aria-label="Pesquisar pelo imóvel"
                                                    aria-describedby="btn-financeiro">
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-12 mb-4">
                                            <label for="nome_inquilino" class="form-label">Nome do inquilino</label>
                                            <div class="input-group">
                                                <input type="text" id="nome_inquilino"
                                                    class="form-control form-control-lg"
                                                    placeholder="Pesquisar pelo nome do inquilino" name="nome_inquilino"
                                                    value="{{ request('nome_inquilino') }}"
                                                    aria-label="Pesquisar pelo nome do inquilino"
                                                    aria-describedby="btn-financeiro">
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-12 mb-4">
                                            <label for="cpf_inquilino" class="form-label">CPF do inquilino</label>
                                            <div class="input-group">
                                                <input type="text" id="cpf_inquilino"
                                                    class="form-control form-control-lg"
                                                    placeholder="Pesquisar pelo CPF do inquilino" name="cpf_inquilino"
                                                    value="{{ request('cpf_inquilino') }}"
                                                    aria-label="Pesquisar pelo CPF do inquilino"
                                                    aria-describedby="btn-financeiro">
                                            </div>
                                        </div>

                                        <div class="col-sm-2 col-12 mb-4">
                                            <label for="status" class="form-label">Status</label>
                                            <select id="status" class="form-select form-select-lg">
                                                <option>Todos</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-6 col-12 mb-4">
                                            <label for="status" class="form-label">Data Aviso de inadimplência</label>
                                            <div class="input-group">
                                                <span class="input-group-text">De</span>
                                                <input type="date" name="data_aviso_inicial"
                                                    class="form-control form-control-lg">
                                                <span class="input-group-text">Até</span>
                                                <input type="date" name="data_aviso_final"
                                                    class="form-control form-control-lg">
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-12 mb-4">
                                            <label for="status" class="form-label">Valor da inadimplência</label>
                                            <div class="input-group">
                                                <span class="input-group-text">De</span>
                                                <input type="text" name="valor_inadimplencia_inicial"
                                                    class="form-control form-control-lg">
                                                <span class="input-group-text">Até</span>
                                                <input type="text" name="valor_inadimplencia_final"
                                                    class="form-control form-control-lg">
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-12 mb-4">
                                            <button type="submit" class="btn btn-primary btn-lg">Pesquisar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table" style="height: 250px;">
                            <table class="table-sm table-borderless table-striped table-hover table"
                                style="font-size: 18px;">
                                <thead>
                                    <tr>
                                        <th>Contrato</th>
                                        <th class="d-none d-lg-table-cell">Status</th>
                                        <th class="d-none d-xl-table-cell">Data Aviso de Inadimplência</th>
                                        <th>Valor Inadimplência</th>
                                        <th>Valor Atualização</th>
                                    </tr>
                                </thead>
                                <tbody id="ViewNiveisLTableItens">
                                    @foreach ($data as $item)
                                        <tr>
                                            <td><a
                                                    href="{{ route('assets.asset', ['id' => $item['contrato_id']]) }}">{{ $item['contrato_id'] }}</a>
                                            </td>
                                            <td class="d-none d-lg-table-cell">{{ $item['status'] }}</td>
                                            <td class="d-none d-xl-table-cell">
                                                {{ \Carbon\Carbon::parse($item['vencimento_original'])->format('d/m/Y') }}
                                            </td>
                                            <td>R$ {{ number_format($item['valor_original'], 2, ',', '.') }}</td>
                                            <td>R$ {{ number_format($item['valor_aprovado'], 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{--
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
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
