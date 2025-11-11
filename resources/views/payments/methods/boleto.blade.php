<!doctype html>

<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-wide" dir="ltr" data-skin="default"
    data-assets-path="../../assets/" data-template="horizontal-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Invicta - Inquilinos</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-payment.css') }}" />

    <style>
        @media (min-width: 769px) {
            .static-table {
                height: 600px;
            }
        }

        .barcode-container {
            max-width: 100%;
            overflow-x: auto;
            /* ou hidden se quiser ocultar em vez de rolar */
            padding: 0 10px;
        }

        #barcode {
            width: 100%;
            height: auto;
        }
    </style>

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <script src="{{ asset('assets/vendor/js/dropdown-hover.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/mega-dropdown.js') }}"></script>
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <div class="layout-page">
                <div class="content-wrapper">
                    <section class="section-py bg-body first-section-pt p-5">
                        <div class="container">
                            <div class="card px-3">
                                <div class="row" class="static-table">
                                    <div class="col-lg-7 card-body border-end p-md-8">
                                        <div id="boletoInfo" class="d-flex align-items-center">
                                            <a href="{{ route('checktou.index', ['linkHash' => $linkHash]) }}"
                                                class="icon-base ti tabler-arrow-left icon-xs mb-4 me-3"></a>
                                            <h6>
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Boleto</font>
                                                </font>
                                            </h6>
                                        </div>
                                        <div id="boleto-container" class="gerarboleto">
                                            <div class="row g-5 py-3">
                                                <div class="col-md col-lg-12 col-xl-12">
                                                    <div class="p-3" style="background: #f7f7f7; border-radius: 5px">
                                                        <p>Valor do Boleto: <b>{{ $data['valor_total_pagamento'] }}</b>
                                                        </p>
                                                        <p>1 - O boleto estará disponível assim que você clicar em
                                                            concluir a escolha do pagamento.</p>
                                                        <p>2 - Imprima o Boleto Bancário ou copie o código para efeturar
                                                            o pagamento.</p>
                                                        <p>A confirmação de pagamento via Boleto pode ocorrer em até 6
                                                            dias úteis, conforme compensação bancária</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="boleto-link-container" style="display: none;">
                                            <svg id="barcode"></svg>
                                        </div>

                                        <a href="#" id="gerar-boleto"
                                            class="btn btn-label-primary btn-prev waves-effect">
                                            <span class="d-sm-inline-block align-middle">Gerar boleto para
                                                pagamento</span>
                                            <i class="icon-base ti tabler-arrow-right icon-xs me-sm-2 me-0"></i>
                                        </a>
                                        <a href="#" id="alterar-pagamento" class="mt-5 text-center"
                                            style="display: none;">Alterar forma de pagamento</a>
                                    </div>

                                    <div class="col-lg-5 card-body p-md-12 d-flex flex-column justify-content-between">
                                        <div>
                                            <h4 class="mb-2">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Resumo do pedido</font>
                                                </font>
                                            </h4>
                                            <p class="mb-8">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">
                                                        Ele pode ajudar você a gerenciar e atender pedidos antes,
                                                    </font>
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
                                                        <font style="vertical-align: inherit;">Taxa Serviço</font>
                                                    </font>
                                                </p>
                                                <p class="mb-0">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">
                                                            {{ $data['proposta_total_valor'] }}</font>
                                                    </font>
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-4 pb-1">
                                                <p class="mb-0">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">Taxa Setup</font>
                                                    </font>
                                                </p>
                                                <p class="mb-0">
                                                    <font style="vertical-align: inherit;">
                                                        <font style="vertical-align: inherit;">
                                                            {{ $data['proposta_setup_valor'] }}</font>
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
                                                        <font style="vertical-align: inherit;">
                                                            {{ $data['valor_total_pagamento'] }}</font>
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

    <div class="layout-overlay layout-menu-toggle"></div>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@algolia/autocomplete-js.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/pickr/pickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleave-zen/cleave-zen.js') }}"></script>
    <script src="{{ asset('assets/js/front-page-payment.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script>
        const btnGerarBoleto = document.getElementById('gerar-boleto');
        const alterarPagamentoBtn = document.getElementById('alterar-pagamento');
        const boletoLinkContainer = document.getElementById('boleto-link-container');
        let idPagamento = null; // Será preenchido após gerar o boleto

        btnGerarBoleto.addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Processando...',
                text: 'Estamos gerando o seu boleto. Aguarde um instante.',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            const methodPayment = 'BOLETO';

            fetch(`/pagamentos/checkout/boleto/{{ $linkHash }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    metodo_pagamento: methodPayment
                })
            }).then(response => {
                if (!response.ok) throw new Error('Erro ao gerar pagamento');
                return response.json();
            }).then(data => {
                if (data.pago && data.html) {
                    // renderiza a tela de confirmação que veio pelo JSON
                    document.documentElement.innerHTML = data.html;
                    return;
                }

                if (data.success) {
                    // Salva o ID do pagamento para uso posterior
                    idPagamento = data.id_pagamento;

                    const boletoUrl = data.link_boleto;
                    const barCode = data.detalhe_pagamento.barCode;

                    document.getElementById('boleto-container').style.display = 'none';
                    document.getElementById('boletoInfo').classList.remove('d-flex');
                    document.getElementById('boletoInfo').classList.add('d-none');
                    boletoLinkContainer.style.display = 'block';
                    boletoLinkContainer.innerHTML = `
                    <div class="text-center">
                     <div class="badge bg-label-secondary text-body p-4 me-4 rounded">
                              <i class="icon-base ti tabler-clock icon-lg"></i>
                            </div>

                            <h4 class="mt-4 mb-0">Aguardando o seu pagamento</h4>
                            <p>Data de vencimento: ${data.data_vencimento}</p>
                            </div>
                    <div class="mt-3">
                        <div class="text-center barcode-container"><svg id="barcode"></svg></div>
                    </div>
                    <p class="mt-2"><b>Atenção:</b> A confirmação de pagamento pode ocorrer em até 6 dias úteis, conforme a compensação bancária</p>
                    <div class="mt-3 d-flex gap-2 justify-content-center">
                        <a href="${boletoUrl}" target="_blank" class="btn btn-outline-success">
                            <i class="ti tabler-file-type-pdf"></i> Visualizar PDF
                        </a>
                        <button class="btn btn-outline-primary" id="btn-copiar-pix">
                            <i class="bx bx-copy-alt"></i> Copiar código de barras
                        </button>
                        <input type="hidden" id="pix-payload" value="${barCode}" />
                    </div>
                `;

                    btnGerarBoleto.style.display = 'none';
                    alterarPagamentoBtn.style.display = 'block';

                    Swal.close();

                    const dynamicWidth = Math.max(1, 300 / barCode
                        .length); // Ajusta com base no tamanho do código

                    JsBarcode("#barcode", barCode, {
                        format: "CODE128",
                        lineColor: "#000",
                        width: 2,
                        height: 60,
                        displayValue: true
                    });

                    setTimeout(() => {
                        const copiarBtn = document.getElementById('btn-copiar-pix');
                        copiarBtn.addEventListener('click', function() {
                            const payload = document.getElementById('pix-payload').value;
                            navigator.clipboard.writeText(payload).then(() => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Código de barras copiado!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }).catch(err => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro ao copiar código de barras!',
                                    text: err.message
                                });
                            });
                        });
                    }, 100);
                } else {
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: 'Não foi possível gerar o boleto.'
                    });
                }
            }).catch(error => {
                console.error('Erro:', error);
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao gerar boleto!',
                    text: error.message || 'Erro ao enviar a proposta.'
                });
            });
        });

        if (alterarPagamentoBtn) {
            alterarPagamentoBtn.addEventListener('click', function(e) {
                e.preventDefault();

                if (!idPagamento) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Pagamento ainda não gerado!',
                        text: 'Você precisa gerar o boleto antes de alterar a forma de pagamento.'
                    });
                    return;
                }

                Swal.fire({
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, desejo alterar!',
                    cancelButtonText: 'Cancelar',
                    html: `
        <h3 style="font-size: 1.25rem; margin-bottom: 1rem;">Você tem certeza que deseja alterar a forma de pagamento?</h3>
        <p style="text-align: center; white-space: pre-line; font-size: 1rem;">
            Caso já tenha efetuado o pagamento do boleto não altere para outra forma de pagamento e entre com contato com o nosso time de atendimento para obter ajuda.<br>
            Canal de atendimento: 00000000000<br>
            WhatsApp: (34) 0000000000
        </p> `
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/pagamentos/checkout/cancelar/${idPagamento}/{{ $linkHash }}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Forma de pagamento alterada!',
                                    text: 'Agora você pode escolher outro método de pagamento.'
                                }).then(() => {
                                    window.location.href =
                                        `{{ route('checktou.index', ['linkHash' => $linkHash]) }}`;
                                });
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro ao cancelar boleto!',
                                    text: error.message
                                });
                            });
                    }
                });
            });
        }
    </script>
</body>

</html>
