<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Assets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AssetsController extends Controller
{
    public function index(Request $request): View
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $queryParams = [
            'search'     => $request->input('search'),
            'status'     => $request->input('status'),
            'created_at' => $request->input('created_at'),
            'pendences'  => $request->input('pendences'),
        ];

        $response = Http::withToken($token)->get(config('api.route') . '/assetsHome/' . $idImobiliaria, $queryParams);
        $data     = $response->json();

        $statusContagem = [
            'Todos'        => count($data['data'] ?? []),
            'Ativos'       => 0,
            'Cancelados'   => 0,
            'Em renovação' => 0,
            'Pendente'     => 0,
        ];

        if (! empty($data['contratos'])) {
            foreach ($data['contratos'] as $contrato) {
                $status = $contrato['CONTRATO_STATUS'] ?? '';
                $total  = $contrato['TOTAL'] ?? 0;

                // Mapear nomes conhecidos para os do card
                switch (strtolower($status)) {
                    case 'ativo':
                        $statusContagem['Ativos'] = $total;

                        break;
                    case 'cancelado':
                        $statusContagem['Cancelados'] = $total;

                        break;
                    case 'renovando':
                        $statusContagem['Em renovação'] = $total;

                        break;
                    case 'pendente':
                        $statusContagem['Pendente'] = $total;

                        break;
                }
            }
        }

        return view('assets.index', ['statusContagem' => $statusContagem, 'contratos' => $data['data']]);
    }

    public function find(string $id): View
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/assets/' . $id . '/find');
        $data     = $response->json();

        return view('assets.asset', ['data' => $data['data']]);
    }

    public function edit(): View
    {
        return view('assets.edit');
    }
}
