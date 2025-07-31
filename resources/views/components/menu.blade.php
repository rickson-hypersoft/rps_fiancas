<nav class="layout-navbar navbar navbar-expand-xl align-items-center" style="background: #2f3349" id="layout-navbar"
    data-bs-theme="dark">
    <div class="container-xxl">
        <div class="navbar-brand app-brand demo d-none d-xl-flex me-4 ms-0 py-0">
            <a href="{{ route('home') }}" class="app-brand-link">
                <span>
                    <img width="120" height="120" src="{{ asset('/assets/img/logo.svg') }}" alt="">
                </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large d-xl-none ms-auto">
                <i class="icon-base ti tabler-x icon-sm d-flex align-items-center justify-content-center"></i>
            </a>
        </div>

        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-xl-0 d-xl-none me-3">
            <a class="nav-item nav-link me-xl-6 px-0" href="javascript:void(0)">
                <i class="icon-base ti tabler-menu-2 icon-md"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
            <ul class="navbar-nav align-items-center ms-md-auto flex-row">
                <!-- Style Switcher -->
                <li class="nav-item">
                    <button id="theme-toggle-btn"
                        class="nav-link btn btn-icon btn-text-secondary rounded-pill waves-effect"
                        aria-label="Toggle theme">
                        <i id="theme-icon" class="tabler-sun icon-base ti icon-22px text-heading"></i>
                    </button>
                </li>
                <!-- / Style Switcher-->

                <!-- Notification -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-xl-2 me-3">
                    <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"
                        href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                        aria-expanded="false">
                        <span class="position-relative">
                            <i class="icon-base ti tabler-bell icon-22px text-heading"></i>
                            <span class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end p-0">
                        <li class="dropdown-menu-header border-bottom">
                            <div class="dropdown-header d-flex align-items-center py-3">
                                <h6 class="mb-0 me-auto">Notificações</h6>
                                <div class="d-flex align-items-center h6 mb-0">
                                    <a href="javascript:void(0)" class="dropdown-notifications-all btn btn-icon p-2"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i
                                            class="icon-base ti tabler-mail-opened text-heading"></i></a>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-notifications-list scrollable-container">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                    <div class="d-flex">
                                      Em breve, você receberá uma notificação de atualização do sistema.
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                        data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            @php $profileImage = file_exists(public_path("assets/user-profiles/{$user['id']}.png")) ? asset("assets/user-profiles/{$user['id']}.png") : asset('assets/user-profiles/default.png'); @endphp
                            <img src="{{ $profileImage }}" alt class="rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item mt-0" href="{{ route('my-profile') }}">
                                <div class="d-flex align-items-center">
                                    <div class="me-2 flex-shrink-0">
                                        <div class="avatar avatar-online">
                                            <img src="{{ $profileImage }}" alt class="rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">
                                            {{ $user['usuario'] }}
                                        </h6>
                                        <small class="text-body-secondary">{{ $user['nivel'] }}</small>
                                        <small
                                            class="text-body-secondary d-block">{{ $realEstateSectorOrCompany['fantasia'] }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider mx-n2 my-1"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('my-profile') }}">
                                <i class="icon-base ti tabler-user-circle icon-md me-3"></i><span
                                    class="align-middle">Minha conta</span>
                            </a>
                        </li>
                        @php
                            $user = session('user');
                            $categoria = $user['categoria'] ?? null;
                            $idImobiliaria = $user['id_imobiliaria'] ?? null;
                            $links = [
                                'Imobiliária' => [
                                    [
                                        'route' => route('realestatesector.users.index'),
                                        'icon' => 'tabler-users',
                                        'label' => 'Usuários',
                                    ],
                                    $idImobiliaria
                                        ? [
                                            'route' => route(
                                                'realestatesector.realestatesectors.index',
                                                $idImobiliaria,
                                            ),
                                            'icon' => 'tabler-file',
                                            'label' => 'Dados da imobiliária',
                                        ]
                                        : null,
                                ],
                                'Fianças' => [
                                    [
                                        'route' => route('user.index'),
                                        'icon' => 'tabler-users',
                                        'label' => 'Usuários',
                                    ],
                                    [
                                        'route' => route('realestatesector.index'),
                                        'icon' => 'tabler-file',
                                        'label' => 'Dados da imobiliária',
                                    ],
                                ],
                            ];
                        @endphp
                        @if (isset($links[$categoria]))
                            @foreach ($links[$categoria] as $link)
                                @if ($link)
                                    <li>
                                        <a class="dropdown-item" href="{{ $link['route'] }}">
                                            <i class="icon-base ti {{ $link['icon'] }} icon-md me-3"></i>
                                            <span class="align-middle">{{ $link['label'] }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                        <li>
                            <div class="dropdown-divider mx-n2 my-1"></div>
                        </li>
                        <li>
                            <div class="d-grid px-2 pb-1 pt-2">
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="icon-base ti tabler-logout icon-md me-3"></i><span
                                        class="align-middle">Sair</span>
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
