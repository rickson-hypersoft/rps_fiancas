<div id="proposta-enviada" class="content fv-plugins-bootstrap5 active fv-plugins-framework">
    <div id="background-confirmation" style="{{ $styles['cardStyle'] }}" class="{{ $styles['card'] }}">
        <h4 class="mb-0 text-center fw-bold text-white">Proposta enviada</h4>
    </div>
    <div class="row g-6 justify-content-center">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="card ">
                <div class="card-header pb-1 ">
                    <div class="d-flex align-middle justify-content-between mb-1">
                        <small>PRÓXIMOS PASSOS</small>
                        <span class="badge bg-label-secondary">Proposta</span>
                    </div>
                </div>
                <div class="card-body mb-0">
                    <h4 class="{{ $styles['colorText'] }}" id="text_card_primary">{{ $styles['text'] }}</h4>
                    <p id="paragraph_card">{{ $styles['paragrapfCard'] }}</p>
                    <hr>
                    <small>REGISTRO</small>
                    <p>Proposta #<span id="id_proposta">{{ $proposta['id'] }}</span></p>
                    <a id="link" href="{{ route('proposta.resume', ['id' => $proposta['id']]) }}"
                        class="btn btn-success waves-effect">Ver detalhes da proposta</a>
                </div>
            </div>
        </div>
    </div>
</div>
