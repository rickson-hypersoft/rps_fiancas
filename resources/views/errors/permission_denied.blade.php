@extends('dashboard')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>🔐 Permissão Negada</h5>
            </div>
            <div class="card-body pt-1">
                <p>Você não possui permissão para acessar essa página</p>
                <a href="{{ route('home') }}" class="btn btn-outline-primary">Voltar para a tela inicial</a>
            </div>
        </div>
    </div>
@endsection
