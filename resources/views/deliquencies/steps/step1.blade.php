@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('delinquencies.store', ['contrato_id' => request()->route('contrato_id')]) }}" method="POST"
    class="needs-validation" novalidate>
    @csrf
    <!-- Account Details -->
    <div id="account-details" class="content active dstepper-block">
        <div class="content-header bg-light mb-4 p-3" style="border-radius: 0.5rem">

            <div class="d-flex justify-content-between mb-2">
                <div>
                    <h6 class="mb-0">Fiança disponível:</h6>
                    <small class="badge text-bg-success">{{ $fianca_disponivel }}</small>
                </div>
                <div class="" id="cobertura-saida" style="display: none;">
                    <h6 class="mb-0">Cobertura Saída:</h6>
                    <small class="badge text-bg-success">{{ $cobertura_saida }}</small>
                    <i class="menu-icon icon-base ti tabler-alert-hexagon" data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="A cobertura de saída considera os valores de multa rescisória e os orçamentos"></i>
                </div>
            </div>
            <p class="p-0">
                * Este valor considera apenas inadimplências pagas e
                provisionadas. Inadimplências em análise não são
                debatidas deste valor
            </p>
        </div>

        <div class="row g-6">
            <div class="content-header mb-4">
                <div class="card-header">
                    <h4>Sobre o imóvel</h4>
                    <p>
                        Precisamos de algumas informações sobre a
                        situação do imóvel para garantir a análise
                        da inadimplência.
                    </p>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md mb-md-0 mb-5">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="ocupado">
                                    <input name="imovel_situacao" class="form-check-input" type="radio"
                                        value="Ocupado" id="ocupado" checked="">
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Ocupado</span>
                                    </span>
                                    <span class="custom-option-body">
                                        <small>O inquilino ainda esta no imóvel</small>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="desocupado">
                                    <input name="imovel_situacao" class="form-check-input" type="radio"
                                        value="Desocupado" id="desocupado">
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Desocupado</span>
                                    </span>
                                    <span class="custom-option-body">
                                        <small>O inquilino já saiu do imóvel porém ainda tem débitos com a
                                            imobiliária</small>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-next waves-effect waves-light">
                    <span class="d-sm-inline-block d-none me-sm-2 align-middle">Próximo</span>
                    <i class="icon-base ti tabler-arrow-right icon-xs"></i>
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const coberturaSaida = document.getElementById("cobertura-saida");
        const radios = document.querySelectorAll('input[name="imovel_situacao"]');

        radios.forEach(radio => {
            radio.addEventListener("change", function() {
                if (this.value === "Desocupado") {
                    coberturaSaida.style.display = "block";
                } else {
                    coberturaSaida.style.display = "none";
                }
            });
        });
    });
</script>
