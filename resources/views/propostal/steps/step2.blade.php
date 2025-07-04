<div class="alert alert-primary" role="alert">A última consulta realizado com esse CPF foi em: {{ \Carbon\Carbon::parse($scoreData['data'])->format('d/m/Y') }} -  {{ $scoreData['hora'] }}</div>

<div id="analise-credito" class="content active fv-plugins-bootstrap5 fv-plugins-framework">
    <div style="{{ $styles['cardStyle'] }}" class="{{ $styles['card'] }}" id="card_status_propostal">
        <h4 class="fw-bold mb-0 text-center text-white" id="text_status_propostal">{{ $styles['text'] }}</h4>
    </div>
    <div class="row g-6 justify-content-center">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="card">
                <div class="card-header pb-1">
                    <div class="d-flex justify-content-between mb-1 align-middle">
                        <small>VALOR SOLICITADO DE ALUGUEL</small>
                        <span id="badge_status_propostal" class="badge bg-label-secondary">{{ $styles['badge'] }}</span>
                    </div>
                </div>
                <div class="card-body mb-0">
                    <h4 class="{{ $styles['colorText'] }}" id="color_text_imovel_aluguel"><i id="icon_status_propostal"
                            class="{{ $styles['icon'] }}"></i>
                        <span id="imovel_aluguel_text">{{ $proposta['imovel_aluguel'] }}</span>
                    </h4>
                    <div class="d-flex bg-label-secondary gap-5 p-4" style="border-radius: 10px;">
                        <div class="p-2">
                            <span class="fw-bold">Valor de condomínio</span>
                            <p class="m-0"><span
                                    id="imovel_condominio_text">{{ $proposta['imovel_condominio'] }}</span></p>
                        </div>
                        <div class="p-2">
                            <span class="fw-bold">Taxas inclusas</span>
                            <p class="m-0"><span id="imovel_taxas_text">{{ $proposta['imovel_taxas'] }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-1">
                    <span class="small fw-bold mb-0" style="font-size: 16px;">DETALHAMENTO</span>

                    <div class="demo-inline-spacing m-0 p-0">
                        <p class="m-0 p-0" id="detalhamento">
                            {{ $styles['detalhamento'] }}
                        </p>
                    </div>

                    <div class="d-flex mt-5 gap-2">
                        <a href="{{ route('propostal.create.step1', ['id' => $proposta['id']]) }}"
                            class="btn-prev btn btn-text-success waves-effect"><i
                                class="menu-icon icon-base ti tabler-pencil"></i> Editar dados</a>
                        <a href="{{ route('propostal.create') }}" id="btn-nova-simulacao"
                            class="btn btn-text-success waves-effect"><i
                                class="menu-icon icon-base ti tabler-refresh"></i> Fazer nova simulação</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-6 justify-content-center mt-5" id="setup-config">
        <div class="col-lg-8 d-{{ $styles['displaySetup'] }} m-0 px-0.5">
            <div class="card" style="border: 1px solid green;">
                <div class="card-header pb-1">
                    <div class="d-flex justify-content-between mb-1 align-middle">
                        <small style="font-size: 16px;">Taxa de 15%, Custo de saída 5x e Cobertura total de 40x</small>
                    </div>
                    <hr>
                    <small class="text-success fw-bold" style="font-size: 20px;">12x de
                        {{ $proposta['valor_parcelado'] }}<span id="valor_parcelado"></span></small>
                    <small style="font-size: 16px;">ou <span
                            id="valor_total_vista">{{ $proposta['valor_total'] }}</span> à vista</small>
                    <hr>
                </div>
                <div class="card-body mb-0">
                    <h6 class="fw-bold">Defina a taxa de setup e o tipo de pagamento</h6>
                    <form id="form-proposta" method="POST">
                        <div class="col-12">
                            <label for="setup" class="form-label">Setup</label>
                            <select class="form-select form-select-lg" name="setup" id="setup"
                                aria-label="Default select example">
                                @if (!isset($setups) || empty($setups))
                                    <option value="1">Nenhum setup disponível</option>
                                @else
                                    <option value="">Selecionar setup</option>
                                    @foreach ($setups as $setup)
                                        <option value="{{ $setup['taxa'] }}"
                                            @if (isset($proposta['proposta_setup_valor']) && $proposta['proposta_setup_valor'] == $setup['taxa']) selected @endif>
                                            {{ $setup['taxa_formatada'] }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <p class="mb-4 mt-2">Se trata do valor para realizar a ativação deste produto</p>

                            <div style="border: 1px solid #387BA8; border-radius: 10px">
                                <div class="card-body bg-label-secondary" style="border-radius: 10px">
                                    <p>A escolha do parcelamento fica na tela de pagamentos visível à pessoa inquilina.
                                        O repasse para a imobiliária da taxa setup é feito a vista, mesmo que a pessoa
                                        inquilina pague parcelado.</p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

             <div class="col-lg-12 my-10">
                 <div class="card p-4">
                 <div class="accordion-item">
                     <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
                                Informações do Inquilino
                            </button>
                        </h2>

                        <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
                            <div class="accordion-body">
                                <div class="table-responsive text-nowrap7">
                                <table class="table table-borderless table-sm">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th class="text-center">Classe</th>
                                            <th>Faixa</th>
                                            <th>Descrição</th>
                                            <th>Pontos</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if(!isset($checkScore['message']))
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($scoreData['data'])->format('d/m/Y') }} {{ $scoreData['hora'] }}</td>
                                            <td class="text-center">{{ $scoreData['score_classe'] }}</td>
                                            <td>{{ $scoreData['score_faixa_titulo'] }}</td>
                                            <td>{{ $scoreData['score_faixa_descricao'] }}</td>
                                            <td>{{ $scoreData['score_pontos'] }}</td>
                                        </tr>
                                        @else
                                            <tr>
                                                <td colspan="5">{{ $checkScore['message'] }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

            <input type="hidden" id="id" value="{{ $proposta['id'] }}">

            <div class="col-12 d-flex justify-content-between mb-5 mt-5" id="next-setup-config">
                <a href="{{ route('propostal.create.step1', ['id' => $proposta['id']]) }}"
                    class="btn btn-label-secondary btn-prev waves-effect">
                    <i class="icon-base ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
                    <span class="d-sm-inline-block d-none align-middle">Voltar</span>
                </a>
                <button type="submit" class="btn btn-primary btn-next-analise waves-effect waves-light">
                    <span class="d-sm-inline-block d-none me-sm-2 align-middle">Salvar e avançar com a proposta</span>
                    <i class="icon-base ti tabler-arrow-right icon-xs"></i>
                </button>
                </form>
            </div>
        </div>
    </div>


</div>
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('form-proposta').addEventListener('submit', async function(e) {
            e.preventDefault();

            // Mostra o SweetAlert de carregamento ANTES de começar o fetch
            Swal.fire({
                title: 'Aguarde...',
                text: 'Transformando sua simulação em um rascunho de proposta!',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                const id = document.getElementById('id'); // Pega o elemento
                const valor = id.value; // Pega o valor

                const form = e.target;
                const formData = new FormData(form);
                const url = `/propostas/salvar-step2/${valor}`;

                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Proteção CSRF
                    },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                // Redireciona ao sucesso
                window.location.href = `/propostas/step3/${data.data.id}`;

            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Erro!',
                    text: error.message || 'Houve um problema ao criar a proposta.'
                });
            }
        });
    </script>
@endsection
