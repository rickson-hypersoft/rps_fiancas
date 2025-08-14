<?php

declare(strict_types = 1);

namespace App\Services\Delinquencies;

use Illuminate\Support\Facades\Http;

class DelinquenciesService
{
    public function aluguel(array $request): array
    {
        return [
            'tipo_conta'          => $request['tipo_conta'],
            'valor_original'      => $request['valor_original_aluguel'],
            'vencimento_original' => $request['vencimento_original_aluguel'],
        ];
    }

    public function condominio(array $request): array
    {
        return [
            'tipo_conta'          => $request['tipo_conta'],
            'valor_original'      => $request['valor_original_condominio'],
            'vencimento_original' => $request['vencimento_original_condominio'],
        ];
    }

    public function iptu(array $request): array
    {
        return [
            'tipo_conta'          => $request['tipo_conta'],
            'valor_original'      => $request['valor_original_iptu'],
            'vencimento_original' => $request['vencimento_original_iptu'],
        ];
    }

    public function seguro(array $request): array
    {
        return [
            'tipo_conta'          => $request['tipo_conta'],
            'valor_original'      => $request['valor_original_seguro'],
            'vencimento_original' => $request['vencimento_original_seguro'],
        ];
    }

    public function agua(array $request): array
    {
        return [
            'tipo_conta'          => $request['tipo_conta'],
            'valor_original'      => $request['valor_original_agua'],
            'vencimento_original' => $request['vencimento_original_agua'],
        ];
    }

    public function luz(array $request): array
    {
        return [
            'tipo_conta'          => $request['tipo_conta'],
            'valor_original'      => $request['valor_original_luz'],
            'vencimento_original' => $request['vencimento_original_luz'],
        ];
    }

    public function gas(array $request): array
    {
        return [
            'tipo_conta'          => $request['tipo_conta'],
            'valor_original'      => $request['valor_original_gas'],
            'vencimento_original' => $request['vencimento_original_gas'],
        ];
    }

    public function seguroIncendio(array $request): array
    {
        return [
            'tipo_conta'          => $request['tipo_conta'],
            'valor_original'      => $request['valor_original_seguro_incendio'],
            'vencimento_original' => $request['vencimento_original_seguro_incendio'],
        ];
    }

    public function maisBoletos(array $request): array
    {
        $tipos = [
            'agua',
            'condominio',
            'gas',
            'iptu',
            'seguro',
            'seguro_incendio',
        ];

        $maisBoletos = [];

        foreach ($tipos as $tipo) {
            if (! empty($request["valor_outro_boleto_{$tipo}"])) {
                $maisBoletos[$tipo]['valor_original'] = $request["valor_outro_boleto_{$tipo}"];
            }

            if (! empty($request["vencimento_outro_boleto_{$tipo}"])) {
                $maisBoletos[$tipo]['vencimento_original'] = $request["vencimento_outro_boleto_{$tipo}"];
            }
        }

        return $maisBoletos;
    }

    public function anexos($request, $idImobiliaria, string $idInadimplencia, $token): void
    {
        $tipos = [
            'anexos-agua'            => 'Inadimplência Água',
            'anexos-condominio'      => 'Inadimplência Condomínio',
            'anexos-gas'             => 'Inadimplência Gás',
            'anexos-iptu'            => 'Inadimplência IPTU',
            'anexos-luz'             => 'Inadimplência Luz',
            'anexos-seguro'          => 'Inadimplência Seguro',
            'anexos-seguro_incendio' => 'Inadimplência Seguro Incêndio',
            'anexos-outros_anexos'   => 'Inadimplência Outros Anexos',
        ];

        foreach ($tipos as $campo => $descricao) {
            $this->processarAnexo($request, $campo, $descricao, $idImobiliaria, $idInadimplencia, $token);
        }
    }

    private function processarAnexo($request, string $campo, string $descricao, $idImobiliaria, string $idInadimplencia, $token): void
    {
        // Se $request for array
        if (is_array($request)) {
            if (empty($request[$campo])) {
                return;
            }
            $file = $request[$campo];
        } else {
            // Se for um Request
            if (! $request->hasFile($campo)) {
                return;
            }
            $file = $request->file($campo);
        }

        if (! $file || ! $file->isValid()) {
            return;
        }

        $ext          = $file->getClientOriginalExtension();
        $nomeOriginal = $file->getClientOriginalName();

        $verificaAnexo = Http::withToken($token)->get(config('api.route') . '/attachment/exists', [
            'id_imobiliaria' => $idImobiliaria,
            'id_movi'        => $idInadimplencia,
            'nome_arquivo'   => $nomeOriginal,
        ]);

        // Aqui ajustei a lógica para "adicionar quando não existir"
        if ($verificaAnexo->ok() && $verificaAnexo->json()['exists'] === false) {
            $nomeUnico = uniqid($idInadimplencia . '_') . '.' . $ext;

            $file->storeAs("anexos/{$idImobiliaria}/inadimplencia", $nomeUnico, 'public');

            Http::withToken($token)->post(config('api.route') . '/attachment', [
                'id_imobiliaria'        => $idImobiliaria,
                'id_movi'               => $idInadimplencia,
                'movi'                  => 'inadimplencias',
                'movi_sub'              => $descricao,
                'data'                  => now()->format('Y-m-d H:i:s'),
                'nome_arquivo'          => $nomeUnico,
                'nome_arquivo_original' => $nomeOriginal,
                'descricao'             => "Arquivo anexado à {$descricao}",
            ]);
        }
    }
}
