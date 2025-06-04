<html lang="en" class="layout-menu-fixed layout-compact" dir="ltr" data-skin="default" data-assets-path="../../assets/" data-template="horizontal-menu-template-no-customizer" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Invicta</title>

    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/favicon.ico')}}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/iconify-icons.css')}}">
    <script src="https://kit.fontawesome.com/e52263f0c5.js" crossorigin="anonymous"></script>
    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/node-waves/node-waves.css')}}">

    <link rel="stylesheet" href=".{{asset('assets/vendor/libs/pickr/pickr-themes.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/spinkit/spinkit.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/notiflix/notiflix.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/form-validation.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}">
    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/swiper/swiper.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-advance.css')}}" />
    <!-- endbuild -->

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    <style type="text/css">
        .layout-menu-fixed .layout-navbar-full .layout-menu,
        .layout-menu-fixed-offcanvas .layout-navbar-full .layout-menu {
            top: 56px !important;
        }

        .layout-page {
            padding-top: 56px !important;
        }

        .content-wrapper {
            padding-bottom: 54px !important;
        }
    </style>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="{{asset('assets/js/config.js')}}"></script>
</head>

<body style="--bs-scrollbar-width: 15px;">

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            <!-- Navbar -->
            @include('components.menu', ['user' => session('user'), 'realEstateSectorOrCompany' => session('realEstateSectorOrCompany')])
            <!-- / Navbar -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Menu -->
                    <aside id="layout-menu" class="bg-dark layout-menu-horizontal menu-horizontal menu flex-grow-0" data-bs-theme="dark">
                        <div class="container-xxl d-flex h-100">
                            <ul class="menu-inner">
                                <li class="menu-item">
                                    <a href="javascript:void(0)" class="menu-link">
                                        <i class="menu-icon icon-base ti tabler-home"></i>
                                        <div data-i18n="Home">Home</div>
                                    </a>
                                </li>

                                <!-- Administrativo -->
                                @if(session('user')['categoria'] == 'Fianças')
                                <li class="menu-item {{ request()->is('adm/empresa*', 'adm/imobiliarias*', 'adm/usuarios*') ? 'active' : '' }}">
                                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                                        <i class="menu-icon icon-base ti tabler-smart-home"></i>
                                        <div data-i18n="Administrativo">Administrativo</div>
                                    </a>
                                    <ul class="menu-sub">
                                        <li class="menu-item {{ request()->routeIs('company.index') ? 'active' : '' }}">
                                            <a href="{{route('company.index')}}" class="menu-link ">
                                                <div data-i18n="Minha Empresa">Minha Empresa</div>
                                            </a>
                                        </li>
                                        <li class="menu-item {{ request()->routeIs('realestatesector.index') ? 'active' : '' }}">
                                            <a href="{{route('realestatesector.index')}}" class="menu-link">
                                                <div data-i18n="Imobiliárias">Imobiliárias</div>
                                            </a>
                                        </li>
                                        <li class="menu-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
                                            <a href="{{route('user.index')}}" class="menu-link">
                                                <div data-i18n="Usuários">Usuários</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endif

                                <!-- Propostas -->
                                <li class="menu-item {{ request()->is('propostas*') ? 'active' : '' }}">
                                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                                        <i class="menu-icon icon-base ti tabler-file-like"></i>
                                        <div data-i18n="Propostas">Propostas</div>
                                    </a>
                                    <ul class="menu-sub">
                                        <li class="menu-item {{ request()->routeIs('propostal.create') ? 'active' : '' }}">
                                            <a href="{{route('propostal.create')}}" class="menu-link">
                                                <div data-i18n="Criar Proposta">Criar Proposta</div>
                                            </a>
                                        </li>
                                        <li class="menu-item {{ request()->routeIs('propostal.index') ? 'active' : '' }}">
                                            <a href="{{route('propostal.index')}}" class="menu-link">
                                                <div data-i18n="Acompanhar">Acompanhar</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Contratos -->
                                <li class="menu-item {{ request()->is('Contratos*') ? 'active' : '' }}">
                                    <a href="javascript:void(0)" class="menu-link menu-toggle">

                                        <i class="menu-icon icon-base ti tabler-file-check"></i>
                                        <div data-i18n="Contratos">Contratos</div>
                                    </a>
                                    <ul class="menu-sub">
                                        <li class="menu-item">
                                            <a href="" class="menu-link">
                                                <div data-i18n="Acompanhar">Acompanhar</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="#" class="menu-link">
                                                <div data-i18n="Renovações">Renovações</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="#" class="menu-link">
                                                <div data-i18n="Inadimplências">Inadimplências</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                @if(session('user')['categoria'] == 'Imobiliária')
                                <!-- Financeiro -->
                                <li class="menu-item {{ request()->is('imobiliaria/financeiro*', 'imobiliaria/categoria') ? 'active' : '' }}">
                                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                                        <i class="menu-icon icon-base ti tabler-file-dollar"></i>
                                        <div data-i18n="Financeiro">Financeiro</div>
                                    </a>
                                    <ul class="menu-sub">
                                        <li class="menu-item {{ request()->routeIs('financial.financial_account.index') ? 'active' : '' }}">
                                            <a href="{{route('financial.financial_account.index')}}" class="menu-link">
                                                <div data-i18n="Contas">Contas</div>
                                            </a>
                                        </li>
                                        <li class="menu-item {{ request()->routeIs('financial.financial_category.index') ? 'active' : '' }}">
                                            <a href="{{route('financial.financial_category.index')}}" class="menu-link">
                                                <div data-i18n="Categorias">Categorias</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="#" class="menu-link">
                                                <div data-i18n="Lançamentos">Lançamentos</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endif

                                <!-- Relatórios -->
                                <li class="menu-item">
                                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                                        <i class="menu-icon icon-base ti tabler-printer"></i>
                                        <div data-i18n="Relatórios">Relatórios</div>
                                    </a>
                                    <ul class="menu-sub">
                                        <li class="menu-item">
                                            <a href="#" class="menu-link">
                                                <div data-i18n="Minhas Comissões">Minhas Comissões</div>
                                            </a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="#" class="menu-link">
                                                <div data-i18n="Financeiro">Financeiro</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </aside>
                    <!-- / Menu -->

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            @yield('content')
                        </div>
                    </div>
                    <!--/ Content -->

                    <!-- Footer -->
                    <!--
                    <footer class="content-footer footer bg-footer-theme" style="background: #2f3349;" data-bs-theme="dark">
                        <div class="container-xxl">
                            <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="text-body">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with ❤️ by <a href="https://pixinvent.com" target="_blank" class="footer-link">Pixinvent</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                -->
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

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!--/ Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->
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

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
    <script src="{{asset('assets/js/cards-advance.js')}}"></script>
    <script src="{{asset('assets/js/app-ecommerce-dashboard.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script>
    <script src="{{asset('assets/js/forms-file-upload.js')}}"></script>
    <script src=".{{asset('assets/js/form-layouts.js')}}"></script>
    <script src="{{asset('assets/js/dashboards-crm.js')}}"></script>
    <script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/bs-stepper/bs-stepper.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/@form-validation/popular.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/@form-validation/bootstrap5.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/@form-validation/auto-focus.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/form-wizard-numbered.js')}}"></script>
    <script src="{{asset('assets/js/form-wizard-validation.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/cleave-zen/cleave-zen.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
    <script src="{{asset('assets/js/cards-actions.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/sortablejs/sortable.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/notiflix/notiflix.js')}}"></script>
    <script src="https://unpkg.com/imask"></script>
    @yield('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('theme-toggle-btn');
            const icon = document.getElementById('theme-icon');

            // Recupera tema e ícone salvos
            const savedTheme = localStorage.getItem('theme');
            const savedIcon = localStorage.getItem('themeIcon');

            // Aplica tema e ícone salvos, ou usa padrão
            if (savedTheme && savedIcon) {
                document.documentElement.setAttribute('data-bs-theme', savedTheme);
                icon.classList.add(savedIcon);
            } else {
                // Tema padrão: claro com ícone de sol
                document.documentElement.setAttribute('data-bs-theme', 'light');
                icon.classList.add('tabler-sun');
                localStorage.setItem('theme', 'light');
                localStorage.setItem('themeIcon', 'tabler-sun');
            }

            // Função para alternar tema e salvar no localStorage
            function toggleTheme() {
                const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';

                if (isDark) {
                    // Muda para light
                    document.documentElement.setAttribute('data-bs-theme', 'light');
                    icon.classList.remove('tabler-moon-stars');
                    icon.classList.add('tabler-sun');
                    localStorage.setItem('theme', 'light');
                    localStorage.setItem('themeIcon', 'tabler-sun');
                } else {
                    // Muda para dark
                    document.documentElement.setAttribute('data-bs-theme', 'dark');
                    icon.classList.remove('tabler-sun');
                    icon.classList.add('tabler-moon-stars');
                    localStorage.setItem('theme', 'dark');
                    localStorage.setItem('themeIcon', 'tabler-moon-stars');
                }
            }

            toggleBtn.addEventListener('click', toggleTheme);
        });

        document.getElementById('upload').addEventListener('change', function (event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('uploadedAvatar').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
</body>

</html>