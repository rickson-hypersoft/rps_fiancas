@extends('dashboard')
@section('content')
    <div class="col-md-12">
        <form method="POST" action="{{ route('update.my-profile', $user['id']) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <!-- Account -->
                <div class="card-body pb-0">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            @foreach ($errors->all() as $error)
                                <span>{{ $error }}</span>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <span>{{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="d-flex align-items-start align-items-sm-center gap-6">
                        @php
                            $profileImage = file_exists("assets/user-profiles/{$user['id']}.png")
                                ? asset("assets/user-profiles/{$user['id']}.png")
                                : asset('assets/user-profiles/default.png');
                        @endphp

                        <img src="{{ $profileImage }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded"
                            id="uploadedAvatar" />

                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary mb-4 me-3" tabindex="0">
                                <span class="d-none d-sm-block">Atualizar foto</span>
                                <i class="icon-base ti tabler-upload d-block d-sm-none"></i>
                            </label>
                            <input type="file" id="upload" name="imagem" class="account-file-input" hidden
                                accept="image/png, image/jpeg" />
                            <div>Aceita o tipo JPG, GIF ou PNG. Tamanho máximo de 800K</div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-4 gx-6">
                        <div class="col-md-6 form-control-validation">
                            <label for="usuario" class="form-label">Usuário</label>
                            <input class="form-control form-control-lg" type="text" id="usuario" name="usuario"
                                value="{{ $user['usuario'] }}" autofocus />
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control form-control-lg" type="text" id="email" name="email"
                                value="{{ $user['email'] }}" placeholder="john.doe@example.com" />
                        </div>

                        <div class="col-md-6">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control form-control-lg" id="nome" name="nome"
                                value="{{ $user['nome'] }}" />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="cpf">CPF</label>
                            <input type="text" class="form-control form-control-lg" id="cpf" name="cpf"
                                value="{{ $user['cpf'] }}" />
                        </div>

                        <div class="col-md-6">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control form-control-lg" id="telefone" name="telefone"
                                value="{{ $user['telefone'] }}" />
                        </div>

                        <div class="col-md-6">
                            <label for="categoria" class="form-label">Categória</label>
                            <input type="text" class="form-control form-control-lg" id="categoria" name="categoria"
                                value="{{ $user['categoria'] }}" disabled />
                        </div>

                        <!--
                                                        <div class="col-md-6">
                                                            <label for="ativo" class="form-label">Ativo</label>
                                                            <div class="form-check form-switch mb-2">
                                                                <input class="form-check-input" type="checkbox" id="user-status-switch" name="ativo"
                                                                    {{ $user['ativo'] ? 'checked' : '' }}>
                                                            </div>
                                                        </div>
                                                    -->

                    </div>
                    <div class="d-flex mt-4">
                        <button type="submit" class="btn btn-primary me-3" id="salvar">Salvar alterações</button>
                        <a href="{{ route('home') }}" class="btn btn-label-secondary">Cancelar</a>
                    </div>
                </div>
                <!-- /Account -->
            </div>
        </form>
    </div>
@section('scripts')
    <script>
        IMask(document.getElementById('cpf'), {
            mask: '000.000.000-00'
        });

        IMask(document.getElementById('telefone'), {
            mask: '00 0000-0000'
        });

        const form = document.querySelector('form');
        const button = form.querySelector('#salvar');

        form.addEventListener('submit', function(e) {
            button.disabled = true;
            button.innerText = 'Salvando...';
        });
    </script>
@endsection
@endsection
