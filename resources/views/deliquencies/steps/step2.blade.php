<form action="{{ route('delinquencies.storeStep2', ['contrato_id' => $contrato_id, 'id' => $idInadimplencia]) }}"
    method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Account Details -->
    <div id="account-details" class="content active dstepper-block">
        <div class="content-header bg-light mb-4 p-3" style="border-radius: 0.5rem">
            <div class="d-flex mb-2">
                <div class="d-flex align-items-center gap-2">
                    <h6 class="mb-0">Fiança disponível:</h6>
                    <small class="badge text-bg-success">{{ $fianca_disponivel }}</small>
                </div>
            </div>
            <p class="p-0">
                * Este valor considera apenas inadimplências pagas e
                provisionadas. Inadimplências em análise não são debatidas deste
                valor
            </p>
        </div>

        <div class="row g-6">
            <div class="content-header mb-4">
                <div class="card-header">
                    <h4 class="mb-0">Boleto original</h4>
                    <p class="m-0 p-0">
                        Adicione todos os comprovantes inadimplantes que precisa
                        comunicar para a Invicta
                    </p>
                </div>
                <hr />

                <div class="card-body">
                    <div class="row" id="cards-container" data-card>
                        <div style="@if ($situacao_imovel == 'Desocupado') display:none; @else display:block; @endif"
                            class="col-12 mb-4" id="comprovante-boleto-original">
                            <h5 class="m-0">
                                Envie o comprovante ou boleto original
                            </h5>
                            <span class="m-0 p-0">Tamanho máximo 6MB</span>

                            <div class="row gy-6 mt-3">
                                <div class="col-12">
                                    <input class="form-control" name="anexos" type="file" id="formFile">
                                </div>
                            </div>
                        </div>

                        <div class="col-4"
                            style="@if ($situacao_imovel == 'Desocupado') display:none; @else display:block; @endif">
                            <div class="mb-4">
                                <label for="defaultSelect" class="form-label">Tipo da conta</label>
                                <select name="tipo_conta" class="form-select tipo-conta">
                                    <option value="">Selecionar tipo de conta</option>
                                    <option value="Aluguel"
                                        {{ old('tipo', $tipo ?? '') == 'Aluguel' ? 'selected' : '' }}>Aluguel</option>
                                    <option value="Condomínio"
                                        {{ old('tipo', $tipo ?? '') == 'Condomínio' ? 'selected' : '' }}>Condomínio
                                    </option>
                                    <option value="IPTU" {{ old('tipo', $tipo ?? '') == 'IPTU' ? 'selected' : '' }}>
                                        IPTU</option>
                                    <option value="Seguro" {{ old('tipo', $tipo ?? '') == 'Seguro' ? 'selected' : '' }}>
                                        Seguro</option>
                                    <option value="Água" {{ old('tipo', $tipo ?? '') == 'Água' ? 'selected' : '' }}>
                                        Água</option>
                                    <option value="Luz" {{ old('tipo', $tipo ?? '') == 'Luz' ? 'selected' : '' }}>Luz
                                    </option>
                                    <option value="Gás" {{ old('tipo', $tipo ?? '') == 'Gás' ? 'selected' : '' }}>Gás
                                    </option>
                                    <option value="Seguro incêndio"
                                        {{ old('tipo', $tipo ?? '') == 'Seguro incêndio' ? 'selected' : '' }}>Seguro
                                        incêndio</option>
                                    <option value="Outros anexos"
                                        {{ old('tipo', $tipo ?? '') == 'Outros anexos' ? 'selected' : '' }}>Outros
                                        anexos</option>
                                    @if ($situacao_imovel == 'Desocupado')
                                        <option value="Orçamentos de Reparos"
                                            @if ($situacao_imovel == 'Desocupado' && (!isset($tipo) || $tipo != 'Multa rescisória')) selected @endif>
                                            Orçamentos de Reparos
                                        </option>
                                        <option value="Multa rescisória"
                                            @if ($situacao_imovel == 'Desocupado') selected @endif>
                                            Multa rescisória
                                        </option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <!-- Aluguel -->
                        <div class="col-4 aluguel-field" style="display: none">
                            <label for="valor_original_aluguel" class="form-label">Valor original sem multa e
                                juros*</label>
                            <input type="text" class="form-control" id="valor_original_aluguel"
                                name="valor_original_aluguel" placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp" />
                        </div>

                        <div class="col-4 aluguel-field" style="display: none">
                            <label for="vencimento_original_aluguel" class="form-label">Vencimento original*</label>
                            <input type="date" class="form-control" id="vencimento_original_aluguel"
                                name="vencimento_original_aluguel" aria-describedby="defaultFormControlHelp" />
                        </div>

                        <div class="col-12 boletos-alugueis mb-4" style="display: none">
                            <p>Tem outras contas no mesmo boleto?*</p>
                            <div class="row">
                                <div class="col-md mb-md-0 mb-5">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="customRadioTemp1">
                                            <input name="maisBoletos" class="form-check-input" type="radio"
                                                value="sim" id="customRadioTemp1" />
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">Sim</span>
                                            </span>
                                            <span class="custom-option-body">
                                                <small>O boleto é composto por
                                                    mais contas, como contas de
                                                    condomínio, gás, seguro
                                                    incêndio e outras</small>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-check custom-option custom-option-basic">
                                        <label class="form-check-label custom-option-content" for="customRadioTemp2">
                                            <input name="maisBoletos" class="form-check-input" type="radio"
                                                value="não" id="customRadioTemp2" />
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">Não</span>
                                            </span>
                                            <span class="custom-option-body">
                                                <small>É um boleto único de
                                                    aluguel e as outras contas
                                                    são separadas</small>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4" style="display: none" id="selecionar_mais_boletos">
                            <label class="mb-2 block text-sm font-medium text-gray-900">Selecione quais contas
                                estão
                                no
                                mesmo
                                boleto</label>
                            <div class="flex flex-wrap gap-2">
                                <button type="button"
                                    class="conta-btn select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                    data-conta="Água">
                                    Água
                                </button>
                                <button type="button"
                                    class="conta-btn select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                    data-conta="Condomínio">
                                    Condomínio
                                </button>
                                <button type="button"
                                    class="conta-btn select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                    data-conta="Gás">
                                    Gás
                                </button>
                                <button type="button"
                                    class="conta-btn select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                    data-conta="IPTU">
                                    IPTU
                                </button>
                                <button type="button"
                                    class="conta-btn select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                    data-conta="Luz">
                                    Luz
                                </button>
                                <button type="button"
                                    class="conta-btn select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                    data-conta="Seguro">
                                    Seguro
                                </button>
                                <button type="button"
                                    class="conta-btn select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                    data-conta="Seguro incêndio">
                                    Seguro incêndio
                                </button>
                                <button type="button"
                                    class="conta-btn select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                    data-conta="Outros anexos">
                                    Outros anexos
                                </button>
                            </div>
                        </div>

                        <!-- Div onde vai ser criado parte dos comprovantes de valores -->
                        <div id="bloco-comprovantes" class="col-12 mt-5" style="display: none">
                            <h4 class="mb-0">Comprovante dos valores</h4>
                            <p class="m-0 p-0">
                                Adicione todos os comprovantes dos valores do
                                boleto de aluguel
                            </p>
                            <hr />
                            <div class="alert alert-secondary" role="alert">
                                <i class="icon-base ti tabler-info-circle icon-md"></i>
                                Esses valores, não serão somados à
                                inadimplência, serão utilizados exclusivamente
                                para agilizar a análise.
                            </div>

                            <!-- Parte que vai ser gerada após o click nas opções a mais -->
                            <hr />
                            <div id="comprovantes-container"></div>
                        </div>
                        <!-- Fim aluguel -->

                        <!-- Condominio -->
                        <div class="col-4 condominio-field" style="display: none">
                            <label for="valor_original_condominio" class="form-label">Valor original sem multa e
                                juros*</label>
                            <input type="text" name="valor_original_condominio" class="form-control"
                                id="valor_original_condominio" placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp" />
                        </div>

                        <div class="col-4 condominio-field" style="display: none">
                            <label for="vencimento_original_condominio" class="form-label">Vencimento
                                original*</label>
                            <input type="date" class="form-control" id="vencimento_original_condominio"
                                name="vencimento_original_condominio" aria-describedby="defaultFormControlHelp" />
                        </div>

                        <!-- IPTU -->
                        <div class="col-4 iptu-field" style="display: none">
                            <label for="valor_original_iptu" class="form-label">Valor original sem multa e
                                juros*</label>
                            <input type="text" class="form-control" id="valor_original_iptu"
                                name="valor_original_iptu" placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp" />
                        </div>

                        <div class="col-4 iptu-field" style="display: none">
                            <label for="vencimento_original_iptu" class="form-label">Vencimento original*</label>
                            <input type="date" class="form-control" id="vencimento_original_iptu"
                                name="vencimento_original_iptu" aria-describedby="defaultFormControlHelp" />
                        </div>

                        <!-- Seguro -->
                        <div class="col-4 seguro-field" style="display: none">
                            <label for="valor_original_seguro" class="form-label">Valor original sem multa e
                                juros*</label>
                            <input type="text" class="form-control" id="valor_original_seguro"
                                name="valor_original_seguro" placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp" />
                        </div>

                        <div class="col-4 seguro-field" style="display: none">
                            <label for="vencimento_original_seguro" class="form-label">Vencimento
                                original*</label>
                            <input type="date" class="form-control" id="vencimento_original_seguro"
                                name="vencimento_original_seguro" aria-describedby="defaultFormControlHelp" />
                        </div>

                        <!-- Água -->
                        <div class="col-4 agua-field" style="display: none">
                            <label for="valor_original_agua" class="form-label">Valor original sem multa e
                                juros*</label>
                            <input type="text" class="form-control" id="valor_original_agua"
                                name="valor_original_agua" placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp" />
                        </div>

                        <div class="col-4 agua-field" style="display: none">
                            <label for="vencimento_original_agua" class="form-label">Vencimento original*</label>
                            <input type="date" class="form-control" id="vencimento_original_agua"
                                name="vencimento_original_agua" aria-describedby="defaultFormControlHelp" />
                        </div>

                        <!-- Luz -->
                        <div class="col-4 luz-field" style="display: none">
                            <label for="valor_original_luz" class="form-label">Valor original sem multa e
                                juros*</label>
                            <input type="text" class="form-control" id="valor_original_luz"
                                name="valor_original_luz" placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp" />
                        </div>

                        <div class="col-4 luz-field" style="display: none">
                            <label for="vencimento_original_luz" class="form-label">Vencimento original*</label>
                            <input type="date" class="form-control" id="vencimento_original_luz"
                                name="vencimento_original_luz" aria-describedby="defaultFormControlHelp" />
                        </div>

                        <!-- Gás -->
                        <div class="col-4 gas-field" style="display: none">
                            <label for="valor_original_gas" class="form-label">Valor original sem multa e
                                juros*</label>
                            <input type="text" class="form-control" id="valor_original_gas"
                                name="valor_original_gas" placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp" />
                        </div>

                        <div class="col-4 gas-field" style="display: none">
                            <label for="vencimento_original_gas" class="form-label">Vencimento original*</label>
                            <input type="date" class="form-control" id="vencimento_original_gas"
                                name="vencimento_original_gas" aria-describedby="defaultFormControlHelp" />
                        </div>

                        <!-- Seguro Incêndio -->
                        <div class="col-4 seguro-incendio-field" style="display: none">
                            <label for="valor_original_seguro_incendio" class="form-label">Valor original sem multa e
                                juros*</label>
                            <input type="text" class="form-control" id="valor_original_seguro_incendio"
                                name="valor_original_seguro_incendio" placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp" />
                        </div>

                        <div class="col-4 seguro-incendio-field" style="display: none">
                            <label for="vencimento_original_seguro_incendio" class="form-label">Vencimento
                                original*</label>
                            <input type="date" class="form-control" id="vencimento_original_seguro_incendio"
                                name="vencimento_original_seguro_incendio"
                                aria-describedby="defaultFormControlHelp" />
                        </div>

                        <!-- Outros anexos -->
                        <div class="col-12 outros-anexos-field" style="display: none">
                            <label for="observacoes" class="form-label">Observações</label>
                            <textarea class="form-control" name="observacoes" id="observacoes" rows="3"></textarea>
                        </div>

                        <!-- Orçamentos de Reparos -->
                        <div class="col-4 orcamento-field" style="display: none">
                            <label for="valor_original_orcamentos" class="form-label">Valor*</label>
                            <input type="text" class="form-control" id="valor_original_orcamentos"
                                placeholder="R$ 0,00" aria-describedby="defaultFormControlHelp" />
                        </div>

                        <div class="col-12 orcamento-container" style="display: none">
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-warning mt-3" role="alert">
                                        <i class="icon-base ti tabler-info-circle icon-md"></i>
                                        Envie dois orçamentos para análise.
                                        <b>No campo de valor, basta preencher
                                            com o valor de um deles,
                                            preferencialmente o de menor
                                            valor.</b>
                                        Não se preocupe, vamos revisar os dois
                                        orçamentos com calma para garantir a
                                        melhor decisão.
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <h5 class="m-0">Segundo orçamento</h5>
                                    <span class="m-0 p-0">Tamanho máximo 6MB</span>

                                    <div class="row gy-6 mt-3">
                                        <div class="col-12">
                                            <div class="row gy-6 mt-3">
                                                <div class="col-12">
                                                    <input class="form-control" name="anexos_orcamento"
                                                        type="file" id="formFile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Multa rescisória -->
                        <div class="multa-rescisoria-container"
                            style="@if ($situacao_imovel == 'Desocupado') display:block; @else display:none; @endif">
                            <div class="col-12 mb-4">
                                <h5 class="m-0">Termos de recisão*</h5>
                                <span class="m-0 p-0">Tamanho máximo 6MB</span>

                                <div class="row gy-6 mt-3">
                                    <div class="col-12">
                                        <input class="form-control" name="anexos_termos_recisao" type="file"
                                            id="formFile">
                                    </div>
                                </div>

                                <a class="text-success d-block pt-4" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter" style="cursor: pointer">
                                    Como comprovar a Rescisão do contrato
                                </a>

                                <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">
                                                    Como comprovar a Rescisão do
                                                    contrato
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                A comprovação da rescisão do
                                                contrato pode ser feita por meio
                                                de três documentos, sendo eles:
                                                <ul>
                                                    <li>
                                                        Termo de entrega das
                                                        chaves
                                                    </li>
                                                    <li>
                                                        E-mail de formalização
                                                    </li>
                                                    <li>
                                                        Declaração de Imissão de
                                                        Posse
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-label-secondary waves-effect"
                                                    data-bs-dismiss="modal">
                                                    Fechar
                                                </button>
                                                <button type="button"
                                                    class="btn btn-primary waves-effect waves-light">
                                                    <i class="ti tabler-file-type-pdf"></i>
                                                    Baixar modelo
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <h5 class="m-0">Vistoria de saída*</h5>
                                <span class="m-0 p-0">Tamanho máximo 6MB</span>

                                <div class="row gy-6 mt-3">
                                    <div class="col-12">
                                        <input class="form-control" name="anexos_vistoria_saida" type="file"
                                            id="formFile">
                                    </div>
                                </div>

                                <a class="text-success d-block pt-4" data-bs-toggle="modal"
                                    data-bs-target="#vistoriaSaida" style="cursor: pointer">
                                    O que não pode faltar na Vistória de Saída
                                </a>

                                <div class="modal fade" id="vistoriaSaida" tabindex="-1" style="display: none"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">
                                                    O que não pode faltar na
                                                    Vistória de Saída
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul>
                                                    <li>
                                                        Nome completo e CPF do
                                                        Locatário.
                                                    </li>
                                                    <li>
                                                        Endereço completo do
                                                        imóvel.
                                                    </li>
                                                    <li>
                                                        Data da realização da
                                                        vistoria.
                                                    </li>
                                                    <li>
                                                        Assinatura do
                                                        vistoriador e/ou do
                                                        responsável da
                                                        imobiliária/locador.
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-label-secondary waves-effect"
                                                    data-bs-dismiss="modal">
                                                    Fechar
                                                </button>
                                                <button type="button"
                                                    class="btn btn-primary waves-effect waves-light">
                                                    <i class="ti tabler-file-type-pdf"></i>
                                                    Baixar modelo
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <h5 class="m-0">
                                    Descrição de Valores em Aberto*
                                </h5>
                                <span class="m-0 p-0">Tamanho máximo 6MB</span>

                                <div class="row gy-6 mt-3">
                                    <div class="col-12">
                                        <input class="form-control" name="anexos_descricao_valores_novo"
                                            type="file" id="formFile">
                                    </div>
                                </div>

                                <a class="text-success d-block pt-4" data-bs-toggle="modal"
                                    data-bs-target="#descricaoValoresAberto" style="cursor: pointer">
                                    O que não pode faltar na Descrição dos
                                    Valores em Aberto
                                </a>

                                <div class="modal fade" id="descricaoValoresAberto" tabindex="-1"
                                    style="display: none" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">
                                                    O que não pode faltar na
                                                    Descrição dos Valores em
                                                    Aberto
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul>
                                                    <li>
                                                        Dados da imobiliária
                                                    </li>
                                                    <li>
                                                        Identificação do(a)
                                                        locador(a)
                                                    </li>
                                                    <li>
                                                        Identificação dos
                                                        locatários
                                                    </li>
                                                    <li>Endereço do imóvel</li>
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-label-secondary waves-effect"
                                                    data-bs-dismiss="modal">
                                                    Fechar
                                                </button>
                                                <button type="button"
                                                    class="btn btn-primary waves-effect waves-light">
                                                    <i class="ti tabler-file-type-pdf"></i>
                                                    Baixar modelo
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <template id="card-template">
                            <div class="card card-body mb-4 border shadow-sm" data-card-novo>
                                <div class="col-12 mb-1" id="comprovante-boleto-original-novo"
                                    style="@if ($situacao_imovel == 'Desocupado') display:none; @else display:block; @endif">
                                    <h5 class="m-0">
                                        Envie o comprovante ou boleto original
                                    </h5>
                                    <span class="m-0 p-0">Tamanho máximo 6MB</span>
                                </div>

                                <div class="col-4">
                                    <div class="mb-1">
                                        <label for="defaultSelect" class="form-label">Tipo da conta</label>
                                        <select class="form-select tipo-conta-novo" name="tipo_conta_novo[]">
                                            <option value="">Selecione um tipo</option>
                                            <option value="Aluguel">Aluguel</option>
                                            <option value="Condomínio">
                                                Condomínio
                                            </option>
                                            <option value="IPTU">IPTU</option>
                                            <option value="Seguro">Seguro</option>
                                            <option value="Água">Água</option>
                                            <option value="Luz">Luz</option>
                                            <option value="Gás">Gás</option>
                                            <option value="Seguro incêndio">
                                                Seguro incêndio
                                            </option>
                                            <option value="Outros anexos">
                                                Outros anexos
                                            </option>
                                            <option value="Orçamentos de Reparos">
                                                Orçamentos de Reparos
                                            </option>
                                            <option value="Multa rescisória">
                                                Multa rescisória
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Aluguel -->
                                <div id="card_aluguel" style="display: none">
                                    <div class="row">
                                        <div class="row gy-6 m-0 p-0" id="anexos_novo_aluguel">
                                            <div class="col-12 my-3 py-0">
                                                <input class="form-control" name="anexos_novo_aluguel[]"
                                                    type="file" id="formFile">
                                            </div>
                                        </div>

                                        <div class="col-4 aluguel-field-novo">
                                            <label for="valor_original_aluguel_novo" class="form-label">Valor original
                                                sem
                                                multa e
                                                juros*</label>
                                            <input type="text" class="form-control"
                                                id="valor_original_aluguel_novo" name="valor_original_aluguel_novo[]"
                                                placeholder="R$ 0,00" aria-describedby="defaultFormControlHelp" />
                                        </div>

                                        <div class="col-4 aluguel-field-novo">
                                            <label for="vencimento_original_aluguel_novo"
                                                class="form-label">Vencimento
                                                original*</label>
                                            <input type="date" class="form-control"
                                                id="vencimento_original_aluguel_novo"
                                                name="vencimento_original_aluguel_novo[]"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>

                                        <div class="col-12 boletos-alugueis-novos mb-4">
                                            <p>Tem outras contas no mesmo boleto?*</p>
                                            <div class="row">
                                                <div class="col-md mb-md-0 mb-5">
                                                    <div class="form-check custom-option custom-option-basic">
                                                        <label class="form-check-label custom-option-content"
                                                            for="customRadioTemp1Novo">
                                                            <input name="possuiMaisBoletosNovo[]"
                                                                class="form-check-input" type="radio"
                                                                value="sim" id="customRadioTemp1Novo" />
                                                            <span class="custom-option-header">
                                                                <span class="h6 mb-0">Sim</span>
                                                            </span>
                                                            <span class="custom-option-body">
                                                                <small>O boleto é composto por
                                                                    mais contas, como contas de
                                                                    condomínio, gás, seguro
                                                                    incêndio e outras</small>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-check custom-option custom-option-basic">
                                                        <label class="form-check-label custom-option-content"
                                                            for="customRadioTemp2Novo">
                                                            <input name="possuiMaisBoletosNovo[]"
                                                                class="form-check-input" type="radio"
                                                                value="não" id="customRadioTemp2Novo" />
                                                            <span class="custom-option-header">
                                                                <span class="h6 mb-0">Não</span>
                                                            </span>
                                                            <span class="custom-option-body">
                                                                <small>É um boleto único de
                                                                    aluguel e as outras contas
                                                                    são separadas</small>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4" style="display: none" id="selecionar_mais_boletos_novo">
                                            <label class="mb-2 block text-sm font-medium text-gray-900">Selecione quais
                                                contas
                                                estão no
                                                mesmo
                                                boleto</label>
                                            <div class="flex flex-wrap gap-2">
                                                <button type="button"
                                                    class="conta-btn-novo select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                                    data-novo="Água">
                                                    Água
                                                </button>
                                                <button type="button"
                                                    class="conta-btn-novo select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                                    data-novo="Condomínio">
                                                    Condomínio
                                                </button>
                                                <button type="button"
                                                    class="conta-btn-novo select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                                    data-novo="Gás">
                                                    Gás
                                                </button>
                                                <button type="button"
                                                    class="conta-btn-novo select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                                    data-novo="IPTU">
                                                    IPTU
                                                </button>
                                                <button type="button"
                                                    class="conta-btn-novo select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                                    data-novo="Luz">
                                                    Luz
                                                </button>
                                                <button type="button"
                                                    class="conta-btn-novo select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                                    data-novo="Seguro">
                                                    Seguro
                                                </button>
                                                <button type="button"
                                                    class="conta-btn-novo select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                                    data-novo="Seguro incêndio">
                                                    Seguro incêndio
                                                </button>
                                                <button type="button"
                                                    class="conta-btn-novo select-btn rounded-full border border-gray-400 px-4 py-1 text-sm text-gray-800"
                                                    data-novo="Outros anexos">
                                                    Outros anexos
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Div onde vai ser criado parte dos comprovantes de valores -->
                                <div id="bloco-comprovantes-novo" class="col-12 mt-5" style="display: none">
                                    <h4 class="mb-0">Comprovante dos valores</h4>
                                    <p class="m-0 p-0">
                                        Adicione todos os comprovantes dos valores do
                                        boleto de aluguel
                                    </p>
                                    <hr />
                                    <div class="alert alert-secondary" role="alert">
                                        <i class="icon-base ti tabler-info-circle icon-md"></i>
                                        Esses valores, não serão somados à
                                        inadimplência, serão utilizados exclusivamente
                                        para agilizar a análise.
                                    </div>

                                    <!-- Parte que vai ser gerada após o click nas opções a mais -->
                                    <hr />
                                    <div id="comprovantes-container-novo"></div>
                                </div>
                                <!-- Fim aluguel -->

                                <!-- Condominio -->
                                <div id="card_condominio" style="display: none">
                                    <div class="row">
                                        <div class="row gy-6 m-0 p-0" id="anexos_novo_condominio">
                                            <div class="col-12 my-3 py-0">
                                                <input class="form-control" name="anexos_novo_condominio[]"
                                                    type="file" id="formFile">
                                            </div>
                                        </div>

                                        <div class="col-4 condominio-field-novo">
                                            <label for="valor_original_condominio_novo" class="form-label">Valor
                                                original
                                                sem
                                                multa
                                                e
                                                juros*</label>
                                            <input type="text" class="form-control"
                                                id="valor_original_condominio_novo"
                                                name="valor_original_condominio_novo[]" placeholder="R$ 0,00"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>

                                        <div class="col-4 condominio-field-novo">
                                            <label for="vencimento_original_condominio_novo"
                                                class="form-label">Vencimento
                                                original*</label>
                                            <input type="date" class="form-control"
                                                id="vencimento_original_condominio_novo"
                                                name="vencimento_original_condominio_novo[]"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>
                                    </div>
                                </div>

                                <!-- IPTU -->
                                <div id="card_iptu" style="display: none">
                                    <div class="row">
                                        <div class="row gy-6 m-0 p-0" id="anexos_novo_iptu">
                                            <div class="col-12 my-3 py-0">
                                                <input class="form-control" name="anexos_novo_iptu[]" type="file"
                                                    id="formFile">
                                            </div>
                                        </div>

                                        <div class="col-4 iptu-field-novo">
                                            <label for="valor_original_iptu_novo" class="form-label">Valor original
                                                sem
                                                multa
                                                e
                                                juros*</label>
                                            <input type="text" class="form-control" id="valor_original_iptu_novo"
                                                name="valor_original_iptu_novo[]" placeholder="R$ 0,00"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>

                                        <div class="col-4 iptu-field-novo">
                                            <label for="vencimento_original_iptu_novo" class="form-label">Vencimento
                                                original*</label>
                                            <input type="date" class="form-control"
                                                id="vencimento_original_iptu_novo"
                                                name="vencimento_original_iptu_novo[]"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Seguro -->
                                <div id="card_seguro" style="display: none">
                                    <div class="row">
                                        <div class="row gy-6 m-0 p-0" id="anexos_novo_seguro">
                                            <div class="col-12 my-3 py-0">
                                                <input class="form-control" name="anexos_novo_seguro[]"
                                                    type="file" id="formFile">
                                            </div>
                                        </div>

                                        <div class="col-4 seguro-field-novo">
                                            <label for="valor_original_seguro_novo" class="form-label">Valor original
                                                sem
                                                multa e
                                                juros*</label>
                                            <input type="text" class="form-control"
                                                id="valor_original_seguro_novo" name="valor_original_seguro_novo[]"
                                                placeholder="R$ 0,00" aria-describedby="defaultFormControlHelp" />
                                        </div>

                                        <div class="col-4 seguro-field-novo">
                                            <label for="vencimento_original_seguro_novo" class="form-label">Vencimento
                                                original*</label>
                                            <input type="date" class="form-control"
                                                id="vencimento_original_seguro_novo"
                                                name="vencimento_original_seguro_novo[]"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Água -->
                                <div id="card_agua" style="display: none">
                                    <div class="row">
                                        <div class="row gy-6 m-0 p-0" id="anexos_novo_agua">
                                            <div class="col-12 my-3 py-0">
                                                <input class="form-control" name="anexos_novo_agua[]" type="file"
                                                    id="formFile">
                                            </div>
                                        </div>

                                        <div class="col-4 agua-field-novo">
                                            <label for="valor_original_agua_novo" class="form-label">Valor original
                                                sem
                                                multa
                                                e
                                                juros*</label>
                                            <input type="text" class="form-control" id="valor_original_agua_novo"
                                                name="valor_original_agua_novo[]" placeholder="R$ 0,00"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>

                                        <div class="col-4 agua-field-novo">
                                            <label for="vencimento_original_agua_novo" class="form-label">Vencimento
                                                original*</label>
                                            <input type="date" class="form-control"
                                                id="vencimento_original_agua_novo"
                                                name="vencimento_original_agua_novo[]"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Luz -->
                                <div id="card_luz" style="display: none">
                                    <div class="row">
                                        <div class="row gy-6 m-0 p-0" id="anexos_novo_luz">
                                            <div class="col-12 my-3 py-0">
                                                <input class="form-control" name="anexos_novo_luz[]" type="file"
                                                    id="formFile">
                                            </div>
                                        </div>

                                        <div class="col-4 luz-field-novo">
                                            <label for="valor_original_luz_novo" class="form-label">Valor original sem
                                                multa e
                                                juros*</label>
                                            <input type="text" class="form-control" id="valor_original_luz_novo"
                                                name="valor_original_luz_novo[]" placeholder="R$ 0,00"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>

                                        <div class="col-4 luz-field-novo">
                                            <label for="vencimento_original_luz_novo" class="form-label">Vencimento
                                                original*</label>
                                            <input type="date" class="form-control"
                                                id="vencimento_original_luz_novo"
                                                name="vencimento_original_luz_novo[]"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Gás -->
                                <div id="card_gas" style="display: none">
                                    <div class="row">
                                        <div class="row gy-6 m-0 p-0" id="anexos_novo_gas">
                                            <div class="col-12 my-3 py-0">
                                                <input class="form-control" name="anexos_novo_gas[]" type="file"
                                                    id="formFile">
                                            </div>
                                        </div>

                                        <div class="col-4 gas-field-novo">
                                            <label for="valor_original_gas_novo" class="form-label">Valor original sem
                                                multa e
                                                juros*</label>
                                            <input type="text" class="form-control" id="valor_original_gas_novo"
                                                name="valor_original_gas_novo[]" placeholder="R$ 0,00"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>

                                        <div class="col-4 gas-field-novo">
                                            <label for="vencimento_original_gas_novo" class="form-label">Vencimento
                                                original*</label>
                                            <input type="date" class="form-control"
                                                id="vencimento_original_gas_novo"
                                                name="vencimento_original_gas_novo[]"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Seguro Incêndio -->
                                <div id="card_seguro_incendio" style="display: none">
                                    <div class="row">
                                        <div class="row gy-6 m-0 p-0" id="anexos_novo_seguro-incendio">
                                            <div class="col-12 my-3 py-0">
                                                <input class="form-control" name="anexos_novo_seguro-incendio[]"
                                                    type="file" id="formFile">
                                            </div>
                                        </div>

                                        <div class="col-4 seguro-incendio-field-novo">
                                            <label for="valor_original_seguro_incendio_novo" class="form-label">Valor
                                                original
                                                sem
                                                multa e
                                                juros*</label>
                                            <input type="text" class="form-control"
                                                id="valor_original_seguro_incendio_novo"
                                                name="valor_original_seguro_incendio_novo[]" placeholder="R$ 0,00"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>

                                        <div class="col-4 seguro-incendio-field-novo">
                                            <label for="vencimento_original_seguro_incendio_novo"
                                                class="form-label">Vencimento
                                                original*</label>
                                            <input type="date" class="form-control"
                                                id="vencimento_original_seguro_incendio_novo"
                                                name="vencimento_original_seguro_incendio_novo[]"
                                                aria-describedby="defaultFormControlHelp" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Outros anexos -->
                                <div id="card_outros_anexos" style="display: none">
                                    <div class="row">
                                        <div class="row gy-6 m-0 p-0" id="anexos_novo_outros-anexos">
                                            <div class="col-12 my-3 py-0">
                                                <input class="form-control" name="anexos_novo_outros-anexos[]"
                                                    type="file" id="formFile">
                                            </div>
                                        </div>

                                        <div class="col-12 outros-anexos-field-novo">
                                            <label for="observacoes" class="form-label">Observações</label>
                                            <textarea class="form-control" name="observacoes_novo[]" id="observacoes" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Orçamentos de Reparos -->
                                <div class="col-4 orcamento-field-novo" style="display: none">
                                    <label for="valor_original_orcamentos_novo" class="form-label">Valor*</label>
                                    <input type="text" class="form-control" id="valor_original_orcamentos_novo"
                                        name="valor_original_orcamentos_novo[]" placeholder="R$ 0,00"
                                        aria-describedby="defaultFormControlHelp" />
                                </div>

                                <div class="col-12 orcamento-container-novo" style="display: none">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="alert alert-warning mt-3" role="alert">
                                                <i class="icon-base ti tabler-info-circle icon-md"></i>
                                                Envie dois orçamentos para análise.
                                                <b>No campo de valor, basta preencher
                                                    com o valor de um deles,
                                                    preferencialmente o de menor
                                                    valor.</b>
                                                Não se preocupe, vamos revisar os dois
                                                orçamentos com calma para garantir a
                                                melhor decisão.
                                            </div>
                                        </div>

                                        <div class="col-12 mb-4">
                                            <h5 class="m-0">Segundo orçamento</h5>
                                            <span class="m-0 p-0">Tamanho máximo 6MB</span>

                                            <div class="row gy-6 mt-3">
                                                <div class="col-12">
                                                    <input class="form-control" name="anexos_novo_orcamento[]"
                                                        type="file" id="formFile">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Multa rescisória -->
                                <div class="multa-rescisoria-container-novo" style="display: none">
                                    <div class="col-12 mb-4">
                                        <h5 class="m-0">Termos de recisão*</h5>
                                        <span class="m-0 p-0">Tamanho máximo 6MB</span>

                                        <div class="row gy-6 mt-3">
                                            <div class="col-12">
                                                <input class="form-control" name="anexos_termos_recisao_novo"
                                                    type="file" id="formFile">
                                            </div>
                                        </div>

                                        <a class="text-success d-block pt-4" data-bs-toggle="modal"
                                            data-bs-target="#modalCenter" style="cursor: pointer">
                                            Como comprovar a Rescisão do contrato
                                        </a>

                                        <div class="modal fade" id="modalCenter" tabindex="-1"
                                            style="display: none" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">
                                                            Como comprovar a Rescisão do
                                                            contrato
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        A comprovação da rescisão do
                                                        contrato pode ser feita por meio
                                                        de três documentos, sendo eles:
                                                        <ul>
                                                            <li>
                                                                Termo de entrega das
                                                                chaves
                                                            </li>
                                                            <li>
                                                                E-mail de formalização
                                                            </li>
                                                            <li>
                                                                Declaração de Imissão de
                                                                Posse
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-label-secondary waves-effect"
                                                            data-bs-dismiss="modal">
                                                            Fechar
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-primary waves-effect waves-light">
                                                            <i class="ti tabler-file-type-pdf"></i>
                                                            Baixar modelo
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <h5 class="m-0">Vistoria de saída*</h5>
                                        <span class="m-0 p-0">Tamanho máximo 6MB</span>

                                        <div class="row gy-6 mt-3">
                                            <div class="col-12">
                                                <input class="form-control" name="anexos_vistoria_saida_novo"
                                                    type="file" id="formFile">
                                            </div>
                                        </div>

                                        <a class="text-success d-block pt-4" data-bs-toggle="modal"
                                            data-bs-target="#vistoriaSaida" style="cursor: pointer">
                                            O que não pode faltar na Vistória de Saída
                                        </a>

                                        <div class="modal fade" id="vistoriaSaida" tabindex="-1"
                                            style="display: none" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">
                                                            O que não pode faltar na
                                                            Vistória de Saída
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul>
                                                            <li>
                                                                Nome completo e CPF do
                                                                Locatário.
                                                            </li>
                                                            <li>
                                                                Endereço completo do
                                                                imóvel.
                                                            </li>
                                                            <li>
                                                                Data da realização da
                                                                vistoria.
                                                            </li>
                                                            <li>
                                                                Assinatura do
                                                                vistoriador e/ou do
                                                                responsável da
                                                                imobiliária/locador.
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-label-secondary waves-effect"
                                                            data-bs-dismiss="modal">
                                                            Fechar
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-primary waves-effect waves-light">
                                                            <i class="ti tabler-file-type-pdf"></i>
                                                            Baixar modelo
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <h5 class="m-0">
                                            Descrição de Valores em Aberto*
                                        </h5>
                                        <span class="m-0 p-0">Tamanho máximo 6MB</span>

                                        <div class="row gy-6 mt-3">
                                            <div class="col-12">
                                                <input class="form-control" name="anexos_descricao_valores"
                                                    type="file" id="formFile">
                                            </div>
                                        </div>

                                        <a class="text-success d-block pt-4" data-bs-toggle="modal"
                                            data-bs-target="#descricaoValoresAberto" style="cursor: pointer">
                                            O que não pode faltar na Descrição dos
                                            Valores em Aberto
                                        </a>

                                        <div class="modal fade" id="descricaoValoresAberto" tabindex="-1"
                                            style="display: none" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">
                                                            O que não pode faltar na
                                                            Descrição dos Valores em
                                                            Aberto
                                                        </h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul>
                                                            <li>
                                                                Dados da imobiliária
                                                            </li>
                                                            <li>
                                                                Identificação do(a)
                                                                locador(a)
                                                            </li>
                                                            <li>
                                                                Identificação dos
                                                                locatários
                                                            </li>
                                                            <li>Endereço do imóvel</li>
                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-label-secondary waves-effect"
                                                            data-bs-dismiss="modal">
                                                            Fechar
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-primary waves-effect waves-light">
                                                            <i class="ti tabler-file-type-pdf"></i>
                                                            Baixar modelo
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="col-12 d-flex justify-content-between mt-5">
                        <button type="button" class="btn btn-success btn-next waves-effect waves-light"
                            id="add-card-btn">
                            Adicionar mais contas / boletos / faturas / orçamentos / anexos
                        </button>

                        <button type="submit" class="btn btn-primary btn-next waves-effect waves-light">
                            <span class="d-sm-inline-block d-none me-sm-2 align-middle">Próximo</span>
                            <i class="icon-base ti tabler-arrow-right icon-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@section('scripts')
    <script src="{{ asset('assets/deliquencies/deliquencies.js') }}"></script>
    <script>
        document.getElementById('add-card-btn').addEventListener('click', function() {
            const template = document.getElementById('card-template');
            const container = document.getElementById('cards-container');

            // Clona o conteúdo do template
            const clone = template.content.cloneNode(true);

            // Anexa ao container
            container.appendChild(clone);
        });
    </script>
@endsection
