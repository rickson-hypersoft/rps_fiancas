@extends('dashboard')
@section('content')
<div class="col-12 mb-6">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header mb-0 pb-3 pt-3" style="background: #f7f7f7;">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="p-0 m-0">Solicitação</h5>

                        <div class="d-flex gap-1 m-0 p-0">
                            <a href="#" class="btn btn-outline-secondary">Abrir inadimplência</a>
                            <a href="# " class="btn btn-outline-secondary">Acompanhar inadimplências</a>
                            <a href="#" disabled class="btn btn-outline-secondary">Cancelar proposta</a>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-4">
                    <h5>Número do Contrato: <span class="text-success">#{{$data['id']}}</span></h5>
                    <p>Situação atual: <span class="badge rounded-pill bg-success badge-dot border"></span> {{$data['status']}}</p>
                    <p>Proxíma Renovação estimada: 03/06/2025</p>
                    <p>Fiança disponível: <span class="badge text-bg-success">R$ 8.000,00</span></p>
                    <span>* Este valor considera apenas inadimplências pagas e provisionadas. Inadimplências em análise não são debatidas deste valor.</span>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header mb-0 pb-3 pt-3" style="background: #f7f7f7;">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="p-0 m-0">Dados da Locação</h5>

                        <div class="dropdown">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                Ações
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="icon-base ti tabler-trash me-1"></i> Rescindir</a>
                                <a class="dropdown-item waves-effect" href="{{route('assets.edit')}}"><i class="icon-base ti tabler-pencil me-1"></i> Editar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-5">
                    <div class="row">
                        <div class="col-4">
                            <img src="{{ asset('assets/img/casa.png') }}" alt="" class="img-fluid">
                        </div>
                        <div class="col-8">
                            <h6></h6>
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Tipo de Imóvel:</td>
                                        <td class="text-end">Residencial</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Valor Aluguel:</td>
                                        <td class="text-end">R$ 200,00</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Valor Condomínio:</td>
                                        <td class="text-end">R$ 0,00</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Outras Taxas:</td>
                                        <td class="text-end">R$ 0,00</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Valor Locatício Total:</td>
                                        <td class="text-end">R$ 0,00</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Parcelas Serviço:</td>
                                        <td class="text-end">R$ 0,00</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Valor Setup:</td>
                                        <td class="text-end">R$ 0,00</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Parcelas Setup:</td>
                                        <td class="text-end">R$ 0,00</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Pagador:</td>
                                        <td class="text-end">R$ 0,00</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h6>Dados do Imóvel</h6>
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">CEP:</td>
                                        <td class="text-end">Residencial</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Endereço:</td>
                                        <td class="text-end">R$ 200,00</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Bairro:</td>
                                        <td class="text-end">R$ 0,00</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h6>Dados Opcionais</h6>
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Complemento:</td>
                                        <td class="text-end">Residencial</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Tag:</td>
                                        <td class="text-end">R$ 200,00</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Descrição:</td>
                                        <td class="text-end">R$ 0,00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h6>Documentos</h6>
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Contrato:</td>
                                        <td class="text-end">Residencial</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Vistoria:</td>
                                        <td class="text-end">R$ 200,00</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Apólice:</td>
                                        <td class="text-end">R$ 0,00</td>
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

                        <div class="accordion-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi inventore illum, vero harum soluta quia suscipit, modi consectetur sed provident doloremque. Veritatis laudantium earum fugit, facere sed autem accusantium repudiandae.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header d-flex">
                    <h5>JOCILAINE</h5>
                    <span>INQUILINO</span>
                    <span class="badge badge-text-success">APROVADO</span>
                </div>

                <div class="card-body">
                    <div class="col-md-4">
                        <img src="{{asset('assets/img/avatars/1.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <h6 class="bg-light p-3">Dados Pessoais</h6>
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-bold">Nome:</td>
                                    <td class="text-end">Residencial</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">CPF:</td>
                                    <td class="text-end">R$ 200,00</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Data Nascimento:</td>
                                    <td class="text-end">R$ 0,00</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">E-mail:</td>
                                    <td class="text-end">R$ 0,00</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Telefone Fixo/Celular:</td>
                                    <td class="text-end">R$ 0,00</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Comprovante Fatura:</td>
                                    <td class="text-end">R$ 0,00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer">
                    <p>Termo Aprovado - 03/06/2025</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
