<div id="resumo" class="content fv-plugins-bootstrap5 active fv-plugins-framework">
    <div class="row g-6 justify-content-center mb-5 pb-5 pt-5">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="d-flex align-items-start">
                <div class="badge bg-label-primary me-3 rounded p-2">
                    <i class="icon-base ti tabler-file icon-lg"></i>
                </div>
                <div class="d-flex justify-content-between w-100 align-items-center gap-2">
                    <div class="me-2">
                        <h6 class="mb-0">Resumo da proposta</h6>
                        <small class="text-body">Solicitação <span id="proposta_id">{{ $proposta['id'] }}</span></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-6 justify-content-center mt-5">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="card">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <p class="fw-bold mb-2 p-0">Status da proposta</p>
                        @php
                            switch ($proposta['proposta_status']) {
                                case 'Aprovado':
                                    $badge = 'success';
                                    break;
                                case 'Pendente':
                                    $badge = 'warning';
                                    break;
                                case 'Alteração Imobiliária':
                                    $badge = 'warning';
                                    break;
                                case 'Cancelado':
                                    $badge = 'danger';
                                    break;
                                default:
                                    $badge = 'secondary';
                                    break;
                            }

                        @endphp
                        <span class="badge text-bg-{{ $badge }}"><span
                                id="contrato_status_resumo">{{ $proposta['proposta_status'] }}</span></span>
                    </div>

                    <button data-bs-toggle="modal" data-bs-target="#modalCancelarProposta" id="propostal-canceled"
                        class="btn btn-outline-secondary">Cancelar proposta</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-6 justify-content-center mt-5">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="card">
                <div class="card-body">
                    <div class="content-header">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Dados do plano</h6>
                            <a href="{{ route('propostal.step2', ['id' => $proposta['id']]) }}"
                                class="text-success">Editar Dados</a>
                        </div>
                        <hr>
                    </div>

                    <div class="card-body d-flex justify-content-between m-0 p-0">
                        <div>
                            <!--<p>Tipo de pagador</p>-->
                            <p>Valor da taxa</p>
                            <p>Valor do setup</p>
                        </div>
                        <div>
                            <!--<p id="proposta_tipo_pagador_resumo"></p>-->
                            <p style="text-align: right" id="proposta_total_valor_resumo">
                                {{ $proposta['proposta_total_valor'] }}</p>
                            <p style="text-align: right" id="proposta_setup_valor_resumo">
                                {{ $proposta['proposta_setup_valor'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-6 justify-content-center mt-5">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="card">
                <div class="card-body">
                    <div class="content-header">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Dados da locação</h6>
                            <a href="{{ route('propostal.create.step1', ['id' => $proposta['id']]) }}"
                                class="text-success">Editar Dados</a>
                        </div>
                        <hr>
                    </div>

                    <div class="card-body m-0 p-0">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>Tipo de imóvel</p>
                                <p>Valor do aluguel</p>
                                <p>Valor do condomínio</p>
                                <p>Outras taxas</p>
                            </div>
                            <div>
                                <p id="imovel_tipo_resumo">{{ $proposta['imovel_tipo'] }}</p>
                                <p style="text-align: right" id="imovel_aluguel_resumo">
                                    {{ $proposta['imovel_aluguel'] }}</p>
                                <p style="text-align: right" id="imovel_condominio_resumo">
                                    {{ $proposta['imovel_condominio'] }}</p>
                                <p style="text-align: right" id="imovel_taxas_resumo">{{ $proposta['imovel_taxas'] }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p>Total</p>
                            </div>
                            <div>
                                <p style="text-align: right" id="proposta_total_valor_total">
                                    {{ $proposta['proposta_total_valor'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-6 justify-content-center mt-5">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="card">
                <div class="card-body">
                    <div class="content-header">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Endereço do imóvel</h6>
                            <a href="{{ route('propostal.step3', ['id' => $proposta['id']]) }}"
                                class="text-success">Editar Dados</a>
                        </div>
                        <hr>
                    </div>

                    <div class="card-body m-0 p-0">
                        <div>
                            <p class="fw-bold">CEP</p>
                            <p id="imovel_cep_resumo">{{ $proposta['imovel_cep'] }}</p>
                        </div>
                        <div>
                            <p class="fw-bold">Endereço</p>
                            <p id="imovel_endereco_completo">{{ $proposta['endereco_completo'] }}</p>
                        </div>
                        <div>
                            <p class="fw-bold">Complemento</p>
                            <p id="imovel_complemento_resumo">{{ $proposta['imovel_complemento'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-6 justify-content-center mt-5">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="card">
                <div class="card-body">
                    <div class="content-header">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-0">Dados do inquilino</h6>
                            <a href="{{ route('propostal.create.step1', ['id' => $proposta['id']]) }}"
                                class="text-success">Editar Dados</a>
                        </div>
                        <hr>
                    </div>

                    <div class="card-body m-0 p-0">
                        <div class="card-body m-0 p-0">
                            <div>
                                <p class="fw-bold">Nome</p>
                                <p id="pessoa_nome_resumo">{{ $proposta['pessoa_nome'] }}</p>
                            </div>
                            <div>
                                <p class="fw-bold">CPF</p>
                                <p id="pessoa_doc_resumo">{{ $proposta['pessoa_doc'] }}</p>
                            </div>
                            <div>
                                <p class="fw-bold">Telefone</p>
                                <p id="pessoa_telefone_resumo">{{ $proposta['pessoa_telefone'] }}</p>
                            </div>
                            <div>
                                <p class="fw-bold">Data Nascimento</p>
                                <p id="data_nascimento_resumo">
                                    {{ \Carbon\Carbon::parse($proposta['data_nascimento'])->format('d/m/Y') }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-6 justify-content-center mt-2">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="accordion mt-4" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                            data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
                            Histórico
                        </button>
                    </h2>

                    <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample"
                        style="">
                        @foreach ($histories as $history)
                            <div class="accordion-body mb-0 mt-0 pb-0 pt-0">
                                {{ \Carbon\Carbon::parse($history['data'])->format('d/m/Y') }} {{ $history['hora'] }}
                                - {{ $history['historico'] }}
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 d-flex justify-content-between mb-5 mt-5">
            <a href="{{ route('propostal.step3', ['id' => $proposta['id']]) }}"
                class="btn btn-label-secondary btn-prev waves-effect">
                <i class="icon-base ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
                <span class="d-sm-inline-block d-none align-middle">Voltar</span>
            </a>
            <a href="{{ route('propostal.step5', ['id' => $proposta['id']]) }}" id="btn-enviar-proposta"
                data-proposta-id="{{ $proposta['id'] }}" class="btn btn-primary btn-next waves-effect waves-light">
                <span class="d-sm-inline-block d-none me-sm-2 align-middle">Enviar proposta</span>
                <i class="icon-base ti tabler-arrow-right icon-xs"></i>
            </a>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCancelarProposta" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCancelarPropostaTitle">Qual o motivo do cancelamento desta proposta
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCancelarProposta" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-4">
                            <label for="motivo" class="form-label">Selecionar motivo</label>
                            <select id="motivo" class="form-select form-select-lg" name="motivo">
                                <option value="Processo de locação interrompido">Processo de locação interrompido
                                </option>
                                <option value="Cliente interessado em outra forma de garantia">Cliente interessado em
                                    outra forma de garantia</option>
                                <option value="Cliente interessado em outro imóvel">Cliente interessado em outro imóvel
                                </option>
                                <option value="Proposta transferida para outra pessoa">Proposta transferida para outra
                                    pessoa</option>
                                <option value="Cliente não respondeu às tentativas de contato">Cliente não respondeu às
                                    tentativas de contato</option>
                                <option value="Imóvel já locado para outro interessado">Imóvel já locado para outro
                                    interessado</option>
                                <option value="Cliente visitou o imóvel, mas desistiu">Cliente visitou o imóvel, mas
                                    desistiu</option>
                                <option value="Imóvel fora do orçamento do cliente">Imóvel fora do orçamento do cliente
                                </option>
                                <option value="Questões financeiras do cliente">Questões financeiras do cliente
                                </option>
                                <option value="Inquilino não concordou com o modelo de garantia">Inquilino não
                                    concordou com o modelo de garantia</option>
                                <option value="Desacordo entre inquilino e proprietário">Desacordo entre inquilino e
                                    proprietário</option>
                                <option value="Imobiliária cancelou para cadastrar uma nova proposta no CPF">
                                    Imobiliária cancelou para cadastrar uma nova proposta no CPF</option>

                            </select>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col mb-4">
                            <label for="exampleFormControlTextarea1" class="form-label">Explicar motivo
                                (opcional)</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="motivo_opicional"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary waves-effect"
                        data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modalCancelar = new bootstrap.Modal(document.getElementById('modalCancelarProposta'));
            const form = document.getElementById('formCancelarProposta');

            // Envio do formulário
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                const propostaId = "{{ $proposta['id'] }}";

                fetch(`/propostas/cancelar/${propostaId}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        modalCancelar.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Proposta cancelada com sucesso!',
                            confirmButtonText: 'Voltar para listagem'
                        }).then(() => {
                            window.location.href = "{{ route('propostal.index') }}";
                        });
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire('Erro', 'Ocorreu um erro ao cancelar a proposta.', 'error');
                    });
            });
        });

        const button = document.getElementById('btn-enviar-proposta');
        let isSending = false;

        button.addEventListener('click', function(event) {
            event.preventDefault(); // impede o redirecionamento imediato
const status = `{{ $proposta['proposta_credito_status'] }}`
            if (isSending) return;
            isSending = true;

            if(status == 'Aprovado') {
                Swal.fire({
                    title: 'Enviando proposta...',
                    text: 'Aguarde o envio por e-mail e WhatsApp.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            } else {
                 Swal.fire({
                    title: 'Enviando proposta...',
                    text: 'Aguarde a análise da imobiliária para continuar.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }

            const propostaId = button.getAttribute('data-proposta-id');
            const redirectUrl = button.getAttribute('href');
            const nomeInquilino = `{{ $proposta['pessoa_nome'] }}`
            const emailInquilino = `{{ $proposta['pessoa_email'] }}`
            const linkInquilino = `{{ $proposta['link_hash'] }}`
            const numeroWhatsAppDestino = `+55{{ $proposta['pessoa_telefone'] }}`


            if(status == 'Aprovado') {
            // Envia o e-mail por AJAX
            fetch('/propostas/email', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name: nomeInquilino,
                        email: emailInquilino,
                        link: linkInquilino,
                    })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Erro ao enviar o e-mail');
                    return response.json();
                })
                .then(data => {
                    // Após o e-mail, enviar o WhatsApp
                    return fetch('/propostas/whatsapp', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            to: numeroWhatsAppDestino,
                            link: linkInquilino,
                            type: 'proposta',
                        })
                    });
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            console.error('Erro na resposta da API:', errorData);
                            throw new Error(errorData.message || 'Erro desconhecido na API.');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    // Após o WhatsApp, agora atualizar o status
                    return fetch(`/propostas/atualizar/status/${propostaId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            proposta_status: 'Aprovado',
                            contrato_status: 'Pendente',
                            contrato_sub_status: 'Em análise biométrica',
                        })
                    });
                })
                .then(response => {
                    if (!response.ok) throw new Error('Erro ao atualizar o status da proposta');
                    return response.json();
                })
                .then(data => {
                    // Se tudo der certo: redirecionar
                    window.location.href = redirectUrl;
                    Swal.close();
                })
                .catch(error => {
                    Swal.close();
                    Swal.fire('Erro', error.message || 'Erro ao processar a proposta.', 'error');
                    isSending = false;
                });
            }
        });
    </script>
@endsection
