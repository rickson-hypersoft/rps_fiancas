@extends('dashboard')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>
                        {{ $method == 'PUT' ? 'Editar Movimentação' : 'Registrar Movimentação' }}
                    </h5>
                </div>
                <hr class="mt-0 pt-0">
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible mb-4" role="alert">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ $action }}" method="POST"
                    class="fv-plugins-bootstrap5 fv-plugins-framework row mb-0" novalidate="novalidate">
                    @csrf
                    @if ($method === 'PUT')
                        @method('PUT')
                    @endif
                    <div class="col-md-4 col-12 mb-2">
                        <label for="data" class="form-label">Data de Lançamento</label>
                        <input type="date" class="form-control form-control-lg" name="data" id="data"
                            value="{{ old('data', $movi['data'] ?? date('Y-m-d')) }}">
                    </div>

                    <div class="col-md-4 col-12 mb-2">
                        <label for="valor" class="form-label">Valor</label>
                        <div class="input-group input-group-merge input-group-lg">
                            <span class="input-group-text">
                                <i class="ti tabler-currency-dollar"></i>
                            </span>
                            <input name="valor" style="text-align: right" id="valor" type="number"
                                class="form-control form-control-lg" value="{{ old('valor', $movi['valor'] ?? '') }}"
                                aria-label="Amount (to the nearest dollar)">
                        </div>
                    </div>

                    <div class="col-md-4 col-12 mb-2">
                        <label for="conta" class="form-label">Conta</label>
                        <select class="form-select form-select-lg" name="id_conta" id="conta"
                            aria-label="Default select example">
                            <option value="">Todos</option>
                            @foreach ($contas as $conta)
                                <option value="{{ $conta['id'] }}"
                                    {{ isset($movi['id_conta']) == $conta['id'] ? 'selected' : '' }}>{{ $conta['descricao'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 col-12 mb-2">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select class="form-select form-select-lg" name="id_categoria" id="categoria"
                            aria-label="Default select example">
                            <option value="">Todos</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria['id'] }}"
                                    {{ isset($movi['id_categoria']) == $categoria['id'] ? 'selected' : '' }}>
                                    {{ trim($categoria['descricao']) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 col-12 mb-2">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-select form-select-lg" name="tipo" id="tipo"
                            aria-label="Default select example">
                            <option value="D" {{ isset($movi['tipo']) == 'D' ? 'selected' : '' }}>
                                Débito
                            </option>
                            <option value="C" {{ isset($movi['tipo']) == 'C' ? 'selected' : '' }}>
                                Crédito
                            </option>
                        </select>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="historico" class="form-label">Histórico</label>
                        <textarea class="form-control" name="historico" id="historico" rows="3">{{ old('historico', $movi['historico'] ?? '') }}</textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                            class="btn btn-primary waves-effect waves-light me-3">{{ $method == 'PUT' ? 'Salvar alteração' : 'Gravar' }}</button>
                        <a href="{{ route('financial.financial_movi.index') }}"
                            class="btn btn-label-secondary waves-effect">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    @section('scripts')
        <script>
            const form = document.querySelector('form');

            form.addEventListener('submit', function(e) {
                const buttons = form.querySelectorAll('button[type="submit"]');
                buttons.forEach(btn => {
                    btn.disabled = true;
                    btn.innerText = 'Salvando...';
                });
            });
        </script>
    @endsection
@endsection
