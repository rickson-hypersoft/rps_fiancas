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
                                        <h4 class="mb-2">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Escolha sua forma de pagamento
                                                </font>
                                            </font>
                                        </h4>
                                        <div class="row g-5 py-3">
                                            <div class="col-md col-lg-12 col-xl-12">
                                                <div class="form-check custom-option custom-option-basic checked">
                                                    <label
                                                        class="form-check-label custom-option-content form-check-input-payment"
                                                        for="customRadioCreditCard">
                                                        <input name="payment" class="form-check-input mt-2"
                                                            type="radio" value="CREDIT_CARD"
                                                            id="customRadioCreditCard">
                                                        <span class="custom-option-body">
                                                            <img src="https://cdn-icons-png.flaticon.com/512/2695/2695969.png"
                                                                alt="boleto" width="40">
                                                            <span class="fw-medium text-heading ms-4">
                                                                Cartão de crédito
                                                            </span>
                                                        </span>
                                                        <a href="{{ route('checkout.cartao', ['linkHash' => $data['link_hash']]) }}"
                                                            class="stretched-link"></a>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md col-lg-12 col-xl-12">
                                                <div class="form-check custom-option custom-option-basic">
                                                    <label
                                                        class="form-check-label custom-option-content form-check-input-payment"
                                                        for="customRadioBoleto">
                                                        <input name="payment" class="form-check-input mt-2"
                                                            type="radio" value="BOLETO" id="customRadioBoleto">
                                                        <span class="custom-option-body">
                                                            <img src="https://raw.githubusercontent.com/bubbstore/ecommerce-icons/7be9e66d6ecd87fa618275245ba707cb96285e6a/gateways-e-adquirentes/boleto.svg"
                                                                alt="boleto" width="58"
                                                                data-app-light-img="icons/payments/paypal-light.png"
                                                                data-app-dark-img="icons/payments/paypal-dark.png"
                                                                style="visibility: visible;">
                                                            <span class="fw-medium text-heading ms-4">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Boleto</font>
                                                                </font>
                                                            </span>
                                                        </span>
                                                        <a href="{{ route('checkout.boleto', ['linkHash' => $data['link_hash']]) }}"
                                                            class="stretched-link"></a>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md col-lg-12 col-xl-12">
                                                <div class="form-check custom-option custom-option-basic">
                                                    <label
                                                        class="form-check-label custom-option-content form-check-input-payment"
                                                        for="customRadioPix">
                                                        <input name="payment" class="form-check-input mt-2"
                                                            type="radio" value="PIX" id="customRadioPix">
                                                        <span class="custom-option-body">
                                                            <img src="https://img.icons8.com/?size=100&id=Dk4sj0EM4b20&format=png&color=000000"
                                                                alt="pix" width="35" height="35"
                                                                data-app-light-img="icons/payments/paypal-light.png"
                                                                data-app-dark-img="icons/payments/paypal-dark.png"
                                                                style="visibility: visible;">
                                                            <span class="fw-medium text-heading ms-4">
                                                                <font style="vertical-align: inherit;">
                                                                    <font style="vertical-align: inherit;">Pix</font>
                                                                </font>
                                                            </span>
                                                        </span>
                                                    </label>
                                                    <a href="{{ route('checkout.pix', ['linkHash' => $data['link_hash']]) }}"
                                                        class="stretched-link"></a>
                                                </div>
                                            </div>
                                        </div>
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
    <script src="{{ asset('assets/js/front-main.js') }}"></script>
    <script src="{{ asset('assets/js/pages-pricing.js') }}"></script>
    <script src="{{ asset('assets/js/front-page-payment.js') }}"></script>
</body>

</html>
