@extends('dashboard')
@section('content')
    <div class="col-12">
        <h4>Confirmar Rescisão - Dados do <b>Imóvel</b></h4>
        <p>{{ $data['id'] }}</p>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header bg-label-secondary pb-3 pt-3">
                <h5 class="m-0 p-0">Produto</h5>
            </div>
            <div class="card-body mt-5">
                <form action="{{ route('assets.canceled.post', ['idContrato' => $data['id']]) }}" id="formEdit"
                    class="row" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-sm-3 form-control-validation fv-plugins-icon-container mb-4">
                        <label class="form-label" for="formValidationUsername">Valor Aluguel</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">
                                R$
                            </span>
                            <input name="imovel_aluguel" disabled readonly style="text-align: right" id="imovel_aluguel"
                                type="text" class="form-control form-control-lg"
                                value="{{ str_replace('R$ ', '', $data['imovel_aluguel']) }}"
                                aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>

                    <div class="col-sm-3 form-control-validation fv-plugins-icon-container mb-4">
                        <label class="form-label" for="formValidationUsername">Valor do Condomínio</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">
                                R$
                            </span>
                            <input disabled readonly name="imovel_condominio" style="text-align: right"
                                id="imovel_condominio" type="text" class="form-control form-control-lg"
                                value="{{ str_replace('R$ ', '', $data['imovel_condominio']) }}"
                                aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>

                    <div class="col-sm-3 form-control-validation fv-plugins-icon-container mb-4">
                        <label class="form-label" for="formValidationUsername">Outras Taxas</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">
                                R$
                            </span>
                            <input disabled readonly name="imovel_taxas" style="text-align: right" id="imovel_taxas"
                                type="text" class="form-control form-control-lg"
                                value="{{ str_replace('R$ ', '', $data['imovel_taxas']) }}"
                                aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>

                    <div class="col-sm-3 form-control-validation fv-plugins-icon-container mb-4">
                        <label class="form-label" for="formValidationUsername">Valor locatício total</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">
                                R$
                            </span>
                            <input disabled readonly name="valor_total_pagamento" style="text-align: right"
                                id="valor_total_pagamento" type="text" class="form-control form-control-lg"
                                value="{{ str_replace('R$ ', '', $data['valor_total_pagamento']) }}"
                                aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>

                    <div class="col-sm-3 form-control-validation mb-4">
                        <label class="form-label" for="formValidationUsername">Tipo</label>
                        <div class="input-group">

                            <input disabled readonly name="imovel_tipo" id="imovel_tipo" type="text"
                                class="form-control form-control-lg" value="{{ $data['imovel_tipo'] }}"
                                aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>

                    <div class="col-sm-3 form-control-validation mb-4">
                        <label class="form-label" for="formValidationUsername">Setup</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">
                                R$
                            </span>
                            <input disabled readonly name="proposta_setup_valor" style="text-align: right"
                                id="proposta_setup_valor" type="text" class="form-control form-control-lg"
                                value="{{ str_replace('R$ ', '', $data['proposta_setup_valor']) }}"
                                aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>

                    <div class="col-sm-3 form-control-validation mb-4">
                        <label class="form-label" for="formValidationUsername">Parcelas Setup</label>
                        <div class="input-group">

                            <input disabled readonly name="proposta_setup_parc" style="text-align: right"
                                id="proposta_setup_parc" type="text" class="form-control form-control-lg"
                                value="{{ $data['proposta_setup_parc'] }}" aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>

                    <div class="col-sm-3 form-control-validation mb-4">
                        <label class="form-label" for="formValidationUsername">Resposável pelo Pagmento</label>
                        <input disabled readonly name="pessoa_nome" id="pessoa_nome" type="text"
                            class="form-control form-control-lg" value="{{ $data['pessoa_nome'] }}"
                            aria-label="Amount (to the nearest dollar)">
                    </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header bg-label-secondary pb-3 pt-3">
                <h5 class="m-0 p-0">Localização</h5>
            </div>
            <div class="card-body mt-5">
                <div class="row">
                    <div class="col-md-2 col-12 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_cep">CEP</label>
                            <input type="text" name="imovel_cep" id="imovel_cep" class="form-control form-control-lg"
                                value="{{ $data['imovel_cep'] }}" disabled readonly />
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_endereco">Endereço</label>
                            <input type="text" name="imovel_endereco" id="imovel_endereco"
                                class="form-control form-control-lg" value="{{ $data['imovel_endereco'] }}" disabled
                                readonly />
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_numero">Número</label>
                            <input type="text" name="imovel_numero" id="imovel_numero"
                                class="form-control form-control-lg" value="{{ $data['imovel_numero'] }}" disabled
                                readonly />
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_bairro">Bairro</label>
                            <input type="text" name="imovel_bairro" id="imovel_bairro"
                                class="form-control form-control-lg" value="{{ $data['imovel_bairro'] }}" disabled
                                readonly />
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_estado">Estado</label>
                            <input type="text" name="imovel_estado" id="imovel_estado_dados"
                                class="form-control form-control-lg" value="{{ $data['imovel_estado'] }}" disabled
                                readonly />
                        </div>
                    </div>
                    <div class="col-md-5 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_cidade">Cidade</label>
                            <input type="text" name="imovel_cidade" id="imovel_cidade"
                                class="form-control form-control-lg" value="{{ $data['imovel_cidade'] }}" disabled
                                readonly />
                        </div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_complemento">Complemento</label>
                            <input type="text" name="imovel_complemento" id="imovel_complemento"
                                class="form-control form-control-lg" value="{{ $data['imovel_complemento'] }}" disabled
                                readonly />
                        </div>
                    </div>

                    <div class="col-md-3 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_tag">Tag</label>
                            <input type="text" name="imovel_tag" id="imovel_tag" class="form-control form-control-lg"
                                value="{{ $data['imovel_tag'] }}" disabled readonly />
                        </div>
                    </div>

                    <div class="col-md-3 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="imovel_ramo_atv">Ramo Atividade</label>
                            <input type="text" name="imovel_ramo_atv" id="imovel_ramo_atv"
                                class="form-control form-control-lg" value="{{ $data['imovel_ramo_atv'] }}" disabled
                                readonly />
                        </div>
                    </div>

                    <div class="col-md-12 mb-2 py-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="observacao">Descrição</label>
                            <textarea disabled readonly class="form-control" id="observacao" rows="3" name="observacao">
                            {{ $data['observacao'] }}
                        </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header bg-label-secondary pb-3 pt-3">
                <h5 class="m-0 p-0">Dados do Cancelamento</h5>
            </div>
            <div class="card-body mt-5">
                <div class="row">
                    <div class="col-md-2 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="data_ativacao">Data Ativação</label>
                            <!-- Imóvel número com data formatada -->
                            <input type="text" name="data_ativacao" id="data_ativacao"
                                class="form-control form-control-lg"
                                value="{{ \Carbon\Carbon::parse($data['data'])->format('d/m/Y') }}" disabled readonly />
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="data_cancelamento">Data do Cancelamento</label>
                            <input type="text" name="data_cancelamento" id="data_cancelamento"
                                class="form-control form-control-lg" value="{{ now()->format('d/m/Y') }}" disabled
                                readonly />
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="motivo_rescisao">Motivo da rescisão:</label>
                            <select id="motivo_rescisao" required name="motivo_rescisao"
                                class="form-select form-select-lg">
                                <option>Escolha um motivo</option>
                                <option value="Inquilino desistiu da locação">Inquilino desistiu da locação</option>
                                <option value="Utilizará outra fiança">Utilizará outra fiança</option>
                                <option value="Inquilino com outro contrato ativo">Inquilino com outro contrato ativo
                                </option>
                                <option value="Inquilino com outro contrato em análise">Inquilino com outro contrato em
                                    análise</option>
                                <option value="Contrato de locação errado">Contrato de locação errado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="detalhe">Detalhe:</label>
                            <select id="detalhe" required name="detalhe" class="form-select form-select-lg">
                                <option>Sem detalhe</option>
                                <option value="Aumento de espaço">Aumento de espaço</option>
                                <option value="Conflito - Familiar">Conflito - Familiar</option>
                                <option value="Conflito - Vizinhos">Conflito - Vizinhos</option>
                                <option value="Desastre Natural - Chuva">Desastre Natural - Chuva</option>
                                <option value="Desastre Natural - Erosão">Desastre Natural - Erosão</option>
                                <option value="Desastre Natural - Área de Risco">Desastre Natural - Área de Risco</option>
                                <option value="Desastre Natural - Vento">Desastre Natural - Vento</option>
                                <option value="Desemprego">Desemprego</option>
                                <option value="Duplicidade de locação do mesmo imóvel">Duplicidade de locação do mesmo
                                    imóvel</option>
                                <option value="Imóvel não permite animais">Imóvel não permite animais</option>
                                <option value="Manutenção - Externa">Manutenção - Externa</option>
                                <option value="Manutenção - Interna">Manutenção - Interna</option>
                                <option value="Mudança de Imóvel - Imóvel familiar">Mudança de Imóvel - Imóvel familiar
                                </option>
                                <option value="Mudança de Imóvel - Imóvel próprio">Mudança de Imóvel - Imóvel próprio
                                </option>
                                <option value="Novo membro na família">Novo membro na família</option>
                                <option value="Óbito - Corresponsável">Óbito - Corresponsável</option>
                                <option value="Óbito - Titular">Óbito - Titular</option>
                                <option value="Problemas no Imóvel - Alagamento">Problemas no Imóvel - Alagamento</option>
                                <option value="Problemas no Imóvel - Danos életricos">Problemas no Imóvel - Danos életricos
                                </option>
                                <option value="Problemas no Imóvel - Danos estruturais">Problemas no Imóvel - Danos
                                    estruturais</option>
                                <option value="Problemas no Imóvel - Danos hídraulicos">Problemas no Imóvel - Danos
                                    hídraulicos</option>
                                <option value="Problemas no Imóvel - Falta de manutenção do imóvel">Problemas no Imóvel -
                                    Falta de manutenção do imóvel</option>
                                <option value="Problemas no Imóvel - Imóvel">Problemas no Imóvel - Imóvel</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 mb-2">
                        <div class="form-control-validation fv-plugins-icon-container">
                            <label class="form-label" for="data_entrega">Data Entrega de Chaves/Rescisão</label>
                            <input type="date" name="data_entrega" id="data_entrega"
                                class="form-control form-control-lg" value="" />
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5" id="anexos">
            <div class="card-header bg-label-secondary pb-3 pt-3">
                <h5 class="m-0 p-0">Anexos/Documentos</h5>
                <p>O arquivo anexado obrigatóriamente deverá ser pdf ou umagem de no máximo 80MB</p>
            </div>
            <div class="card-body mt-5">
                <div class="row">
                    <!-- Contrato -->
                    <div class="col-md-4 mb-3">
                        <label for="file_contrato" class="form-label">Contrato</label>
                        <input class="form-control" type="file" id="file_contrato" name="arquivos[contrato]">
                    </div>

                    <!-- Vistoria -->
                    <div class="col-md-4 mb-3">
                        <label for="file_vistoria" class="form-label">Vistoria</label>
                        <input class="form-control" type="file" id="file_vistoria" name="arquivos[vistoria]">
                    </div>

                    <!-- Apólice -->
                    <div class="col-md-4 mb-3">
                        <label for="file_apolice" class="form-label">Apólice</label>
                        <input class="form-control" type="file" id="file_apolice" name="arquivos[apolice]">
                    </div>
                </div>

                @if ($data['anexo_contrato'] || $data['anexo_vistoria'] || $data['anexo_apolice'])
                    <div class="table-responsive mt-5 text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Nome do arquivo</th>
                                    <th>Data do anexo</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($anexos as $anexo)
                                    <tr>
                                        <td>
                                            {{ $anexo['movi_sub'] }}
                                        </td>
                                        <td>{{ $anexo['nome_arquivo_original'] }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($anexo['data'])->format('d/m/Y') }}
                                        </td>
                                        <td>
                                            <a href="#" class="btn-download-anexo text-secondary"
                                                data-tipo="{{ $anexo['movi_sub'] }}" data-id="{{ $data['id'] }}">
                                                <i class="ti tabler-file-type-pdf"></i> Baixar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
        </form>
        <div class="mt-5">
            <a href="{{ route('assets.asset', ['id' => $data['id']]) }}" class="btn btn-secondary">Voltar</a>
            <button id="enviar" type="button" class="btn btn-primary">Prosseguir</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function formatarDataBR(dataISO) {
            if (!dataISO) return '-';
            const [ano, mes, dia] = dataISO.split('-');
            return `${dia}/${mes}/${ano}`;
        }

        const pagamento = @json($payments);
        const dataBr = formatarDataBR(pagamento.DATA_PAGAMENTO)
        document.getElementById('enviar').addEventListener('click', function(e) {
            e.preventDefault()
            // Pegando dados do pagamento vindos do controller (injetados no Blade como JSON)

            if (pagamento.METODO_PAGAMENTO !== 'CREDIT_CARD' && pagamento.STATUS === 'CONFIRMED') {
                Swal.fire({
                    title: 'Atenção',
                    text: `Favor estornar pagamento para o Inquilino ${pagamento.pessoa_nome}, no valor de ${pagamento.proposta_total_valor} referente a pagamento efetuado por ${pagamento.METODO_PAGAMENTO} na data de ${dataBr}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar Estorno',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('formEdit').submit();
                    }
                });
            } else {
                Swal.fire({
                    title: 'Atenção',
                    text: `Deseja realmente cancelar o contrato do inquilino ${pagamento.pessoa_nome}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar Cancelamento',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('formEdit').submit();
                    }
                });

            }
        });

        document.querySelectorAll('.btn-download-anexo').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const tipo = this.dataset.tipo.toLowerCase();
                const idContrato = this.dataset.id;

                console.log(tipo, idContrato);

                fetch(`/anexos/baixar/${idContrato}/${tipo}`)
                    .then(res => {
                        if (!res.ok) throw new Error('Erro ao abrir o anexo');
                        window.open(`/anexos/baixar/${idContrato}/${tipo}`, '_blank');
                    })
                    .catch(error => {
                        Swal.fire('Erro', 'Arquivo não encontrado.', 'error');
                    });
            });
        });
    </script>
@endsection
