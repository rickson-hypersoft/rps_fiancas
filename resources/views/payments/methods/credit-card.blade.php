<!doctype html>

<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-wide" dir="ltr" data-skin="default" data-assets-path="../../assets/" data-template="horizontal-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Invicta - Inquilinos</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/favicon.ico')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/iconify-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/node-waves/node-waves.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/pickr/pickr-themes.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/front-page-payment.css')}}" />
    <style>
        @media (min-width: 769px) {
            .static-table {
                height: 600px;
            }
        }

        .is-invalid {
            border: 1px solid red;
        }
    </style>
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
</head>

<body>
    <script src="{{asset('assets/vendor/js/dropdown-hover.js')}}"></script>
    <script src="{{asset('assets/vendor/js/mega-dropdown.js')}}"></script>
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <div class="layout-page">
                <div class="content-wrapper">
                    <section class="section-py bg-body first-section-pt p-5">
                        <div class="container">
                            <div class="card px-3">
                                <div class="row" class="static-table">
                                    <div class="col-lg-7 card-body border-end p-md-8">
                                        <div class="d-flex align-items-center">
                                            <a href="{{route('payment.formCheckout', ['link' => $link])}}"><i class="icon-base ti tabler-arrow-left icon-xs me-sm-2 me-0"></i></a>
                                            <h4 class="mb-2">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Cartão de crédito</font>
                                                </font>
                                            </h4>
                                        </div>
                                        <div class="row g-5 py-3">
                                            <div class="card" style="background: #f7f7f7; box-shadow: none;">
                                                <div class="card-body">
                                                    <form action="{{ route('payment.checkout.save.credit-card', ['linkHash' => $link, 'id' => $id]) }}" method="POST">
                                                        @csrf
                                                        <div class="row" id="card-data-section">
                                                            <div class="mb-3 col-md-7">
                                                                <label for="numero_cartao" class="form-label">Número do cartão</label>
                                                                <input type="text" class="form-control bg-white" name="numero_cartao" id="numero_cartao" placeholder="0000 0000 0000 0000" required />
                                                            </div>
                                                            <div class="mb-3 col-md-2">
                                                                <label for="cvv" class="form-label">CVV</label>
                                                                <input type="text" class="form-control bg-white" name="cvv" id="cvv" placeholder="000" required />
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label for="data_vencimento" class="form-label">Vencimento</label>
                                                                <input type="text" class="form-control bg-white" name="data_vencimento" id="data_vencimento" placeholder="00/00" required />
                                                            </div>
                                                            <div class="mb-3 col-md-7">
                                                                <label for="nome_cartao" class="form-label">Nome (como está no cartão)</label>
                                                                <input type="text" class="form-control bg-white" name="nome_cartao" id="nome_cartao" placeholder="Nome impresso no cartão" required />
                                                            </div>

                                                            <hr>
                                                            <div class="mb-3 col-md-8">
                                                                <label for="pessoa_nome" class="form-label">Nome Completo</label>
                                                                <input type="text" class="form-control bg-white" name="pessoa_nome" id="pessoa_nome" placeholder="Nome completo do titular do cartão" required />
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label for="pessoa_doc" class="form-label">CPF</label>
                                                                <input type="text" class="form-control bg-white" name="pessoa_doc" id="pessoa_doc" placeholder="000.000.000-00" required />
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label for="pessoa_cep" class="form-label">CEP</label>
                                                                <input type="text" class="form-control bg-white" name="pessoa_cep" id="pessoa_cep" placeholder="00000-000" required />
                                                            </div>
                                                            <div class="mb-3 col-md-8">
                                                                <label for="pessoa_endereco" class="form-label">Endereço</label>
                                                                <input type="text" class="form-control bg-white" name="pessoa_endereco" id="pessoa_endereco" required />
                                                            </div>
                                                            <div class="mb-3 col-md-3">
                                                                <label for="pessoa_numero" class="form-label">Número</label>
                                                                <input type="text" class="form-control bg-white" name="pessoa_numero" id="pessoa_numero" placeholder="000" required />
                                                            </div>
                                                            <div class="mb-3 col-md-6">
                                                                <label for="pessoa_complemento" class="form-label">Complemento</label>
                                                                <input type="text" class="form-control bg-white" name="pessoa_complemento" id="pessoa_complemento" placeholder="Complemento" />
                                                            </div>

                                                            <div class="mb-3 col-md-3" id="estado-container">
                                                                <label class="form-label" for="pessoa_estado">Estado</label>
                                                                <input type="text" name="pessoa_estado" id="pessoa_estado" class="form-control bg-white" readonly>
                                                            </div>

                                                            <div class="mb-3 col-md-6" id="cidade-container">
                                                                <label class="form-label" for="pessoa_cidade">Cidade</label>
                                                                <input type="text" name="pessoa_cidade" id="pessoa_cidade" class="form-control bg-white" readonly>
                                                            </div>

                                                            <div class="mb-3 col-md-6">
                                                                <label for="pessoa_bairro" class="form-label">Bairro</label>
                                                                <input type="text" class="form-control bg-white" name="pessoa_bairro" id="pessoa_bairro" required />
                                                            </div>
                                                            <div class="col-md-6 aligm-items-end">
                                                                <button type="button" id="btn-continuar" class="btn btn-primary">Continuar</button>
                                                            </div>
                                                        </div>

                                                        <div class="row" id="installment-section" style="display: none;">
                                                            <div>
                                                                <span>Pagamento 1</span>
                                                                <div class="card mt-5">
                                                                    <div class="card-body" style="background: #f7f7f7; box-shadow: none;">
                                                                        <h4>Aluguel Imóvel <span class="h5 fw-normal">{{$data['proposta_total_valor']}}</span></h4>
                                                                        <hr>
                                                                        <div class="mb-4">
                                                                            <label for="parcelas_imovel_aluguel" class="form-label">Parcelas</label>
                                                                            <select class="form-select" name="proposta_total_parc" id="parcelas_imovel_aluguel" placeholder="Selecione uma forma de pagamento" aria-label="Default select example">
                                                                                @foreach($data['parcelas_total_valor_disponiveis'] as $numero => $descricao)
                                                                                <option value="{{ $numero }}">{{ $descricao }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mt-5">
                                                                <span>Pagamento 2</span>
                                                                <div class="card mt-5">
                                                                    <div class="card-body" style="background: #f7f7f7; box-shadow: none;">
                                                                        <h4>Setup <span class="h5 fw-normal">{{$data['proposta_setup_valor']}}</span></h4>
                                                                        <hr>
                                                                        <div class="mb-4">
                                                                            <label for="parcelas_imovel_aluguel" class="form-label">Parcelas</label>
                                                                            <select class="form-select" name="proposta_setup_parc" id="parcelas_imovel_aluguel" placeholder="Selecione uma forma de pagamento" aria-label="Default select example">
                                                                                @foreach($data['parcelas_setup_disponiveis'] as $numero => $descricao)
                                                                                <option value="{{ $numero }}">{{ $descricao }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <a href="#" id="btn-voltar-cartao" class="mt-4 btn btn-secondary">Voltar</a>
                                                                <button id="btn-finalizar" class="mt-4 btn btn-primary">Continuar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 card-body p-md-12 d-flex flex-column">
                                        <div>
                                            <h4 class="mb-2">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Resumo do pedido</font>
                                                </font>
                                            </h4>
                                            <p class="mb-8">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">
                                                        Ele pode ajudar você a gerenciar e atender pedidos antes, </font>
                                                </font><br>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">
                                                        durante e depois do atendimento.
                                                    </font>
                                                </font>
                                            </p>
                                        </div>
                                        <div class="mt-5">
                                            <div class="d-flex justify-content-between align-items-center mt-4 pb-1">
                                                <p class="mb-0">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Valor Aluguel</font>
                                                    </font>
                                                </p>
                                                <p class="mb-0">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">{{$data['proposta_total_valor']}}</font>
                                                    </font>
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-4 pb-1">
                                                <p class="mb-0">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Valor Setup</font>
                                                    </font>
                                                </p>
                                                <p class="mb-0">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">{{$data['proposta_setup_valor']}}</font>
                                                    </font>
                                                </p>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between align-items-center mt-4 pb-1">
                                                <h5 class="mb-0">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Total</font>
                                                    </font>
                                                </h5>
                                                <h4 class="mb-0">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">{{$data['valor_total_pagamento']}}</font>
                                                    </font>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/imask"></script>
    <script>
        // Aplicação de máscaras
        IMask(document.getElementById('numero_cartao'), {
            mask: '0000 0000 0000 0000'
        });
        IMask(document.getElementById('cvv'), {
            mask: '000'
        });
        IMask(document.getElementById('data_vencimento'), {
            mask: '00/00'
        });
        IMask(document.getElementById('pessoa_doc'), {
            mask: '000.000.000-00'
        });
        IMask(document.getElementById('pessoa_cep'), {
            mask: '00000-000'
        });

        document.addEventListener("DOMContentLoaded", function () {
            // Preenchimento automático de cidade/estado via CEP
            document.getElementById('pessoa_cep').addEventListener('blur', function () {
                const cep = this.value.replace(/\D/g, '');

                const statusEl = document.getElementById('cep-status');
                const estadoInput = document.getElementById('pessoa_estado');
                const cidadeInput = document.getElementById('pessoa_cidade');
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

            // Elementos de botão e seções
            const btnContinuar = document.getElementById("btn-continuar");
            const btnFinalizar = document.getElementById("btn-finalizar");
            const voltarCartao = document.getElementById("btn-voltar-cartao");

            const cardDataSection = document.getElementById("card-data-section");
            const installmentSection = document.getElementById("installment-section");

            const form = document.querySelector("form"); // Ou use um ID fixo para o formulário
            const methodPayment = 'CREDIT_CARD';

            btnContinuar.addEventListener("click", function () {
                const camposObrigatorios = [
                    'numero_cartao',
                    'cvv',
                    'data_vencimento',
                    'nome_cartao',
                    'pessoa_nome',
                    'pessoa_doc',
                    'pessoa_cep',
                    'pessoa_endereco',
                    'pessoa_numero',
                    'pessoa_estado',
                    'pessoa_bairro'
                ];

                let preenchido = true;

                camposObrigatorios.forEach(function (campo) {
                    const elemento = document.getElementById(campo);

                    if (!elemento) {
                        console.warn(`Elemento com ID '${campo}' não encontrado.`);
                        return;
                    }

                    if (elemento.value.trim() === '') {
                        preenchido = false;
                        elemento.classList.add('is-invalid');
                    } else {
                        elemento.classList.remove('is-invalid');
                    }
                });

                if (preenchido) {
                    cardDataSection.classList.remove("row");
                    cardDataSection.classList.add("d-none");
                    installmentSection.style.display = "block";
                } else {
                    alert('Por favor, preencha todos os campos obrigatórios corretamente.');
                }
            });

            voltarCartao.addEventListener("click", function () {
                cardDataSection.classList.remove("d-none");
                cardDataSection.classList.add("row");
                installmentSection.style.display = "none";
            });

            btnFinalizar.addEventListener("click", function () {
                // Você pode validar o campo de parcelas aqui, se necessário
                form.submit();
            });
        });
    </script>


    <div class="layout-overlay layout-menu-toggle"></div>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/node-waves/node-waves.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/@algolia/autocomplete-js.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/pickr/pickr.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/cleave-zen/cleave-zen.js')}}"></script>
    <script src="{{asset('assets/js/front-page-payment.js')}}"></script>
</body>

</html>
