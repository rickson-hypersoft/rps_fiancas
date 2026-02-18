@extends('dashboard')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="col-md-12">

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span><br>
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
                <h5>Extrato Financeiro Asaas</h5>

                @php
                    $saldoTotal = (float) ($totals['saldoTotal'] ?? 0);
                    $recebimentos = (float) ($totals['recebimentos'] ?? 0);
                    $taxas = (float) ($totals['taxas'] ?? 0); // negativo
                @endphp

                <div class="row mt-4">
                    <div class="col-lg-4 col-sm-6 mb-2">
                        <div class="card card-border-shadow-secondary h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial bg-label-secondary rounded">
                                            <i class="icon-base ti tabler-wallet icon-28px"></i>
                                        </span>
                                    </div>
                                    <h4 class="mb-0">R$ {{ number_format($saldoTotal, 2, ',', '.') }}</h4>
                                </div>
                                <p class="mb-1">Saldo total</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 mb-2">
                        <div class="card card-border-shadow-success h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial bg-label-success rounded">
                                            <i class="icon-base ti tabler-cash icon-28px"></i>
                                        </span>
                                    </div>
                                    <h4 class="mb-0">R$ {{ number_format($recebimentos, 2, ',', '.') }}</h4>
                                </div>
                                <p class="mb-1">Recebimentos</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 mb-2">
                        <div class="card card-border-shadow-danger h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar me-4">
                                        <span class="avatar-initial bg-label-danger rounded">
                                            <i class="icon-base ti tabler-receipt-tax icon-28px"></i>
                                        </span>
                                    </div>
                                    <h4 class="mb-0">R$ {{ number_format(abs($taxas), 2, ',', '.') }}</h4>
                                </div>
                                <p class="mb-1">Taxas</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        {{-- Filtros --}}
                        <form method="GET" action="{{ url()->current() }}">
                            <div class="row g-2 align-items-end">
                                <div class="col-12 col-md-3">
                                    <label class="form-label">Data inicial</label>
                                    <input type="date" name="start_date" class="form-control"
                                        value="{{ request('start_date') }}">
                                </div>

                                <div class="col-12 col-md-3">
                                    <label class="form-label">Data final</label>
                                    <input type="date" name="finish_date" class="form-control"
                                        value="{{ request('finish_date') }}">
                                </div>

                                <div class="col-12 col-md-3">
                                    <label class="form-label">Tipo</label>
                                    <select name="direction" class="form-select">
                                        <option value="" {{ request('direction') === '' ? 'selected' : '' }}>Todos
                                        </option>

                                        <option value="received"
                                            {{ request('direction') === 'received' ? 'selected' : '' }}>
                                            Recebimento
                                        </option>

                                        <option value="fee" {{ request('direction') === 'fee' ? 'selected' : '' }}>
                                            Taxa
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-3 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary w-100">Limpar</a>
                                </div>
                            </div>
                        </form>

                        <hr class="my-3">

                        @php
                            $firstItem = $pagination['from'] ?? 0;
                            $lastItem = $pagination['to'] ?? 0;
                            $total = $pagination['total'] ?? 0;
                            $currentPage = $pagination['current_page'] ?? 1;
                            $lastPage = $pagination['last_page'] ?? 1;

                            $baseQuery = request()->except('page');
                        @endphp

                        {{-- Informativo --}}
                        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                            <div class="text-muted">
                                <strong>Total de registros:</strong>
                                {{ $total }}
                            </div>
                        </div>

                        {{-- Tabela --}}
                        <div class="table-responsive">
                            <table class="table-striped table-hover table align-middle">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Descrição</th>
                                        <th>Tipo</th>
                                        <th class="text-end">Valor</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($extratos as $item)
                                        @php
                                            $value = (float) ($item['value'] ?? 0);
                                            $rawDate = $item['date'] ?? null;

                                            $date = $rawDate
                                                ? \Carbon\Carbon::createFromFormat('Y-m-d', $rawDate)->format('d/m/Y')
                                                : null;

                                            $desc = $item['description'] ?? '';
                                            $type = $item['type'] ?? '';

                                            // Tradução do tipo
                                            $typeLabel = match ($type) {
                                                'PAYMENT_FEE' => 'Taxa de Pagamento',
                                                'PAYMENT_RECEIVED' => 'Pagamento Recebido',
                                                default => $type,
                                            };

                                            // Categoria principal: Taxa/Recebimento
                                            // Preferência pelo TYPE; se vier desconhecido, cai pelo sinal do valor.
                                            $isFee = $type === 'PAYMENT_FEE' || $typeLabel === 'Taxa de Pagamento';
                                            $isReceived =
                                                $type === 'PAYMENT_RECEIVED' || $typeLabel === 'Pagamento Recebido';

                                            if (!$isFee && !$isReceived) {
                                                // fallback pelo valor
                                                $isReceived = $value > 0;
                                                $isFee = $value < 0;
                                            }
                                        @endphp

                                        <tr>
                                            <td style="white-space:nowrap;">
                                                {{ $date }}
                                            </td>

                                            <td>
                                                {{ $desc }}
                                            </td>

                                            <td style="white-space:nowrap;">
                                                <span
                                                    class="badge {{ $isReceived ? 'bg-success' : ($isFee ? 'bg-danger' : 'bg-secondary') }}">
                                                    {{ $typeLabel }}
                                                </span>
                                            </td>

                                            <td class="text-end" style="white-space:nowrap;">
                                                <strong>
                                                    {{ 'R$ ' . number_format($value, 2, ',', '.') }}
                                                </strong>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-muted py-4 text-center">
                                                Nenhum registro encontrado com os filtros selecionados.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Paginação (seu padrão) --}}
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
                                                <a class="page-link"
                                                    href="{{ url()->current() . '?' . http_build_query(array_merge($baseQuery, ['page' => 1])) }}"
                                                    aria-label="Primeira página">
                                                    <i class="icon-base ti tabler-chevrons-left icon-sm"></i>
                                                </a>
                                            </li>

                                            <li class="page-item prev {{ $currentPage == 1 ? 'disabled' : '' }}">
                                                <a class="page-link"
                                                    href="{{ url()->current() . '?' . http_build_query(array_merge($baseQuery, ['page' => max(1, $currentPage - 1)])) }}"
                                                    aria-label="Página anterior">
                                                    <i class="icon-base ti tabler-chevron-left icon-sm"></i>
                                                </a>
                                            </li>

                                            <li class="page-item next {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                                <a class="page-link"
                                                    href="{{ url()->current() . '?' . http_build_query(array_merge($baseQuery, ['page' => min($lastPage, $currentPage + 1)])) }}"
                                                    aria-label="Próxima página">
                                                    <i class="icon-base ti tabler-chevron-right icon-sm"></i>
                                                </a>
                                            </li>

                                            <li class="page-item last {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                                <a class="page-link"
                                                    href="{{ url()->current() . '?' . http_build_query(array_merge($baseQuery, ['page' => $lastPage])) }}"
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
