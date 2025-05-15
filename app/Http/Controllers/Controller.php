<?php

declare(strict_types = 1);

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

            // Apenas números se for um campo com formatação
            if (preg_match('/^[\d.\-\/()\s]+$/', $value)) {
                return preg_replace('/\D/', '', $value);
            }

            return trim($value); // Para nomes ou textos comuns
        };

        // Campos que precisam de sanitização
        foreach ($fields as $field) {
            if (isset($data[$field])) {
                $data[$field] = $sanitize($data[$field]);
            }
        }

        return $data;
    }
}
