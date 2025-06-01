<?php

declare(strict_types=1);

namespace App\Http\Controllers;

abstract class Controller
{
    /*
     * @param array<string, string|null> $data
     * @param array<string> $fields
     * @return array<string, string|null>
     */
    protected function sanitizeData(?array $data, ?array $fields): ?array
    {
        $sanitize = function (?string $value): ?string {
            if (! $value) {
                return null;
            }

            $value = preg_replace('/\xC2\xA0|\xA0|\s+/u', ' ', $value);
            $value = trim($value);
            $value = preg_replace('/^R\$\s*/', '', $value);

            // Remove o símbolo de porcentagem, se existir
            $value = str_replace('%', '', $value);

            // Detecta se é um valor monetário/percentual no formato brasileiro (ex: 1.234,56)
            if (preg_match('/^[\d\.\,]+$/', $value)) {
                // Remove os pontos de milhar e troca vírgula por ponto
                $value = str_replace('.', '', $value);
                $value = str_replace(',', '.', $value);

                return $value;
            }

            // Caso seja um campo como CPF/CNPJ/telefone/endereço, remove todos os não numéricos
            if (preg_match('/^[\d.\-\/()\s]+$/', $value)) {
                return preg_replace('/\D/', '', $value);
            }

            return $value;
        };

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $data[$field] = $sanitize($data[$field]);
            }
        }

        return $data;
    }
}
