@extends('dashboard')
@section('content')
<div class="col-md-12">
    <div class="card mb-6">
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

        <form method="POST" action="{{route('update.my-profile', $user['id'])}}" enctype="multipart/form-data" >
            @csrf
            @method('PUT')

        <div class="d-flex align-items-start align-items-sm-center gap-6">
    @php
        $profileImage = file_exists(public_path("assets/user-profiles/{$user['id']}.png"))
            ? asset("assets/user-profiles/{$user['id']}.png")
            : asset("assets/user-profiles/default.png");
    @endphp

    <img
        src="{{ $profileImage }}"
        alt="user-avatar"
        class="d-block w-px-100 h-px-100 rounded"
        id="uploadedAvatar" />

    <div class="button-wrapper">
        <label for="upload" class="btn btn-primary me-3 mb-4" tabindex="0">
            <span class="d-none d-sm-block">Atualizar foto</span>
            <i class="icon-base ti tabler-upload d-block d-sm-none"></i>
        </label>
        <input
 type="file"
 id="upload"
 name="imagem"
 class="account-file-input"
 hidden
 accept="image/png, image/jpeg" />
        <div>Aceita o tipo JPG, GIF ou PNG. Tamanho máximo de 800K</div>
    </div>
</div>
    </div>
    <div class="card-body">
        <div class="row gy-4 gx-6 mb-6">
            <div class="col-md-6 form-control-validation">
            <label for="usuario" class="form-label">Usuário</label>
            <input
                class="form-control"
                type="text"
                id="usuario"
                name="usuario"
                value="{{$user['usuario']}}"
                autofocus />
            </div>

            <div class="col-md-6">
            <label for="email" class="form-label">E-mail</label>
            <input
                class="form-control"
                type="text"
                id="email"
                name="email"
                value="{{$user['email']}}"
                placeholder="john.doe@example.com" />
            </div>

            <div class="col-md-6">
            <label for="nome" class="form-label">Nome</label>
            <input
                type="text"
                class="form-control"
                id="nome"
                name="nome"
                value="{{$user['nome']}}"/>
            </div>

            <div class="col-md-6">
            <label class="form-label" for="cpf">CPF</label>
             <input
                type="text"
                class="form-control"
                id="cpf"
                name="cpf"
                value="{{$user['cpf']}}"/>
            </div>

            <div class="col-md-6">
            <label for="telefone" class="form-label">Telefone</label>
            <input
                type="text"
                class="form-control"
                id="telefone"
                name="telefone"
                value="{{$user['telefone']}}"/>
            </div>

            <div class="col-md-6">
            <label for="nivel" class="form-label">Nível</label>
             <input
                type="text"
                class="form-control"
                id="nivel"
                name="nivel"
                value="{{$user['nivel']}}"/>
            </div>

            <div class="col-md-6">
            <label for="categoria" class="form-label">Categória</label>
             <input
                type="text"
                class="form-control"
                id="categoria"
                name="categoria"
                value="{{$user['categoria']}}"/>
            </div>

            <div class="col-md-6">
            <label for="ativo" class="form-label">Ativo</label>
           <div class="form-check form-switch mb-2">
    <input
        class="form-check-input"
        type="checkbox"
        id="user-status-switch"
        name="ativo"
        {{ $user['ativo'] ? 'checked' : '' }}>
</div>
            </div>

        </div>
        <div class="mt-2 d-flex">
            <button type="submit" class="btn btn-primary me-3">Salvar alterações</button>
            <button type="reset" class="btn btn-label-secondary">Cancelar</button>
        </div>
        </form>
    </div>
    <!-- /Account -->
    </div>
    <!--
    <div class="card">
    <h5 class="card-header">Excluir conta</h5>
    <div class="card-body">
        <div class="mb-6 col-12 mb-0">
        <div class="alert alert-warning">
            <h5 class="alert-heading mb-1">Are you sure you want to delete your account?</h5>
            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
        </div>
        </div>
        <form id="formAccountDeactivation" onsubmit="return false">
        <div class="form-check my-8">
            <input
            class="form-check-input"
            type="checkbox"
            name="accountActivation"
            id="accountActivation" />
            <label class="form-check-label" for="accountActivation"
            >I confirm my account deactivation</label
            >
        </div>
        <button type="submit" class="btn btn-danger deactivate-account" disabled>
            Deactivate Account
        </button>
        </form>
    </div>
</div>
-->
</div>
@endsection
