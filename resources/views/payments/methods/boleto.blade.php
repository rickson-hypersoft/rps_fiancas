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
                                        <h4 class="mb-2">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">BOLETO</font>
                                            </font>
                                        </h4>
                                      <div id="boleto-container" class="gerarboleto">
  <div class="row g-5 py-3">
    <div class="col-md col-lg-12 col-xl-12">
      <div class="p-3" style="background: #f7f7f7; border-radius: 5px">
        <p>Valor do Boleto: R$ {{$data['valor_total_pagamento']}}</p>
        <p>Após confirmar a geração, o link do boleto estará disponível para pagamento no banco da sua preferência.</p>
      </div>
    </div>
  </div>
</div>

<div id="boleto-link-container" style="display: none;">
    <svg id="barcode"></svg>
</div>

<a href="#" id="gerar-boleto" class="btn btn-primary">Gerar Boleto</a>
<a href="#" id="alterar-pagamento" class="btn btn-secondary" style="display: none;">Alterar forma de pagamento</a>
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

    <div class="layout-overlay layout-menu-toggle"></div>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/node-waves/node-waves.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/@algolia/autocomplete-js.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/pickr/pickr.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/cleave-zen/cleave-zen.js')}}"></script>
    <script src="{{asset('assets/js/front-page-payment.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script>
        const btnGerarBoleto = document.getElementById('gerar-boleto');
const alterarPagamentoBtn = document.getElementById('alterar-pagamento');
const boletoLinkContainer = document.getElementById('boleto-link-container');
const paymentId = `{{$id}}`;

        btnGerarBoleto.addEventListener('click', function (e) {
            e.preventDefault();

            const methodPayment = 'BOLETO';

            fetch(`/pagamentos/update-metodo/${paymentId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    metodo_pagamento: methodPayment
                })
            })
                .then(response => {
                    if (!response.ok) throw new Error('Erro ao gerar pagamento');
                    return response.json();
                })
                .then(data => {
                    if (data.success && data.tipo === 'BOLETO') {
                        const boletoUrl = data.link;
                        const barCode = data.detalhes_pagamentos.barCode

                        console.log(boletoUrl)

        boletoLinkContainer.style.display = 'block';
        boletoLinkContainer.innerHTML = `
            <div class="text-center mt-3">
                <a href="${boletoUrl}" target="_blank" class="btn btn-success">
                    <i class="bx bx-printer"></i> Visualizar Boleto
                </a>
                <div class="mt-3">
                    <strong>Código de Barras:</strong>
                    <div><svg id="barcode"></svg></div>
                </div>
            </div>
        `;

            btnGerarBoleto.style.display = 'none';
            alterarPagamentoBtn.style.display = 'block';

              JsBarcode("#barcode", barCode, {
            format: "CODE128",
            lineColor: "#000",
            width: 2,
            height: 60,
            displayValue: true
        });

                setTimeout(() => {
    const copiarBtn = document.getElementById('btn-copiar-pix');
    copiarBtn.addEventListener('click', function () {
        const payload = document.getElementById('pix-payload').value;
        navigator.clipboard.writeText(payload).then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Código Pix copiado!',
                showConfirmButton: false,
                timer: 1500
            });
        }).catch(err => {
            Swal.fire({
                icon: 'error',
                title: 'Erro ao copiar Pix!',
                text: err.message
            });
        });
    });
}, 100);
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert(error.message || 'Erro ao enviar a proposta.');
                              });
        });

       alterarPagamentoBtn.addEventListener('click', function (e) {
    e.preventDefault();

     btnGerarBoleto.style.display = 'inline-block';
    boletoLinkContainer.style.display = 'none';
    alterarPagamentoBtn.style.display = 'none';

    Swal.fire({
        title: 'Deseja alterar a forma de pagamento?',
        text: "Você voltará para a tela anterior!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, alterar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `/pagamentos/formCheckout/{{$data['link_hash']}}`; // ajuste o path se necessário
        }
    });
});
    </script>


</body>

</html>
