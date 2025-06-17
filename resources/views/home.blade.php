@extends('dashboard') @section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
        <div class="col-lg-8 col-md-12">
            <div class="row g-4">
                <!-- Website Analytics -->
                <div class="col-12 p-0">
                    <div class="swiper-container swiper-container-horizontal swiper bg-lighter swiper-card-advance-bg" id="swiper-with-pagination-cards">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide p-0 m-0">
                                <div class="row">
                                    <img src="{{
                                            asset(
                                                'assets/img/pages/bannerinvicta2.PNG'
                                            )
                                        }}" />
                                </div>
                            </div>

                            <div class="swiper-slide p-0 m-0">
                                <div class="row">
                                    <img src="{{
                                            asset(
                                                'assets/img/pages/bannerinvicta1.PNG'
                                            )
                                        }}" />
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <!--/ Website Analytics -->
                @php
                $statusContratos = collect([
                'Ativo' => ['icon' => 'tabler-file-check', 'color' => 'primary'],
                'Pendente' => ['icon' => 'tabler-file-info', 'color' => 'info'],
                'Em renovação' => ['icon' => 'tabler-file-dots', 'color' => 'warning'],
                'Cancelado' => ['icon' => 'tabler-file-x', 'color' => 'danger'],
                ]);

                $statusPropostas = collect([
                'Aprovado' => ['label' => 'Aprovadas', 'icon' => 'tabler-copy-check', 'color' => 'primary'],
                'Pendente' => ['label' => 'Pendentes', 'icon' => 'tabler-copy-plus', 'color' => 'info'],
                'Cancelado' => ['label' => 'Canceladas', 'icon' => 'tabler-copy-minus', 'color' => 'warning'],
                'Reprovado' => ['label' => 'Reprovadas', 'icon' => 'tabler-copy-x', 'color' => 'danger'],
                ]);

               $propostasMapeadas = collect($propostas)->mapWithKeys(fn ($item) => [trim($item['PROPOSTA_STATUS']) => $item['TOTAL']]);

$contratosMapeados = collect($contratos)->mapWithKeys(fn ($item) => [trim($item['CONTRATO_STATUS']) => $item['TOTAL']]);
                @endphp
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Contratos</h5>
                    </div>
                    <div class="card-body d-flex align-items-end">
                        <div class="w-100">
                            <div class="row gy-3">
                                @foreach($statusContratos as $status => $config)
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded bg-label-{{ $config['color'] }} me-4 p-2">
                                            <i class="icon-base ti {{ $config['icon'] }} icon-lg"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">{{ $contratosMapeados[$status] ?? 0 }}</h5>
                                            <small>{{ $status }}</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Propostas</h5>
                        <!-- <small class="text-body-secondary">Maio/2025</small> -->
                    </div>
                    <div class="card-body d-flex align-items-end">
                        <div class="w-100">
                            <div class="row gy-3">
                                @foreach($statusPropostas as $status => $config)
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded bg-label-{{ $config['color'] }} me-4 p-2">
                                            <i class="icon-base ti {{ $config['icon'] }} icon-lg"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">{{ $propostasMapeadas[$status] ?? 0 }}</h5>
                                            <small>{{ $config['label'] }}</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div>
                <div class="card mb-2">
                    <form method="GET" action="{{route('assets.index')}}">

                        <h5 class="card-header">
                            Pesquisar propostas e contratos por número ou nome do
                            cliente
                        </h5>
                        <div class="card-body demo-vertical-spacing demo-only-element">
                            <div class="input-group input-group-merge form-send-message">
                            <input type="text" class="form-control message-input" placeholder="Pesquisar" name="search" aria-describedby="text-to-speech-addon" />
                             <button type="submit" class="message-actions input-group-text" id="text-find">
                    <i class="icon-base ti tabler-folder-search cursor-pointer"></i>
                </button>
                        </div>
                    </div>
                </form>
                </div>

                <div class="card overflow-hidden" style="height: 424px">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title m-0 me-2 pt-1 mb-2 d-flex align-items-center">
                            <i class="icon-base ti tabler-list-details me-3"></i>
                            Atividades
                        </h5>
                        <div class="dropdown">
                            <button class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-2 me-n1" type="button" id="timelineWapper" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-base ti tabler-dots-vertical icon-md text-body-secondary"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="timelineWapper">
                                <a class="dropdown-item" href="javascript:void(0);">Todas Atividades</a>
                                <a class="dropdown-item" href="javascript:void(0);">Minhas Atividades</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-xxl-0 table-responsive">
                        <ul class="timeline mb-0">

                            @foreach ($cards as $card)
                            @php
                                $pointer = '';
                                switch ($card['proposta_status']) {
                                    case 'Aprovado':
                                         $pointer = 'success';
                                        break;
                                     case 'Cancelado':
                                         $pointer = 'danger';
                                        break;

                                    default:
                                        $pointer = 'secondary';
                                        break;
                                }
                            @endphp
                            <li class="timeline-item timeline-item-transparent mt-2">
                                <span class="timeline-point timeline-point-{{$pointer}}"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1 ">
                                        <h6 class="mb-0">Proposta {{$card['proposta_status']}}</h6>
                                        <small class="text-body-secondary"> {{ \Carbon\Carbon::parse($card['data_ultima_atualizacao'] . ' ' . $card['hora_ultima_atualizacao'])->format('m/Y H:i') }}</small>
                                    </div>
                                    <p class="mb-1">Inquilino {{$card['pessoa_nome']}}</p>
                                    @if ($card['observacao'])
                                        <p class="mb-1 small text-body-secondary">
                                        Motivo: {{ $card['observacao']}}
                                    </p>
                                    @endif
                                    <a href="{{ $card['contrato_status'] === 'Ativo'
                                            ? route('assets.asset', ['id' => $card['id']])
                                            : route('propostal.resume', ['id' => $card['id']]) }}"
                                    class="btn btn-xs rounded-pill btn-label-secondary">
                                        Visualizar
                                    </a>
                                </div>
                            </li>
                            @endforeach



                            <!--
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-success"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0">Proposta Aprovada</h6>
                                        <small class="text-body-secondary">28/05 11:30</small>
                                    </div>
                                    <p class="mb-2">
                                        Inquilino Richard Igor Silva
                                    </p>
                                    <button type="button" class="btn btn-xs rounded-pill btn-label-secondary">
                                        Visualizar
                                    </button>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-secondary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0">Nova Proposta</h6>
                                        <small class="text-body-secondary">28/05 10:30</small>
                                    </div>
                                    <p class="mb-2">
                                        Inquilino Richard Igor Silva
                                    </p>
                                    <button type="button" class="btn btn-xs rounded-pill btn-label-secondary">
                                        Visualizar
                                    </button>
                                </div>
                            </li>

                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-secondary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0">Nova Proposta</h6>
                                        <small class="text-body-secondary">28/05 10:30</small>
                                    </div>
                                    <p class="mb-2">
                                        Inquilino Richard Igor Silva
                                    </p>
                                    <button type="button" class="btn btn-xs rounded-pill btn-label-secondary">
                                        Visualizar
                                    </button>
                                </div>
                            </li>

                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-secondary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0">Nova Proposta</h6>
                                        <small class="text-body-secondary">28/05 10:30</small>
                                    </div>
                                    <p class="mb-2">
                                        Inquilino Richard Igor Silva
                                    </p>
                                    <button type="button" class="btn btn-xs rounded-pill btn-label-secondary">
                                        Visualizar
                                    </button>
                                </div>
                            </li>
                        -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Content -->
</div>
@endsection
