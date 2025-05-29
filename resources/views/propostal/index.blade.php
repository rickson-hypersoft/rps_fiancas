<html lang="en" class="layout-compact layout-menu-fixed layout-navbar-fixed" dir="ltr" data-skin="default" data-assets-path="../../assets/" data-template="horizontal-menu-template" data-bs-theme="light"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Demo: File upload - Forms | Vuexy - Bootstrap Dashboard PRO</title>

    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/vendor/fonts/iconify-icons.css">

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css">

    <link rel="stylesheet" href="../../assets/vendor/libs/pickr/pickr-themes.css">

    <link rel="stylesheet" href="../../assets/vendor/css/core.css">
    <link rel="stylesheet" href="../../assets/css/demo.css">

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">

    <!-- endbuild -->

    <link rel="stylesheet" href="../../assets/vendor/libs/dropzone/dropzone.css">

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script><style type="text/css">
.layout-menu-fixed .layout-navbar-full .layout-menu,
.layout-menu-fixed-offcanvas .layout-navbar-full .layout-menu {
  top: 56px !important;
}
.layout-page {
  padding-top: 56px !important;
}
.content-wrapper {
  padding-bottom: 54px !important;
}</style>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script><style>/*
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
#template-customizer .template-customizer-colors-options .custom-option .custom-option-content .pcr-button::before, #template-customizer .template-customizer-colors-options .custom-option .custom-option-content .pcr-button::after {
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
}</style>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="../../assets/js/config.js"></script><style id="custom-css"></style>
  </head>

  <body style="--bs-scrollbar-width: 15px;">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
      <div class="layout-container">
        <!-- Navbar -->

        <nav class="layout-navbar navbar navbar-expand-xl align-items-center" id="layout-navbar">
          <div class="container-xxl">


            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="icon-base ti tabler-menu-2 icon-md"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
              <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                <!-- Search -->
                <li class="nav-item navbar-search-wrapper btn btn-text-secondary btn-icon rounded-pill waves-effect">
                  <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                    <span class="d-inline-block text-body-secondary fw-normal" id="autocomplete"></span>
                  </a>
                </li>
                <!-- /Search -->

                <li class="nav-item dropdown-language dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill waves-effect" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <i class="icon-base ti tabler-language icon-22px text-heading"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item waves-effect active" href="javascript:void(0);" data-language="en" data-text-direction="ltr">
                        <span>English</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" data-language="fr" data-text-direction="ltr">
                        <span>French</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" data-language="ar" data-text-direction="rtl">
                        <span>Arabic</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item waves-effect" href="javascript:void(0);" data-language="de" data-text-direction="ltr">
                        <span>German</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ Language -->

                <!-- Style Switcher -->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill waves-effect" id="nav-theme" href="javascript:void(0);" data-bs-toggle="dropdown" aria-label="Toggle theme (light)">
                    <i class="tabler-sun icon-base ti icon-22px theme-icon-active text-heading"></i>
                    <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                    <li>
                      <button type="button" class="dropdown-item align-items-center waves-effect active" data-bs-theme-value="light" aria-pressed="true">
                        <span><i class="icon-base ti tabler-sun icon-22px me-3" data-icon="sun"></i>Light</span>
                      </button>
                    </li>
                    <li>
                      <button type="button" class="dropdown-item align-items-center waves-effect" data-bs-theme-value="dark" aria-pressed="false">
                        <span><i class="icon-base ti tabler-moon-stars icon-22px me-3" data-icon="moon-stars"></i>Dark</span>
                      </button>
                    </li>
                    <li>
                      <button type="button" class="dropdown-item align-items-center waves-effect" data-bs-theme-value="system" aria-pressed="false">
                        <span><i class="icon-base ti tabler-device-desktop-analytics icon-22px me-3" data-icon="device-desktop-analytics"></i>System</span>
                      </button>
                    </li>
                  </ul>
                </li>
                <!-- / Style Switcher-->

                <!-- Quick links  -->
                <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill waves-effect" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <i class="icon-base ti tabler-layout-grid-add icon-22px text-heading"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-end p-0">
                    <div class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h6 class="mb-0 me-auto">Shortcuts</h6>
                        <a href="javascript:void(0)" class="dropdown-shortcuts-add py-2 btn btn-text-secondary rounded-pill btn-icon waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Add shortcuts" data-bs-original-title="Add shortcuts"><i class="icon-base ti tabler-plus icon-20px text-heading"></i></a>
                      </div>
                    </div>
                    <div class="dropdown-shortcuts-list scrollable-container ps">
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-calendar icon-26px text-heading"></i>
                          </span>
                          <a href="app-calendar.html" class="stretched-link">Calendar</a>
                          <small>Appointments</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-file-dollar icon-26px text-heading"></i>
                          </span>
                          <a href="app-invoice-list.html" class="stretched-link">Invoice App</a>
                          <small>Manage Accounts</small>
                        </div>
                      </div>
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-user icon-26px text-heading"></i>
                          </span>
                          <a href="app-user-list.html" class="stretched-link">User App</a>
                          <small>Manage Users</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-users icon-26px text-heading"></i>
                          </span>
                          <a href="app-access-roles.html" class="stretched-link">Role Management</a>
                          <small>Permission</small>
                        </div>
                      </div>
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-device-desktop-analytics icon-26px text-heading"></i>
                          </span>
                          <a href="index.html" class="stretched-link">Dashboard</a>
                          <small>User Dashboard</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-settings icon-26px text-heading"></i>
                          </span>
                          <a href="pages-account-settings-account.html" class="stretched-link">Setting</a>
                          <small>Account Settings</small>
                        </div>
                      </div>
                      <div class="row row-bordered overflow-visible g-0">
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-help-circle icon-26px text-heading"></i>
                          </span>
                          <a href="pages-faq.html" class="stretched-link">FAQs</a>
                          <small>FAQs &amp; Articles</small>
                        </div>
                        <div class="dropdown-shortcuts-item col">
                          <span class="dropdown-shortcuts-icon rounded-circle mb-3">
                            <i class="icon-base ti tabler-square icon-26px text-heading"></i>
                          </span>
                          <a href="modal-examples.html" class="stretched-link">Modals</a>
                          <small>Useful Popups</small>
                        </div>
                      </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                  </div>
                </li>
                <!-- Quick links -->

                <!-- Notification -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                  <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill waves-effect" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <span class="position-relative">
                      <i class="icon-base ti tabler-bell icon-22px text-heading"></i>
                      <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end p-0">
                    <li class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h6 class="mb-0 me-auto">Notification</h6>
                        <div class="d-flex align-items-center h6 mb-0">
                          <span class="badge bg-label-primary me-2">8 New</span>
                          <a href="javascript:void(0)" class="dropdown-notifications-all p-2 btn btn-icon waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark all as read" data-bs-original-title="Mark all as read"><i class="icon-base ti tabler-mail-opened text-heading"></i></a>
                        </div>
                      </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container ps">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action dropdown-notifications-item waves-effect">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <img src="../../assets/img/avatars/1.png" alt="" class="rounded-circle">
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="small mb-1">Congratulation Lettie 🎉</h6>
                              <small class="mb-1 d-block text-body">Won the monthly best seller gold badge</small>
                              <small class="text-body-secondary">1h ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item waves-effect">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1 small">Charles Franklin</h6>
                              <small class="mb-1 d-block text-body">Accepted your connection</small>
                              <small class="text-body-secondary">12hr ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read waves-effect">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <img src="../../assets/img/avatars/2.png" alt="" class="rounded-circle">
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1 small">New Message ✉️</h6>
                              <small class="mb-1 d-block text-body">You have new message from Natalie</small>
                              <small class="text-body-secondary">1h ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item waves-effect">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-success"><i class="icon-base ti tabler-shopping-cart"></i></span>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1 small">Whoo! You have new order 🛒</h6>
                              <small class="mb-1 d-block text-body">ACME Inc. made new order $1,154</small>
                              <small class="text-body-secondary">1 day ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read waves-effect">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <img src="../../assets/img/avatars/9.png" alt="" class="rounded-circle">
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1 small">Application has been approved 🚀</h6>
                              <small class="mb-1 d-block text-body">Your ABC project application has been approved.</small>
                              <small class="text-body-secondary">2 days ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read waves-effect">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-success"><i class="icon-base ti tabler-chart-pie"></i></span>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1 small">Monthly report is generated</h6>
                              <small class="mb-1 d-block text-body">July monthly financial report is generated </small>
                              <small class="text-body-secondary">3 days ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read waves-effect">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <img src="../../assets/img/avatars/5.png" alt="" class="rounded-circle">
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1 small">Send connection request</h6>
                              <small class="mb-1 d-block text-body">Peter sent you connection request</small>
                              <small class="text-body-secondary">4 days ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item waves-effect">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <img src="../../assets/img/avatars/6.png" alt="" class="rounded-circle">
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1 small">New message from Jane</h6>
                              <small class="mb-1 d-block text-body">Your have new message from Jane</small>
                              <small class="text-body-secondary">5 days ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read waves-effect">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-warning"><i class="icon-base ti tabler-alert-triangle"></i></span>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1 small">CPU is running high</h6>
                              <small class="mb-1 d-block text-body">CPU Utilization Percent is currently at 88.63%,</small>
                              <small class="text-body-secondary">5 days ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="icon-base ti tabler-x"></span></a>
                            </div>
                          </div>
                        </li>
                      </ul>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></li>
                    <li class="border-top">
                      <div class="d-grid p-4">
                        <a class="btn btn-primary btn-sm d-flex waves-effect waves-light" href="javascript:void(0);">
                          <small class="align-middle">View all notifications</small>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="../../assets/img/avatars/1.png" alt="" class="rounded-circle">
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item mt-0 waves-effect" href="pages-account-settings-account.html">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0 me-2">
                            <div class="avatar avatar-online">
                              <img src="../../assets/img/avatars/1.png" alt="" class="rounded-circle">
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-0">John Doe</h6>
                            <small class="text-body-secondary">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1 mx-n2"></div>
                    </li>
                    <li>
                      <a class="dropdown-item waves-effect" href="pages-profile-user.html">
                        <i class="icon-base ti tabler-user me-3 icon-md"></i><span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item waves-effect" href="pages-account-settings-account.html">
                        <i class="icon-base ti tabler-settings me-3 icon-md"></i><span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item waves-effect" href="pages-account-settings-billing.html">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 icon-base ti tabler-file-dollar me-3 icon-md"></i><span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge bg-danger d-flex align-items-center justify-content-center">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider my-1 mx-n2"></div>
                    </li>
                    <li>
                      <a class="dropdown-item waves-effect" href="pages-pricing.html">
                        <i class="icon-base ti tabler-currency-dollar me-3 icon-md"></i><span class="align-middle">Pricing</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item waves-effect" href="pages-faq.html">
                        <i class="icon-base ti tabler-question-mark me-3 icon-md"></i><span class="align-middle">FAQ</span>
                      </a>
                    </li>
                    <li>
                      <div class="d-grid px-2 pt-2 pb-1">
                        <a class="btn btn-sm btn-danger d-flex waves-effect waves-light" href="auth-login-cover.html" target="_blank">
                          <small class="align-middle">Logout</small>
                          <i class="icon-base ti tabler-logout ms-2 icon-14px"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu menu-vertical null" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
              <div class="container-xxl d-flex h-100 flex-column p-0">

              <a href="#" class="menu-horizontal-prev d-none"></a><div class="navbar-brand app-brand demo d-xl-flex py-0 me-4 ms-0">
              <a href="index.html" class="app-brand-link">
                <span class="app-brand-logo demo">
                  <span class="text-primary">
                    <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="currentColor"></path>
                      <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616"></path>
                      <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616"></path>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="currentColor"></path>
                    </svg>
                  </span>
                </span>
                <span class="app-brand-text demo menu-text fw-bold text-heading">Vuexy</span>
              </a>

              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                <i class="icon-base ti tabler-x icon-sm d-flex align-items-center justify-content-center"></i>
              </a>
            </div><ul class="menu-inner ps overflow-auto" style="margin-left: 0px;">
                  <!-- Dashboards -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon icon-base ti tabler-smart-home"></i>
                      <div data-i18n="Dashboards">Dashboards</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="dashboards-analytics.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-chart-pie-2"></i>
                          <div data-i18n="Analytics">Analytics</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="dashboards-crm.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-vector-bezier-circle"></i>
                          <div data-i18n="CRM">CRM</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="app-ecommerce-dashboard.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-shopping-cart"></i>
                          <div data-i18n="eCommerce">eCommerce</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="app-logistics-dashboard.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-truck"></i>
                          <div data-i18n="Logistics">Logistics</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="app-academy-dashboard.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-book"></i>
                          <div data-i18n="Academy">Academy</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <!-- Layouts -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon icon-base ti tabler-layout-sidebar"></i>
                      <div data-i18n="Layouts">Layouts</div>
                    </a>

                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="layouts-without-menu.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-menu-2"></i>
                          <div data-i18n="Without menu">Without menu</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="../vertical-menu-template/" class="menu-link" target="_blank">
                          <i class="menu-icon icon-base ti tabler-layout-distribute-vertical"></i>
                          <div data-i18n="Vertical">Vertical</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="layouts-fluid.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-maximize"></i>
                          <div data-i18n="Fluid">Fluid</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="layouts-container.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-arrows-maximize"></i>
                          <div data-i18n="Container">Container</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="layouts-blank.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-square"></i>
                          <div data-i18n="Blank">Blank</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <!-- Apps -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon icon-base ti tabler-layout-grid-add"></i>
                      <div data-i18n="Apps">Apps</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="app-email.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-mail"></i>
                          <div data-i18n="Email">Email</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="app-chat.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-messages"></i>
                          <div data-i18n="Chat">Chat</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="app-calendar.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-calendar"></i>

                          <div data-i18n="Calendar">Calendar</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="app-kanban.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-layout-kanban"></i>
                          <div data-i18n="Kanban">Kanban</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-shopping-cart"></i>
                          <div data-i18n="eCommerce">eCommerce</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="app-ecommerce-dashboard.html" class="menu-link">
                              <div data-i18n="Dashboard">Dashboard</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="Products">Products</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="app-ecommerce-product-list.html" class="menu-link">
                                  <div data-i18n="Product List">Product List</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-product-add.html" class="menu-link">
                                  <div data-i18n="Add Product">Add Product</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-category-list.html" class="menu-link">
                                  <div data-i18n="Category List">Category List</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="Order">Order</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="app-ecommerce-order-list.html" class="menu-link">
                                  <div data-i18n="Order List">Order List</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-order-details.html" class="menu-link">
                                  <div data-i18n="Order Details">Order Details</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="Customer">Customer</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="app-ecommerce-customer-all.html" class="menu-link">
                                  <div data-i18n="All Customers">All Customers</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                  <div data-i18n="Customer Details">Customer Details</div>
                                </a>
                                <ul class="menu-sub">
                                  <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-overview.html" class="menu-link">
                                      <div data-i18n="Overview">Overview</div>
                                    </a>
                                  </li>
                                  <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-security.html" class="menu-link">
                                      <div data-i18n="Security">Security</div>
                                    </a>
                                  </li>
                                  <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-billing.html" class="menu-link">
                                      <div data-i18n="Address &amp; Billing">Address &amp; Billing</div>
                                    </a>
                                  </li>
                                  <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-notifications.html" class="menu-link">
                                      <div data-i18n="Notifications">Notifications</div>
                                    </a>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="app-ecommerce-manage-reviews.html" class="menu-link">
                              <div data-i18n="Manage Reviews">Manage Reviews</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-ecommerce-referral.html" class="menu-link">
                              <div data-i18n="Referrals">Referrals</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="Settings">Settings</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="app-ecommerce-settings-detail.html" class="menu-link">
                                  <div data-i18n="Store Details">Store Details</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-settings-payments.html" class="menu-link">
                                  <div data-i18n="Payments">Payments</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-settings-checkout.html" class="menu-link">
                                  <div data-i18n="Checkout">Checkout</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-settings-shipping.html" class="menu-link">
                                  <div data-i18n="Shipping &amp; Delivery">Shipping &amp; Delivery</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-settings-locations.html" class="menu-link">
                                  <div data-i18n="Locations">Locations</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-ecommerce-settings-notifications.html" class="menu-link">
                                  <div data-i18n="Notifications">Notifications</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-book"></i>
                          <div data-i18n="Academy">Academy</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="app-academy-dashboard.html" class="menu-link">
                              <div data-i18n="Dashboard">Dashboard</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-academy-course.html" class="menu-link">
                              <div data-i18n="My Course">My Course</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-academy-course-details.html" class="menu-link">
                              <div data-i18n="Course Details">Course Details</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-truck"></i>
                          <div data-i18n="Logistics">Logistics</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="app-logistics-dashboard.html" class="menu-link">
                              <div data-i18n="Dashboard">Dashboard</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-logistics-fleet.html" class="menu-link">
                              <div data-i18n="Fleet">Fleet</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-file-dollar"></i>
                          <div data-i18n="Invoice">Invoice</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="app-invoice-list.html" class="menu-link">
                              <div data-i18n="List">List</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-invoice-preview.html" class="menu-link">
                              <div data-i18n="Preview">Preview</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-invoice-edit.html" class="menu-link">
                              <div data-i18n="Edit">Edit</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-invoice-add.html" class="menu-link">
                              <div data-i18n="Add">Add</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-users"></i>
                          <div data-i18n="Users">Users</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="app-user-list.html" class="menu-link">
                              <div data-i18n="List">List</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="View">View</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="app-user-view-account.html" class="menu-link">
                                  <div data-i18n="Account">Account</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-user-view-security.html" class="menu-link">
                                  <div data-i18n="Security">Security</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-user-view-billing.html" class="menu-link">
                                  <div data-i18n="Billing &amp; Plans">Billing &amp; Plans</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-user-view-notifications.html" class="menu-link">
                                  <div data-i18n="Notifications">Notifications</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="app-user-view-connections.html" class="menu-link">
                                  <div data-i18n="Connections">Connections</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-settings"></i>
                          <div data-i18n="Roles &amp; Permissions">Roles &amp; Permissions</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="app-access-roles.html" class="menu-link">
                              <div data-i18n="Roles">Roles</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="app-access-permission.html" class="menu-link">
                              <div data-i18n="Permission">Permission</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>

                  <!-- Pages -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon icon-base ti tabler-file"></i>
                      <div data-i18n="Pages">Pages</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-files"></i>
                          <div data-i18n="Front Pages">Front Pages</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="../front-pages/landing-page.html" class="menu-link" target="_blank">
                              <div data-i18n="Landing">Landing</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="../front-pages/pricing-page.html" class="menu-link" target="_blank">
                              <div data-i18n="Pricing">Pricing</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="../front-pages/payment-page.html" class="menu-link" target="_blank">
                              <div data-i18n="Payment">Payment</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="../front-pages/checkout-page.html" class="menu-link" target="_blank">
                              <div data-i18n="Checkout">Checkout</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="../front-pages/help-center-landing.html" class="menu-link" target="_blank">
                              <div data-i18n="Help Center">Help Center</div>
                            </a>
                          </li>
                        </ul>
                      </li>

                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-user-circle"></i>
                          <div data-i18n="User Profile">User Profile</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="pages-profile-user.html" class="menu-link">
                              <div data-i18n="Profile">Profile</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-profile-teams.html" class="menu-link">
                              <div data-i18n="Teams">Teams</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-profile-projects.html" class="menu-link">
                              <div data-i18n="Projects">Projects</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-profile-connections.html" class="menu-link">
                              <div data-i18n="Connections">Connections</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-settings"></i>
                          <div data-i18n="Account Settings">Account Settings</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="pages-account-settings-account.html" class="menu-link">
                              <div data-i18n="Account">Account</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-account-settings-security.html" class="menu-link">
                              <div data-i18n="Security">Security</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-account-settings-billing.html" class="menu-link">
                              <div data-i18n="Billing &amp; Plans">Billing &amp; Plans</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-account-settings-notifications.html" class="menu-link">
                              <div data-i18n="Notifications">Notifications</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-account-settings-connections.html" class="menu-link">
                              <div data-i18n="Connections">Connections</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="pages-faq.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-help"></i>
                          <div data-i18n="FAQ">FAQ</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="pages-pricing.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-diamond"></i>
                          <div data-i18n="Pricing">Pricing</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-vector-bezier-circle"></i>
                          <div data-i18n="Misc">Misc</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="pages-misc-error.html" class="menu-link" target="_blank">
                              <div data-i18n="Error">Error</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-misc-under-maintenance.html" class="menu-link" target="_blank">
                              <div data-i18n="Under Maintenance">Under Maintenance</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-misc-comingsoon.html" class="menu-link" target="_blank">
                              <div data-i18n="Coming Soon">Coming Soon</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="pages-misc-not-authorized.html" class="menu-link" target="_blank">
                              <div data-i18n="Not Authorized">Not Authorized</div>
                            </a>
                          </li>
                        </ul>
                      </li>

                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-lock"></i>
                          <div data-i18n="Authentications">Authentications</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="Login">Login</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="auth-login-basic.html" class="menu-link" target="_blank">
                                  <div data-i18n="Basic">Basic</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-login-cover.html" class="menu-link" target="_blank">
                                  <div data-i18n="Cover">Cover</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="Register">Register</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="auth-register-basic.html" class="menu-link" target="_blank">
                                  <div data-i18n="Basic">Basic</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-register-cover.html" class="menu-link" target="_blank">
                                  <div data-i18n="Cover">Cover</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-register-multisteps.html" class="menu-link" target="_blank">
                                  <div data-i18n="Multi-steps">Multi-steps</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="Verify Email">Verify Email</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="auth-verify-email-basic.html" class="menu-link" target="_blank">
                                  <div data-i18n="Basic">Basic</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-verify-email-cover.html" class="menu-link" target="_blank">
                                  <div data-i18n="Cover">Cover</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="Reset Password">Reset Password</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="auth-reset-password-basic.html" class="menu-link" target="_blank">
                                  <div data-i18n="Basic">Basic</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-reset-password-cover.html" class="menu-link" target="_blank">
                                  <div data-i18n="Cover">Cover</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="Forgot Password">Forgot Password</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
                                  <div data-i18n="Basic">Basic</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-forgot-password-cover.html" class="menu-link" target="_blank">
                                  <div data-i18n="Cover">Cover</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="Two Steps">Two Steps</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="auth-two-steps-basic.html" class="menu-link" target="_blank">
                                  <div data-i18n="Basic">Basic</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="auth-two-steps-cover.html" class="menu-link" target="_blank">
                                  <div data-i18n="Cover">Cover</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-forms"></i>
                          <div data-i18n="Wizard Examples">Wizard Examples</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="wizard-ex-checkout.html" class="menu-link">
                              <div data-i18n="Checkout">Checkout</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="wizard-ex-property-listing.html" class="menu-link">
                              <div data-i18n="Property Listing">Property Listing</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="wizard-ex-create-deal.html" class="menu-link">
                              <div data-i18n="Create Deal">Create Deal</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="modal-examples.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-square"></i>
                          <div data-i18n="Modal Examples">Modal Examples</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <!-- Components -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon icon-base ti tabler-toggle-left"></i>
                      <div data-i18n="Components">Components</div>
                    </a>
                    <ul class="menu-sub">
                      <!-- Cards -->
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-id"></i>
                          <div data-i18n="Cards">Cards</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="cards-basic.html" class="menu-link">
                              <div data-i18n="Basic">Basic</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="cards-advance.html" class="menu-link">
                              <div data-i18n="Advance">Advance</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="cards-statistics.html" class="menu-link">
                              <div data-i18n="Statistics">Statistics</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="cards-analytics.html" class="menu-link">
                              <div data-i18n="Analytics">Analytics</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="cards-actions.html" class="menu-link">
                              <div data-i18n="Actions">Actions</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <!-- User interface -->
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-color-swatch"></i>
                          <div data-i18n="User interface">User interface</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="ui-accordion.html" class="menu-link">
                              <div data-i18n="Accordion">Accordion</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-alerts.html" class="menu-link">
                              <div data-i18n="Alerts">Alerts</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-badges.html" class="menu-link">
                              <div data-i18n="Badges">Badges</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-buttons.html" class="menu-link">
                              <div data-i18n="Buttons">Buttons</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-carousel.html" class="menu-link">
                              <div data-i18n="Carousel">Carousel</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-collapse.html" class="menu-link">
                              <div data-i18n="Collapse">Collapse</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-dropdowns.html" class="menu-link">
                              <div data-i18n="Dropdowns">Dropdowns</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-footer.html" class="menu-link">
                              <div data-i18n="Footer">Footer</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-list-groups.html" class="menu-link">
                              <div data-i18n="List groups">List groups</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-modals.html" class="menu-link">
                              <div data-i18n="Modals">Modals</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-navbar.html" class="menu-link">
                              <div data-i18n="Navbar">Navbar</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-offcanvas.html" class="menu-link">
                              <div data-i18n="Offcanvas">Offcanvas</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-pagination-breadcrumbs.html" class="menu-link">
                              <div data-i18n="Pagination &amp; Breadcrumbs">Pagination &amp; Breadcrumbs</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-progress.html" class="menu-link">
                              <div data-i18n="Progress">Progress</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-spinners.html" class="menu-link">
                              <div data-i18n="Spinners">Spinners</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-tabs-pills.html" class="menu-link">
                              <div data-i18n="Tabs &amp; Pills">Tabs &amp; Pills</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-toasts.html" class="menu-link">
                              <div data-i18n="Toasts">Toasts</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-tooltips-popovers.html" class="menu-link">
                              <div data-i18n="Tooltips &amp; Popovers">Tooltips &amp; Popovers</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="ui-typography.html" class="menu-link">
                              <div data-i18n="Typography">Typography</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <!-- Extended components -->
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-components"></i>
                          <div data-i18n="Extended UI">Extended UI</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="extended-ui-avatar.html" class="menu-link">
                              <div data-i18n="Avatar">Avatar</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="extended-ui-blockui.html" class="menu-link">
                              <div data-i18n="BlockUI">BlockUI</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="extended-ui-drag-and-drop.html" class="menu-link">
                              <div data-i18n="Drag &amp; Drop">Drag &amp; Drop</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="extended-ui-media-player.html" class="menu-link">
                              <div data-i18n="Media Player">Media Player</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="extended-ui-perfect-scrollbar.html" class="menu-link">
                              <div data-i18n="Perfect Scrollbar">Perfect Scrollbar</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="extended-ui-star-ratings.html" class="menu-link">
                              <div data-i18n="Star Ratings">Star Ratings</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="extended-ui-sweetalert2.html" class="menu-link">
                              <div data-i18n="SweetAlert2">SweetAlert2</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="extended-ui-text-divider.html" class="menu-link">
                              <div data-i18n="Text Divider">Text Divider</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                              <div data-i18n="Timeline">Timeline</div>
                            </a>
                            <ul class="menu-sub">
                              <li class="menu-item">
                                <a href="extended-ui-timeline-basic.html" class="menu-link">
                                  <div data-i18n="Basic">Basic</div>
                                </a>
                              </li>
                              <li class="menu-item">
                                <a href="extended-ui-timeline-fullscreen.html" class="menu-link">
                                  <div data-i18n="Fullscreen">Fullscreen</div>
                                </a>
                              </li>
                            </ul>
                          </li>
                          <li class="menu-item">
                            <a href="extended-ui-tour.html" class="menu-link">
                              <div data-i18n="Tour">Tour</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="extended-ui-treeview.html" class="menu-link">
                              <div data-i18n="Treeview">Treeview</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="extended-ui-misc.html" class="menu-link">
                              <div data-i18n="Miscellaneous">Miscellaneous</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <!-- Icons -->
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-brand-tabler"></i>
                          <div data-i18n="Icons">Icons</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="icons-tabler.html" class="menu-link">
                              <div data-i18n="Tabler">Tabler</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="icons-font-awesome.html" class="menu-link">
                              <div data-i18n="Font Awesome">Font Awesome</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>

                  <!-- Forms -->
                  <li class="menu-item active open">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon icon-base ti tabler-forms"></i>
                      <div data-i18n="Forms">Forms</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item active open">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-toggle-left"></i>
                          <div data-i18n="Form Elements">Form Elements</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="forms-basic-inputs.html" class="menu-link">
                              <div data-i18n="Basic Inputs">Basic Inputs</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="forms-input-groups.html" class="menu-link">
                              <div data-i18n="Input groups">Input groups</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="forms-custom-options.html" class="menu-link">
                              <div data-i18n="Custom Options">Custom Options</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="forms-editors.html" class="menu-link">
                              <div data-i18n="Editors">Editors</div>
                            </a>
                          </li>
                          <li class="menu-item active">
                            <a href="forms-file-upload.html" class="menu-link">
                              <div data-i18n="File Upload">File Upload</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="forms-pickers.html" class="menu-link">
                              <div data-i18n="Pickers">Pickers</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="forms-selects.html" class="menu-link">
                              <div data-i18n="Select &amp; Tags">Select &amp; Tags</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="forms-sliders.html" class="menu-link">
                              <div data-i18n="Sliders">Sliders</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="forms-switches.html" class="menu-link">
                              <div data-i18n="Switches">Switches</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="forms-extras.html" class="menu-link">
                              <div data-i18n="Extras">Extras</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-layout-navbar"></i>
                          <div data-i18n="Form Layouts">Form Layouts</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="form-layouts-vertical.html" class="menu-link">
                              <div data-i18n="Vertical Form">Vertical Form</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="form-layouts-horizontal.html" class="menu-link">
                              <div data-i18n="Horizontal Form">Horizontal Form</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="form-layouts-sticky.html" class="menu-link">
                              <div data-i18n="Sticky Actions">Sticky Actions</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-text-wrap-disabled"></i>
                          <div data-i18n="Form Wizard">Form Wizard</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="form-wizard-numbered.html" class="menu-link">
                              <div data-i18n="Numbered">Numbered</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="form-wizard-icons.html" class="menu-link">
                              <div data-i18n="Icons">Icons</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="form-validation.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-checkbox"></i>
                          <div data-i18n="Form Validation">Form Validation</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <!-- Tables -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon icon-base ti tabler-layout-grid"></i>
                      <div data-i18n="Tables">Tables</div>
                    </a>
                    <ul class="menu-sub">
                      <!-- Tables -->
                      <li class="menu-item">
                        <a href="tables-basic.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-table"></i>
                          <div data-i18n="Tables">Tables</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-layout-grid"></i>
                          <div data-i18n="Datatables">Datatables</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="tables-datatables-basic.html" class="menu-link">
                              <div data-i18n="Basic">Basic</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="tables-datatables-advanced.html" class="menu-link">
                              <div data-i18n="Advanced">Advanced</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="tables-datatables-extensions.html" class="menu-link">
                              <div data-i18n="Extensions">Extensions</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>

                  <!-- Charts & Maps -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon icon-base ti tabler-chart-bar"></i>
                      <div data-i18n="Charts">Charts</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                          <i class="menu-icon icon-base ti tabler-chart-pie"></i>
                          <div data-i18n="Charts">Charts</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="charts-apex.html" class="menu-link">
                              <div data-i18n="Apex Charts">Apex Charts</div>
                            </a>
                          </li>
                          <li class="menu-item">
                            <a href="charts-chartjs.html" class="menu-link">
                              <div data-i18n="ChartJS">ChartJS</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                      <li class="menu-item">
                        <a href="maps-leaflet.html" class="menu-link">
                          <i class="menu-icon icon-base ti tabler-map"></i>
                          <div data-i18n="Leaflet Maps">Leaflet Maps</div>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <!-- Multi Level Menu -->
                  <li class="menu-item">
                    <a href="javascript:void(0)" class="menu-link menu-toggle">
                      <i class="menu-icon icon-base ti tabler-layout-board"></i>
                      <div data-i18n="Multi Level">Multi Level</div>
                    </a>
                    <ul class="menu-sub">
                      <li class="menu-item">
                        <a href="javascript:void(0)" class="menu-link menu-toggle">
                          <div data-i18n="Level 2">Level 2</div>
                        </a>
                        <ul class="menu-sub">
                          <li class="menu-item">
                            <a href="javascript:void(0)" class="menu-link">
                              <div data-i18n="Level 3">Level 3</div>
                            </a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 4px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></ul><div class="menu-horizontal-wrapper"></div><a href="#" class="menu-horizontal-next d-none"></a></div>
            </aside>
            <!-- / Menu -->

            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row gy-6">
                <!-- Basic  -->
                <div class="col-12">
                  <div class="card">
                    <h5 class="card-header">Basic</h5>
                    <div class="card-body">
                      <form action="/upload" class="dropzone needsclick dz-clickable" id="dropzone-basic">
                        <div class="dz-message needsclick">
                          Drop files here or click to upload
                          <span class="note needsclick">(This is just a demo dropzone. Selected files are
                            <span class="fw-medium">not</span> actually uploaded.)</span>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>
                <!-- /Basic  -->
                <!-- Multi  -->
                <div class="col-12">
                  <div class="card">
                    <h5 class="card-header">Multiple</h5>
                    <div class="card-body">
                      <form action="/upload" class="dropzone needsclick dz-clickable dz-started" id="dropzone-multi">
                        <div class="dz-message needsclick">
                          Drop files here or click to upload
                          <span class="note needsclick">(This is just a demo dropzone. Selected files are
                            <span class="fw-medium">not</span> actually uploaded.)</span>
                        </div>

                      <div class="dz-preview dz-file-preview dz-processing dz-success dz-complete"><div class="dz-details">  <div class="dz-thumbnail">    <img data-dz-thumbnail="">    <span class="dz-nopreview">No preview</span>    <div class="dz-success-mark"></div>    <div class="dz-error-mark"></div>    <div class="dz-error-message"><span data-dz-errormessage=""></span></div>    <div class="progress">      <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress="" style="width: 100%;"></div>    </div>  </div>  <div class="dz-filename" data-dz-name="">Trabalho.ods</div>  <div class="dz-size" data-dz-size=""><strong>36</strong> KB</div></div><a class="dz-remove" href="javascript:undefined;" data-dz-remove="">Remove file</a></div></form>
                    </div>
                  </div>
                </div>
                <!-- Multi  -->
              </div>
            </div>
            <!--/ Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                  <div class="text-body">
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>2025
                    , made with ❤️ by <a href="https://pixinvent.com" target="_blank" class="footer-link">Pixinvent</a>
                  </div>
                  <div class="d-none d-lg-inline-block">
                    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank">License</a>
                    <a href="https://themeforest.net/user/pixinvent/portfolio" target="_blank" class="footer-link me-4">More Themes</a>

                    <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>

                    <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>
                  </div>
                </div>
              </div>
            </footer>
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
    <div class="drag-target" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>

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
    <script src="../../assets/vendor/libs/dropzone/dropzone.js"></script>

    <!-- Main JS -->

    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/forms-file-upload.js"></script><input type="file" class="dz-hidden-input" tabindex="-1" style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">


<div id="template-customizer" class="card rounded-0" style="visibility: visible"> <a href="javascript:void(0)" class="template-customizer-open-btn" tabindex="-1"></a> <div class="p-6 m-0 lh-1 border-bottom template-customizer-header position-relative py-4"> <h6 class="template-customizer-t-panel_header mb-1">Template Customizer</h6> <p class="template-customizer-t-panel_sub_header mb-0 small">Customize and preview in real time</p> <div class="d-flex align-items-center gap-2 position-absolute end-0 top-0 mt-6 me-5"> <a href="javascript:void(0)" class="template-customizer-reset-btn text-heading" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Reset Customizer"><i class="icon-base ti tabler-refresh icon-lg"></i><span class="badge rounded-pill bg-danger badge-dot badge-notifications"></span></a> <a href="javascript:void(0)" class="template-customizer-close-btn fw-light text-heading" tabindex="-1"> <i class="icon-base ti tabler-x icon-lg"></i> </a> </div> </div> <div class="template-customizer-inner pt-6"> <div class="template-customizer-theming"> <h5 class="m-0 px-6 pb-6"> <span class="template-customizer-t-theming_header bg-label-primary rounded-1 py-1 px-3 small">Theming</span> </h5> <div class="m-0 px-6 pb-6 template-customizer-color w-100"> <label for="customizerColor" class="form-label d-block template-customizer-t-color_label mb-2">Primary Color</label> <div class="row template-customizer-colors-options"><div class="form-check custom-option custom-option-icon mb-0 checked">
          <label class="form-check-label custom-option-content p-0" for="colorRadioIconprimary">
            <span class="custom-option-body mb-0 scaleX-n1-rtl" style="background-color: #7367f0;"></span>
          </label>
          <input name="colorRadioIcon" class="form-check-input d-none" type="radio" value="#7367f0" data-color="#7367f0" id="colorRadioIconprimary" checked="checked">
        </div><div class="form-check custom-option custom-option-icon mb-0">
          <label class="form-check-label custom-option-content p-0" for="colorRadioIconsuccess">
            <span class="custom-option-body mb-0 scaleX-n1-rtl" style="background-color: #0D9394;"></span>
          </label>
          <input name="colorRadioIcon" class="form-check-input d-none" type="radio" value="#0D9394" data-color="#0D9394" id="colorRadioIconsuccess">
        </div><div class="form-check custom-option custom-option-icon mb-0">
          <label class="form-check-label custom-option-content p-0" for="colorRadioIconwarning">
            <span class="custom-option-body mb-0 scaleX-n1-rtl" style="background-color: #FFAB1D;"></span>
          </label>
          <input name="colorRadioIcon" class="form-check-input d-none" type="radio" value="#FFAB1D" data-color="#FFAB1D" id="colorRadioIconwarning">
        </div><div class="form-check custom-option custom-option-icon mb-0">
          <label class="form-check-label custom-option-content p-0" for="colorRadioIcondanger">
            <span class="custom-option-body mb-0 scaleX-n1-rtl" style="background-color: #EB3D63;"></span>
          </label>
          <input name="colorRadioIcon" class="form-check-input d-none" type="radio" value="#EB3D63" data-color="#EB3D63" id="colorRadioIcondanger">
        </div><div class="form-check custom-option custom-option-icon mb-0">
          <label class="form-check-label custom-option-content p-0" for="colorRadioIconinfo">
            <span class="custom-option-body mb-0 scaleX-n1-rtl" style="background-color: #2092EC;"></span>
          </label>
          <input name="colorRadioIcon" class="form-check-input d-none" type="radio" value="#2092EC" data-color="#2092EC" id="colorRadioIconinfo">
        </div><div class="form-check custom-option custom-option-icon mb-0"><label class="form-check-label custom-option-content" for="colorRadioIcon"><div class="pickr">

        <button type="button" class="pcr-button ti tabler-color-picker" role="button" aria-label="toggle color picker dialog" style="transition: none; --pcr-color: rgba(255, 73, 97, 1);"></button>


      </div></label><input name="colorRadioIcon" class="form-check-input picker d-none" type="radio" value="picker" id="colorRadioIcon"> </div></div> </div> <div class="m-0 px-6 pb-6 template-customizer-theme w-100"> <label for="customizerTheme" class="form-label d-block template-customizer-t-theme_label mb-2">Theme</label> <div class="row px-1 template-customizer-themes-options"><div class="col-4 px-2">
        <div class="form-check custom-option custom-option-icon mb-0 checked">
          <label class="form-check-label custom-option-content p-0" for="customRadioIconlight">
            <span class="custom-option-body mb-0 scaleX-n1-rtl"><i class="ti tabler-sun icon-base mb-0"></i></span>
          </label>
          <input name="customRadioIcon" class="form-check-input d-none" type="radio" value="light" id="customRadioIconlight" checked="checked">
        </div>
        <label class="form-check-label small text-nowrap text-body" for="customRadioIconlight">Light</label>
      </div><div class="col-4 px-2">
        <div class="form-check custom-option custom-option-icon mb-0">
          <label class="form-check-label custom-option-content p-0" for="customRadioIcondark">
            <span class="custom-option-body mb-0 scaleX-n1-rtl"><i class="ti tabler-moon icon-base mb-0"></i></span>
          </label>
          <input name="customRadioIcon" class="form-check-input d-none" type="radio" value="dark" id="customRadioIcondark">
        </div>
        <label class="form-check-label small text-nowrap text-body" for="customRadioIcondark">Dark</label>
      </div><div class="col-4 px-2">
        <div class="form-check custom-option custom-option-icon mb-0">
          <label class="form-check-label custom-option-content p-0" for="customRadioIconsystem">
            <span class="custom-option-body mb-0 scaleX-n1-rtl"><i class="ti tabler-device-desktop-analytics icon-base mb-0"></i></span>
          </label>
          <input name="customRadioIcon" class="form-check-input d-none" type="radio" value="system" id="customRadioIconsystem">
        </div>
        <label class="form-check-label small text-nowrap text-body" for="customRadioIconsystem">System</label>
      </div></div> </div> <div class="m-0 px-6 pb-6 template-customizer-skins w-100"> <label for="customizerSkin" class="form-label template-customizer-t-skin_label mb-2">Skins</label> <div class="row px-1 template-customizer-skins-options"><div class="col-4 px-2">
        <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0 checked">
          <label class="form-check-label custom-option-content p-0" for="skinRadiosdefault">
            <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
          </label>
          <input name="skinRadios" class="form-check-input d-none" type="radio" value="default" id="skinRadiosdefault" checked="checked">
        </div>
        <label class="form-check-label small text-nowrap text-body" for="skinRadiosdefault">Default</label>
      </div><div class="col-4 px-2">
        <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0">
          <label class="form-check-label custom-option-content p-0" for="skinRadiosbordered">
            <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
          </label>
          <input name="skinRadios" class="form-check-input d-none" type="radio" value="bordered" id="skinRadiosbordered">
        </div>
        <label class="form-check-label small text-nowrap text-body" for="skinRadiosbordered">Bordered</label>
      </div></div> </div> <div class="m-0 px-6 template-customizer-semiDark w-100 d-flex justify-content-between pe-12"> <span class="form-label template-customizer-t-semiDark_label">Semi Dark</span> <label class="switch template-customizer-t-semiDark_label"> <input type="checkbox" class="template-customizer-semi-dark-switch switch-input"> <span class="switch-toggle-slider"> <span class="switch-on"></span> <span class="switch-off"></span> </span> </label> </div> <hr class="m-0 px-6 my-6"> </div> <div class="template-customizer-layout"> <h5 class="m-0 px-6 pb-6"> <span class="template-customizer-t-layout_header bg-label-primary rounded-2 py-1 px-3 small">Layout</span> </h5>  <div class="m-0 px-6 pb-6 template-customizer-headerOptions w-100"> <label for="customizerHeader" class="form-label template-customizer-t-layout_header_label mb-2">Header Types</label> <div class="row px-1 template-customizer-header-options"><div class="col-4 px-2">
        <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0 checked">
          <label class="form-check-label custom-option-content p-0" for="headerRadioIconfixed">
            <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
          </label>
          <input name="headerRadioIcon" class="form-check-input d-none" type="radio" value="fixed" id="headerRadioIconfixed" checked="checked">
        </div>
        <label class="form-check-label small text-nowrap text-body" for="headerRadioIconfixed">Fixed</label>
      </div><div class="col-4 px-2">
        <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0">
          <label class="form-check-label custom-option-content p-0" for="headerRadioIconstatic">
            <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
          </label>
          <input name="headerRadioIcon" class="form-check-input d-none" type="radio" value="static" id="headerRadioIconstatic">
        </div>
        <label class="form-check-label small text-nowrap text-body" for="headerRadioIconstatic">Static</label>
      </div></div> </div>  <div class="m-0 px-6 pb-6 template-customizer-content w-100"> <label for="customizerContent" class="form-label template-customizer-t-content_label mb-2">Content</label> <div class="row px-1 template-customizer-content-options"><div class="col-4 px-2">
        <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0 checked">
          <label class="form-check-label custom-option-content p-0" for="contentRadioIconcompact">
            <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
          </label>
          <input name="contentRadioIcon" class="form-check-input d-none" type="radio" value="compact" id="contentRadioIconcompact" checked="checked">
        </div>
        <label class="form-check-label small text-nowrap text-body" for="contentRadioIconcompact">Compact</label>
      </div><div class="col-4 px-2">
        <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0">
          <label class="form-check-label custom-option-content p-0" for="contentRadioIconwide">
            <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
          </label>
          <input name="contentRadioIcon" class="form-check-input d-none" type="radio" value="wide" id="contentRadioIconwide">
        </div>
        <label class="form-check-label small text-nowrap text-body" for="contentRadioIconwide">Wide</label>
      </div></div> </div> <div class="m-0 px-6 pb-6 template-customizer-directions w-100"> <label for="customizerDirection" class="form-label template-customizer-t-direction_label mb-2">Direction</label> <div class="row px-1 template-customizer-directions-options"><div class="col-4 px-2">
        <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0 checked">
          <label class="form-check-label custom-option-content p-0" for="directionRadioIconltr">
            <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
          </label>
          <input name="directionRadioIcon" class="form-check-input d-none" type="radio" value="ltr" id="directionRadioIconltr" checked="checked">
        </div>
        <label class="form-check-label small text-nowrap text-body" for="directionRadioIconltr">Left to Right (En)</label>
      </div><div class="col-4 px-2">
        <div class="form-check custom-option custom-option-image custom-option-image-radio mb-0">
          <label class="form-check-label custom-option-content p-0" for="directionRadioIconrtl">
            <span class="custom-option-body mb-0 scaleX-n1-rtl"></span>
          </label>
          <input name="directionRadioIcon" class="form-check-input d-none" type="radio" value="rtl" id="directionRadioIconrtl">
        </div>
        <label class="form-check-label small text-nowrap text-body" for="directionRadioIconrtl">Right to Left (Ar)</label>
      </div></div> </div> </div> </div> </div><div class="pcr-app " data-theme="nano" aria-label="color picker dialog" role="window" style="top: 263.438px; left: 661.125px;">
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
        </div><input type="file" multiple="multiple" class="dz-hidden-input" tabindex="-1" style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;"></body></html>
