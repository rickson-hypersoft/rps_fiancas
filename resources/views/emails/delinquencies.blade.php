<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hypersoft</title>
</head>

<body style="margin:0;padding:0;background-color: rgb(200, 200, 200);">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: rgb(200, 200, 200); padding: 20px 0;">
        <tr>
            <td align="center">
                <img src="http://invicta.kinghost.net/fianca/assets/img/logo.svg" alt="Logo Invicta" />
            </td>
        </tr>
        <tr>
            <td align="center">

                <table align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation"
                    style="width: 100%;max-width:37.5em;background:#ffffff;border-radius:10px; font-family: Inter,Roboto,arial,sans-serif;font-size:14px;color:#191f23;overflow:hidden;">
                    <tr>
                        <td>
                            <table width="100%" style="padding:0px 40px; margin-top:32px;">
                                <tr>
                                    <td>
                                        <p style="font-size:24px;font-weight:700;color:#7367f0;">Inadimplência criada
                                            com sucesso!</p>
                                    </td>
                                </tr>
                            </table>

                            <table width="100%" style="padding:0px 40px">
                                <tr>
                                    <td>
                                        <p>Olá, {{ $nome }}!</p>

                                        <p>Informamos que, após a análise da solicitação, o(s) valor(es) solicitado(s)
                                            foram aprovado(s) conforme o valor original de
                                            <strong>R$ {{ number_format($valor_original, 2, ',', '.') }}</strong>.
                                        </p>

                                        <p>Encaminhamos os dados para pagamento via TED para o dia
                                            <strong>{{ \Carbon\Carbon::parse($vencimento_original)->format('d/m/Y') }}</strong>.
                                            Por gentileza, confirme o recebimento na conta informada após as 18h dessa
                                            data.
                                        </p>

                                        <p>Segue o detalhamento do(s) valor(es) aprovado(s):</p>

                                        <p>- {{ utf8_decode($tipo_conta) }}
                                            ({{ \Carbon\Carbon::parse($vencimento_original)->format('d/m/Y') }}):
                                            <strong>R$ {{ number_format($valor_original, 2, ',', '.') }}</strong>
                                            (aprovado conforme o valor locatício contratado)
                                        </p>

                                        <p>Valor total aprovado:
                                            <strong>R$ {{ number_format($valor_original, 2, ',', '.') }}</strong>
                                        </p>

                                        <p>Durante o período de cobrança, a imobiliária está autorizada a receber
                                            diretamente os valores dos locatários.
                                            Caso isso ocorra, solicitamos que a cobrança seja cancelada na plataforma.
                                        </p>

                                        <p><strong>Atenção:</strong> Este é um e-mail automático. Favor não responder a
                                            esta mensagem.
                                            Todas as dúvidas e documentos devem ser registradas exclusivamente na
                                            plataforma.</p>
                                    </td>
                                </tr>
                            </table>






                </table>
            </td>
        </tr>
    </table>
    </table>
    </td>
    </tr>
    </table>
</body>

</html>
