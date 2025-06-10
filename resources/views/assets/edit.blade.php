@extends('dashboard')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header pb-3 pt-3" style="background: #f7f7f7">
            <h5 class="p-0 m-0">Produto</h5>
        </div>
        <div class="card-body mt-5">
            <form action="" class="row">
                <div class="col-sm-3 mb-4 form-control-validation fv-plugins-icon-container">
                    <label class="form-label" for="formValidationUsername">Valor Aluguel</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">R$</span>
                        <input name="imovel_aluguel" style="text-align: right" id="imovel_aluguel" type="text" class="form-control form-control-lg" value="" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>

                <div class="col-sm-3 mb-4 form-control-validation fv-plugins-icon-container">
                    <label class="form-label" for="formValidationUsername">Valor Aluguel</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">R$</span>
                        <input name="imovel_aluguel" style="text-align: right" id="imovel_aluguel" type="text" class="form-control form-control-lg" value="" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>

                <div class="col-sm-3 mb-4 form-control-validation fv-plugins-icon-container">
                    <label class="form-label" for="formValidationUsername">Valor Aluguel</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">R$</span>
                        <input name="imovel_aluguel" style="text-align: right" id="imovel_aluguel" type="text" class="form-control form-control-lg" value="" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>

                <div class="col-sm-3 mb-4 form-control-validation fv-plugins-icon-container">
                    <label class="form-label" for="formValidationUsername">Valor Aluguel</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">R$</span>
                        <input name="imovel_aluguel" style="text-align: right" id="imovel_aluguel" type="text" class="form-control form-control-lg" value="" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>


                <div class="col-sm-3 mb-4 form-control-validation fv-plugins-icon-container">
                    <label class="form-label" for="formValidationUsername">Valor Aluguel</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">R$</span>
                        <input name="imovel_aluguel" style="text-align: right" id="imovel_aluguel" type="text" class="form-control form-control-lg" value="" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>

                <div class="col-sm-3 mb-4 form-control-validation fv-plugins-icon-container">
                    <label class="form-label" for="formValidationUsername">Valor Aluguel</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">R$</span>
                        <input name="imovel_aluguel" style="text-align: right" id="imovel_aluguel" type="text" class="form-control form-control-lg" value="" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>

                <div class="col-sm-3 mb-4 form-control-validation fv-plugins-icon-container">
                    <label class="form-label" for="formValidationUsername">Valor Aluguel</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">R$</span>
                        <input name="imovel_aluguel" style="text-align: right" id="imovel_aluguel" type="text" class="form-control form-control-lg" value="" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>

                <div class="col-sm-3 mb-4 form-control-validation fv-plugins-icon-container">
                    <label class="form-label" for="formValidationUsername">Valor Aluguel</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">R$</span>
                        <input name="imovel_aluguel" style="text-align: right" id="imovel_aluguel" type="text" class="form-control form-control-lg" value="" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>

                <div class="col-sm-3 mb-4 form-control-validation fv-plugins-icon-container">
                    <label class="form-label" for="formValidationUsername">Valor Aluguel</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text">R$</span>
                        <input name="imovel_aluguel" style="text-align: right" id="imovel_aluguel" type="text" class="form-control form-control-lg" value="" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header pb-3 pt-3" style="background: #f7f7f7">
            <h5 class="p-0 m-0">Localização</h5>
        </div>
        <div class="card-body mt-5">
            <form action="" class="row">
                <div class="row mt-5">
                    <div class="col-md-3 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_cep">CEP</label>
                            <input type="text" name="imovel_cep" id="imovel_cep_dados" class="form-control form-control-lg" value="" disabled />
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_endereco">Endereço</label>
                            <input type="text" name="imovel_endereco" id="imovel_endereco" class="form-control form-control-lg" value="" />
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_numero">Número</label>
                            <input type="text" name="imovel_numero" id="imovel_numero" class="form-control form-control-lg" value="" />
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_bairro">Bairro</label>
                            <input type="text" name="imovel_bairro" id="imovel_bairro" class="form-control form-control-lg" value="" />
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_estado">Estado</label>
                            <input type="text" name="imovel_estado" id="imovel_estado_dados" class="form-control form-control-lg" value="" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="form-control-validation fv-plugins-icon-container">
                        <label class="form-label" for="imovel_cidade">Cidade</label>
                        <input type="text" name="imovel_cidade" id="imovel_cidade_dados" class="form-control form-control-lg" value="" />
                    </div>
                </div>

                <div class="col-md-8 mb-2">
                    <div class="form-control-validation fv-plugins-icon-container">
                        <label class="form-label" for="imovel_complemento">Complemento</label>
                        <input type="text" name="imovel_complemento" id="imovel_complemento" class="form-control form-control-lg" value="" />
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-control-validation fv-plugins-icon-container">
                        <label class="form-label" for="imovel_tag">Tag</label>
                        <input type="text" name="imovel_tag" id="imovel_tag" class="form-control form-control-lg" value="" />
                    </div>
                </div>

                <div class="col-md-6 mb-2">
                    <div class="form-control-validation fv-plugins-icon-container">
                        <label class="form-label" for="imovel_tag">Ramo Atividade</label>
                        <input type="text" name="imovel_tag" id="imovel_tag" class="form-control form-control-lg" value="" />
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <div class="form-control-validation fv-plugins-icon-container">
                        <label class="form-label" for="imovel_tag">Descrição</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="observacao"></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header pb-3 pt-3" style="background: #f7f7f7">
            <h5 class="p-0 m-0">Anexos/Documentos</h5>
            <p>O arquivo anexado obrigatóriamente deverá ser pdf ou umagem de no máximo 80MB</p>
        </div>
        <div class="card-body mt-5">
            <div class="row">
                <div class="col-md-4">
                    <form action="/upload" class="dropzone needsclick dz-clickable" id="dropzone-basic">
                        <div class="dz-message needsclick">
                            Contrato
                            <span class="note needsclick">(This is just a demo dropzone. Selected files are
                                <span class="fw-medium">not</span> actually uploaded.)</span>
                        </div>
                    </form>
                </div>

                <div class="col-md-4">
                    <form action="/upload" class="dropzone needsclick dz-clickable" id="dropzone-basic">
                        <div class="dz-message needsclick">
                            Vistoria
                            <span class="note needsclick">(This is just a demo dropzone. Selected files are
                                <span class="fw-medium">not</span> actually uploaded.)</span>
                        </div>

                    </form>
                </div>

                <div class="col-md-4">
                    <form action="/upload" class="dropzone needsclick dz-clickable" id="dropzone-basic">
                        <div class="dz-message needsclick">
                            Apólice
                            <span class="note needsclick">(This is just a demo dropzone. Selected files are
                                <span class="fw-medium">not</span> actually uploaded.)</span>
                        </div>
                    </form>

                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <a href="" class="btn btn-secondary">Voltar</a>
        <button class="btn btn-primary">Salvar alterações</button>
    </div>
</div>

@endsection