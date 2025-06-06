
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

    <title>Invicta - Inquilinos</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

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

    <link rel="stylesheet" href="../../assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/select2/select2.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

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
            <div class="row mb-6 gy-6 d-flex align-self-center p-8">
              <div class="col-xl">
                  <div class="card d-flex flex-column align-items-center"  style="height: 600px">
                    <div class="card-header d-flex flex-column align-items-center mt-5">
                      <h4 class="mb-2 text-center ">Mais segurança na ativação  do seu contrato</h4>
                      <h5 class="text-body-secondary text-center">Precisamos de um documento para validarmos alguns dados não vai demorar muito</h5>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                      <div class="d-flex">
                        <img src="https://static.thenounproject.com/png/face-id-mobile-scan-icon-3388350-512.png" alt="face-scan-icon" width="58" height="58">
                        <img src="https://uxwing.com/wp-content/themes/uxwing/download/arts-graphic-shapes/verified-symbol-icon.png" alt="veriify-icon" width="58" height="58">
                      </div>
                      <div class="my-6">
                        <div class="d-flex align-items-center">
                          <img src="https://www.svgrepo.com/show/474769/checkmark.svg" height="28" width="28" style="opacity: 40%;">
                          <h6 class="mx-3" style="opacity: 75%;">É necessario o cadastro ser feito pelo portador do cpf cadastrado</h6>
                        </div>
                        <div class="d-flex align-items-center">
                          <img src="https://www.svgrepo.com/show/474769/checkmark.svg" height="28" width="28" style="opacity: 40%;">
                          <h6 class="mx-3" style="opacity: 75%;">Encontre um lugar com uma boa iluminação</h6>
                        </div>
                        <div class="d-flex align-items-center">
                          <img src="https://www.svgrepo.com/show/474769/checkmark.svg" height="28" width="28" style="opacity: 40%;">
                          <h6 class="mx-3" style="opacity: 75%;">Mantenha uma expressão neutra</h6>
                        </div>
                        <div class="d-flex align-items-center">
                          <img src="https://www.svgrepo.com/show/474769/checkmark.svg" height="28" width="28" style="opacity: 40%;">
                          <h6 class="mx-3" style="opacity: 75%;">Evite o uso de acessorios faciais</h6>
                        </div>
                      </div>
                      <a href="{{route('assets.active', ['link' => $link])}}" class="btn btn-primary waves-effect waves-light">Continuar</a>
                    </div>
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
