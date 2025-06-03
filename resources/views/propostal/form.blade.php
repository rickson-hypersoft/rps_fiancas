@extends('dashboard')
@section('content')
<div class="col-12 mb-6">
    <div id="wizard-validation" class="bs-stepper mt-2 linear">
        <div class="bs-stepper-header">
            <div class="step active" data-target="#criar-proposta">
                <button type="button" class="step-trigger" aria-selected="true">
                    <span class="bs-stepper-circle">1</span>
                    <span class="bs-stepper-label mt-1">
                        <span class="bs-stepper-title">Criar proposta</span>
                        <span class="bs-stepper-subtitle">de fianças</span>
                    </span>
                </button>
            </div>

            <div class="line">
                <i class="icon-base ti tabler-chevron-right"></i>
            </div>
            <div class="step" data-target="#analise-credito">
                <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                    <span class="bs-stepper-circle">2</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Análise</span>
                        <span class="bs-stepper-subtitle">de crédito</span>
                    </span>
                </button>
            </div>

            <div class="line">
                <i class="icon-base ti tabler-chevron-right"></i>
            </div>
            <div class="step" data-target="#dados-complementares">
                <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                    <span class="bs-stepper-circle">3</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Dados</span>
                        <span class="bs-stepper-subtitle">complementares</span>
                    </span>
                </button>
            </div>

            <div class="line">
                <i class="icon-base ti tabler-chevron-right"></i>
            </div>
            <div class="step" data-target="#resumo">
                <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                    <span class="bs-stepper-circle">4</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Resumo</span>
                        <span class="bs-stepper-subtitle">proposta</span>
                    </span>
                </button>
            </div>

            <div class="line">
                <i class="icon-base ti tabler-chevron-right"></i>
            </div>
            <div class="step" data-target="#proposta-enviada">
                <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
                    <span class="bs-stepper-circle">5</span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Proposta</span>
                        <span class="bs-stepper-subtitle">concluída</span>
                    </span>
                </button>
            </div>
        </div>

        <div class="bs-stepper-content">
            <form id="wizard-validation-form" onsubmit="return false">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                @csrf
                <!-- Account Details -->
                @include('propostal.components.create-propostal', ['user' => session('user')])

                <!-- Personal Info -->
                @include('propostal.components.analys-credit', ['setups' => $setups])

                @include('propostal.components.resume')

                @include('propostal.components.confirmation')

                <!-- Social Links -->
                @include('propostal.components.complementar-data')
            </form>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let dropzone;

    // Só inicialize se ainda não existir
    if (!Dropzone.instances.length) {
        dropzone = new Dropzone("#dropzone-multi", {
            url: "/upload",
            autoProcessQueue: false,
            maxFiles: 6
        });
    } else {
        dropzone = Dropzone.instances[0]; // reutiliza a instância existente
    }

    const form = document.getElementById('wizard-validation-form');
    const formData = new FormData(form);

    IMask(document.getElementById('pessoa_doc'), {
        mask: '000.000.000-00'
    });
    IMask(document.getElementById('imovel_cep'), {
        mask: '00000-000'
    });

    IMask(document.getElementById('imovel_aluguel'), {
        mask: Number,
        scale: 2,
        thousandsSeparator: '.',  // CORRIGIDO: separador de milhar brasileiro
        padFractionalZeros: true, // Garante que sempre haja duas casas decimais
        normalizeZeros: true,
        radix: ',',               // separador decimal brasileiro
        mapToRadix: ['.'],
        min: 0,
        max: 1000000,
        autofix: true,
    });

    IMask(document.getElementById('imovel_condominio'), {
        mask: Number,
        scale: 2,
        thousandsSeparator: '.',  // CORRIGIDO: separador de milhar brasileiro
        padFractionalZeros: true, // Garante que sempre haja duas casas decimais
        normalizeZeros: true,
        radix: ',',               // separador decimal brasileiro
        mapToRadix: ['.'],
        min: 0,
        max: 1000000,
        autofix: true,
    });

    IMask(document.getElementById('imovel_taxas'), {
        mask: Number,
        scale: 2,
        thousandsSeparator: '.',  // CORRIGIDO: separador de milhar brasileiro
        padFractionalZeros: true, // Garante que sempre haja duas casas decimais
        normalizeZeros: true,
        radix: ',',               // separador decimal brasileiro
        mapToRadix: ['.'],
        min: 0,
        max: 1000000,
        autofix: true,
    });

    document.getElementById('imovel_cep').addEventListener('blur', function () {
        const cep = this.value.replace(/\D/g, '');

        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    const statusEl = document.getElementById('cep-status');

                    if (!data.erro) {
                        formData.append('imovel_estado', data.uf);
                        formData.append('imovel_cidade', data.localidade);

                        // Atualiza a escrita na div
                        statusEl.textContent = `${data.localidade} - ${data.uf}`;
                    } else {
                        statusEl.textContent = 'CEP não encontrado';
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar o CEP:', error);
                    document.getElementById('cep-status').textContent = 'Erro ao buscar o CEP';
                });
        } else {
            document.getElementById('cep-status').textContent = 'CEP inválido';
        }
    });

    async function carregarDadosProposta(id) {
        try {
            const response = await fetch(`/propostas/${id}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            const data = await response.json();
            if (!data) return;

            const {
                imovel_aluguel = 0,
                imovel_condominio = 0,
                imovel_taxas = 0,
                pessoa_nome,
                pessoa_doc,
                imovel_tipo,
                imovel_cidade,
                imovel_estado
            } = data;

            const card = document.querySelector('#card_status_propostal');
            const text = document.querySelector('#text_status_propostal');
            const colorText = document.querySelector('#color_text_imovel_aluguel');
            const icon = document.querySelector('#icon_status_propostal');
            const badge = document.querySelector('#badge_status_propostal');
            const detalhamento = document.querySelector('#detalhamento');

            let imovelAluguel = 0;

            if (typeof data.imovel_aluguel === 'string') {
                imovelAluguel = parseFloat(data.imovel_aluguel.replace(/\./g, '').replace(',', '.'));
            } else {
                imovelAluguel = parseFloat(data.imovel_aluguel);
            }

            const valorTotal = parseFloat(imovel_aluguel) + parseFloat(imovel_condominio) + parseFloat(imovel_taxas);
            const valorParcela = valorTotal / 12;

            function setTextIfExists(selector, text) {
                const el = document.querySelector(selector);
                if (el) {
                    el.textContent = text;
                } else {
                    console.warn(`Elemento não encontrado: ${selector}`);
                }
            }

            function preencherCampos() {
                setTextIfExists('#valor_total_vista', formatarReais(valorTotal));
                setTextIfExists('#valor_parcelado', formatarReais(valorParcela));
                setTextIfExists('#imovel_aluguel_text', formatarReais(data.imovel_aluguel));
                setTextIfExists('#imovel_condominio_text', formatarReais(data.imovel_condominio));
                setTextIfExists('#imovel_taxas_text', formatarReais(data.imovel_taxas));
                setTextIfExists('#pessoa_nome_text', data.pessoa_nome);
                setTextIfExists('#pessoa_doc_text', data.pessoa_doc);
                setTextIfExists('#imovel_tipo_text', data.imovel_tipo);
                setTextIfExists('#imovel_cidade_text', data.imovel_cidade);
                setTextIfExists('#imovel_estado_text', data.imovel_estado);
            }

            preencherCampos();

            const setupConfig = document.getElementById('setup-config');

            switch (true) {
                case data.proposta_credito_status == 'Aprovado':
                    colorText.className = 'fw-bold text-success';
                    text.textContent = 'Crédito aprovado!';
                    card.className = 'content-header mb-4 p-5 bg-success text-white';
                    icon.className = 'menu-icon icon-base ti tabler-check';
                    badge.textContent = 'Simulação';
                    detalhamento.textContent = `O inquilino ${data.pessoa_nome} do CPF ${data.pessoa_doc} está aprovado para uma locação com garantia de um imóvel ${data.imovel_tipo}, na cidade de ${data.imovel_cidade} - ${data.imovel_estado}`;
                    if (setupConfig) setupConfig.style.display = '';
                    break;

                case data.proposta_credito_status == 'Pendente':
                    colorText.className = 'fw-bold text-warning';
                    text.textContent = 'Crédito pendente de análise!';
                    card.className = 'content-header mb-4 p-5 text-white';
                    card.style.backgroundColor = '#FFA600';
                    badge.textContent = 'Simulação';
                    icon.className = 'menu-icon icon-base ti tabler-clock';
                    detalhamento.textContent = `O inquilino ${data.pessoa_nome} do CPF ${data.pessoa_doc} está pendente de uma análise manual para uma locação com garantia de um imóvel ${data.imovel_tipo}, na cidade de ${data.imovel_cidade} - ${data.imovel_estado}`;
                    if (setupConfig) setupConfig.style.display = '';
                    break;

                default:
                    colorText.className = 'fw-bold text-secondary';
                    text.textContent = 'Crédito reprovado para fiança!';
                    card.className = 'content-header mb-4 p-5 bg-secondary text-white';
                    icon.className = 'menu-icon icon-base ti tabler-x';
                    badge.textContent = 'Reprovado';
                    badge.className = 'badge bg-label-secondary';
                    detalhamento.textContent = `O inquilino ${data.pessoa_nome} do CPF ${data.pessoa_doc} está reprovado para uma locação com garantia de um imóvel ${data.imovel_tipo}, na cidade de ${data.imovel_cidade} - ${data.imovel_estado}`;
                    if (setupConfig) setupConfig.style.display = 'none';
                    break;
            }
        } catch (error) {
            console.error('Erro ao carregar dados da proposta:', error);
        }
    }

    function carregarDadosComplementares(id) {
        fetch(`/propostas/${id}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data) {
                    const campos = [
                        ['#imovel_cep_dados', data.imovel_cep],
                        ['#imovel_estado_dados', data.imovel_estado],
                        ['#imovel_cidade_dados', data.imovel_cidade],
                        ['#pessoa_nome_dados', data.pessoa_nome],
                        ['#pessoa_doc_dados', data.pessoa_doc]
                    ];

                    campos.forEach(([seletor, valor]) => {
                        const campo = document.querySelector(seletor);
                        if (campo) {
                            campo.value = valor;
                            campo.disabled = true;
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Erro ao carregar dados da COMPLEMENTARES:', error);
            });
    }

    function carregarResumoProposta(id) {
        fetch(`/propostas/${id}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data) {

                    const campos = [
                        ['#proposta_id', data.id],
                        ['#contrato_status_resumo', data.proposta_status],
                        ['#proposta_tipo_pagador_resumo', data.proposta_tipo_pagador],
                        ['#proposta_total_valor_resumo', data.proposta_total_valor],
                        ['#proposta_setup_valor_resumo', data.proposta_setup_valor],
                        ['#imovel_tipo_resumo', data.imovel_tipo],
                        ['#imovel_aluguel_resumo', data.imovel_aluguel],
                        ['#imovel_condominio_resumo', data.imovel_condominio],
                        ['#imovel_taxas_resumo', data.imovel_taxas],
                        ['#imovel_cep_resumo', data.imovel_cep],
                        ['#imovel_endereco_completo', data.endereco_completo],
                        ['#imovel_complemento_resumo', data.imovel_complemento],
                        ['#pessoa_nome_resumo', data.pessoa_nome],
                        ['#pessoa_doc_resumo', data.pessoa_doc],
                        ['#pessoa_telefone_resumo', data.pessoa_telefone],
                        ['#data_nascimento_resumo', data.data_nascimento],
                        ['#proposta_total_valor_total', data.proposta_total_valor],
                    ];

                    const camposReais = [
                        'proposta_total_valor_resumo',
                        'proposta_setup_valor_resumo',
                        'imovel_taxas_resumo',
                        'imovel_aluguel_resumo',
                        'imovel_condominio_resumo',
                        'proposta_total_valor_total',
                    ];


                    campos.forEach(([seletor, valor]) => {
                        const campo = document.querySelector(seletor);
                        if (campo) {
                            const id = campo.id;
                            campo.textContent = camposReais.includes(id) ? formatarReais(valor) : valor;
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Erro ao carregar dados dO RESUMO:', error);
            });
    }

    function formatarReais(valor) {
        const numero = parseFloat(valor);
        if (isNaN(numero)) return 'Valor inválido';
        return numero.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    }

    const FORM_PREFIX = 'form_data_';

    // Salva os campos no localStorage, com a chave "form_data_{propostaId}"
    function salvarFormularioLocal(propostaId) {
        if (!propostaId) return;
        const formData = {};

        document.querySelectorAll('#wizard-validation-form input, #wizard-validation-form select, #wizard-validation-form textarea')
            .forEach(field => {
                if (field.id) {
                    if (field.type === 'checkbox') {
                        formData[field.id] = field.checked;
                    } else {
                        formData[field.id] = field.value;
                    }
                }
            });

        localStorage.setItem(`${FORM_PREFIX}${propostaId}`, JSON.stringify(formData));
    }

    function salvarDados(propostaId) {
        document.querySelectorAll('#wizard-validation-form input, #wizard-validation-form select, #wizard-validation-form textarea')
            .forEach(field => {
                field.addEventListener('input', () => {
                    salvarFormularioLocal(propostaId);
                });
                field.addEventListener('change', () => {
                    salvarFormularioLocal(propostaId);
                });
            });
    }

    function limparFormularioLocal(propostaId) {
        localStorage.removeItem(`${FORM_PREFIX}${propostaId}`);
    }

    function restaurarFormularioLocal(propostaId) {
        if (!propostaId) return;
        const savedData = localStorage.getItem(`${FORM_PREFIX}${propostaId}`);
        if (!savedData) return;

        const formData = JSON.parse(savedData);
        for (let id in formData) {
            const el = document.getElementById(id);
            if (el) {
                if (el.type === 'radio') {
                    if (formData[el.name] === el.value) {
                        el.checked = true;
                    }
                } else {
                    el.value = formData[id];
                }
            }
        }
    }

    let propostaId = null;
    document.getElementById('btn-simular-credito').addEventListener('click', function (e) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        e.preventDefault(); // Impede a navegação imediata

        const requiredFields = {
            'id_imobiliaria': 'ID da Imobiliária',
            'pessoa_tipo': 'Tipo da pessoa',
            'pessoa_doc': 'Documento',
            'pessoa_nome': 'Nome',
            'imovel_tipo': 'Tipo do imóvel',
            'imovel_cep': 'CEP do imóvel',
            'imovel_aluguel': 'Valor aluguel',
            'imovel_condominio': 'Valor condomínio',
            'imovel_taxas': 'Taxas',
        };

        const missingFields = [];

        Object.keys(requiredFields).forEach(field => {
            let value = '';

            if (field === 'pessoa_tipo' || field === 'imovel_tipo') {
                // Para inputs do tipo radio, verifica qual está marcado
                const checkedRadio = document.querySelector(`input[name="${field}"]:checked`);
                value = checkedRadio ? checkedRadio.value.trim() : '';
            } else {
                const el = document.getElementById(field);
                value = el ? el.value.trim() : '';
            }

            if (!value) {
                missingFields.push(requiredFields[field]);
            }
        });

        if (missingFields.length > 0) {
            const list = missingFields.map(f => `- ${f}`).join('<br>');

            Swal.fire({
                title: 'Atenção',
                html: `Preencha os seguintes campos obrigatórios:<br><br>${list}`,
                icon: 'warning'
            });
            return;
        }

        let imovelAluguelPropostal = parseFloat(document.getElementById('imovel_aluguel').value.replace(',', '.'));
        if (isNaN(imovelAluguelPropostal) || imovelAluguelPropostal <= 0) {
            Swal.fire('Valor inválido', 'O valor do aluguel é inválido.', 'error');
            return;
        }

        // Exibe o SweetAlert de carregamento
        Swal.fire({
            title: 'Aguarde...',
            text: 'Análise de crédito em andamento',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        formData.append('id_imobiliaria', document.getElementById('id_imobiliaria').value);
        formData.append('pessoa_tipo', document.querySelector('input[name="pessoa_tipo"]:checked')?.value || '');
        formData.append('imovel_tipo', document.querySelector('input[name="imovel_tipo"]:checked')?.value || '');
        formData.append('pessoa_doc', document.getElementById('pessoa_doc').value);
        formData.append('pessoa_nome', document.getElementById('pessoa_nome').value);
        formData.append('imovel_cep', document.getElementById('imovel_cep').value);
        formData.append('imovel_aluguel', document.getElementById('imovel_aluguel').value ?? 0);
        formData.append('imovel_condominio', document.getElementById('imovel_condominio').value ?? 0);
        formData.append('imovel_taxas', document.getElementById('imovel_taxas').value ?? 0);
        formData.append('id', propostaId ?? null);
        formData.append('proposta_status', 'Rascunho');

        let imovelAluguel = document.getElementById('imovel_aluguel').value
        imovelAluguel = imovelAluguel.replace(/\./g, '').replace(',', '.');

        if (imovelAluguel < 1500) {
            formData.append('proposta_credito_status', 'Aprovado');

        } else if (imovelAluguel >= 1500 && imovelAluguel <= 2500) {
            formData.append('proposta_credito_status', 'Pendente');
        }
        else {
            formData.append('proposta_credito_status', 'Negado');
        }

        fetch('/propostas/criar-proposta', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(async data => {
                Swal.close();

                if (!data.success) {
                    const mensagens = data.message;
                    let mensagemFinal = '';
                    if (typeof mensagens === 'object') {
                        for (let campo in mensagens) {
                            mensagemFinal += `${mensagens[campo].join(', ')}\n`;
                        }
                    } else {
                        mensagemFinal = mensagens;
                    }
                    Swal.close();
                    Swal.fire('Erro', mensagemFinal, 'error');
                    return;
                }

                propostaId = data.data.id; // Salva o ID retornado

                await carregarDadosProposta(propostaId);

                salvarDados(propostaId)

                // Avança para o próximo step do wizard
                document.querySelector('#analise-credito').style.display = '';
                document.querySelector('.btn-next').click();
            })
            .catch(error => {
                Swal.close();
                console.error('Erro ao criar proposta:', error);
                Swal.fire('Erro', 'Não foi possível criar a proposta.', 'error');
            });
    });

    document.getElementById('btn-analise-credito').addEventListener('click', function (e) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        e.preventDefault(); // Impede a navegação imediata

        const requiredFields = {
            'setup': 'Setup',
        };

        const missingFields = [];

        Object.keys(requiredFields).forEach(field => {
            const el = document.getElementById(field);
            const value = el ? el.value.trim() : '';

            if (!value) {
                missingFields.push(requiredFields[field]);
            }
        });

        if (missingFields.length > 0) {
            const list = missingFields.map(f => `- ${f}`).join('<br>');

            Swal.fire({
                title: 'Atenção',
                html: `Por favor preencher o campo de setup`,
                icon: 'warning'
            });
            return;
        }

        // Exibe o SweetAlert de carregamento


        formData.append('proposta_total_valor', document.getElementById('valor_total_vista').textContent);
        formData.append('proposta_setup_valor', document.getElementById('setup').value);
        formData.append('id', propostaId);

        fetch('/propostas/criar-proposta', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(async data => {
                Swal.close();

                if (!data.success) {
                    const mensagens = data.message;
                    let mensagemFinal = '';
                    if (typeof mensagens === 'object') {
                        for (let campo in mensagens) {
                            mensagemFinal += `${mensagens[campo].join(', ')}\n`;
                        }
                    } else {
                        mensagemFinal = mensagens;
                    }
                    Swal.close();
                    Swal.fire('Erro', mensagemFinal, 'error');
                    return;
                }

                propostaId = data.data.id; // Salva o ID retornado
                limparFormularioLocal(propostaId)

                await carregarDadosComplementares(propostaId)

                salvarDados(propostaId)
                // Avança para o próximo step do wizard
                document.querySelector('.btn-next').click();
            })
            .catch(error => {
                Swal.close();
                console.error('Erro ao criar proposta:', error);
                Swal.fire('Erro', 'Não foi possível criar a proposta.', 'error');
            });
    });

    document.getElementById('btn-dados').addEventListener('click', function (e) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        e.preventDefault(); // Impede a navegação imediata

        const requiredFields = {
            'imovel_cep_dados': 'CEP do Imóvel',
            'imovel_endereco': 'Endereço do Imóvel',
            'imovel_bairro': 'Bairro do Imóvel',
            'imovel_estado_dados': 'Estado do Imóvel',
            'imovel_cidade_dados': 'Cidade do Imóvel',
            'imovel_numero': 'Número do Imóvel',
            'imovel_complemento': 'Complemento do Imóvel',
            'imovel_subtipo': 'Subtipo do Imóvel',
            'pessoa_nome_dados': 'Nome da Pessoa',
            'pessoa_doc_dados': 'Documento da Pessoa',
            'data_nascimento': 'Data de Nascimento',
            'pessoa_email': 'Email da Pessoa',
            'pessoa_telefone': 'Telefone da Pessoa',
            'imovel_ramo_atv': 'Ramo de Atividade do Imóvel'
        };

        const missingFields = [];

        Object.keys(requiredFields).forEach(field => {
            const el = document.getElementById(field);
            const value = el ? el.value.trim() : '';

            if (!value) {
                missingFields.push(requiredFields[field]);
            }
        });

        if (missingFields.length > 0) {
            const list = missingFields.map(f => `- ${f}`).join('<br>');
            Swal.close();
            Swal.fire({
                title: 'Atenção',
                html: `Preencha os seguintes campos obrigatórios:<br><br>${list}`,
                icon: 'warning'
            });
            return;
        }

        Swal.fire({
            title: 'Aguarde...',
            text: 'Aguarde o resumo da proposta',
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        formData.append('imovel_cep', document.getElementById('imovel_cep_dados').value);
        formData.append('imovel_endereco', document.getElementById('imovel_endereco').value);
        formData.append('imovel_bairro', document.getElementById('imovel_bairro').value);
        formData.append('imovel_estado', document.getElementById('imovel_estado_dados').value);
        formData.append('imovel_cidade', document.getElementById('imovel_cidade_dados').value);
        formData.append('imovel_numero', document.getElementById('imovel_numero').value);
        formData.append('imovel_complemento', document.getElementById('imovel_complemento').value);
        formData.append('pessoa_nome', document.getElementById('pessoa_nome_dados').value);
        formData.append('pessoa_doc', document.getElementById('pessoa_doc_dados').value);
        formData.append('data_nascimento', document.getElementById('data_nascimento').value);
        formData.append('pessoa_email', document.getElementById('pessoa_email').value);
        formData.append('pessoa_telefone', document.getElementById('pessoa_telefone').value);
        formData.append('imovel_ramo_atv', document.getElementById('imovel_ramo_atv').value);
        formData.append('imovel_subtipo', document.getElementById('imovel_subtipo').value);
        formData.append('imovel_tag', document.getElementById('imovel_tag').value);
        formData.append('id', propostaId);

        dropzone.getAcceptedFiles().forEach((file, index) => {
            formData.append(`imagens[${index}]`, file, file.name);
        });

        fetch('/propostas/criar-proposta', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(async data => {
                Swal.close();

                if (!data.success) {
                    const mensagens = data.message;
                    let mensagemFinal = '';
                    if (typeof mensagens === 'object') {
                        for (let campo in mensagens) {
                            mensagemFinal += `${mensagens[campo].join(', ')}\n`;
                        }
                    } else {
                        mensagemFinal = mensagens;
                    }
                    Swal.close();
                    Swal.fire('Erro', mensagemFinal, 'error');
                    return;
                }

                propostaId = data.data.id; // Salva o ID retornado

                await carregarResumoProposta(propostaId)
                // Avança para o próximo step do wizard
                salvarDados(propostaId)
                document.querySelector('.btn-next').click();
            })
            .catch(error => {
                Swal.close();
                console.error('Erro ao criar proposta:', error);
                Swal.fire('Erro', 'Não foi possível criar a proposta.', 'error');
            });
    });

    document.getElementById('propostal-canceled').addEventListener('click', function (e) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        e.preventDefault(); // Impede a navegação imediata

        formData.append('proposta_status', 'Cancelado');
        formData.append('proposta_credito_status', 'Cancelado');

        fetch('/propostas/criar-proposta', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(async data => {
                Swal.close();

                if (!data.success) {
                    const mensagens = data.message;
                    let mensagemFinal = '';
                    if (typeof mensagens === 'object') {
                        for (let campo in mensagens) {
                            mensagemFinal += `${mensagens[campo].join(', ')}\n`;
                        }
                    } else {
                        mensagemFinal = mensagens;
                    }
                    Swal.close();
                    Swal.fire('Erro', mensagemFinal, 'error');
                    return;
                }

                propostaId = data.data.id; // Salva o ID retornado
                limparFormularioLocal(propostaId)
                Swal.fire({
                    title: 'Proposta cancelada!',
                    text: 'A proposta foi cancelada com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'Criar nova proposta',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/propostas/criar-proposta'; // Altere a URL se necessário
                    }
                });
            })
            .catch(error => {
                Swal.close();
                console.error('Erro ao criar proposta:', error);
                Swal.fire('Erro', 'Não foi possível criar a proposta.', 'error');
            });
    });

    document.getElementById('btn-confirmation').addEventListener('click', function (e) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        e.preventDefault(); // Impede a navegação imediata

        fetch(`/propostas/${propostaId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data) {
                    const card = document.querySelector('#background-confirmation');
                    const text = document.querySelector('#text_card_primary');
                    const paragrapfCard = document.querySelector('#paragraph_card');
                    const id_proposta = document.querySelector('#id_proposta');
                    const link = document.querySelector('#link');

                    id_proposta.textContent = data.id
                    link.href = '/proposta/resumo/' + data.id

                    if (data.proposta_credito_status == 'Aprovado') {
                        text.textContent = 'A proposta enviada e aguardando ativação pelo inquilino.';
                        text.className = 'fw-bold text-success'
                        paragrapfCard.textContent = 'A ativação do contrato locação com garantia da Invicta é efetivada mediante o aceite dos termos e pagamento. Enviamos os próximos passos para o e-mail e WhatsApp da pessoa inquilina.'
                        card.className = 'content-header mb-4 p-5 bg-success text-white';
                    } else if (data.proposta_credito_status == 'Pendente') {
                        text.textContent = 'A proposta está em análise manual pelo nosso time interno.';
                        text.className = 'fw-bold text-warning'
                        paragrapfCard.textContent = 'Estaremos em contato através da nossa plataforma e por e-mail para dar retorno em até 30 minutos.'
                        card.className = 'content-header mb-4 p-5 text-white';
                        card.style.backgroundColor = '#FFA600';
                    } else if (data.proposta_credito_status == 'Negado') {
                        text.textContent = 'A proposta está em análise manual pelo nosso time interno.';
                        paragrapfCard.textContent = 'Estaremos em contato através da nossa plataforma e por e-mail para dar retorno em até 30 minutos.'
                        card.className = 'content-header mb-4 p-5 bg-success text-white';
                    }

                    limparFormularioLocal(propostaId)
                }
            })
            .catch(error => {
                console.error('Erro ao carregar dados da CONFIRMAÇÃO:', error);
            });
    });

    document.getElementById('btn-nova-simulacao').addEventListener('click', function (e) {
        limparFormularioLocal(propostaId)
    })

    window.addEventListener('DOMContentLoaded', () => {
        propostaId = localStorage.getItem('proposta_id'); // Se já existir
        restaurarFormularioLocal(propostaId);
    });
</script>
@endsection
@endsection
