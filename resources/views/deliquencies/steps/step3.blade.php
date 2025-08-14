<form action="{{ route('delinquencies.storeStep3', ['contrato_id' => $contrato_id, 'id' => $idInadimplencia]) }}"
    method="POST" class="needs-validation" novalidate>
    @csrf
    <!-- Account Details -->
    <div id="account-details" class="content active dstepper-block">
        <div class="content-header bg-light mb-4 p-3" style="border-radius: 0.5rem">
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
                    <h4>Forma de pagamento</h4>
                    <p>
                        Escolha como gostaria de receber o pagamento da Invicta
                    </p>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md mb-md-0 mb-5">
                            <label for="contas" class="form-label">Selecionar Conta</label>
                            <select class="form-select" id="contas" name="conta_bancaria_id"
                                aria-label="Default select example">
                                <option value="">Selecione uma conta</option>
                                @foreach ($contas as $conta)
                                    <option value="{{ $conta['id'] }}"
                                        data-beneficiario="{{ $conta['banco_titular'] }}"
                                        data-cnpj-cpf="{{ $conta['banco_cnpj'] }}"
                                        data-banco="{{ $conta['descricao'] }}"
                                        data-agencia="{{ $conta['banco_agencia'] }}"
                                        data-conta="{{ $conta['banco_conta'] }}">
                                        {{ $conta['descricao'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div id="card-conta" class="card-body d-none mt-4">
                    <div class="row">
                        <div class="col-md mb-md-0 mb-5">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="ted">
                                    <input name="ted" class="form-check-input" type="radio" value="TED"
                                        id="ted" checked="" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">TED</span>
                                        <span class="badge bg-label-success me-4 rounded p-2">Recomendado</span>
                                    </span>
                                    <span class="custom-option-body">
                                        <small>Beneficiário: <span id="beneficiario"></span></small> <br>
                                        <small>CNPJ/CPF: <span id="cnpj-cpf"></span></small> <br>
                                        <small>Banco: <span id="banco"></span></small> <br>
                                        <small>Agência: <span id="agencia"></span></small> <br>
                                        <small>Conta: <span id="conta"></span></small> <br>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-0 py-0">

            <div class="content-header mb-4">
                <div class="card-header">
                    <h4>Resumo</h4>
                </div>

                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md mb-md-0 mb-5">
                            <div class="card">
                                <table class="table-sm table-borderless table-striped table-hover table"
                                    style="font-size: 18px;">
                                    <thead>
                                        <tr>
                                            <th>Tipo</td>
                                            <th>Valor</th>
                                            </th>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Valores comunicados</td>
                                            <td>R$ {{ number_format($delinquencie['valor_original'], 2, ',', '.') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <div>
                                <label for="observacao" class="form-label">Observações</label>
                                <textarea disabled class="form-control" id="observacao" rows="3">
                                    {{ $delinquencie['observacao'] }}
                                </textarea>
                            </div>

                        </div>

                        <div class="accordion-item mt-5">
                            <h1 class="" id="headingOne">
                                <button type="button" class="accordion-button collapsed bg-light"
                                    data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false"
                                    aria-controls="accordionOne">
                                    Todos anexos
                                </button>
                            </h1>

                            <div id="accordionOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body">
                                    <table class="table-sm table-borderless table-striped table-hover m-0 table p-0"
                                        style="font-size: 18px;">
                                        <thead>
                                            <tr>
                                                <th>Tipo da conta</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($anexos as $anexo)
                                                <tr>
                                                    <td>{{ $anexo['movi_sub'] }}</td>
                                                    <td>
                                                        <a href="#" class="btn-download-anexo text-secondary"
                                                            data-tipo="{{ $delinquencie['tipo_conta'] }}"
                                                            data-id="{{ $delinquencie['id'] }}">
                                                            <i class="ti tabler-file-type-pdf"></i> Baixar
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-next waves-effect waves-light">
                    <span class="d-sm-inline-block d-none me-sm-2 align-middle">Enviar</span>
                    <i class="icon-base ti tabler-arrow-right icon-xs"></i>
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    document.querySelectorAll('.btn-download-anexo').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const tipo = this.dataset.tipo;
            const idContrato = this.dataset.id;

            console.log(tipo, idContrato);

            fetch(`/inadimplencias/anexos/baixar/${idContrato}/${tipo}`)
                .then(res => {
                    if (!res.ok) throw new Error('Erro ao abrir o anexo');
                    window.open(`/inadimplencias/anexos/baixar/${idContrato}/${tipo}`, '_blank');
                })
                .catch(error => {
                    Swal.fire('Erro', 'Arquivo não encontrado.', 'error');
                });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const selectContas = document.getElementById('contas');
        const cardConta = document.getElementById('card-conta');

        // Elementos do card para preencher
        const beneficiarioSpan = document.getElementById('beneficiario');
        const cnpjCpfSpan = document.getElementById('cnpj-cpf');
        const bancoSpan = document.getElementById('banco');
        const agenciaSpan = document.getElementById('agencia');
        const contaSpan = document.getElementById('conta');

        selectContas.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];

            if (selectedOption.value !== "") {
                // Remove a classe d-none para exibir o card
                cardConta.classList.remove('d-none');

                // Preenche os spans com os dados dos atributos data-*
                beneficiarioSpan.textContent = selectedOption.dataset.beneficiario;
                cnpjCpfSpan.textContent = selectedOption.dataset.cnpjCpf;
                bancoSpan.textContent = selectedOption.dataset.banco;
                agenciaSpan.textContent = selectedOption.dataset.agencia;
                contaSpan.textContent = selectedOption.dataset.conta;
            } else {
                // Oculta o card se a opção "Selecione uma conta" for escolhida
                cardConta.classList.add('d-none');
            }
        });
    });
</script>
