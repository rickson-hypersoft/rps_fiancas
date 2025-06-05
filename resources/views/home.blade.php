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

                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Contratos</h5>
                    </div>
                    <div class="card-body d-flex align-items-end">
                        <div class="w-100">
                            <div class="row gy-3">
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded bg-label-primary me-4 p-2">
                                            <i class="icon-base ti tabler-file-check icon-lg"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">107</h5>
                                            <small>Ativos</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded bg-label-info me-4 p-2">
                                            <i class="icon-base ti tabler-file-info icon-lg"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">9</h5>
                                            <small>Pendentes</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded bg-label-warning me-4 p-2">
                                            <i class="icon-base ti tabler-file-dots"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">18</h5>
                                            <small>Em renovação</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded bg-label-danger me-4 p-2">
                                            <i class="icon-base ti tabler-file-x icon-lg"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">136</h5>
                                            <small>Cancelados</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Propostas</h5>
                        <small class="text-body-secondary">Maio/2025</small>
                    </div>
                    <div class="card-body d-flex align-items-end">
                        <div class="w-100">
                            <div class="row gy-3">
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded bg-label-primary me-4 p-2">
                                            <i class="icon-base ti tabler-copy-check icon-lg"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">10</h5>
                                            <small>Aprovadas</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded bg-label-info me-4 p-2">
                                            <i class="icon-base ti tabler-copy-plus icon-lg"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">6</h5>
                                            <small>Pendentes</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded bg-label-warning me-4 p-2">
                                            <i class="icon-base ti tabler-copy-minus"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">3</h5>
                                            <small>Canceladas</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge rounded bg-label-danger me-4 p-2">
                                            <i class="icon-base ti tabler-copy-x icon-lg"></i>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="mb-0">2</h5>
                                            <small>Reprovadas</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div>
                <div class="card mb-2">
                    <h5 class="card-header">
                        Pesquisar propostas e contratos por número ou nome do
                        cliente
                    </h5>
                    <div class="card-body demo-vertical-spacing demo-only-element">
                        <div class="input-group input-group-merge form-send-message">
                            <input type="text" class="form-control message-input" placeholder="Pesquisar" aria-describedby="text-to-speech-addon" />
                            <span class="message-actions input-group-text" id="text-find">
                                <i class="icon-base ti tabler-folder-search cursor-pointer"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card overflow-hidden" style="height: 440px">
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
                            <li class="timeline-item timeline-item-transparent mt-2">
                                <span class="timeline-point timeline-point-danger"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1 ">
                                        <h6 class="mb-0">Proposta Cancelada</h6>
                                        <small class="text-body-secondary">28/05 10:30</small>
                                    </div>
                                    <p class="mb-1">Inquilino Rickson Berigo</p>
                                    <p class="mb-1 small text-body-secondary">
                                        Motivo: Desistência
                                    </p>
                                    <button type="button" class="btn btn-xs rounded-pill btn-label-secondary">
                                        Visualizar
                                    </button>
                                </div>
                            </li>
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
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Content -->
</div>
@endsection
