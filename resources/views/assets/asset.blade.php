@extends('dashboard')
@section('content')
<div class="col-12 mb-6">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header mb-0 pb-3 pt-3" style="background: #f7f7f7;">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="p-0 m-0">Solicitação</h5>

                        <div class="d-none d-md-flex gap-1 m-0 p-0">
                            <a href="#" class="btn btn-outline-secondary">Abrir inadimplência</a>
                            <a href="#" class="btn btn-outline-secondary">Acompanhar inadimplências</a>
                            <a href="#" class="btn btn-outline-secondary" disabled>Cancelar proposta</a>
                        </div>

                        <div class="d-block d-md-none dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Ações
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Abrir inadimplência</a></li>
                                <li><a class="dropdown-item" href="#">Acompanhar inadimplências</a></li>
                                <li><a class="dropdown-item disabled" href="#">Cancelar proposta</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-4">
                    <h5>Número do Contrato: <span class="text-success">#{{$data['id']}}</span></h5>
                    <p>Situação atual: <span class="badge rounded-pill bg-{{$data['proposta_status'] == 'Cancelado' ? 'danger' : 'success'}} badge-dot border"></span> {{$data['contrato_status']}}</p>

                    <!--<p>Proxíma Renovação estimada: 03/06/2025</p>
                    <p>Fiança disponível: <span class="badge text-bg-success">R$ 8.000,00</span></p>
                    <span>* Este valor considera apenas inadimplências pagas e provisionadas. Inadimplências em análise não são debatidas deste valor.</span>-->
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header mb-0 pb-3 pt-3" style="background: #f7f7f7;">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="p-0 m-0">Dados da Locação</h5>

                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Ações
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i> Rescindir</a>
                                <a class="dropdown-item waves-effect" href="{{route('assets.edit', ['idContrato' => $data['id']])}}"><i class="icon-base ti tabler-pencil me-1"></i> Editar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-5">
                    <div class="row">
                        <div class="col-4 d-none d-sm-block">
                            <img src="{{ asset('assets/img/casa.png') }}" alt="" class="img-fluid">
                        </div>

                        <div class="col-12 col-sm-8">
                            <h6 class="bg-light p-3 mb-0">Dados do Contrato</h6>
                            <table class="table table-borderless mb-0 mt-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Tipo de Imóvel:</td>
                                        <td class="text-end">{{$data['imovel_tipo']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Valor Aluguel:</td>
                                        <td class="text-end">{{$data['imovel_aluguel']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Valor Condomínio:</td>
                                        <td class="text-end">{{$data['imovel_condominio']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Outras Taxas:</td>
                                        <td class="text-end">{{$data['imovel_taxas']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Valor Locatício Total:</td>
                                        <td class="text-end">{{$data['valor_total_pagamento']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Parcelas Serviço:</td>
                                        <td class="text-end">{{$data['proposta_total_parc']}}x</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Valor Setup:</td>
                                        <td class="text-end">{{$data['proposta_setup_valor']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Parcelas Setup:</td>
                                        <td class="text-end">{{$data['proposta_setup_parc']}}x</td>
                                    </tr>
                                    <!-- ??
                                    <tr>
                                        <td class="fw-bold">Pagador:</td>
                                        <td class="text-end">R$ 0,00</td>
                                    </tr>
                                -->
                                </tbody>
                            </table>

                            <h6 class="bg-light p-3 mb-0">Dados do Imóvel</h6>
                            <table class="table table-borderless mb-0 mt-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">CEP:</td>
                                        <td class="text-end">{{$data['imovel_cep']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Endereço:</td>
                                        <td class="text-end">{{$data['imovel_endereco']}} - {{$data['imovel_numero']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Bairro:</td>
                                        <td class="text-end">{{$data['imovel_bairro']}}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h6 class="bg-light p-3 mb-0">Dados do Opcionais</h6>
                            <table class="table table-borderless mb-0 mt-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Complemento:</td>
                                        <td class="text-end">{{$data['imovel_complemento']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Tag:</td>
                                        <td class="text-end">{{$data['imovel_tag']}}</td>
                                    </tr>
                                    <!--
                                    <tr>
                                        <td class="fw-bold">Descrição:</td>
                                        <td class="text-end">R$ 0,00</td>
                                    </tr>
                                -->
                                </tbody>
                            </table>
                            <h6 class="bg-light p-3 mb-0">Documentos</h6>
                            <table class="table table-borderless mb-0 mt-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Contrato:</td>
                                        <td class="text-end">
                                            <a href="#" class="btn-download-anexo" data-tipo="contrato" data-id="{{ $data['id'] }}"><i class="ti tabler-file-type-pdf"></i> Anexar</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Vistoria:</td>
                                        <td class="text-end">
                                            <a href="#" class="btn-download-anexo" data-tipo="vistoria" data-id="{{ $data['id'] }}"><i class="ti tabler-file-type-pdf"></i> Anexar</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Apólice:</td>
                                        <td class="text-end">
                                            <a href="#" class="btn-download-anexo" data-tipo="apolice" data-id="{{ $data['id'] }}"><i class="ti tabler-file-type-pdf"></i> Anexar</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="accordion mt-4" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="false" aria-controls="accordionOne">
                            Histórico
                        </button>
                    </h2>

                    <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">

                        @foreach ($histories as $history)
                        <div class="accordion-body">
                            {{ \Carbon\Carbon::parse($history['data'])->format('d/m/Y') }} {{$history['hora']}} - {{$history['historico']}}
                        </div>
                        <hr>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-1">{{$data['pessoa_nome']}}</h5>
                        <p class="card-subtitle">{{$data['imovel_ramo_atv']}}</p>
                    </div>
                    <div>
                        <span class="badge bg-label-{{$data['proposta_status'] == 'Cancelado' ? 'danger' : 'success'}}">{{$data['proposta_status']}}</span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="col-md-12">
                        <h6 class="bg-light p-3">Dados Pessoais</h6>
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-bold">Nome:</td>
                                    <td class="text-end">{{$data['pessoa_nome']}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">CPF:</td>
                                    <td class="text-end">{{$data['pessoa_doc']}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Data Nascimento:</td>
                                    <td class="text-end">{{ \Carbon\Carbon::parse($data['data_nascimento'])->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">E-mail:</td>
                                    <td class="text-end">{{$data['pessoa_email']}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Telefone Fixo/Celular:</td>
                                    <td class="text-end">{{$data['pessoa_telefone']}}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Comprovante Fatura:</td>
                                    <td class="text-end"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- <div class="card-footer text-body-secondary">Termo Aprovado </div> -->
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.btn-download-anexo').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const tipo = this.dataset.tipo;
            const idContrato = this.dataset.id;

            fetch(`/anexos/baixar/${idContrato}/${tipo}`)
                .then(res => {
                    if (!res.ok) throw new Error('Erro ao baixar');
                    return res.blob();
                })
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `${tipo}.pdf`; // ou .html, se for esse o formato
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                })
                .catch(error => {
                    Swal.fire('Erro', 'Arquivo não encontrado.', 'error');
                });
        });
    });
</script>

@endsection