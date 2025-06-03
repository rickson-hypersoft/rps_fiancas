<div id="analise-credito" style="display: none" class="content fv-plugins-bootstrap5 fv-plugins-framework">
    <div class="content-header mb-4 p-5" id="card_status_propostal">
        <h4 class="mb-0 text-center fw-bold text-white" id="text_status_propostal"></h4>
    </div>
    <div class="row g-6 justify-content-center">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="card">
                <div class="card-header pb-1">
                    <div class="d-flex align-middle justify-content-between mb-1">
                        <small>VALOR SOLICITADO DE ALUGUEL</small>
                        <span id="badge_status_propostal" class="badge bg-label-secondary">Simulação</span>
                    </div>
                </div>
                <div class="card-body mb-0">
                    <h4 class="fw-bold" id="color_text_imovel_aluguel"><i id="icon_status_propostal" class="menu-icon icon-base ti tabler-clock"></i>
                        <span id="imovel_aluguel_text"></span>
                    </h4>
                    <div class="d-flex gap-5 p-4 bg-label-secondary" style="border-radius: 10px;">
                        <div class="p-2">
                            <span class="fw-bold">Valor de condomínio</span>
                            <p class="m-0"><span id="imovel_condominio_text"></span></p>
                        </div>
                        <div class="p-2">
                            <span class="fw-bold">Taxas inclusas</span>
                            <p class="m-0"><span id="imovel_taxas_text">0,00</span></p>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-1">
                    <span class="small fw-bold mb-0" style="font-size: 16px;">DETALHAMENTO</span>

                    <div class="demo-inline-spacing p-0 m-0">
                        <p class="m-0 p-0" id="detalhamento"></p>
                    </div>

                    <div class="d-flex mt-5 gap-2">
                        <a href="#" data-id="" class="btn-prev btn btn-text-success waves-effect"><i class="menu-icon icon-base ti tabler-pencil"></i> Editar dados</a>
                        <a href="{{route('propostal.create')}}" id="btn-nova-simulacao" class="btn btn-text-success waves-effect"><i class="menu-icon icon-base ti tabler-refresh"></i> Fazer nova simulação</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-6 mt-5 justify-content-center" id="setup-config">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="card" style="border: 1px solid green;">
                <div class="card-header pb-1">
                    <div class="d-flex align-middle justify-content-between mb-1">
                        <small style="font-size: 16px;">Taxa de 15%, Custo de saída 5x e Cobertura total de 40x</small>
                    </div>
                    <hr>
                    <small class="text-success fw-bold" style="font-size: 20px;">12x de <span id="valor_parcelado"></span></small>
                    <small style="font-size: 16px;">ou <span id="valor_total_vista"></span> à vista</small>
                    <hr>
                </div>
                <div class="card-body mb-0">
                    <h6 class="fw-bold">Defina a taxa de setup e o tipo de pagamento</h6>
                    <div class="col-12">
                        <label for="setup" class="form-label">Setup</label>
                        <select class="form-select form-select-lg" name="setup" id="setup" aria-label="Default select example">
                            <option value="">Selecionar setup</option>
                            @foreach($setups as $setup)
                            <option value="{{$setup['taxa']}}">
                                {{$setup['taxa_formatada']}}
                            </option>
                            @endforeach

                        </select>
                        <p class="mt-2 mb-4">Se trata do valor para realizar a ativação deste produto</p>

                        <div style="border: 1px solid #387BA8; border-radius: 10px">
                            <div class="card-body bg-label-secondary" style="border-radius: 10px">
                                <p>A escolha do parcelamento fica na tela de pagamentos visível à pessoa inquilina. O repasse para a imobiliária da taxa setup é feito a vista, mesmo que a pessoa inquilina pague parcelado.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-end mb-5 mt-5" id="next-setup-config">
                <button id="btn-analise-credito" class="btn btn-primary btn-next-analise waves-effect waves-light">
                    <span class="align-middle d-sm-inline-block d-none me-sm-2">Avançar</span>
                    <i class="icon-base ti tabler-arrow-right icon-xs"></i>
                </button>
            </div>
        </div>
    </div>
</div>
