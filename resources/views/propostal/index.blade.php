@extends('dashboard')
@section('content')
    <div class="col-12 mb-6">
        <h4>Análise em andamento</h4>
        <div class="nav-align-top nav-tabs-shadow">
            <ul class="nav nav-tabs flex-sm-row flex-column" role="tablist">
                <li class="nav-item p-3" role="presentation">
                    <button type="button" class="nav-link waves-effect active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pendente" aria-controls="navs-pendente" aria-selected="true">
                        Imóvel com Contrato Pendente
                    </button>
                </li>
                <li class="nav-item p-3" role="presentation">
                    <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-rascunhos" aria-controls="navs-rascunhos" aria-selected="false"
                        tabindex="-1">
                        Rascunhos
                    </button>
                </li>
                <li class="nav-item p-3" role="presentation">
                    <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-cancelados" aria-controls="navs-cancelados" aria-selected="false"
                        tabindex="-1">
                        Cancelados
                    </button>
                </li>
                <li class="nav-item p-3" role="presentation">
                    <button type="button" class="nav-link waves-effect" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-excluidos" aria-controls="navs-excluidos" aria-selected="false"
                        tabindex="-1">
                        Negados
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="bordered p-5" style="border-radius: 10px;">
                    <form method="GET" action="{{ route('propostal.index') }}">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-12 mb-2">
                                <label for="largeInput" class="form-label">Pesquisar</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text" id="basic-addon-search31"><i
                                            class="icon-base ti tabler-search"></i></span>
                                    <input type="text" name="search" class="form-control form-control-lg"
                                        placeholder="Número da proposta, nome/razão social, CPF/CNPJ ou Tag"
                                        aria-label="Número da proposta, nome/razão social, CPF/CNPJ ou Tag"
                                        value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-2 col-12 mb-2">
                                <label for="largeSelect" class="form-label">Status</label>
                                <select name="status" id="largeSelect" class="form-select form-select-lg">
                                    <option value="">Todos</option>
                                    <option value="Pendente" {{ request('status') == 'Pendente' ? 'selected' : '' }}>
                                        Aguardando Cancelamento</option>
                                    <option value="Aprovado" {{ request('status') == 'Aprovado' ? 'selected' : '' }}>Alteração
                                        Imobiliária</option>
                                    <option value="Cancelado" {{ request('status') == 'Cancelado' ? 'selected' : '' }}>
                                        Alteração Imobiliária solicitada</option>
                                    <option value="Negado" {{ request('status') == 'Negado' ? 'selected' : '' }}>Analise
                                    </option>
                                    <option value="Rascunho" {{ request('status') == 'Rascunho' ? 'selected' : '' }}>Aprovado
                                    </option>
                                    <option value="Rascunho" {{ request('status') == 'Rascunho' ? 'selected' : '' }}>Em
                                        análise Biométrica</option>
                                    <option value="Rascunho" {{ request('status') == 'Rascunho' ? 'selected' : '' }}>Em
                                        análise Biométrica - Ag Retorno Imobiliária</option>
                                    <option value="Rascunho" {{ request('status') == 'Rascunho' ? 'selected' : '' }}>Em
                                        análise de estorno</option>
                                    <option value="Rascunho" {{ request('status') == 'Rascunho' ? 'selected' : '' }}>Em
                                        cancelamento</option>
                                    <option value="Rascunho" {{ request('status') == 'Rascunho' ? 'selected' : '' }}>Pendente
                                    </option>
                                    <option value="Rascunho" {{ request('status') == 'Rascunho' ? 'selected' : '' }}>Pendente
                                        Análise</option>
                                    <option value="Rascunho" {{ request('status') == 'Rascunho' ? 'selected' : '' }}>Suspenso
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2 col-12 mb-2">
                                <label id="created_at" class="form-label">Criado em:</label>
                                <input type="date" name="created_at" id="created_at" class="form-control form-control-lg"
                                    value="{{ request('created_at') }}">
                            </div>
                            <div class="col-md-2 mt-2">
                                <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">
                                    <span class="icon-xs icon-base ti tabler-search me-2"></span>Pesquisar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade active show" id="navs-pendente" role="tabpanel">
                    <div class="table-responsive mt-4 text-nowrap pt-2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Contrato</th>
                                    <th>Inquilino</th>
                                    <th>Documento</th>
                                    <th>Valor locatício</th>
                                    <th>Tag</th>
                                    <th>Status</th>
                                    <th>Data de criação</th>
                                    <th>Última atualização</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($propostals as $propostal)
                                    @php
                                        $badgeColor = '';
                                        $status = $propostal['proposta_status'];
                                        $badgeColor = '';

                                        if ($status == 'Aprovado') {
                                            $badgeColor = 'success';
                                        }
                                        if ($status == 'Pendente') {
                                            $badgeColor = 'warning';
                                        }
                                        if ($status == 'Negado') {
                                            $badgeColor = 'black';
                                        }
                                        if ($status == 'Cancelado') {
                                            $badgeColor = 'danger';
                                        }
                                    @endphp
                                    @if ($propostal['contrato_status'] == 'Pendente' and $propostal['proposta_status'] != 'Cancelado')
                                        <tr>
                                            <td>
                                                <a href="{{ route('propostal.resume', $propostal['id']) }}"
                                                    class="text-success">{{ $propostal['id'] }}</a>
                                            </td>
                                            <td>{{ $propostal['pessoa_nome'] }}</td>
                                            <td>
                                                {{ $propostal['pessoa_doc'] }}
                                            </td>
                                            <td>{{ $propostal['imovel_aluguel'] }}</td>
                                            <td>{{ $propostal['imovel_tag'] }}</td>
                                            <td><span
                                                    class="badge bg-label-{{ $badgeColor }} me-1">{{ $propostal['proposta_status'] }}</span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($propostal['data'])->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($propostal['data_ultima_atualizacao'])->format('d/m/Y') }}
                                            </td>
                                            <td style="text-align: center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                                        data-bs-toggle="dropdown">
                                                        <i class="icon-base ti tabler-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item waves-effect btnCancelarProposta"
                                                            data-bs-toggle="modal" data-bs-target="#modalCancelarProposta"
                                                            href="javascript:void(0);"
                                                            data-id="{{ $propostal['id'] }}"><i
                                                                class="icon-base ti tabler-trash me-1"></i> Cancelar
                                                            proposta</a>

                                                        <a class="dropdown-item waves-effect btnAlterarProposta"
                                                            data-bs-toggle="modal" data-bs-target="#modalAlterarProposta"
                                                            href="javascript:void(0);"
                                                            data-id="{{ $propostal['id'] }}"><i
                                                                class="icon-base ti tabler-edit me-1"></i> Alteração
                                                            imobiliária</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="navs-rascunhos" role="tabpanel">
                    <div class="bg-label-secondary p-4" style="border-radius: 10px;">
                        <p class="m-0 p-0">Propostas em rascunho por mais de 30 dias serão automaticamente canceladas. Mas
                            não se preocupe: você poderá criar novas propostas para esses clientes a qualquer momento!
                            Assim, sua imobiliária terá acesso mais fácil às propostas mais quentes e focará nas melhores
                            oportunidades.</p>
                    </div>

                    <div class="table-responsive mt-4 text-nowrap pt-2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Contrato</th>
                                    <th>Inquilino</th>
                                    <th>Documento</th>
                                    <th>Valor locatício</th>
                                    <th>Tag</th>
                                    <th>Status</th>
                                    <th>Data de criação</th>
                                    <th>Última atualização</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($propostals as $propostal)
                                    @if ($propostal['proposta_status'] == 'Rascunho')
                                        <tr>
                                            <td>
                                                <a href="{{ route('propostal.resume', $propostal['id']) }}"
                                                    class="text-success">{{ $propostal['id'] }}</a>
                                            </td>
                                            <td>{{ $propostal['pessoa_nome'] }}</td>
                                            <td>
                                                {{ $propostal['pessoa_doc'] }}
                                            </td>
                                            <td>{{ $propostal['imovel_aluguel'] }}</td>
                                            <td>{{ $propostal['imovel_tag'] }}</td>
                                            <td><span
                                                    class="badge bg-label-secondary me-1">{{ $propostal['proposta_status'] }}</span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($propostal['data'])->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($propostal['data_ultima_atualizacao'])->format('d/m/Y') }}
                                            </td>
                                            <td style="text-align: center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn dropdown-toggle hide-arrow p-0"
                                                        data-bs-toggle="dropdown">
                                                        <i class="icon-base ti tabler-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item waves-effect btnCancelarProposta"
                                                            data-bs-toggle="modal" data-bs-target="#modalCancelarProposta"
                                                            href="javascript:void(0);"
                                                            data-id="{{ $propostal['id'] }}"><i
                                                                class="icon-base ti tabler-trash me-1"></i> Cancelar
                                                            proposta</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="navs-cancelados" role="tabpanel">
                    <div class="table-responsive mt-4 text-nowrap pt-2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Contrato</th>
                                    <th>Inquilino</th>
                                    <th>Documento</th>
                                    <th>Valor locatício</th>
                                    <th>Tag</th>
                                    <th>Status</th>
                                    <th>Data de criação</th>
                                    <th>Última atualização</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($propostals as $propostal)
                                    @if ($propostal['proposta_status'] == 'Cancelado')
                                        <tr>
                                            <td>
                                                <a href="{{ route('propostal.resume', $propostal['id']) }}"
                                                    class="text-success">{{ $propostal['id'] }}</a>
                                            </td>
                                            <td>{{ $propostal['pessoa_nome'] }}</td>
                                            <td>
                                                {{ $propostal['pessoa_doc'] }}
                                            </td>
                                            <td>{{ $propostal['imovel_aluguel'] }}</td>
                                            <td>{{ $propostal['imovel_tag'] }}</td>
                                            <td><span
                                                    class="badge bg-label-danger me-1">{{ $propostal['proposta_status'] }}</span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($propostal['data'])->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($propostal['data_ultima_atualizacao'])->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="navs-excluidos" role="tabpanel">
                    <div class="table-responsive mt-4 text-nowrap pt-2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Contrato</th>
                                    <th>Inquilino</th>
                                    <th>Documento</th>
                                    <th>Valor locatício</th>
                                    <th>Tag</th>
                                    <th>Status</th>
                                    <th>Data de criação</th>
                                    <th>Última atualização</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($propostals as $propostal)
                                    @if ($propostal['proposta_status'] == 'Negado')
                                        <tr>
                                            <td>
                                                <a href="{{ route('propostal.resume', $propostal['id']) }}"
                                                    class="text-success">{{ $propostal['id'] }}</a>
                                            </td>
                                            <td>{{ $propostal['pessoa_nome'] }}</td>
                                            <td>
                                                {{ $propostal['pessoa_doc'] }}
                                            </td>
                                            <td>{{ $propostal['imovel_aluguel'] }}</td>
                                            <td>{{ $propostal['imovel_tag'] }}</td>
                                            <td><span
                                                    class="badge bg-label-dark me-1">{{ $propostal['proposta_status'] }}</span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($propostal['data'])->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($propostal['data_ultima_atualizacao'])->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCancelarProposta" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCancelarPropostaTitle">Qual o motivo do cancelamento desta proposta
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formCancelarProposta" method="POST" action="">
                    @csrf
                    <input type="hidden" name="id" id="propostaIdInput">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-4">
                                <label for="motivo" class="form-label">Selecionar motivo</label>
                                <select id="motivo" class="form-select form-select-lg" name="motivo">
                                    <option value="Processo de locação interrompido">Processo de locação interrompido
                                    </option>
                                    <option value="Cliente interessado em outra forma de garantia">Cliente interessado em
                                        outra forma de garantia</option>
                                    <option value="Cliente interessado em outro imóvel">Cliente interessado em outro imóvel
                                    </option>
                                    <option value="Proposta transferida para outra pessoa">Proposta transferida para outra
                                        pessoa</option>
                                    <option value="Cliente não respondeu às tentativas de contato">Cliente não respondeu às
                                        tentativas de contato</option>
                                    <option value="Imóvel já locado para outro interessado">Imóvel já locado para outro
                                        interessado</option>
                                    <option value="Cliente visitou o imóvel, mas desistiu">Cliente visitou o imóvel, mas
                                        desistiu</option>
                                    <option value="Imóvel fora do orçamento do cliente">Imóvel fora do orçamento do cliente
                                    </option>
                                    <option value="Questões financeiras do cliente">Questões financeiras do cliente
                                    </option>
                                    <option value="Inquilino não concordou com o modelo de garantia">Inquilino não
                                        concordou com o modelo de garantia</option>
                                    <option value="Desacordo entre inquilino e proprietário">Desacordo entre inquilino e
                                        proprietário</option>
                                    <option value="Imobiliária cancelou para cadastrar uma nova proposta no CPF">
                                        Imobiliária cancelou para cadastrar uma nova proposta no CPF</option>

                                </select>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col mb-4">
                                <label for="motivo_opicional" class="form-label">Explicar motivo (opcional)</label>
                                <textarea class="form-control" id="motivo_opicional" rows="3" name="motivo_opicional"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary waves-effect"
                            data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAlterarProposta" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAlterarPropostaTitle">Qual o motivo da sua solicitação de alteração?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAlterarProposta" method="GET" action="">
                    @csrf
                    <input type="hidden" name="id" id="propostaIdInput">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-4">
                                <label for="motivoAlteracao" class="form-label">Selecionar motivo</label>
                                <select id="motivoAlteracao" class="form-select form-select-lg" name="motivoAlteracao">
                                    <option value="Dados do inquilino">Dados do inquilino</option>
                                    <option value="Valor locatício">Valor locatício</option>
                                    <option value="Forma de pagamento/recorrência">Forma de pagamento/recorrência</option>
                                    <option value="Dados do imóvel">Dados do imóvel</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col mb-4">
                                <label for="observacaoAlteracao" class="form-label">Explicar motivo (opcional)</label>
                                <textarea class="form-control" id="observacaoAlteracao" rows="3" name="observacaoAlteracao"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary waves-effect"
                            data-bs-dismiss="modal">Fechar</button>
                        <button type="button" id="btnConfirmarAlteracao"
                            class="btn btn-primary waves-effect waves-light">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modalCancelar = new bootstrap.Modal(document.getElementById('modalCancelarProposta'));
            const form = document.getElementById('formCancelarProposta');

            // Abertura do modal e set do ID e action
            document.querySelectorAll('.btnCancelarProposta').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    document.getElementById('propostaIdInput').value = id;
                    form.action = "{{ url('/propostas/cancelar') }}/" + id;
                    modalCancelar.show();
                });
            });

            // Envio do formulário
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        modalCancelar.hide();

                        Swal.fire({
                            icon: 'success',
                            title: 'Proposta cancelada com sucesso!',
                            confirmButtonText: 'Voltar para listagem'
                        }).then(() => {
                            window.location.href = "{{ route('propostal.index') }}";
                        });
                    })
                    .catch(error => {
                        modalCancelar.hide();
                        console.error(error);
                        Swal.fire('Erro', 'Ocorreu um erro ao cancelar a proposta.', 'error');
                    });
            });

            document.querySelectorAll('.btnAlterarProposta').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    document.getElementById('propostaIdInput').value = id;
                });
            });

            const modalAlterar = new bootstrap.Modal(document.getElementById('modalAlterarProposta'));
            document.getElementById('btnConfirmarAlteracao').addEventListener('click', function() {
                modalAlterar.hide();
                let idProposta = document.getElementById('propostaIdInput').value;
                let motivo = document.getElementById('motivoAlteracao').value;
                let observacao = document.getElementById('observacaoAlteracao').value;

                Swal.fire({
                    title: 'Alteração registrada!',
                    html: `<p>Você será redirecionado para a tela de alteração.</p>
                   <a href="/propostas/alteracao/${idProposta}?motivo=${encodeURIComponent(motivo)}&observacao=${encodeURIComponent(observacao)}" class="btn btn-primary mt-2">Ir para alteração agora</a>`,
                    icon: 'success',
                    showConfirmButton: false,
                });

                // Se quiser redirecionar automático:
                // setTimeout(() => {
                //     window.location.href = `/propostas/alteracao/${idProposta}?motivo=${encodeURIComponent(motivo)}&observacao=${encodeURIComponent(observacao)}`;
                // }, 3000);
            });
        });
    </script>
@endsection
@endsection
