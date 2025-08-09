<div id="criar-proposta" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
    <div class="content-header bg-primary mb-4 p-5">
        <h4 class="fw-bold mb-0 text-center text-white">Proposta de fiança</h4>
    </div>
    <div class="row g-6 justify-content-center">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="card">
                <div class="card-body mb-0 pb-0">
                    <div class="content-header mb-4">
                        <h6 class="mb-0">Dados do inquilino</h6>
                        <hr>
                    </div>

                    <form id="form-proposta" method="POST" action="{{ route('propostal.save.step1') }}">
                        @csrf
                        <div class="row pb-5">
                            <div class="col-md mb-md-0 mb-3">
                                <div class="form-check custom-option custom-option-basic">
                                    <label class="form-check-label custom-option-content" for="pessoa_fisica">
                                        <input name="pessoa_tipo" class="form-check-input" type="radio" value="PF"
                                            id="pessoa_fisica"
                                            {{ ($proposta['pessoa_tipo'] ?? 'Pessoa Física') === 'Pessoa Física' ? 'checked' : '' }}>
                                        <span class="custom-option-header p-0">
                                            <span class="h6 mb-0">Pessoa Física</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md mb-md-0 mb-3">
                                <div class="form-check custom-option custom-option-basic">
                                    <label class="form-check-label custom-option-content" for="pessoa_juridica">
                                        <input name="pessoa_tipo" class="form-check-input" type="radio" value="PJ"
                                            id="pessoa_juridica"
                                            {{ ($proposta['pessoa_tipo'] ?? '') === 'Pessoa Jurídica' ? 'checked' : '' }}>
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
                                    <input type="text" name="pessoa_doc" id="pessoa_doc"
                                        class="form-control form-control-lg"
                                        value="{{ $proposta['pessoa_doc'] ?? '' }}">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="pessoa_nome">Nome</label>
                                    <input type="text" name="pessoa_nome" id="pessoa_nome"
                                        class="form-control form-control-lg"
                                        value="{{ $proposta['pessoa_nome'] ?? '' }}">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
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
                                        <input name="imovel_tipo" class="form-check-input" type="radio" value="R"
                                            id="residencial"
                                            {{ ($proposta['imovel_tipo'] ?? 'Residencial') === 'Residencial' ? 'checked' : '' }}>
                                        <span class="custom-option-header p-0">
                                            <span class="h6 mb-0">Residencial</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-md-0 mb-5">
                                <div class="form-check custom-option custom-option-basic">
                                    <label class="form-check-label custom-option-content" for="comercial">
                                        <input name="imovel_tipo" class="form-check-input" type="radio" value="C"
                                            id="comercial"
                                            {{ ($proposta['imovel_tipo'] ?? '') === 'Comercial' ? 'checked' : '' }}>
                                        <span class="custom-option-header p-0">
                                            <span class="h6 mb-0">Comercial</span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="row align-items-center mb-4 mt-5">
                                <div class="col-md-4">
                                    <label class="form-label" for="imovel_cep">CEP</label>
                                    <input type="text" name="imovel_cep" id="imovel_cep"
                                        class="form-control form-control-lg"
                                        value="{{ $proposta['imovel_cep'] ?? '' }}">
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-4" id="estado-container" style="display: none;">
                                    <label class="form-label" for="imovel_estado">Estado</label>
                                    <input type="text" name="imovel_estado" id="imovel_estado"
                                        class="form-control form-control-lg"
                                        value="{{ $proposta['imovel_estado'] ?? '' }}" readonly>
                                </div>

                                <div class="col-md-4" id="cidade-container" style="display: none;">
                                    <label class="form-label" for="imovel_cidade">Cidade</label>
                                    <input type="text" name="imovel_cidade" id="imovel_cidade"
                                        class="form-control form-control-lg"
                                        value="{{ $proposta['imovel_cidade'] ?? '' }}" readonly>

                                </div>
                                <div class="col-md-12">
                                    <small id="cep-status" class="text-muted"></small>
                                </div>
                            </div>

                        </div>

                        <div class="content-header mb-4 mt-5">
                            <h6 class="mb-0">Valores</h6>
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 form-control-validation fv-plugins-icon-container mb-4">
                                <label class="form-label" for="formValidationUsername">Valor Aluguel</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">R$</span>
                                    <input name="imovel_aluguel" style="text-align: right" id='imovel_aluguel'
                                        type="text" class="form-control form-control-lg"
                                        value="{{ $proposta['imovel_aluguel'] ?? '' }}"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </div>
                            <div class="col-sm-4 form-control-validation fv-plugins-icon-container mb-4">
                                <label class="form-label" for="formValidationUsername">Valor Condomínio</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">R$</span>
                                    <input style="text-align: right" name="imovel_condominio" id="imovel_condominio"
                                        type="text" class="form-control form-control-lg"
                                        value="{{ $proposta['imovel_condominio'] ?? '' }}"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </div>
                            <div class="col-sm-4 form-control-validation fv-plugins-icon-container mb-4">
                                <label class="form-label" for="formValidationUsername">Taxas</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">R$</span>
                                    <input name="imovel_taxas" style="text-align: right" id="imovel_taxas"
                                        type="text" class="form-control form-control-lg"
                                        value="{{ $proposta['imovel_taxas'] ?? '' }}"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end mb-5">
                                <button id="btn-simular-credito" type="submit"
                                    class="btn btn-primary btn-next-simular waves-effect waves-light">
                                    <span class="d-sm-inline-block d-none me-sm-2 align-middle">Simular Crédito</span>
                                    <i class="icon-base ti tabler-arrow-right icon-xs"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@php
    $id = null;
    if ($proposta) {
        $id = $proposta['id'];
    }
@endphp

<input type="hidden" value="{{ $id }}" id="idProposta">

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        IMask(document.getElementById('pessoa_doc'), {
            mask: '000.000.000-00'
        });
        IMask(document.getElementById('imovel_cep'), {
            mask: '00000-000'
        });

        IMask(document.getElementById('imovel_aluguel'), {
            mask: Number,
            scale: 2,
            thousandsSeparator: '.', // CORRIGIDO: separador de milhar brasileiro
            padFractionalZeros: true, // Garante que sempre haja duas casas decimais
            normalizeZeros: true,
            radix: ',', // separador decimal brasileiro
            mapToRadix: ['.'],
            min: 0,
            max: 1000000,
            autofix: true,
        });

        IMask(document.getElementById('imovel_condominio'), {
            mask: Number,
            scale: 2,
            thousandsSeparator: '.', // CORRIGIDO: separador de milhar brasileiro
            padFractionalZeros: true, // Garante que sempre haja duas casas decimais
            normalizeZeros: true,
            radix: ',', // separador decimal brasileiro
            mapToRadix: ['.'],
            min: 0,
            max: 1000000,
            autofix: true,
        });

        IMask(document.getElementById('imovel_taxas'), {
            mask: Number,
            scale: 2,
            thousandsSeparator: '.', // CORRIGIDO: separador de milhar brasileiro
            padFractionalZeros: true, // Garante que sempre haja duas casas decimais
            normalizeZeros: true,
            radix: ',', // separador decimal brasileiro
            mapToRadix: ['.'],
            min: 0,
            max: 1000000,
            autofix: true,
        });

        document.getElementById('imovel_cep').addEventListener('blur', function() {
            const cep = this.value.replace(/\D/g, '');

            const statusEl = document.getElementById('cep-status');
            const estadoInput = document.getElementById('imovel_estado');
            const cidadeInput = document.getElementById('imovel_cidade');
            const estadoContainer = document.getElementById('estado-container');
            const cidadeContainer = document.getElementById('cidade-container');

            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            estadoInput.value = data.uf;
                            cidadeInput.value = data.localidade;

                            estadoContainer.style.display = 'block';
                            cidadeContainer.style.display = 'block';

                            statusEl.textContent = `${data.localidade} - ${data.uf}`;
                        } else {
                            statusEl.textContent = 'CEP não encontrado';
                            estadoContainer.style.display = 'none';
                            cidadeContainer.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar o CEP:', error);
                        statusEl.textContent = 'Erro ao buscar o CEP';
                        estadoContainer.style.display = 'none';
                        cidadeContainer.style.display = 'none';
                    });
            } else {
                statusEl.textContent = 'CEP inválido';
                estadoContainer.style.display = 'none';
                cidadeContainer.style.display = 'none';
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('form-proposta').addEventListener('submit', async function(e) {
                console.log('Interceptando submit...');
                e.preventDefault();

                // Abre o SweetAlert de carregamento ANTES de tudo
                Swal.fire({
                    title: 'Aguarde...',
                    text: 'Análise de crédito em andamento',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                try {
                    // Preenche endereço pelo CEP antes de enviar
                    const cepInput = document.getElementById('imovel_cep');
                    const cep = cepInput.value.replace(/\D/g, '');
                    if (cep.length === 8) {
                        const cepResponse = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                        const dataCep = await cepResponse.json();
                        if (!dataCep.erro) {
                            document.getElementById('imovel_estado').value = dataCep.uf;
                            document.getElementById('imovel_cidade').value = dataCep.localidade;
                        }
                    }

                    const form = e.target;
                    const formData = new FormData(form);
                    const idProposta = document.getElementById('idProposta').value;
                    let url = '/propostas/salvar-step1';
                    if (idProposta) {
                        url += `/${idProposta}`;
                    }

                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw data;
                    }

                    // Se deu tudo certo, redireciona
                    window.location.href = `/propostas/step2/${data.data.id}`;

                } catch (error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: error.message || 'Houve um problema ao criar a proposta.'
                    });
                }
            });
        });
    </script>
@endsection
