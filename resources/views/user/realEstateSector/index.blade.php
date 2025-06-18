@extends('dashboard') @section('content')
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif @if (session('success'))
                <div class="alert alert-success alert-dismissible mb-4" role="alert">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h5>Listagem de Usuários</h5>
                            <hr />
                            <div class="row align-items-center pt-5">
                                <div class="col-sm-7 col-12 mb-1">
                                    <form action="{{ route('realestatesector.users.index') }}" method="GET">
                                        <label for="pesquisar" class="form-label">Pesquisar</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Pesquisar pelo nome ou CPF" id="pesquisar" name="search"
                                                value="{{ request('search') }}" aria-label="Pesquisar pelo nome ou CPF"
                                                aria-describedby="button-addon2" />
                                            <button class="btn btn-outline-primary waves-effect" type="submit"
                                                id="button-addon2">
                                                <i class="icon-base ti tabler-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-5" style="text-align: right">
                                    <a href="{{ route('realestatesector.users.create') }}"
                                        class="btn btn-lg btn-primary waves-effect waves-light">Adicionar Usuário</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table" style="height: 250px">
                                <table class="table-sm table-borderless table-striped table-hover table"
                                    style="font-size: 18px">
                                    <thead>
                                        <tr>
                                            <th class="align-middle" style="width: 40px; height: 40px">
                                                Foto
                                            </th>
                                            <th class="align-middle">Nome</th>
                                            <th class="align-middle">CPF</th>
                                            <th class="align-middle">E-mail</th>
                                            <th class="align-middle">Ativo</th>
                                            <th class="text-center" style="width: 100px">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="ViewNiveisLTableItens">
                                        @foreach ($users as $user)
                                            @php$path = public_path(
                                                    'assets/user-profiles/' . $user['id'] . '.png',
                                                );
                                                $image = file_exists($path)
                                                    ? asset('assets/user-profiles/' . $user['id'] . '.png')
                                                    : asset('assets/user-profiles/default.png');
                                            @endphp

                                            <tr>
                                                <td>
                                                    <img class="rounded" src="{{ $image }}" alt="avatar"
                                                        height="38" width="38" />
                                                </td>
                                                <td class="align-middle">
                                                    {{ $user['nome'] }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $user['cpf'] }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $user['email'] }}
                                                </td>
                                                <td class="align-middle">
                                                    <span
                                                        class="badge bg-label-{{ $user['ativo'] ? 'success' : 'danger' }} me-1">
                                                        {{ $user['ativo'] ? 'Ativo' : 'Inativo' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="dropdown" style="text-align: center">
                                                        <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                                            data-bs-toggle="dropdown">
                                                            <i class="icon-base ti tabler-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item waves-effect"
                                                                href="{{ route('realestatesector.users.edit', $user['id']) }}"><i
                                                                    class="icon-base ti tabler-pencil me-1"></i>
                                                                Editar</a>
                                                            <a class="dropdown-item waves-effect"
                                                                href="javascript:void(0);"><i
                                                                    class="icon-base ti tabler-trash me-1"></i>
                                                                Excluir</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @php$firstItem = $pagination['from'];
                                $lastItem = $pagination['to'];
                                $total = $pagination['total'];
                                $currentPage = $pagination['current_page'];
                            $lastPage = $pagination['last_page']; @endphp @if ($total > 0 && $lastPage > 1)
                                <div class="mt-25 float-end">
                                    <div class="d-flex justify-content-between align-items-center mt-3 px-4 py-2"
                                        style="background: #eee; border-radius: 5rem">
                                        <div class="mx-2">
                                            <span>{{ $firstItem }} a {{ $lastItem }} de
                                                {{ $total }}</span>
                                        </div>

                                        <nav aria-label="Page navigation">
                                            <ul class="pagination pagination-sm mb-0">
                                                <li class="page-item first {{ $currentPage == 1 ? 'disabled' : '' }}">
                                                    <a class="page-link" href="{{ url()->current() . '?page=1' }}"
                                                        aria-label="Primeira página">
                                                        <i class="icon-base ti tabler-chevrons-left icon-sm"></i>
                                                    </a>
                                                </li>

                                                <li class="page-item prev {{ $currentPage == 1 ? 'disabled' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ url()->current() . '?page=' . max(1, $currentPage - 1) }}"
                                                        aria-label="Página anterior">
                                                        <i class="icon-base ti tabler-chevron-left icon-sm"></i>
                                                    </a>
                                                </li>

                                                <li
                                                    class="page-item next {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ url()->current() . '?page=' . min($lastPage, $currentPage + 1) }}"
                                                        aria-label="Próxima página">
                                                        <i class="icon-base ti tabler-chevron-right icon-sm"></i>
                                                    </a>
                                                </li>

                                                <li
                                                    class="page-item last {{ $currentPage == $lastPage ? 'disabled' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ url()->current() . '?page=' . $lastPage }}"
                                                        aria-label="Última página">
                                                        <i class="icon-base ti tabler-chevrons-right icon-sm"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>

@endsection
