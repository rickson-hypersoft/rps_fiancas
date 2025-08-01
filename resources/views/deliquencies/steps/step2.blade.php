<form onsubmit="return false">
    <!-- Account Details -->
    <div id="account-details" class="content active dstepper-block">
        <div
            class="content-header mb-4 bg-light p-3"
            style="border-radius: 0.5rem"
        >
            <div class="d-flex mb-2">
                <div class="d-flex align-items-center gap-2">
                    <h6 class="mb-0">Fiança disponível:</h6>
                    <small class="badge text-bg-success">R$ 120.000,00</small>
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
                    <div class="row">
                        <div class="col-12 mb-4">
                            <h5 class="m-0">
                                Envie o comprovante ou boleto original
                            </h5>
                            <span class="m-0 p-0">Tamanho máximo 6MB</span>

                            <div class="row gy-6 mt-3">
                                <div class="col-12">
                                    <div
                                        action="/upload"
                                        class="dropzone needsclick dz-clickable"
                                        id="dropzone-multi"
                                    >
                                        <div class="dz-message needsclick">
                                            Clique ou arraste o arquivo aqui
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="mb-4">
                                <label for="defaultSelect" class="form-label"
                                    >Tipo da conta</label
                                >
                                <select id="defaultSelect" class="form-select">
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
                        <div class="col-4 aluguel-field" style="display: none">
                            <label for="valor_original" class="form-label"
                                >Valor original sem multa e juros*</label
                            >
                            <input
                                required
                                type="text"
                                class="form-control"
                                id="valor_original"
                                placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>

                        <div class="col-4 aluguel-field" style="display: none">
                            <label for="vencimento_original" class="form-label"
                                >Vencimento original*</label
                            >
                            <input
                                required
                                type="date"
                                class="form-control"
                                id="vencimento_original"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>

                        <div
                            class="col-12 mb-4 boletos-alugueis"
                            style="display: none"
                        >
                            <p>Tem outras contas no mesmo boleto?*</p>
                            <div class="row">
                                <div class="col-md mb-md-0 mb-5">
                                    <div
                                        class="form-check custom-option custom-option-basic"
                                    >
                                        <label
                                            class="form-check-label custom-option-content"
                                            for="customRadioTemp1"
                                        >
                                            <input
                                                name="customRadioTemp"
                                                class="form-check-input"
                                                type="radio"
                                                value="sim"
                                                id="customRadioTemp1"
                                                checked=""
                                            />
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">Sim</span>
                                            </span>
                                            <span class="custom-option-body">
                                                <small
                                                    >O boleto é composto por
                                                    mais contas, como contas de
                                                    condomínio, gás, seguro
                                                    incêndio e outras</small
                                                >
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div
                                        class="form-check custom-option custom-option-basic"
                                    >
                                        <label
                                            class="form-check-label custom-option-content"
                                            for="customRadioTemp2"
                                        >
                                            <input
                                                name="customRadioTemp"
                                                class="form-check-input"
                                                type="radio"
                                                value="não"
                                                id="customRadioTemp2"
                                            />
                                            <span class="custom-option-header">
                                                <span class="h6 mb-0">Não</span>
                                            </span>
                                            <span class="custom-option-body">
                                                <small
                                                    >É um boleto único de
                                                    aluguel e as outras contas
                                                    são separadas</small
                                                >
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="mt-4"
                            style="display: none"
                            id="selecionar_mais_boletos"
                        >
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900"
                                >Selecione quais contas estão no mesmo
                                boleto</label
                            >
                            <div class="flex flex-wrap gap-2">
                                <button
                                    type="button"
                                    class="conta-btn select-btn px-4 py-1 rounded-full border border-gray-400 text-sm text-gray-800"
                                    data-conta="Água"
                                >
                                    Água
                                </button>
                                <button
                                    type="button"
                                    class="conta-btn select-btn px-4 py-1 rounded-full border border-gray-400 text-sm text-gray-800"
                                    data-conta="Condomínio"
                                >
                                    Condomínio
                                </button>
                                <button
                                    type="button"
                                    class="conta-btn select-btn px-4 py-1 rounded-full border border-gray-400 text-sm text-gray-800"
                                    data-conta="Gás"
                                >
                                    Gás
                                </button>
                                <button
                                    type="button"
                                    class="conta-btn select-btn px-4 py-1 rounded-full border border-gray-400 text-sm text-gray-800"
                                    data-conta="IPTU"
                                >
                                    IPTU
                                </button>
                                <button
                                    type="button"
                                    class="conta-btn select-btn px-4 py-1 rounded-full border border-gray-400 text-sm text-gray-800"
                                    data-conta="Luz"
                                >
                                    Luz
                                </button>
                                <button
                                    type="button"
                                    class="conta-btn select-btn px-4 py-1 rounded-full border border-gray-400 text-sm text-gray-800"
                                    data-conta="Seguro"
                                >
                                    Seguro
                                </button>
                                <button
                                    type="button"
                                    class="conta-btn select-btn px-4 py-1 rounded-full border border-gray-400 text-sm text-gray-800"
                                    data-conta="Seguro incêndio"
                                >
                                    Seguro incêndio
                                </button>
                                <button
                                    type="button"
                                    class="conta-btn select-btn px-4 py-1 rounded-full border border-gray-400 text-sm text-gray-800"
                                    data-conta="Outros anexos"
                                >
                                    Outros anexos
                                </button>
                            </div>
                        </div>

                        <!-- Div onde vai ser criado parte dos comprovantes de valores -->
                        <div
                            id="bloco-comprovantes"
                            class="col-12 mt-5"
                            style="display: none"
                        >
                            <h4 class="mb-0">Comprovante dos valores</h4>
                            <p class="m-0 p-0">
                                Adicione todos os comprovantes dos valores do
                                boleto de aluguel
                            </p>
                            <hr />
                            <div class="alert alert-secondary" role="alert">
                                <i
                                    class="icon-base ti tabler-info-circle icon-md"
                                ></i>
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
                        <div
                            class="col-4 condominio-field"
                            style="display: none"
                        >
                            <label
                                for="valor_original_condominio"
                                class="form-label"
                                >Valor original sem multa e juros*</label
                            >
                            <input
                                required
                                type="text"
                                class="form-control"
                                id="valor_original_condominio"
                                placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>

                        <div
                            class="col-4 condominio-field"
                            style="display: none"
                        >
                            <label
                                for="vencimento_original_condominio"
                                class="form-label"
                                >Vencimento original*</label
                            >
                            <input
                                required
                                type="date"
                                class="form-control"
                                id="vencimento_original_condominio"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>

                        <!-- IPTU -->
                        <div class="col-4 iptu-field" style="display: none">
                            <label for="valor_original_iptu" class="form-label"
                                >Valor original sem multa e juros*</label
                            >
                            <input
                                required
                                type="text"
                                class="form-control"
                                id="valor_original_iptu"
                                placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>

                        <div class="col-4 iptu-field" style="display: none">
                            <label
                                for="vencimento_original_iptu"
                                class="form-label"
                                >Vencimento original*</label
                            >
                            <input
                                required
                                type="date"
                                class="form-control"
                                id="vencimento_original_iptu"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>

                        <!-- Seguro -->
                        <div class="col-4 seguro-field" style="display: none">
                            <label
                                for="valor_original_seguro"
                                class="form-label"
                                >Valor original sem multa e juros*</label
                            >
                            <input
                                required
                                type="text"
                                class="form-control"
                                id="valor_original_seguro"
                                placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>

                        <div class="col-4 seguro-field" style="display: none">
                            <label
                                for="vencimento_original_seguro"
                                class="form-label"
                                >Vencimento original*</label
                            >
                            <input
                                required
                                type="date"
                                class="form-control"
                                id="vencimento_original_seguro"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>

                        <!-- Água -->
                        <div class="col-4 agua-field" style="display: none">
                            <label for="valor_original_agua" class="form-label"
                                >Valor original sem multa e juros*</label
                            >
                            <input
                                required
                                type="text"
                                class="form-control"
                                id="valor_original_agua"
                                placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>

                        <div class="col-4 agua-field" style="display: none">
                            <label
                                for="vencimento_original_agua"
                                class="form-label"
                                >Vencimento original*</label
                            >
                            <input
                                required
                                type="date"
                                class="form-control"
                                id="vencimento_original_agua"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>

                        <!-- Luz -->
                        <div class="col-4 luz-field" style="display: none">
                            <label for="valor_original_luz" class="form-label"
                                >Valor original sem multa e juros*</label
                            >
                            <input
                                required
                                type="text"
                                class="form-control"
                                id="valor_original_luz"
                                placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>

                        <div class="col-4 luz-field" style="display: none">
                            <label
                                for="vencimento_original_luz"
                                class="form-label"
                                >Vencimento original*</label
                            >
                            <input
                                required
                                type="date"
                                class="form-control"
                                id="vencimento_original_luz"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>

                        <!-- Gás -->
                        <div class="col-4 gas-field" style="display: none">
                            <label for="valor_original_gas" class="form-label"
                                >Valor original sem multa e juros*</label
                            >
                            <input
                                required
                                type="text"
                                class="form-control"
                                id="valor_original_gas"
                                placeholder="R$ 0,00"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>

                        <div class="col-4 gas-field" style="display: none">
                            <label
                                for="vencimento_original_gas"
                                class="form-label"
                                >Vencimento original*</label
                            >
                            <input
                                required
                                type="date"
                                class="form-control"
                                id="vencimento_original_gas"
                                aria-describedby="defaultFormControlHelp"
                            />
                        </div>
                    </div>

                    <div class="col-12 d-flex justify-content-end">
                        <button
                            type="submit"
                            class="btn btn-primary btn-next waves-effect waves-light"
                        >
                            <span
                                class="align-middle d-sm-inline-block d-none me-sm-2"
                                >Próximo</span
                            >
                            <i
                                class="icon-base ti tabler-arrow-right icon-xs"
                            ></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@section('scripts')
<script src="{{ asset('assets/deliquencies/deliquencies.js') }}"></script>
@endsection
