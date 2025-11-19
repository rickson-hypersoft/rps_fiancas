<div id="dados-complementares" class="content active fv-plugins-bootstrap5 fv-plugins-framework">
    <div class="content-header bg-primary mb-4 p-5">
        <h4 class="fw-bold mb-0 text-center text-white">
            Dados complementares
        </h4>
    </div>
    <div class="row g-6 justify-content-center">
        <div class="col-lg-8 m-0 px-0.5">
            <div class="card">
                <form id="form-proposta" method="POST">
                    <div class="card-body mb-0 pb-0">
                        <div class="content-header mb-4">
                            <h6 class="mb-0">Endereço do imóvel a ser alugado</h6>
                            <hr />
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-4 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="imovel_cep">CEP</label>
                                    <input type="text" name="imovel_cep" id="imovel_cep_dados"
                                        class="form-control form-control-lg" value="{{ $proposta['imovel_cep'] }}"
                                        disabled />
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="imovel_endereco">Endereço</label>
                                    <input type="text" name="imovel_endereco" id="imovel_endereco"
                                        class="form-control form-control-lg"
                                        value="{{ $proposta['imovel_endereco'] }}" />
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="imovel_bairro">Bairro</label>
                                    <input type="text" name="imovel_bairro" id="imovel_bairro"
                                        class="form-control form-control-lg" value="{{ $proposta['imovel_bairro'] }}" />
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="imovel_estado">Estado</label>
                                    <input type="text" name="imovel_estado" id="imovel_estado_dados"
                                        class="form-control form-control-lg" value="{{ $proposta['imovel_estado'] }}"
                                        disabled />
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="imovel_cidade">Cidade</label>
                                    <input type="text" name="imovel_cidade" id="imovel_cidade_dados"
                                        class="form-control form-control-lg" value="{{ $proposta['imovel_cidade'] }}"
                                        disabled />
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="imovel_numero">Número</label>
                                    <input type="text" name="imovel_numero" id="imovel_numero"
                                        class="form-control form-control-lg" value="{{ $proposta['imovel_numero'] }}" />
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="imovel_complemento">Complemento</label>
                                    <input type="text" name="imovel_complemento" id="imovel_complemento"
                                        class="form-control form-control-lg"
                                        value="{{ $proposta['imovel_complemento'] }}" />
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="imovel_subtipo">Subtipo do imóvel</label>
                                    <select class="form-select form-select-lg" name="imovel_subtipo" id="imovel_subtipo"
                                        aria-label="Default select example">
                                        <option value="">
                                            Selecionar finalidade
                                        </option>
                                        <option value="Apartamento"
                                            {{ ($proposta['imovel_subtipo'] ?? '') == 'Apartamento' ? 'selected' : '' }}>
                                            Apartamento
                                        </option>
                                        <option value="Casa"
                                            {{ ($proposta['imovel_subtipo'] ?? '') == 'Casa' ? 'selected' : '' }}>
                                            Casa
                                        </option>
                                        <option value="Chácara"
                                            {{ ($proposta['imovel_subtipo'] ?? '') == 'Chácara' ? 'selected' : '' }}>
                                            Chácara</option>
                                        <option value="Sobrado"
                                            {{ ($proposta['imovel_subtipo'] ?? '') == 'Sobrado' ? 'selected' : '' }}>
                                            Sobrado</option>
                                        <option value="Terreno"
                                            {{ ($proposta['imovel_subtipo'] ?? '') == 'Terreno' ? 'selected' : '' }}>
                                            Terreno</option>
                                        <option value="Consultório"
                                            {{ ($proposta['imovel_subtipo'] ?? '') == 'Consultório' ? 'selected' : '' }}>
                                            Consultório</option>
                                        <option value="Escritório"
                                            {{ ($proposta['imovel_subtipo'] ?? '') == 'Escritório' ? 'selected' : '' }}>
                                            Escritório</option>
                                        <option value="Galpão"
                                            {{ ($proposta['imovel_subtipo'] ?? '') == 'Galpão' ? 'selected' : '' }}>
                                            Galpão</option>
                                        <option value="Laje Comercial"
                                            {{ ($proposta['imovel_subtipo'] ?? '') == 'Laje Comercial' ? 'selected' : '' }}>
                                            Laje Comercial</option>
                                        <option value="Loja"
                                            {{ ($proposta['imovel_subtipo'] ?? '') == 'Loja' ? 'selected' : '' }}>
                                            Loja</option>
                                        <option value="Prédio Comercial"
                                            {{ ($proposta['imovel_subtipo'] ?? '') == 'Prédio Comercial' ? 'selected' : '' }}>
                                            Prédio Comercial</option>
                                        <option value="Sala"
                                            {{ ($proposta['imovel_subtipo'] ?? '') == 'Sala' ? 'selected' : '' }}>
                                            Sala</option>
                                        <option value="Sobreloja"
                                            {{ ($proposta['imovel_subtipo'] ?? '') == 'Sobreloja' ? 'selected' : '' }}>
                                            Sobreloja</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="imovel_tag">Tag</label>
                                    <input type="text" name="imovel_tag" id="imovel_tag"
                                        class="form-control form-control-lg" value="{{ $proposta['imovel_tag'] }}" />
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-header mb-4 mt-5">
                            <h6 class="mb-0">Contato do inquilino (Pagador)</h6>
                            <hr />
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="pessoa_nome">Nome</label>
                                    <input type="text" name="pessoa_nome" id="pessoa_nome_dados"
                                        class="form-control form-control-lg" value="{{ $proposta['pessoa_nome'] }}"
                                        disabled />
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="pessoa_doc">CPF</label>
                                    <input type="text" name="pessoa_doc" id="pessoa_doc_dados"
                                        class="form-control form-control-lg" value="{{ $proposta['pessoa_doc'] }}"
                                        disabled />
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="data_nascimento">Data nascimento</label>
                                    @php
                                        $dataNascimento = null;

                                        if ($proposta['data_nascimento']) {
                                            $dataObj = DateTime::createFromFormat(
                                                'Y-m-d',
                                                $proposta['data_nascimento'],
                                            );
                                            $dataNascimento = $dataObj->format('Y-m-d');
                                        }

                                    @endphp
                                    <input type="date" name="data_nascimento" id="data_nascimento"
                                        class="form-control form-control-lg" value="{{ $dataNascimento ?? '' }}"
                                        autocomplete="off" />
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="pessoa_email">E-mail</label>
                                    <input type="text" name="pessoa_email" id="pessoa_email"
                                        class="form-control form-control-lg"
                                        value="{{ $proposta['pessoa_email'] }}" />
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="pessoa_telefone">Telefone</label>
                                    <input type="text" name="pessoa_telefone" id="pessoa_telefone"
                                        class="form-control form-control-lg"
                                        value="{{ $proposta['pessoa_telefone'] }}" />
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="imovel_ramo_atv">Tipo da pessoa</label>
                                    <select class="form-select form-select-lg" name="imovel_ramo_atv"
                                        id="imovel_ramo_atv" aria-label="Default select example">
                                        <option value="Inquilino"
                                            {{ ($proposta['imovel_ramo_atv'] ?? '') == 'Inquilino' ? 'selected' : '' }}>
                                            Inquilino
                                        </option>
                                        <option value="Correspondente"
                                            {{ ($proposta['imovel_ramo_atv'] ?? '') == 'Correspondente' ? 'selected' : '' }}>
                                            Correspondente
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-control-validation fv-plugins-icon-container">
                                    <label class="form-label" for="observacao">Observações</label>
                                    <textarea id="observacao" name="observacao" class="form-control form-control-lg" rows="5">{{ $proposta['observacao'] }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row gy-6">
                            <div class="col-12">
                                <div class="content-header mb-4 mt-5">
                                    <h6 class="mb-0">Documentos</h6>
                                </div>
                                <div action="/upload" class="dropzone needsclick dz-clickable" id="dropzone-multi">
                                    <div class="dz-message needsclick">
                                        Arraste para cá ou clique para selecionar
                                        arquivos
                                        <span class="note needsclick">Envie até 6 arquivos</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-between mb-5 mt-5">
                            <a href="{{ route('propostal.step2', ['id' => $proposta['id']]) }}"
                                class="btn btn-label-secondary btn-prev waves-effect">
                                <i class="icon-base ti tabler-arrow-left icon-xs me-sm-2 me-0"></i>
                                <span class="d-sm-inline-block d-none align-middle">Voltar</span>
                            </a>
                            <button id="btn-dados" type="submit"
                                class="btn btn-primary btn-next-dados waves-effect waves-light">
                                <span class="d-sm-inline-block d-none me-sm-2 align-middle">Salvar</span>
                                <i class="icon-base ti tabler-arrow-right icon-xs"></i>
                            </button>
                        </div>
                </form>
            </div>
        </div>

    </div>
</div>
</div>

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        IMask(document.getElementById('pessoa_telefone'), {
            mask: '00 00000-0000'
        });

        let dropzone;

        // Só inicialize se ainda não existir
        if (!Dropzone.instances.length) {
            dropzone = new Dropzone("#dropzone-multi", {
                url: "/upload",
                autoProcessQueue: false,
                maxFiles: 7,
                accept: function(file, done) {
                    if (dropzone.files.length >= dropzone.options.maxFiles) {
                        done("Você só pode enviar até 6 arquivos");
                        Swal.fire({
                            icon: 'error',
                            title: 'Erro!',
                            text: "Você só pode enviar até 6 arquivos"
                        });
                    } else {
                        done();
                    }
                }
            });

            dropzone.on("addedfile", function(file) {
                if (dropzone.files.length > dropzone.options.maxFiles) {
                    dropzone.removeFile(file);
                }
            });
        } else {
            dropzone = Dropzone.instances[0];

            // Aqui adiciona o evento para garantir que funciona também na instância já criada
            dropzone.options.maxFiles = 7;

            dropzone.on("addedfile", function(file) {
                if (dropzone.files.length > dropzone.options.maxFiles) {
                    dropzone.removeFile(file);
                }
            });

            // Para o accept, infelizmente ele é só na criação, então você pode substituir a função no objeto:
            dropzone.options.accept = function(file, done) {
                if (dropzone.files.length >= dropzone.options.maxFiles) {
                    done("Você só pode enviar até 6 arquivos");
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro!',
                        text: "Você só pode enviar até 6 arquivos"
                    });
                } else {
                    done();
                }
            };
        }

        const idProposta = "{{ $proposta['id'] }}"

        document.getElementById('form-proposta').addEventListener('submit', async function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const url = `/fianca/propostas/salvar-step3/${idProposta}`;

            // Adiciona os arquivos do Dropzone
            dropzone.getAcceptedFiles().forEach((file, index) => {
                formData.append(`imagens[${index}]`, file, file.name);
            });

            // Abre o SweetAlert de loading antes de iniciar o fetch
            Swal.fire({
                title: 'Aguarde...',
                text: 'Atualizando dados complementares',
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                // Redireciona para a próxima etapa
                window.location.href = `/fianca/propostas/step4/${data.data.id}`;

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
