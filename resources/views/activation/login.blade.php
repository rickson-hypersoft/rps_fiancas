<html lang="en" class="layout-wide customizer-hide layout-navbar-fixed" dir="ltr" data-skin="default" data-template="horizontal-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Invicta - Inquilinos</title>
    <meta name="description" content="">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/favicon.ico')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/iconify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/node-waves/node-waves.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/pickr/pickr-themes.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/form-validation.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
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
    <script src="{{asset('assets/js/config.js')}}"></script>
    <style id="custom-css"></style>
</head>

<body style="--bs-scrollbar-width: 15px;">
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

                        <form id="formAuthentication" class="mb-4 fv-plugins-bootstrap5 fv-plugins-framework" method="POST" action="{{ route('activation.verify.login') }}">
                            @csrf
                            <input type="hidden" name="link" value="{{ $linkHash }}">
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
            </div>
        </div>
    </div>

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
    <script src="{{asset('assets/vendor/libs/@form-validation/popular.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/@form-validation/bootstrap5.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/@form-validation/auto-focus.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/pages-auth.js')}}"></script>
    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(document.getElementById('cpf'), {
            mask: '000.000.000-00'
        });
    </script>
</body>

</html>
