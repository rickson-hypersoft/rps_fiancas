<?php

declare(strict_types = 1);

namespace App\Services\Delinquencies;

class DelinquenciesService
{
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
}
