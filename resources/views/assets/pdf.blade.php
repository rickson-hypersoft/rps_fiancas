<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Declaração de Rescisão</title>

    <style>
        /* ====== CONFIG PDF/IMPRESSÃO ====== */
        @page {
            size: A4;
            margin: 22mm 18mm 22mm 18mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #111;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* “Folha” */
        .page {
            min-height: calc(297mm - 44mm);
            /* altura A4 - margens aproximadas */
            position: relative;
        }

        /* ====== TOPO (ondas + logo) ====== */
        .top {
            position: relative;
            padding-top: 6mm;
            margin-bottom: 10mm;
        }

        .top-waves {
            position: absolute;
            top: -6mm;
            left: 0;
            right: 0;
            height: 18mm;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            pointer-events: none;
            overflow: hidden;
        }

        .top-waves img {
            width: 100%;
            height: auto;
            max-height: 18mm;
            object-fit: cover;
        }

        .brand {
            text-align: center;
            /* DomPDF respeita bem */
            margin-top: 8mm;
            margin-bottom: 6mm;
        }

        .brand img {
            display: inline-block;
            /* garante que o text-align funcione */
            height: 18mm;
            width: auto;
        }

        /* ====== TÍTULO ====== */
        .title {
            font-size: 14pt;
            font-weight: 700;
            line-height: 1.25;
            margin: 0 0 2mm 0;
        }

        .subtitle-line {
            font-size: 11pt;
            margin: 0 0 10mm 0;
        }

        .subtitle-line .underline {
            text-decoration: underline;
            font-weight: 700;
        }

        /* ====== CORPO ====== */
        .content {
            font-size: 11pt;
            line-height: 1.35;
        }

        .label-block {
            margin-top: 6mm;
            margin-bottom: 8mm;
        }

        .label-block p {
            margin: 0.6mm 0;
        }

        .label {
            font-weight: 400;
            /* no seu PDF parece “normal”, não super negrito */
        }

        .statement {
            margin-top: 6mm;
            text-align: left;
        }

        .signature {
            margin-top: 14mm;
            font-size: 11pt;
        }

        .company {
            margin-top: 1mm;
            font-size: 11pt;
        }

        /* Opcional: ajuda a manter “cara” de documento */
        .spacer {
            height: 2mm;
        }
    </style>
</head>

<body>
    <div class="page">
        <header class="top">
            <!-- Ondas do topo (troque o src pelo arquivo real, se tiver) -->
            {{-- <div class="top-waves">
                <img src="waves-top.png" alt="Ondas decorativas do topo" />
            </div> --}}

            <!-- Logo central (troque o src pelo arquivo real) -->
            <div class="brand">
                <img src="{{ public_path('assets/img/logo_alt.png') }}">
            </div>
        </header>

        <main class="content">
            <h1 class="title">Declaração de Rescisão Contratual e Inexistência de Débitos</h1>

            <p class="subtitle-line">
                <span class="underline">Dados do Contrato Nº {{ $data['id'] }}</span>
            </p>

            <section class="label-block">
                <p><span class="label">Inquilino:</span> {{ $data['pessoa_nome'] }}</p>
                <p><span class="label">CPF:</span> {{ $data['pessoa_doc'] }}</p>
                <p>
                    <span class="label">Endereço Imóvel:</span>
                    {{ $data['imovel_endereco'] }}, nº {{ $data['imovel_numero'] }} - {{ $data['imovel_bairro'] }} -
                    {{ $data['imovel_cep'] }}, {{ $data['imovel_cidade'] }} – {{ $data['imovel_estado'] }}
                </p>
                <p>
                    <span class="label">Data de Ativação:</span>
                    {{ \Carbon\Carbon::parse($data['data'])->format('d/m/Y') }}
                </p>

                <p>
                    <span class="label">Data de Rescisão/Aditivo:</span>
                    {{ \Carbon\Carbon::parse($data['data_cancelamento'])->format('d/m/Y') }}
                </p>

                <p>
                    <span class="label">Data de Entrega das Chaves/Rescisão:</span>
                    {{ \Carbon\Carbon::parse($data['data_entrega_chave'])->format('d/m/Y') }}
                </p>
            </section>

            <section class="statement">
                <p>
                    Declara-se para todos os fins de direito admitidos, que o Contrato de Locação do Imóvel com
                    dados supracitados, foi encerrado/teve sua garantia substituída em
                    {{ \Carbon\Carbon::parse($data['data_cancelamento'])->format('d/m/Y') }}, conferindo a
                    Imobiliária/Locador a mais plena, rasa, geral e irrevogável quitação em relação à
                    INVICTA, não servindo a presente declaração, em
                    qualquer hipótese, como quitação ao Locatário(a)
                </p>
            </section>

            <section class="signature">
                <p>
                    Iturama,
                    {{ \Carbon\Carbon::parse($data['data_cancelamento'])->locale('pt_BR')->translatedFormat('d \d\e F \d\e Y') }}
                </p>
                {{-- <p class="company">Invicta LTDA CNPJ/MF sob o n. 15087173000166</p> --}}
            </section>
        </main>
    </div>
</body>

</html>
