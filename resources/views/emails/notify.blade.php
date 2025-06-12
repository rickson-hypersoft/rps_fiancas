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
                <img src="{{asset('assets/img/logo.svg')}}" alt="Logo Invicta" />
            </td>
        </tr>
        <tr>
            <td align="center">

                <table align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;max-width:37.5em;background:#ffffff;border-radius:10px; font-family: Inter,Roboto,arial,sans-serif;font-size:14px;color:#191f23;overflow:hidden;">
                    <tr>
                        <td>
                            <table width="100%" style="padding:0px 40px; margin-top:32px;">
                                <tr>
                                    <td>
                                        <p style="font-size:24px;font-weight:700;color:#7367f0;">Parabéns!</p>
                                        <p style="font-weight:700;color:#697077;">Falta pouco para você pegar as chaves do seu novo imóvel</p>
                                    </td>
                                </tr>
                            </table>

                            <table width="100%" style="padding:0px 40px">
                                <tr>
                                    <td>
                                        <p>Olá, {{$nome}}!</p>
                                        <p> É muito bom ter você conosco.
                                            Nós estamos te ajudando a alugar um imóvel.
                                            Seu cadastro foi aprovado e agora faltam apenas alguns passos para finalizar seu cadastro.</p>
                                        <p>Para continuar a alugar o seu imóvel de forma rápida e sem burocracia, siga os seguintes passos:</p>
                                    </td>
                                </tr>
                            </table>


                            <table width="100%" cellpadding="0" cellspacing="0" style="padding: 0px 40px;margin-top: 32px;">
                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <table cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td style="vertical-align: top; padding-right: 10px;">
                                                    <div style="width:24px; height:24px; border:1px solid #191f23; border-radius:50%; text-align:center; line-height:24px; font-size:14px;">
                                                        1
                                                    </div>
                                                </td>
                                                <td style="font-family: sans-serif; font-size:14px; color:#191f23;">
                                                    Clique no botão abaixo e faça seu login via CPF;
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <table cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td style="vertical-align: top; padding-right: 10px;">
                                                    <div style="width:24px; height:24px; border:1px solid #191f23; border-radius:50%; text-align:center; line-height:24px; font-size:14px;">
                                                        2
                                                    </div>
                                                </td>
                                                <td style="font-family: sans-serif; font-size:14px; color:#191f23;">
                                                    Realize sua biometria facial para acessar os termos de serviço e aceitá-los;
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <table cellpadding="0" cellspacing="0" role="presentation">
                                            <tr>
                                                <td style="vertical-align: top; padding-right: 10px;">
                                                    <div style="width:24px; height:24px; border:1px solid #191f23; border-radius:50%; text-align:center; line-height:24px; font-size:14px;">
                                                        3
                                                    </div>
                                                </td>
                                                <td style="font-family: sans-serif; font-size:14px; color:#191f23;">
                                                    Realize o pagamento das taxas e pronto!
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <table width="100%" style="padding:0px 40px">
                                <tr>
                                    <td>
                                        <p>Atente-se as dicas para realização da biometria facial:</p>

                                    </td>
                                </tr>
                                <tr>
                                    <ul>
                                        <li>Precisa ser realizada pelo titular do CPF cadastrado;</li>

                                        <li>Encontre um local bem iluminado;</li>

                                        <li>Mantenha uma expressão neutra;</li>

                                        <li>Evite usar óculos ou máscara.</li>
                                    </ul>
                                </tr>
                            </table>

                            <table width="100%" style="text-align:center; padding:10px 0 24px 0">
                                <tr>
                                    <td>
                                        <p>acesse o link para encontrar oque você procura</p>
                                        <a style="color:#fff;background-color:#7367f0;padding:10px 20px;font-size:12px;border-radius:5px;text-decoration:none;display:inline-block;" href="{{route('activation.index', ['linkHash' => $link])}}">
                                            Fazer leitura dos termos e alugar meu imóvel
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- <table width="100%" style="padding:0px 40px">
                                <tr>
                                    <td>
                                        <p><b>Atenciosamente,</b><br>Hypersoft / Software House</p>
                                    </td>
                                </tr>-->
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