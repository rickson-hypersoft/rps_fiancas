<!doctype html>

<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-wide" dir="ltr" data-skin="default" data-assets-path="../../assets/" data-template="horizontal-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Demo: Fluid - Layouts | Vuexy - Bootstrap Dashboard PRO</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap" rel="stylesheet" />

    <link rel="stylesheet" href="../../assets/vendor/fonts/iconify-icons.css" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="../../assets/vendor/libs/pickr/pickr-themes.css" />

    <link rel="stylesheet" href="../../assets/vendor/css/core.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- endbuild -->

    <!-- Page CSS -->

    <link rel="stylesheet" href="../../assets/vendor/css/pages/front-page-payment.css" />

    <style>
        @media (min-width: 769px) {
            .static-table {
                height: 600px;
            }
        }
    </style>

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->


    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="../../assets/js/config.js"></script>
</head>

<body>
    <script src="../../assets/vendor/js/dropdown-hover.js"></script>
    <script src="../../assets/vendor/js/mega-dropdown.js"></script>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Menu -->

                    <!-- / Menu -->

                    <!-- Content -->
                    <section class="section-py bg-body first-section-pt p-5">
                        @if ($payment == 'PIX')
                        <div class="container">
                            <div class="card px-3">
                                <div class="row" class="static-table">
                                    <div class="col-lg-7 card-body border-end p-md-8">
                                        <h4 class="mb-2">
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">PIX</font>
                                            </font>
                                        </h4>
                                        <div class="row g-5 py-3">
                                            <div class="col-md col-lg-12 col-xl-12">
                                                <div class="p-3 bg-light">
                                                    <p>Valor do PIX R$ 990,00</p>
                                                    <p>Após confirmar o pagamento, o código Pix ficará disponível par avocê pagar no banco da sua preferência.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="" class="btn btn-primary">Gerar Código pix</a>
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
                                                        <font style="vertical-align: inherit;">R$ 69,69</font>
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
                                                        <font style="vertical-align: inherit;">R$ 69,69</font>
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
                                                        <font style="vertical-align: inherit;">R$ 69,69</font>
                                                    </font>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if ($payment == 'BOLETO')
                        <h1>Teste BOLETO</h1>
                        @endif

                        @if ($payment == 'CARTÃO')
                        <h1>Teste CARTÃO</h1>
                        @endif
                    </section>
                    <!--/ Content -->

                    <!-- Footer -->
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!--/ Content wrapper -->
            </div>

            <!--/ Layout container -->
        </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>


    <!--/ Layout wrapper -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->

    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="../../assets/vendor/libs/@algolia/autocomplete-js.js"></script>

    <script src="../../assets/vendor/libs/pickr/pickr.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/cleave-zen/cleave-zen.js"></script>

    <!-- Main JS -->

    <script src="../../assets/js/front-main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/pages-pricing.js"></script>
    <script src="../../assets/js/front-page-payment.js"></script>
</body>

</html>
