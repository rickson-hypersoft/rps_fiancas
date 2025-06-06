<html lang="en" class="layout-wide customizer-hide layout-navbar-fixed" dir="ltr" data-skin="default" data-template="horizontal-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Invicta - Inquilinos</title>

    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/favicon.ico')}}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/iconify-icons.css')}}">

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/node-waves/node-waves.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/pickr/pickr-themes.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}">

    <!-- endbuild -->

    <!-- Vendor -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/form-validation.css')}}">

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">

    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    <style type="text/css">
        .layout-menu-fixed .layout-navbar-full .layout-menu,
        .layout-menu-fixed-offcanvas .layout-navbar-full .layout-menu {
            top: 0px !important;
        }

        .layout-page {
            padding-top: 0px !important;
        }

        .content-wrapper {
            padding-bottom: 0px !important;
        }
    </style>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{asset('assets/vendor/js/template-customizer.js')}}"></script>
    <style>
        /*
* Template Customizer Style
**/
        #template-customizer {
            position: fixed;
            z-index: 99999999;
            display: flex;
            flex-direction: column;
            block-size: 100%;
            -webkit-box-direction: normal;
            -webkit-box-orient: vertical;
            box-shadow: 0 0.3125rem 1.375rem 0 rgba(34, 48, 62, 0.18);
            font-family: "Public Sans", -apple-system, blinkmacsystemfont, "Segoe UI", Oxygen, Ubuntu, Cantarell, "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
            font-size: inherit;
            inline-size: 400px;
            inset-block-start: 0;
            inset-inline-end: 0;
            transform: translateX(420px);
            transition: transform 0.2s ease-in;
            /* Color option styles */
            /* Font Icons sizing and alignments */
            /* border-color for hr */
            /* To update svg image's color */
            /* Customizer button */
            /* Customizer inner */
        }

        [data-bs-theme=dark] #template-customizer {
            box-shadow: 0 0.3125rem 1.375rem 0 rgba(20, 20, 29, 0.26);
        }

        #template-customizer h5 {
            position: relative;
            font-size: 11px;
        }

        #template-customizer .form-label {
            font-size: 0.9375rem;
            font-weight: 500;
        }

        #template-customizer .template-customizer-colors-options {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            margin: 0;
            gap: 0.3rem;
        }

        #template-customizer .template-customizer-colors-options .custom-option {
            inline-size: 50px;
        }

        #template-customizer .template-customizer-colors-options .custom-option .custom-option-content {
            padding: 0;
            min-block-size: 46px;
        }

        #template-customizer .template-customizer-colors-options .custom-option .custom-option-content .pcr-button {
            padding: 0.625rem;
            block-size: 30px;
            inline-size: 30px;
        }

        #template-customizer .template-customizer-colors-options .custom-option .custom-option-content .pcr-button::before,
        #template-customizer .template-customizer-colors-options .custom-option .custom-option-content .pcr-button::after {
            border-radius: 0.5rem;
        }

        #template-customizer .template-customizer-colors-options .custom-option .custom-option-content .pcr-button:focus {
            box-shadow: none;
        }

        #template-customizer .template-customizer-colors-options .custom-option-body {
            border-radius: 0.5rem;
            block-size: 30px;
            inline-size: 30px;
        }

        #template-customizer .custom-option-icon {
            padding: 0;
        }

        #template-customizer .custom-option-icon .custom-option-content {
            display: flex;
            align-items: center;
            justify-content: center;
            min-block-size: 50px;
        }

        #template-customizer hr {
            border-color: var(--bs-border-color);
        }

        #template-customizer .custom-option {
            border-width: 2px;
            margin: 0;
        }

        #template-customizer .custom-option.custom-option-image .custom-option-content .custom-option-body svg {
            inline-size: 100%;
        }

        #template-customizer.template-customizer-open {
            transform: none;
            transition-delay: 0.1s;
        }

        #template-customizer.template-customizer-open .template-customizer-theme .custom-option.checked {
            background-color: rgba(var(--bs-primary-rgb), 0.08);
        }

        #template-customizer.template-customizer-open .template-customizer-theme .custom-option.checked *,
        #template-customizer.template-customizer-open .template-customizer-theme .custom-option.checked *::before,
        #template-customizer.template-customizer-open .template-customizer-theme .custom-option.checked *::after {
            color: var(--bs-primary);
        }

        #template-customizer.template-customizer-open .custom-option.checked {
            border-width: 2px;
            color: var(--bs-primary);
        }

        #template-customizer.template-customizer-open .custom-option.checked .custom-option-content {
            border: none;
        }

        #template-customizer .template-customizer-header a:hover,
        #template-customizer .template-customizer-header a:hover .icon-base {
            color: inherit !important;
        }

        #template-customizer .template-customizer-open-btn {
            position: absolute;
            z-index: -1;
            display: block;
            background: var(--bs-primary);
            block-size: 38px;
            border-end-start-radius: 0.375rem;
            border-start-start-radius: 0.375rem;
            box-shadow: 0 0.125rem 0.25rem 0 rgba(var(--bs-primary-rgb), 0.4);
            color: #fff;
            font-size: 18px;
            inline-size: 38px;
            inset-block-start: 180px;
            inset-inline-start: 0;
            line-height: 38px;
            opacity: 1;
            text-align: center;
            transform: translateX(-58px);
            transition: all 0.1s linear 0.2s;
            /* Customizer Hidden */
        }

        #template-customizer .template-customizer-open-btn::before {
            position: absolute;
            display: block;
            background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAABClJREFUaEPtmY1RFEEQhbsjUCIQIhAiUCNQIxAiECIQIxAiECIAIpAMhAiECIQI2vquZqnZvp6fhb3SK5mqq6Ju92b69bzXf6is+dI1t1+eAfztG5z1BsxsU0S+ici2iPB3vm5E5EpEDlSVv2dZswFIxv8UkZcNy+5EZGcuEHMCOBeR951uvVDVD53vVl+bE8DvDu8Pxtyo6ta/BsByg1R15Bwzqz5/LJgn34CZwfnPInI4BUB6/1hV0cSjVxcAM4PbcBZjL0XklIPN7Is3fLCkdQPpPYw/VNXj5IhPIvJWRIhSl6p60ULWBGBm30Vk123EwRxCuIzWkkjNrCZywith10ewE1Xdq4GoAjCz/RTXW44Ynt+LyBEfT43kYfbj86J3w5Q32DNcRQDpwF+dkQXDMey8xem0L3TEqB4g3PZWad8agBMRgZPeu96D1/C2Zbh3X0p80Op1xxloztN48bMQQNoc7+eLEuAoPSPiIDY4Ooo+E6ixeNXM+D3GERz2U3CIqMstLJUgJQDe+7eq6mub0NYEkLAKwEHkiBQDCZtddZCZ8d6r7JDwFkoARklHRPZUFVDVZWbwGuNrC4EfdOzFrRABh3Wnqhv+d70AEBLGFROPmeHlnM81G69UdSd6IUuM0GgUVn1uqWmg5EmMfBeEyB7Pe3txBkY+rGT8j0J+WXq/BgDkUCaqLgEAnwcRog0veMIqFAAwCy2wnw+bI2GaGboBgF9k5N0o0rUSGUb4eO0BeO9j/GYhkSHMHMTIqwGARX6p6a+nlPBl8kZuXMD9j6pKfF9aZuaFOdJCEL5D4eYb9wCYVCanrBmGyii/tIq+SLj/HQBCaM5bLzwfPqdQ6FpVHyra4IbuVbXaY7dETC2ESPNNWiIOi69CcdgSMXsh4tNSUiklMgwmC0aNd08Y5WAES6HHehM4gu97wyhBgWpgqXsrASglprDy7CwhehMZOSbK6JMSma+Fio1KltCmlBIj7gfZOGx8ppQSXrhzFnOhJ/31BDkjFHRvOd09x0mRBA9SFgxUgHpQg0q0t5ymPMlL+EnldFTfDA0NAmf+OTQ0X0sRouf7NNkYGhrOYNrxtIaGg83MNzVDSe3LXLhP7O/yrCsCz1zlWTpjWkuZAOBpX3yVnLqI1yLCOKU6qMrmP7SSrUEw54XF4WBIK5FxCMOr3lVsfGqNSmPzBXUnJTIX1jyVBq9wO6UObOpgC5GjO98vFKnTdQMZXxEsWZlDiCZMIxAbNxQOqlpVZtobejBaZNoBnRDzMFpkxvTQOD36BlrcySZuI6p1ACB6LU3wWuf5581+oHfD1vi89bz3nFUC8Nm7ZlP3nKkFbM4bWPt/MSFwklprYItwt6cmvpWJ2IVcQBCz6bLysSCv3SaANCiTsnaNRrNRqMXVVT1/BrAqz/buu/Y38Ad3KC5PARej0QAAAABJRU5ErkJggg==);
            background-size: 100% 100%;
            block-size: 22px;
            content: "";
            inline-size: 22px;
            inset-block-start: 50%;
            inset-inline-start: 50%;
            transform: translate(-50%, -50%);
        }

        :dir(rtl) #template-customizer .template-customizer-open-btn::before {
            margin-inline-start: 2px;
            transform: translate(50%, -50%);
        }

        .customizer-hide #template-customizer .template-customizer-open-btn {
            display: none;
        }

        :dir(rtl) #template-customizer .template-customizer-open-btn {
            transform: translateX(58px);
        }

        #template-customizer.template-customizer-open .template-customizer-open-btn {
            opacity: 0;
            transform: none;
            transition-delay: 0s;
        }

        #template-customizer .template-customizer-inner {
            position: relative;
            overflow: auto;
            flex: 0 1 auto;
            -webkit-box-flex: 0;
            opacity: 1;
            transition: opacity 0.2s;
        }

        @media (max-width: 1200px) {
            #template-customizer {
                display: none;
                visibility: hidden;
            }
        }

        .layout-menu-100vh #template-customizer {
            block-size: 100dvh;
        }

        /* RTL */
        :dir(rtl) #template-customizer:not(.template-customizer-open) {
            transform: translateX(-420px);
        }
    </style>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="{{asset('assets/js/config.js')}}"></script>
    <style id="custom-css"></style>
</head>

<body style="--bs-scrollbar-width: 15px;">
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <!-- Login -->
                <div class="card">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="card-body">
                        <h4 class="mb-1">Que bom ter você na Invicta! 👋</h4>
                        <p class="mb-6">Falta pouco para ativar o seu contrato de fiança locatária. Realize o login para assinar o termo de adesão e efetuar o pagamento:</p>

                        <form id="formAuthentication" class="mb-4 fv-plugins-bootstrap5 fv-plugins-framework" method="POST" action="{{ route('assets.verify.login') }}">
                             @csrf
    <input type="hidden" name="link" value="{{ $link }}">
                            <div class="mb-6 form-control-validation fv-plugins-icon-container">
                                <label for="cpf" class="form-label">CPF:</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" autofocus="">
                                <span>Inserir o mesmo CPF informado pela imobiliária</span>
                            </div>

                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100 waves-effect waves-light" type="submit">Acessar</button>
                            </div>

                            <div class="mt-5 text-center">
                                <span>Precisa de ajuda?</span> <br>
                                <span>ou WhatsApp</span>
                            </div>
                            <input type="hidden">
                        </form>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>

    <!-- / Content -->

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
    <script src="{{asset('assets/vendor/libs/@form-validation/popular.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/@form-validation/bootstrap5.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/@form-validation/auto-focus.js')}}"></script>

    <!-- Main JS -->

    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('assets/js/pages-auth.js')}}"></script>
    <script src="https://unpkg.com/imask"></script>

    <script>
  IMask(document.getElementById('cpf'), {
            mask: '000.000.000-00'
        });
    </script>


    <div id="template-customizer" class="card rounded-0" style="visibility: visible"> <a href="javascript:void(0)" class="template-customizer-open-btn" tabindex="-1"></a>
        <div class="p-6 m-0 lh-1 border-bottom template-customizer-header position-relative py-4">
            <h6 class="template-customizer-t-panel_header mb-1">Template Customizer</h6>
            <p class="template-customizer-t-panel_sub_header mb-0 small">Customize and preview in real time</p>
            <div class="d-flex align-items-center gap-2 position-absolute end-0 top-0 mt-6 me-5"> <a href="javascript:void(0)" class="template-customizer-reset-btn text-heading" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reset Customizer"><i class="icon-base ti tabler-refresh icon-lg"></i><span class="badge rounded-pill bg-danger badge-dot badge-notifications"></span></a> <a href="javascript:void(0)" class="template-customizer-close-btn fw-light text-heading" tabindex="-1"> <i class="icon-base ti tabler-x icon-lg"></i> </a> </div>
        </div>
        <div class="template-customizer-inner pt-6">
            <div class="template-customizer-theming">
                <h5 class="m-0 px-6 pb-6"> <span class="template-customizer-t-theming_header bg-label-primary rounded-1 py-1 px-3 small">Theming</span> </h5>
                <div class="m-0 px-6 pb-6 template-customizer-color w-100"> <label for="customizerColor" class="form-label d-block template-customizer-t-color_label mb-2">Primary Color</label>
                    <div class="row template-customizer-colors-options">
                        <div class="form-check custom-option custom-option-icon mb-0 checked">
                            <label class="form-check-label custom-option-content p-0" for="colorRadioIconprimary">
                                <span class="custom-option-body mb-0 scaleX-n1-rtl" style="background-color: #7367f0;"></span>
                            </label>
                            <input name="colorRadioIcon" class="form-check-input d-none" type="radio" value="#7367f0" data-color="#7367f0" id="colorRadioIconprimary" checked="checked">
                        </div>
                        <div class="form-check custom-option custom-option-icon mb-0">
                            <label class="form-check-label custom-option-content p-0" for="colorRadioIconsuccess">
                                <span class="custom-option-body mb-0 scaleX-n1-rtl" style="background-color: #0D9394;"></span>
                            </label>
                            <input name="colorRadioIcon" class="form-check-input d-none" type="radio" value="#0D9394" data-color="#0D9394" id="colorRadioIconsuccess">
                        </div>
                        <div class="form-check custom-option custom-option-icon mb-0">
                            <label class="form-check-label custom-option-content p-0" for="colorRadioIconwarning">
                                <span class="custom-option-body mb-0 scaleX-n1-rtl" style="background-color: #FFAB1D;"></span>
                            </label>
                            <input name="colorRadioIcon" class="form-check-input d-none" type="radio" value="#FFAB1D" data-color="#FFAB1D" id="colorRadioIconwarning">
                        </div>
                        <div class="form-check custom-option custom-option-icon mb-0">
                            <label class="form-check-label custom-option-content p-0" for="colorRadioIcondanger">
                                <span class="custom-option-body mb-0 scaleX-n1-rtl" style="background-color: #EB3D63;"></span>
                            </label>
                            <input name="colorRadioIcon" class="form-check-input d-none" type="radio" value="#EB3D63" data-color="#EB3D63" id="colorRadioIcondanger">
                        </div>
                        <div class="form-check custom-option custom-option-icon mb-0">
                            <label class="form-check-label custom-option-content p-0" for="colorRadioIconinfo">
                                <span class="custom-option-body mb-0 scaleX-n1-rtl" style="background-color: #2092EC;"></span>
                            </label>
                            <input name="colorRadioIcon" class="form-check-input d-none" type="radio" value="#2092EC" data-color="#2092EC" id="colorRadioIconinfo">
                        </div>
                        <div class="form-check custom-option custom-option-icon mb-0"><label class="form-check-label custom-option-content" for="colorRadioIcon">
                                <div class="pickr">

                                    <button type="button" class="pcr-button ti tabler-color-picker" role="button" aria-label="toggle color picker dialog" style="transition: none; --pcr-color: rgba(255, 73, 97, 1);"></button>


                                </div>
                            </label><input name="colorRadioIcon" class="form-check-input picker d-none" type="radio" value="picker" id="colorRadioIcon"> </div>
                    </div>
                </div>
                <div class="m-0 px-6 pb-6 template-customizer-theme w-100"> <label for="customizerTheme" class="form-label d-block template-customizer-t-theme_label mb-2">Theme</label>
                    <div class="row px-1 template-customizer-themes-options">
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon mb-0 checked">
                                <label class="form-check-label custom-option-content p-0" for="customRadioIconlight">
                                    <span class="custom-option-body mb-0 scaleX-n1-rtl"><i class="ti tabler-sun icon-base mb-0"></i></span>
                                </label>
                                <input name="customRadioIcon" class="form-check-input d-none" type="radio" value="light" id="customRadioIconlight" checked="checked">
                            </div>
                            <label class="form-check-label small text-nowrap text-body" for="customRadioIconlight">Light</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon mb-0">
                                <label class="form-check-label custom-option-content p-0" for="customRadioIcondark">
                                    <span class="custom-option-body mb-0 scaleX-n1-rtl"><i class="ti tabler-moon icon-base mb-0"></i></span>
                                </label>
                                <input name="customRadioIcon" class="form-check-input d-none" type="radio" value="dark" id="customRadioIcondark">
                            </div>
                            <label class="form-check-label small text-nowrap text-body" for="customRadioIcondark">Dark</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-icon mb-0">
                                <label class="form-check-label custom-option-content p-0" for="customRadioIconsystem">
                                    <span class="custom-option-body mb-0 scaleX-n1-rtl"><i class="ti tabler-device-desktop-analytics icon-base mb-0"></i></span>
                                </label>
                                <input name="customRadioIcon" class="form-check-input d-none" type="radio" value="system" id="customRadioIconsystem">
                            </div>
                            <label class="form-check-label small text-nowrap text-body" for="customRadioIconsystem">System</label>
                        </div>
                    </div>
                </div>
                <div class="m-0 px-6 pb-6 template-customizer-skins w-100"> <label for="customizerSkin" class="form-label template-customizer-t-skin_label mb-2">Skins</label>
                    <div class="row px-1 template-customizer-skins-options">
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0 checked">
                                <label class="form-check-label custom-option-content p-0" for="skinRadiosdefault">
                                    <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
                                </label>
                                <input name="skinRadios" class="form-check-input d-none" type="radio" value="default" id="skinRadiosdefault" checked="checked">
                            </div>
                            <label class="form-check-label small text-nowrap text-body" for="skinRadiosdefault">Default</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0">
                                <label class="form-check-label custom-option-content p-0" for="skinRadiosbordered">
                                    <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
                                </label>
                                <input name="skinRadios" class="form-check-input d-none" type="radio" value="bordered" id="skinRadiosbordered">
                            </div>
                            <label class="form-check-label small text-nowrap text-body" for="skinRadiosbordered">Bordered</label>
                        </div>
                    </div>
                </div>
                <div class="m-0 px-6 template-customizer-semiDark w-100 d-flex justify-content-between pe-12"> <span class="form-label template-customizer-t-semiDark_label">Semi Dark</span> <label class="switch template-customizer-t-semiDark_label"> <input type="checkbox" class="template-customizer-semi-dark-switch switch-input"> <span class="switch-toggle-slider"> <span class="switch-on"></span> <span class="switch-off"></span> </span> </label> </div>
                <hr class="m-0 px-6 my-6">
            </div>
            <div class="template-customizer-layout">
                <h5 class="m-0 px-6 pb-6"> <span class="template-customizer-t-layout_header bg-label-primary rounded-2 py-1 px-3 small">Layout</span> </h5>
                <div class="m-0 px-6 pb-6 d-block template-customizer-layouts"> <label for="customizerStyle" class="form-label d-block template-customizer-t-layout_label mb-2">Menu (Navigation)</label>
                    <div class="row px-1 template-customizer-layouts-options">
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0 checked">
                                <label class="form-check-label custom-option-content p-0" for="layoutsRadiosexpanded">
                                    <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
                                </label>
                                <input name="layoutsRadios" class="form-check-input d-none" type="radio" value="expanded" id="layoutsRadiosexpanded" checked="checked">
                            </div>
                            <label class="form-check-label small text-nowrap text-body" for="layoutsRadiosexpanded">Expanded</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0">
                                <label class="form-check-label custom-option-content p-0" for="layoutsRadioscollapsed">
                                    <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
                                </label>
                                <input name="layoutsRadios" class="form-check-input d-none" type="radio" value="collapsed" id="layoutsRadioscollapsed">
                            </div>
                            <label class="form-check-label small text-nowrap text-body" for="layoutsRadioscollapsed">Collapsed</label>
                        </div>
                    </div>
                </div>
                <div class="m-0 px-6 pb-6 template-customizer-headerOptions w-100"> <label for="customizerHeader" class="form-label template-customizer-t-layout_header_label mb-2">Header Types</label>
                    <div class="row px-1 template-customizer-header-options">
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0">
                                <label class="form-check-label custom-option-content p-0" for="headerRadioIconfixed">
                                    <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
                                </label>
                                <input name="headerRadioIcon" class="form-check-input d-none" type="radio" value="fixed" id="headerRadioIconfixed">
                            </div>
                            <label class="form-check-label small text-nowrap text-body" for="headerRadioIconfixed">Fixed</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0 checked">
                                <label class="form-check-label custom-option-content p-0" for="headerRadioIconstatic">
                                    <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
                                </label>
                                <input name="headerRadioIcon" class="form-check-input d-none" type="radio" value="static" id="headerRadioIconstatic" checked="checked">
                            </div>
                            <label class="form-check-label small text-nowrap text-body" for="headerRadioIconstatic">Static</label>
                        </div>
                    </div>
                </div>
                <div class="m-0 px-6 pb-6 template-customizer-content w-100"> <label for="customizerContent" class="form-label template-customizer-t-content_label mb-2">Content</label>
                    <div class="row px-1 template-customizer-content-options">
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0">
                                <label class="form-check-label custom-option-content p-0" for="contentRadioIconcompact">
                                    <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
                                </label>
                                <input name="contentRadioIcon" class="form-check-input d-none" type="radio" value="compact" id="contentRadioIconcompact">
                            </div>
                            <label class="form-check-label small text-nowrap text-body" for="contentRadioIconcompact">Compact</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0 checked">
                                <label class="form-check-label custom-option-content p-0" for="contentRadioIconwide">
                                    <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
                                </label>
                                <input name="contentRadioIcon" class="form-check-input d-none" type="radio" value="wide" id="contentRadioIconwide" checked="checked">
                            </div>
                            <label class="form-check-label small text-nowrap text-body" for="contentRadioIconwide">Wide</label>
                        </div>
                    </div>
                </div>
                <div class="m-0 px-6 pb-6 template-customizer-directions w-100"> <label for="customizerDirection" class="form-label template-customizer-t-direction_label mb-2">Direction</label>
                    <div class="row px-1 template-customizer-directions-options">
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0 checked">
                                <label class="form-check-label custom-option-content p-0" for="directionRadioIconltr">
                                    <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
                                </label>
                                <input name="directionRadioIcon" class="form-check-input d-none" type="radio" value="ltr" id="directionRadioIconltr" checked="checked">
                            </div>
                            <label class="form-check-label small text-nowrap text-body" for="directionRadioIconltr">Left to Right (En)</label>
                        </div>
                        <div class="col-4 px-2">
                            <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0">
                                <label class="form-check-label custom-option-content p-0" for="directionRadioIconrtl">
                                    <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
                                </label>
                                <input name="directionRadioIcon" class="form-check-input d-none" type="radio" value="rtl" id="directionRadioIconrtl">
                            </div>
                            <label class="form-check-label small text-nowrap text-body" for="directionRadioIconrtl">Right to Left (Ar)</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pcr-app " data-theme="nano" aria-label="color picker dialog" role="window" style="top: 263.438px; left: 661.125px;">
        <div class="pcr-selection">
            <div class="pcr-color-preview">
                <button type="button" class="pcr-last-color" aria-label="use previous color" style="transition: none; --pcr-color: rgba(255, 73, 97, 1);"></button>
                <div class="pcr-current-color" style="--pcr-color: rgba(255, 73, 97, 1);"></div>
            </div>

            <div class="pcr-color-palette">
                <div class="pcr-picker" style="left: calc(71.3725% - 9px); top: calc(0% - 9px); background: rgb(255, 73, 97);"></div>
                <div class="pcr-palette" tabindex="0" aria-label="color selection area" role="listbox" style="background: linear-gradient(to top, rgb(0, 0, 0), transparent), linear-gradient(to left, rgb(255, 0, 34), rgb(255, 255, 255));"></div>
            </div>

            <div class="pcr-color-chooser">
                <div class="pcr-picker" style="left: calc(97.8022% - 9px); background-color: rgb(255, 0, 34);"></div>
                <div class="pcr-hue pcr-slider" tabindex="0" aria-label="hue selection slider" role="slider"></div>
            </div>

            <div class="pcr-color-opacity" style="display:none" hidden="">
                <div class="pcr-picker"></div>
                <div class="pcr-opacity pcr-slider" tabindex="0" aria-label="selection slider" role="slider"></div>
            </div>
        </div>

        <div class="pcr-swatches "></div>

        <div class="pcr-interaction">
            <input class="pcr-result" type="text" spellcheck="false" aria-label="color input field">

            <input class="pcr-type active" data-type="HEXA" value="HEXA" type="button" style="display:none" hidden="">
            <input class="pcr-type" data-type="RGBA" value="RGBA" type="button" style="display:none" hidden="">
            <input class="pcr-type" data-type="HSLA" value="HSLA" type="button" style="display:none" hidden="">
            <input class="pcr-type" data-type="HSVA" value="HSVA" type="button" style="display:none" hidden="">
            <input class="pcr-type" data-type="CMYK" value="CMYK" type="button" style="display:none" hidden="">

            <input class="pcr-save" value="Save" type="button" style="display:none" hidden="" aria-label="save and close">
            <input class="pcr-cancel" value="Cancel" type="button" style="display:none" hidden="" aria-label="cancel and close">
            <input class="pcr-clear" value="Clear" type="button" style="display:none" hidden="" aria-label="clear and close">
        </div>
    </div>
</body>

</html>
