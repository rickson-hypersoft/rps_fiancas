<div id="criar-proposta" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
    <div class="content-header mb-4 p-5 bg-primary">
        <h4 class="mb-0 text-center fw-bold text-white">Proposta de fiança</h4>
    </div>
    <div class="row g-6 justify-content-center">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="card">
                <div class="card-body mb-0 pb-0">
                    <div class="content-header mb-4">
                        <h6 class="mb-0">Dados do inquilino</h6>
                        <hr>
                    </div>

                    <input type="hidden" name="id_imobiliaria" id="id_imobiliaria" value="{{$user['id_imobiliaria']}}">

                    <div class="row pb-5">
                        <div class="col-md mb-md-0 mb-3">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="pessoa_fisica">
                                    <input name="pessoa_tipo" class="form-check-input" type="radio" value="pf" id="pessoa_fisica" checked>
                                    <span class="custom-option-header p-0">
                                        <span class="h6 mb-0">Pessoa Física</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md mb-md-0 mb-3">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="pessoa_juridica">
                                    <input name="pessoa_tipo" class="form-check-input" type="radio" value="pj" id="pessoa_juridica">
                                    <span class="custom-option-header p-0">
                                        <span class="h6 mb-0">Pessoa Jurídica</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <small class="mb-3">PRIMEIRO INQUILINO</small>
                        <div class="col-md-4 mb-2">
                            <div class="form-control-validation fv-plugins-icon-container">
                                <label class="form-label" for="pessoa_doc">CPF</label>
                                <input type="text" name="pessoa_doc" id="pessoa_doc" class="form-control form-control-lg">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-8 mb-2">
                            <div class="form-control-validation fv-plugins-icon-container">
                                <label class="form-label" for="pessoa_nome">Nome</label>
                                <input type="text" name="pessoa_nome" id="pessoa_nome" class="form-control form-control-lg">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="content-header mb-4 mt-5">
                        <h6 class="mb-0">Dados do imóvel</h6>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-md-0 mb-5">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="residencial">
                                    <input name="imovel_tipo" class="form-check-input" type="radio" value="R" id="residencial" checked>
                                    <span class="custom-option-header p-0">
                                        <span class="h6 mb-0">Residencial</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-md-0 mb-5">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="comercial">
                                    <input name="imovel_tipo" class="form-check-input" type="radio" value="C" id="comercial">
                                    <span class="custom-option-header p-0">
                                        <span class="h6 mb-0">Comercial</span>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="row mt-5 mb-4 align-items-center">
                            <div class="col-md-4">
                                <label class="form-label" for="imovel_cep">CEP</label>
                                <input type="text" name="imovel_cep" id="imovel_cep" class="form-control form-control-lg">
                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                            </div>
                            <div class="pt-4 col-md-3">
                                <i class="menu-icon icon-base ti tabler-map"></i> <span id="cep-status">CEP não encontrado</span>
                            </div>
                        </div>

                    </div>

                    <div class="content-header mb-4 mt-5">
                        <h6 class="mb-0">Valores</h6>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 mb-4 form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="formValidationUsername">Valor Aluguel</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">R$</span>
                                <input name="imovel_aluguel" style="text-align: right" id='imovel_aluguel' type="text" class="form-control form-control-lg" aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-4 form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="formValidationUsername">Valor Condomínio</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">R$</span>
                                <input style="text-align: right" name="imovel_condominio" id="imovel_condominio" type="text" class="form-control form-control-lg" aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-4 form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="formValidationUsername">Taxas</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">R$</span>
                                <input name="imovel_taxas" style="text-align: right" id="imovel_taxas" type="text" class="form-control form-control-lg" aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end mb-5">
                            <button id="btn-simular-credito" class="btn btn-primary btn-next-simular waves-effect waves-light">
                                <span class="align-middle d-sm-inline-block d-none me-sm-2">Simular Crédito</span>
                                <i class="icon-base ti tabler-arrow-right icon-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>