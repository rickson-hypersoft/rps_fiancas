<!doctype html>

<html lang="en" class="layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-skin="default" data-assets-path="../../assets/" data-template="horizontal-menu-template" data-bs-theme="light">

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
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
</head>

<body>
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <div class="layout-page">
                <div class="content-wrapper">
                    <div class="d-flex flex-column justify-content-center align-items-center min-vh-100 bg-light">
                        <div class="card d-flex justify-content-center align-items-center">
                            <div class="card-header d-flex flex-column align-items-center">
                                <h3 class="my-3 text-center" style="max-width: 30ch">Mais segurança na ativação do seu contrato</h3>
                                <p class="text-body-secondary text-center" style="max-width: 50ch">Precisamos de um documento para validarmos
                                    alguns dados não vai demorar muito</p>
                            </div>
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="d-flex m-3 align-items-center">
                                    <img src="https://cdn-icons-png.flaticon.com/512/12689/12689789.png" alt="face-scan-icon" width="180" height="180">
                                </div>
                                <div class="my-6">
                                    <div class="d-flex align-items-middle">
                                        <i class="menu-icon icon-base ti tabler-check text-success"></i>
                                        <h6 style="opacity: 75%;">É necessario o cadastro ser feito pelo
                                            portador do cpf cadastrado</h6>
                                    </div>
                                    <div class="d-flex align-items-middle">
                                        <i class="menu-icon icon-base ti tabler-check text-success"></i>
                                        <h6 style="opacity: 75%;">Encontre um lugar com uma boa
                                            iluminação</h6>
                                    </div>
                                    <div class="d-flex align-items-middle">
                                        <i class="menu-icon icon-base ti tabler-check text-success"></i>
                                        <h6 style="opacity: 75%;">Mantenha uma expressão neutra</h6>
                                    </div>
                                    <div class="d-flex align-items-middle">
                                        <i class="menu-icon icon-base ti tabler-check text-success"></i>
                                        <h6 style="opacity: 75%;">Evite o uso de acessorios faciais</h6>
                                    </div>
                                </div>
                                <a href="{{ route('activation.faceId', ['linkHash' => $linkHash]) }}" class="btn btn-primary waves-effect waves-light">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-2">Continuar</span>
                                    <i class="icon-base ti tabler-arrow-right icon-xs"></i>
                                </a>
                                <!--
                                    <p class="mt-8"> Os dados serão coletados segundo os termos da <a
                                        href="#">Política de Privacidade</a></p>
                                    -->
                            </div>
                        </div>
                    </div>

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>
    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/node-waves/node-waves.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/@algolia/autocomplete-js.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/pickr/pickr.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/hammer/hammer.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/i18n/i18n.js')}}"></script>
    <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/cleave-zen/cleave-zen.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/form-layouts.js')}}"></script>
</body>

</html>