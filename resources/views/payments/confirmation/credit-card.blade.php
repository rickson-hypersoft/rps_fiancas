
<!doctype html>

<html
  lang="en"
  class="layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-skin="default"
  data-assets-path="../../assets/"
  data-template="horizontal-menu-template"
  data-bs-theme="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Demo: Vertical Layouts - Forms | Vuexy - Bootstrap Dashboard PRO</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
    rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/iconify-icons.css')}}" />


    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/node-waves/node-waves.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/pickr/pickr-themes.css')}}" />

    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <style>
      @media (max-width: 612px){
        .full {
          height: 100vh;
        }
      }
    </style>
    <!-- endbuild -->

    <link rel="stylesheet" href="../../assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/select2/select2.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
      <div class="layout-container">
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
              <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light full">
                <div class="card p-4 text-center full" style="max-width: 480px; width: 100%;">
                  <div class="d-flex justify-content-center">
                    <img class="mb-3" height="100" width="100" src="https://cdn2.iconfinder.com/data/icons/greenline/512/check-1024.png" />
                  </div>
                  <h4 class="mb-4">Pagamento Efetuado</h4>

                  @foreach ($paymentInfo as $info)
                  <p class="text-start fw-bold">PAGAMENTO 1</p>
                  <div class="card mb-3" style="border-radius: 10px; border: 2px solid rgb(180, 55, 180, 0.7)">
                    <div class="card-body p-3">
                      <div class="d-flex align-items-center mb-2">
                        <i class="icon-base ti tabler-circle-check"></i>
                        <strong class="me-auto">Taxa Serviço</strong>
                        <span class="fw-semibold">R$ {{$info['value']}}</span>
                      </div>
                      <div class="text-start">
                        <p class="mb-1"><strong class="text-primary">{{$info['creditCard']['creditCardBrand']}}</strong> Cartão: **** **** **** {{$info['creditCard']['creditCardNumber']}}</p>
                        <p class="mb-1">12 parcela(s) de R$ 80,00</p>
                        <p>Próxima cobrança: {{$info['creditDate']}}</p>
                      </div>
                    </div>
                  </div>
                   @endforeach

                  <p class="text-start fw-bold">PAGAMENTO 2</p>
                  <div class="card mb-3" style="border-radius: 10px; border: 2px solid rgb(180, 55, 180, 0.7)">
                    <div class="card-body p-3">
                      <div class="d-flex align-items-center mb-2">
                        <i class="icon-base ti tabler-circle-check"></i>
                        <strong class="me-auto">Taxa Setup</strong>
                        <span class="fw-semibold">R$ 30,00</span>
                      </div>
                      <div class="text-start">
                        <p class="mb-1"><strong class="text-primary">VISA</strong> Cartão: **** **** **** 1481</p>
                        <p class="mb-1">2 parcela(s) de R$ 15,00</p>
                        <p>Próxima cobrança: 03/07/2025</p>
                      </div>
                    </div>
                  </div>

                  <div class="card bg-light mt-3 p-3 text-start">
                    <p class="mb-1 d-flex justify-content-between">
                      <span>Taxa Serviço</span>
                      <strong>R$ 960,00</strong>
                    </p>
                    <p class="mb-1 d-flex justify-content-between">
                      <span>Taxa Setup</span>
                      <strong>R$ 30,00</strong>
                    </p>
                    <hr />
                    <p class="mb-0 d-flex justify-content-between fw-bold">
                      <span>Total</span>
                      <span style="color: rgb(180, 55, 180)">R$ 990,00</span>
                    </p>
                  </div>
                </div>

              </div>
            <!--/ Content -->
            <div class="content-backdrop fade"></div>
          </div>
          <!--/ Content wrapper -->
        </div>
        <!--/ Layout container -->
      </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!--/ Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->

    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>

    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="../../assets/vendor/libs/@algolia/autocomplete-js.js"></script>

    <script src="../../assets/vendor/libs/pickr/pickr.js"></script>

    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>

    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/cleave-zen/cleave-zen.js"></script>
    <script src="../../assets/vendor/libs/moment/moment.js"></script>
    <script src="../../assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="../../assets/vendor/libs/select2/select2.js"></script>

    <!-- Main JS -->

    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/form-layouts.js"></script>
  </body>
</html>
