<?php

declare(strict_types=1);

namespace App\Http\Controllers\Propostal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PropostalController extends Controller
{
    public function index()
    {

        return view('propostal.index');
    }

    public function create()
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(getenv('API_ROUTE') . '/realestatesectorsetup/' . session('user')['id_imobiliaria']);
        $setups = $response->json()['data'];

        return view('propostal.form', ['setups' => $setups]);
    }

    public function find(string|int $id)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(getenv('API_ROUTE') . '/propostal/propostal/' . $id);

        return $response;
    }

    public function store(Request $request)
    {
        $requestSanitize = $this->sanitizeData($request->all(), ['proposta_total_valor', 'proposta_setup_valor', 'imovel_cep', 'pessoa_doc']);
        $requestSanitize['imovel_aluguel'] = floatval($requestSanitize['imovel_aluguel']);
        $requestSanitize['imovel_condominio'] = floatval($requestSanitize['imovel_condominio']);
        $requestSanitize['imovel_taxas'] = floatval($requestSanitize['imovel_taxas']);

        if(isset($requestSanitize['proposta_total_valor']) || isset($requestSanitize['proposta_setup_valor'])) {
            $requestSanitize['proposta_total_valor'] = floatval($requestSanitize['proposta_total_valor']);
            $requestSanitize['proposta_setup_valor'] = floatval($requestSanitize['proposta_setup_valor']);
        }

        $token    = session('jwt_token');

        $response = Http::withToken($token)->post(getenv('API_ROUTE') . '/propostal/propostal/create', $requestSanitize);

        return $response;
    }
}
