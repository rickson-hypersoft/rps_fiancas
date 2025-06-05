<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PropostaController extends Controller
{
    public function create()
    {
        return view('propostas.wizard', [
            'step' => 'step1',
            'proposta' => null
        ]);
    }

    public function step2($id)
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/propostal/propostal/' . $id);
        $data = $response->json();
        $styles = $this->styleStep2($response->json());

        $responseSetup = Http::withToken($token)->get(config('api.route') . '/realestatesectorsetup/' . $data['id_imobiliaria']);
        $setups = $responseSetup->json();

        $parseValorBR = function ($valor) {
            if (is_string($valor)) {
                $valor = str_replace(['R$', '.', ' ', ' '], '', $valor); // Remove R$, pontos, espaços normais e não-quebráveis
                $valor = str_replace(',', '.', $valor); // Troca vírgula por ponto
            }
            return floatval($valor);
        };

        $imovelAluguel = $parseValorBR($data['imovel_aluguel'] ?? 0);
        $imovelCondominio = $parseValorBR($data['imovel_condominio'] ?? 0);
        $imovelTaxas = $parseValorBR($data['imovel_taxas'] ?? 0);

        $valorTotal = $imovelAluguel + $imovelCondominio + $imovelTaxas;
        $valorParcela = $valorTotal / 12;
        $valorTotalFormatado = 'R$ ' . number_format($valorTotal, 2, ',', '.');
        $valorFormatado = 'R$ ' . number_format($valorParcela, 2, ',', '.');
        $data['valor_parcelado'] = $valorFormatado;
        $data['valor_total'] = $valorTotalFormatado;


        return view('propostas.wizard', [
            'step' => 'step2',
            'proposta' => $data,
            'styles' => $styles,
            'setups' => $setups['data']
        ]);
    }

    public function saveStep1(Request $request)
    {
        $requestSanitize                      = $this->sanitizeData(
            $request->all(),
            ['imovel_cep', 'pessoa_doc']
        );

        $requestSanitize['imovel_aluguel']    = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_aluguel'] ?? '0'))));
        $requestSanitize['imovel_condominio'] = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_condominio'] ?? '0'))));
        $requestSanitize['imovel_taxas']      = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_taxas'] ?? '0'))));
        $requestSanitize['proposta_status'] = 'Rascunho';
        $requestSanitize['id_imobiliaria'] = session('user')['id_imobiliaria'];

        if ($requestSanitize['imovel_aluguel'] < 1500) {
            $requestSanitize['proposta_credito_status'] = 'Aprovado';
        }

        if ($requestSanitize['imovel_aluguel'] >= 1500 && $requestSanitize['imovel_aluguel'] <= 2500) {
            $requestSanitize['proposta_credito_status'] = 'Pendente';
        }

        if ($requestSanitize['imovel_aluguel'] > 2500) {
            $requestSanitize['proposta_credito_status'] = 'Negado';
        }

        $currentDate = new DateTime();
        $requestSanitize['data'] = $currentDate->format('Y-m-d');
        $requestSanitize['hora'] = $currentDate->format('H:i:s');

        $token = session('jwt_token');

        $response = Http::withToken($token)->post(config('api.route') . '/propostal/propostal/create', $requestSanitize);

        if (!$response->successful()) {
            return response()->json(['message' => 'Erro ao criar proposta na API'], 400);
        }

        $propostaId = $response->json(['data']);

        return response()->json([
            'success' => true,
            'message' => 'Proposta criada!',
            'data' => [
                'id' => $propostaId['id']
            ]
        ]);
    }

    public function saveStep2(Request $request, string | int $id)
    {
        $requestSanitize                      = $this->sanitizeData(
            $request->all(),
            []
        );


        $requestSanitize['imovel_aluguel']    = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_aluguel'] ?? '0'))));
        $requestSanitize['imovel_condominio'] = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_condominio'] ?? '0'))));
        $requestSanitize['imovel_taxas']      = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_taxas'] ?? '0'))));
        $requestSanitize['id_imobiliaria'] = session('user')['id_imobiliaria'];
        $requestSanitize['id'] = $id;

        $$requestSanitize['proposta_total_valor'] = $requestSanitize['imovel_aluguel'] +  $requestSanitize['imovel_condominio'] + $requestSanitize['imovel_taxas'];
        dd($requestSanitize);

        $currentDate = new DateTime();
        $requestSanitize['data_ultima_autalizacao'] = $currentDate->format('Y-m-d');
        $requestSanitize['hora_ultima_autalizacao'] = $currentDate->format('H:i:s');

        dd($requestSanitize);

        $token = session('jwt_token');

        $response = Http::withToken($token)->post(config('api.route') . '/propostal/propostal/create', $requestSanitize);

        if (!$response->successful()) {
            return response()->json(['message' => 'Erro ao criar proposta na API'], 400);
        }

        $propostaId = $response->json(['data']);

        return response()->json([
            'success' => true,
            'message' => 'Proposta criada!',
            'data' => [
                'id' => $propostaId['id']
            ]
        ]);
    }

    private function styleStep2($data)
    {
        switch ($data['proposta_credito_status']) {
            case 'Aprovado':
                return [
                    'colorText' => 'fw-bold text-success',
                    'text' => 'Crédito aprovado!',
                    'card' => 'content-header mb-4 p-5 bg-success text-white',
                    'icon' => 'menu-icon icon-base ti tabler-check',
                    'badge' => 'Simulação',
                    'detalhamento' => "O inquilino {$data['pessoa_nome']} do CPF {$data['pessoa_doc']} está aprovado para uma locação com garantia de um imóvel {$data['imovel_tipo']}, na cidade de {$data['imovel_cidade']} - {$data['imovel_estado']}",
                    'displaySetup' => 'block',
                    'cardStyle' => '',
                ];

            case 'Pendente':
                return [
                    'colorText' => 'fw-bold text-warning',
                    'text' => 'Crédito pendente de análise!',
                    'card' => 'content-header mb-4 p-5 text-white',
                    'cardStyle' => 'style="background: #FFA600"',
                    'icon' => 'menu-icon icon-base ti tabler-clock',
                    'badge' => 'Simulação',
                    'detalhamento' => "O inquilino {$data['pessoa_nome']} do CPF {$data['pessoa_doc']} está pendente de uma análise manual para uma locação com garantia de um imóvel {$data['imovel_tipo']}, na cidade de {$data['imovel_cidade']} - {$data['imovel_estado']}",
                    'displaySetup' => 'block',
                ];

            default:
                return [
                    'colorText' => 'fw-bold text-secondary',
                    'text' => 'Crédito reprovado para fiança!',
                    'card' => 'content-header mb-4 p-5 bg-secondary text-white',
                    'icon' => 'menu-icon icon-base ti tabler-x',
                    'badge' => 'badge bg-label-secondary',
                    'detalhamento' => "O inquilino {$data['pessoa_nome']} do CPF {$data['pessoa_doc']} está reprovado para uma locação com garantia de um imóvel {$data['imovel_tipo']}, na cidade de {$data['imovel_cidade']} - {$data['imovel_estado']}",
                    'displaySetup' => 'none',
                    'cardStyle' => '',
                ];
        }
    }
}
