<?php

declare(strict_types = 1);

namespace App\Services\Delinquencies;

use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    public function outrosAnexos(array $request): array
    {
        return [
            'tipo_conta'          => $request['tipo_conta'],
            'observacao'          => $request['observacoes'],
            'valor_original'      => 0,
            'vencimento_original' => null,
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
            if (! empty($request["valor_{$tipo}_principal"])) {
                $maisBoletos[$tipo]['valor_original'] = $request["valor_{$tipo}_principal"];
            }

            if (! empty($request["vencimento_{$tipo}_principal"])) {
                $maisBoletos[$tipo]['vencimento_original'] = $request["vencimento_{$tipo}_principal"];
            }
        }

        return $maisBoletos;
    }

    public function getNovasContas(array $request): array
    {
        // Tipos de conta reconhecidos (ajuste se precisar)
        $tipos = [
            'aluguel',
            'condominio',
            'gas',
            'iptu',
            'seguro',
            'agua',
            'luz',
            'seguro_incendio',
            'orcamentos',
        ];

        $novos = [];

        // Mantém o tipo da conta, se existir
        if (isset($request['tipo_conta_novo'])) {
            $novos['conta']['tipo'] = $request['tipo_conta_novo'];
        }

        // Buffer para capturar valor/vencimento (não-original) e usar como fallback
        $buffer = [];

        foreach ($request as $key => $value) {
            // só lidamos com chaves terminando em "_novo"
            if (! str_ends_with($key, '_novo')) {
                continue;
            }

            if ($key === 'tipo_conta_novo') {
                continue;
            }
            // remove o sufixo "_novo"
            $clean = substr($key, 0, -5);

            // descobre o tipo pelo sufixo do nome (suporta tipos compostos como "seguro_incendio")
            $matchedTipo = null;
            $campo       = null;

            foreach ($tipos as $tipo) {
                if (str_ends_with($clean, "_{$tipo}")) {
                    $matchedTipo = $tipo;
                    $campo       = substr($clean, 0, -strlen("_{$tipo}"));

                    break;
                }
            }

            if ($matchedTipo === null) {
                continue;
            }

            if ($campo === null) {
                continue;
            }

            if ($campo === '') {
                continue;
            }

            if ($campo === '0') {
                continue;
            }

            // Guardar apenas os campos desejados; usar buffer para fallback
            if ($campo === 'valor_original' || $campo === 'vencimento_original') {
                $novos[$matchedTipo][$campo] = $value;
            } elseif ($campo === 'valor' || $campo === 'vencimento') {
                $buffer[$matchedTipo][$campo] = $value;
            }
        }

        // Helper para checar "não vazio" inclusive quando for array com null/'' dentro
        $notEmpty = function ($v): bool {
            if (is_array($v)) {
                foreach ($v as $vv) {
                    if ($vv !== null && $vv !== '') {
                        return true;
                    }
                }

                return false;
            }

            return $v !== null && $v !== '';
        };

        // Aplica fallback: se *_original estiver vazio, usa valor/vencimento (se existirem)
        foreach ($tipos as $tipo) {
            if (! isset($novos[$tipo]) && ! isset($buffer[$tipo])) {
                continue;
            }

            if (! $notEmpty($novos[$tipo]['valor_original'] ?? null)
                && $notEmpty($buffer[$tipo]['valor'] ?? null)) {
                $novos[$tipo]['valor_original'] = $buffer[$tipo]['valor'];
            }

            if (! $notEmpty($novos[$tipo]['vencimento_original'] ?? null)
                && $notEmpty($buffer[$tipo]['vencimento'] ?? null)) {
                $novos[$tipo]['vencimento_original'] = $buffer[$tipo]['vencimento'];
            }

            // Se continuar vazio, remove o tipo
            if (
                ! $notEmpty($novos[$tipo]['valor_original'] ?? null) &&
                ! $notEmpty($novos[$tipo]['vencimento_original'] ?? null)
            ) {
                unset($novos[$tipo]);
            }
        }

        return $novos;
    }

    public function anexos($request, $idImobiliaria, int $idInadimplencia, $token): void
    {
        $tipos = [
            'anexos-agua'            => 'Água',
            'anexos-condominio'      => 'Condomínio',
            'anexos-gas'             => 'Gás',
            'anexos-iptu'            => 'IPTU',
            'anexos-luz'             => 'Luz',
            'anexos-seguro'          => 'Seguro',
            'anexos-seguro_incendio' => 'Seguro Incêndio',
            'anexos-outros_anexos'   => 'Outros Anexos',
            'anexos_orcamento'       => 'Orçamentos',

            'anexos_novo_aluguel'     => 'Aluguel',
            'anexos_novo_condominio'  => 'Condomínio',
            'anexos_novo_iptu'        => 'IPTU',
            'anexos_novo_seguro'      => 'Seguro',
            'anexos_novo_agua'        => 'Água',
            'anexos_novo_luz'         => 'Luz',
            'anexos_novo_gas'         => 'Gás',
            'anexos_novo_seguro_incendio' => 'Seguro Incêndio',
            'anexos_novo_orcamento'   => 'Orçamentos',
            'anexos_novo_outros'      => 'Outros Anexos',
        ];

        foreach ($tipos as $campo => $descricao) {
            $this->processarAnexo($request, $campo, $descricao, $idImobiliaria, $idInadimplencia, $token);
        }
    }

    private function processarAnexo($request, string $campo, string $descricao, $idImobiliaria, int $idInadimplencia, $token): void
{
    // Se $request for array
    if (is_array($request)) {
        if (empty($request[$campo])) {
            return;
        }
        $files = $request[$campo];
    } else {
        // Se for um Request
        if (! $request->hasFile($campo)) {
            return;
        }
        $files = $request->file($campo);
    }

    // Normaliza para array (mesmo que seja apenas 1 arquivo)
    if (! is_array($files)) {
        $files = [$files];
    }

    foreach ($files as $file) {
        if (! $file || ! $file->isValid()) {
            continue;
        }

        $ext          = $file->getClientOriginalExtension();
        $nomeOriginal = $file->getClientOriginalName();

        $verificaAnexo = Http::withToken($token)->get(config('api.route') . '/attachment/exists', [
            'id_imobiliaria' => $idImobiliaria,
            'id_movi'        => $idInadimplencia,
            'nome_arquivo'   => $nomeOriginal,
        ]);

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

    public function export($request)
    {
        $queryParams = [
            'imovel'        => $request->input('imovel'),
            'nome'          => $request->input('nome_inquilino'),
            'cpf'           => $request->input('cpf_inquilino'),
            'status'        => $request->input('status'),
            'data_inicial'  => $request->input('data_aviso_inicial'),
            'data_final'    => $request->input('data_aviso_final'),
            'valor_inicial' => $request->input('valor_inadimplencia_inicial'),
            'valor_final'   => $request->input('valor_inadimplencia_final'),
        ];

        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $response = Http::withToken($token)->get(config('api.route') . '/delinquencies/export/' . $idImobiliaria, $queryParams);
        $data     = $response->json();

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        // ======= TABELA DE MOVIMENTAÇÕES =======
        $linha = 1;
        $sheet->fromArray(['Contrato', 'Cliente', 'Inicio da Fiança', 'Data Aviso de Inadimplência', 'Valor Total da Fiança', 'Valor Utilizado da Fiança', 'Valor Disponível da Fiança',
            'Status Contrato', 'Tipo',
        ], null, 'A' . $linha);
        $sheet->getStyle('A' . $linha . ':I' . $linha)->getFont()->setBold(true);
        $sheet->getStyle('A' . $linha . ':I' . $linha)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2');
        $linha++;

        foreach ($data['data'] as $movi) {
            $sheet->setCellValue('A' . $linha, $movi['contrato_id']);
            $sheet->setCellValue('B' . $linha, $movi['propostal']['pessoa_nome']);
            $dataFormatada              = empty($movi['propostal']['data']) ? '-' : \Carbon\Carbon::parse($movi['propostal']['data'])->format('d/m/Y');
            $dataFormatadaInadimplencia = empty($movi['vencimento_original']) ? '-' : \Carbon\Carbon::parse($movi['vencimento_original'])->format('d/m/Y');
            $sheet->setCellValue('C' . $linha, $dataFormatada);
            $sheet->setCellValue('D' . $linha, $dataFormatadaInadimplencia);
            $valorFiancaTotal = floatval(($movi['propostal']['imovel_aluguel'] * 40));
            $sheet->setCellValue('E' . $linha, $valorFiancaTotal);
            $sheet->getStyle('E' . $linha)->getNumberFormat()->setFormatCode('"R$" #,##0.00');
            $sheet->getStyle('E' . $linha)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('F' . $linha, floatval($movi['propostal']['imovel_aluguel']));
            $sheet->getStyle('F' . $linha)->getNumberFormat()->setFormatCode('"R$" #,##0.00');
            $sheet->getStyle('F' . $linha)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('G' . $linha, floatval(($valorFiancaTotal - $movi['propostal']['imovel_aluguel'])));
            $sheet->getStyle('G' . $linha)->getNumberFormat()->setFormatCode('"R$" #,##0.00');
            $sheet->getStyle('G' . $linha)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('H' . $linha, $movi['propostal']['contrato_status']);
            $sheet->setCellValue('I' . $linha, $movi['propostal']['imovel_tipo']);
            $linha++;
        }

        // AutoSize só da tabela pra frente
        foreach (range('A', 'I') as $coluna) {
            $sheet->getColumnDimension($coluna)->setAutoSize(true);
        }

        $writer   = new Xlsx($spreadsheet);
        $fileName = 'relatorio_inadimplencia_' . now()->format('Ymd_His') . '.xlsx';

        return response()->streamDownload(function () use ($writer): void {
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    public function exportarExtratoFinanceiro($request)
    {
        session('user');

        $queryParams = [
            'imovel'        => $request->input('imovel'),
            'nome'          => $request->input('nome_inquilino'),
            'cpf'           => $request->input('cpf_inquilino'),
            'status'        => $request->input('status'),
            'data_inicial'  => $request->input('data_aviso_inicial'),
            'data_final'    => $request->input('data_aviso_final'),
            'valor_inicial' => $request->input('valor_inadimplencia_inicial'),
            'valor_final'   => $request->input('valor_inadimplencia_final'),
        ];

        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $response = Http::withToken($token)->get(config('api.route') . '/delinquencies/' . $idImobiliaria, $queryParams);
        $data     = $response->json();

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        // ======= TABELA DE MOVIMENTAÇÕES =======
        $linha = 1;
        $sheet->fromArray(['Contrato', 'ID Comunicação', 'Data comunicação', 'Vencimento original', 'Valor original', 'Data indenização', 'Valor indenizado',
        ], null, 'A' . $linha);
        $sheet->getStyle('A' . $linha . ':G' . $linha)->getFont()->setBold(true);
        $sheet->getStyle('A' . $linha . ':G' . $linha)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2');
        $linha++;

        foreach ($data['data'] as $movi) {
            $sheet->setCellValue('A' . $linha, $movi['contrato_id']);
            $sheet->setCellValue('B' . $linha, '-');
            $dataFormatada = empty($movi['vencimento_original']) ? '-' : \Carbon\Carbon::parse($movi['vencimento_original'])->format('d/m/Y');
            $sheet->setCellValue('C' . $linha, '-');
            $sheet->setCellValue('D' . $linha, $dataFormatada);
            $sheet->setCellValue('E' . $linha, floatval($movi['valor_original']));
            $sheet->getStyle('E' . $linha)->getNumberFormat()->setFormatCode('"R$" #,##0.00');
            $sheet->getStyle('E' . $linha)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('F' . $linha, '-');
            $sheet->setCellValue('G' . $linha, '-');
            $linha++;
        }

        // AutoSize só da tabela pra frente
        foreach (range('A', 'I') as $coluna) {
            $sheet->getColumnDimension($coluna)->setAutoSize(true);
        }

        $writer   = new Xlsx($spreadsheet);
        $fileName = 'relatorio_inadimplencia_extrato_financeiro' . now()->format('Ymd_His') . '.xlsx';

        return response()->streamDownload(function () use ($writer): void {
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
