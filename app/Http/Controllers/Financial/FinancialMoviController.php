<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FinancialMoviController extends Controller
{
    public function index(Request $request): View
    {
        $hoje        = \Carbon\Carbon::now();
        $dataInicial = $request->input('data_inicial') ?? $hoje->copy()->startOfMonth()->format('Y-m-d');
        $dataFinal   = $request->input('data_final') ?? $hoje->copy()->endOfMonth()->format('Y-m-d');

        $queryParams = [
            'page'         => $request->get('page', 1),
            "id_conta"     => $request->input('id_conta'),
            "data_inicial" => $dataInicial,
            "data_final"   => $dataFinal,
            "id_categoria" => $request->input('id_categoria'),
            'descricao'    => $request->input('search'),
        ];

        $user = session('user');

        $responseContas = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_account/' . $user['id_imobiliaria'], ['active' => 1]);
        $contas         = $responseContas->json()['data'];

        $responseCategorias = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_category/' . $user['id_imobiliaria'], ['active' => 1]);
        $categorias         = $responseCategorias->json()['data'];

        $response      = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_movi/' . $user['id_imobiliaria'], $queryParams);
        $movimentacoes = $response->json()['data'];
        $valores       = $response->json()['valores'];

        return view('financial.financial_movi.index', [
            'movimentacoes' => $movimentacoes,
            'contas'        => $contas,
            'categorias'    => $categorias,
            'valores'       => $valores,
            'pagination'    => $response->json()['meta'],
        ]);
    }

    public function create(): View
    {
        $user = session('user');

        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_account/' . $user['id_imobiliaria'], ['active' => 1]);
        $contas   = $response->json()['data'];

        $response   = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_category/' . $user['id_imobiliaria'], ['active' => 1]);
        $categorias = $response->json()['data'];

        return view('financial.financial_movi.form', [
            'method'     => null,
            'action'     => route('financial.financial_movi.store'),
            'contas'     => $contas,
            'categorias' => $categorias,
            'movi'       => null,
        ]);
    }

    public function edit(string | int $id): View
    {
        $user = session('user');

        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_account/' . $user['id_imobiliaria'], ['active' => 1]);
        $contas   = $response->json()['data'];

        $response   = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_category/' . $user['id_imobiliaria'], ['active' => 1]);
        $categorias = $response->json()['data'];

        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/' . $id . '/financial_movi');
        $movi     = $response->json()['data'];

        return view('financial.financial_movi.form', [
            'method'     => 'PUT',
            'action'     => route('financial.financial_movi.update', $id),
            'contas'     => $contas,
            'categorias' => $categorias,
            'movi'       => $movi,
        ]);
    }

    public function store(Request $request)
    {
        $token = session('jwt_token');
        $user  = session('user');

        $requestSanitize = $request->all();

        if (isset($requestSanitize['valor'])) {
            $valor = $requestSanitize['valor'];

            // Remove espaços
            $valor = trim($valor);

            // Remove ponto como milhar, só se existir vírgula depois
            if (str_contains($valor, ',')) {
                $valor = str_replace('.', '', $valor);
                $valor = str_replace(',', '.', $valor);
            }

            $requestSanitize['valor'] = (float) $valor;
        }

        if ($requestSanitize['valor'] <= 0.0) {
            return back()->withErrors(['valor' => 'O valor deve ser maior que zero.'])->withInput();
        }

        $validator = Validator::make($requestSanitize, [
            'id_conta'     => 'nullable|numeric',
            'id_categoria' => 'nullable|numeric',
            'tipo'         => 'nullable|string',
            'historico'    => 'nullable|string',
            'valor'        => 'numeric|between:1,9999999.99',
            'data'         => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $financialMovi                   = $validator->validated();
        $financialMovi['id_imobiliaria'] = $user['id_imobiliaria'];

        $response       = Http::withToken($token)->post(config('api.route') . '/financial/financial_movi', $financialMovi);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('financial.financial_movi.index')->with('success', $returnResponse['message']);
    }

    public function update(Request $request, string | int $id)
    {
        $token = session('jwt_token');
        $user  = session('user');

        $requestSanitize = $request->all();

        if (isset($requestSanitize['valor'])) {
            $valor = $requestSanitize['valor'];

            // Remove espaços
            $valor = trim($valor);

            // Remove ponto como milhar, só se existir vírgula depois
            if (str_contains($valor, ',')) {
                $valor = str_replace('.', '', $valor);
                $valor = str_replace(',', '.', $valor);
            }

            $requestSanitize['valor'] = (float) $valor;
        }

        $validator = Validator::make($requestSanitize, [
            'id_conta'     => 'nullable|numeric',
            'id_categoria' => 'nullable|numeric',
            'tipo'         => 'nullable|string',
            'historico'    => 'nullable|string',
            'valor'        => 'nullable|numeric',
            'data'         => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $financialMovi                   = $validator->validated();
        $financialMovi['id_imobiliaria'] = $user['id_imobiliaria'];

        $response       = Http::withToken($token)->put(config('api.route') . '/financial/financial_movi/' . $id, $financialMovi);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('financial.financial_movi.index')->with('success', $returnResponse['message']);
    }

    public function delete(string | int $id): RedirectResponse
    {
        $response       = Http::withToken(session('jwt_token'))->delete(config('api.route') . '/financial/financial_movi/' . $id);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('financial.financial_movi.index')->with('success', $returnResponse['message']);
    }

    public function export(Request $request)
    {
        $user = session('user');

        $queryParams = [
            "id_conta"     => $request->input('id_conta'),
            "data_inicial" => $request->input('data_inicial'),
            "data_final"   => $request->input('data_final'),
            "id_categoria" => $request->input('id_categoria'),
            'descricao'    => $request->input('search'),
        ];

        $responseMovi  = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_movi/' . $user['id_imobiliaria'], $queryParams);
        $movimentacoes = $responseMovi->json()['data'];
        $valores       = $responseMovi->json()['valores'];

        $responseContas = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_account/' . $user['id_imobiliaria']);
        $contas         = collect($responseContas->json()['data']);

        $responseCategorias = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_category/' . $user['id_imobiliaria']);
        $categorias         = collect($responseCategorias->json()['data']);

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        // ======= CABEÇALHO =======
        // Linha 1 - Título + Empresa
        $sheet->setCellValue('A1', 'Relatório Movimentação Financeira');
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1:I1')->getFont()->setBold(true)->setSize(16)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:I1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('3C3C3C');
        $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Linha 2 - Período
        $dataInicial = $request->input('data_inicial') ? \Carbon\Carbon::parse($request->input('data_inicial'))->format('d/m/Y') : 'Não informado';
        $dataFinal   = $request->input('data_final') ? \Carbon\Carbon::parse($request->input('data_final'))->format('d/m/Y') : 'Não informado';
        $sheet->setCellValue('A2', 'Período de ' . $dataInicial . ' a ' . $dataFinal);
        $sheet->mergeCells('A2:I2');
        $sheet->getStyle('A2:I2')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A2:I2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('3C3C3C');
        $sheet->getStyle('A2:I2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(2)->setRowHeight(25);

        // Linha 3 - Barra Azul
        $sheet->mergeCells('A3:I3');
        $sheet->getStyle('A3:I3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('5C95C4');
        $sheet->getRowDimension(3)->setRowHeight(5);

        // ======= CARDS (Totais) =======
        $linha = 5;

        // Merges apenas para Débitos e Saldo Atual (mantendo duas linhas para cada)
        $sheet->mergeCells('C5:D5');  // Débitos - Título
        $sheet->mergeCells('C6:D6');  // Débitos - Valor
        $sheet->mergeCells('E5:F5');  // Saldo Atual - Título
        $sheet->mergeCells('E6:F6');  // Saldo Atual - Valor

        $cards = [
            [
                'titleCell' => 'A5',
                'valueCell' => 'A6',
                'label'     => 'Saldo Anterior',
                'value'     => $valores['saldoAnterior'] ?? 0,
                'color'     => 'B1AFAF',
                'merge'     => null,  // Sem merge
            ],
            [
                'titleCell' => 'B5',
                'valueCell' => 'B6',
                'label'     => 'Créditos',
                'value'     => $valores['entradas'] ?? 0,
                'color'     => '6DC45C',
                'merge'     => null,
            ],
            [
                'titleCell' => 'C5',
                'valueCell' => 'C6',
                'label'     => 'Débitos',
                'value'     => $valores['saidas'] ?? 0,
                'color'     => 'C45C5C',
                'merge'     => 'C5:D6',  // Débitos ocupa duas colunas nas duas linhas
            ],
            [
                'titleCell' => 'E5',
                'valueCell' => 'E6',
                'label'     => 'Saldo Atual',
                'value'     => $valores['saldoAtual'] ?? 0,
                'color'     => '5C95C4',
                'merge'     => 'E5:F6',
            ],
        ];

        foreach ($cards as $card) {
            if (isset($card['merge']) && ($card['merge'] !== '' && $card['merge'] !== '0')) {
                $sheet->getStyle($card['merge'])
                    ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);
                $sheet->getStyle($card['merge'])->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($card['color']);
                $sheet->getStyle($card['merge'])->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');

                $sheet->setCellValue($card['titleCell'], $card['label']);
                $sheet->setCellValue($card['valueCell'], 'R$ ' . number_format($card['value'], 2, ',', '.'));
            } else {
                // Para os que não tem merge (Saldo Anterior e Créditos)
                $sheet->getStyle($card['titleCell'] . ':' . $card['valueCell'])
                    ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)
                    ->setVertical(Alignment::VERTICAL_CENTER)
                    ->setWrapText(true);
                $sheet->getStyle($card['titleCell'] . ':' . $card['valueCell'])->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB($card['color']);
                $sheet->getStyle($card['titleCell'] . ':' . $card['valueCell'])->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');

                $sheet->setCellValue($card['titleCell'], $card['label']);
                $sheet->setCellValue($card['valueCell'], 'R$ ' . number_format($card['value'], 2, ',', '.'));
            }
        }

        // Altura das linhas dos cards
        $sheet->getRowDimension(5)->setRowHeight(25);
        $sheet->getRowDimension(6)->setRowHeight(25);

        // ======= TABELA DE MOVIMENTAÇÕES =======
        $linha = 8;

        $sheet->fromArray(['Conta', 'Categoria', 'Data', 'Histórico', 'Valor', 'Tipo'], null, 'A' . $linha);
        $sheet->getStyle('A' . $linha . ':F' . $linha)->getFont()->setBold(true);
        $sheet->getStyle('A' . $linha . ':F' . $linha)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2');
        $linha++;

        foreach ($movimentacoes as $movi) {
            $sheet->setCellValue('A' . $linha, $this->getContaDescricao($contas, $movi['id_conta'] ?? null));
            $sheet->setCellValue('B' . $linha, $this->getCategoriaDescricao($categorias, $movi['id_categoria'] ?? null));
            $dataFormatada = empty($movi['data']) ? '-' : \Carbon\Carbon::parse($movi['data'])->format('d/m/Y');
            $sheet->setCellValue('C' . $linha, $dataFormatada);
            $sheet->setCellValue('D' . $linha, $movi['historico'] ?? '-');
            $sheet->setCellValue('E' . $linha, floatval($movi['valor']));
            $sheet->getStyle('E' . $linha)->getNumberFormat()->setFormatCode('"R$" #,##0.00');
            $sheet->getStyle('E' . $linha)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('F' . $linha, $movi['tipo'] ?? '-');
            $linha++;
        }

        // AutoSize só da tabela pra frente
        foreach (range('A', 'F') as $coluna) {
            $sheet->getColumnDimension($coluna)->setAutoSize(true);
        }

        $writer   = new Xlsx($spreadsheet);
        $fileName = 'relatorio_financeiro_' . now()->format('Ymd_His') . '.xlsx';

        return response()->streamDownload(function () use ($writer): void {
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    private function getContaDescricao($contas, $id)
    {
        return optional($contas->firstWhere('id', $id))['descricao'] ?? '-';
    }

    private function getCategoriaDescricao($categorias, $id)
    {
        return optional($categorias->firstWhere('id', $id))['descricao'] ?? '-';
    }

    public function extract(Request $request)
    {
        $startDate  = $request->get('start_date');
        $finishDate = $request->get('finish_date');
        $direction  = $request->get('direction');
        $page       = (int) $request->get('page', 1);
        $perPage    = (int) $request->get('perPage', 20);

        $response = Http::withToken(session('jwt_token'))
            ->get(config('api.route') . '/extract/financial_movi', [
                'startDate'  => $startDate,
                'finishDate' => $finishDate,
                'direction'  => $direction,
                'page'       => $page,
                'perPage'    => $perPage,
            ]);

        if (! $response->successful()) {
            return view('financial.financial_movi.extract', [
                'extratos'   => [],
                'pagination' => [
                    'total'        => 0, 'from' => 0, 'to' => 0,
                    'current_page' => 1, 'last_page' => 1,
                ],
                'totals' => [
                    'saldoTotal'   => 0,
                    'recebimentos' => 0,
                    'taxas'        => 0,
                ],
                'errorApi' => 'Não foi possível carregar o extrato.',
            ]);
        }

        $extratos = $response->json('data') ?? [];
        $meta     = $response->json('meta') ?? [];
        $totals   = $response->json('totals') ?? [];

        $pagination = [
            'total'        => (int) ($meta['total'] ?? 0),
            'from'         => (int) ($meta['from'] ?? 0),
            'to'           => (int) ($meta['to'] ?? 0),
            'current_page' => (int) ($meta['current_page'] ?? $page),
            'last_page'    => (int) ($meta['last_page'] ?? 1),
            'perPage'      => (int) ($meta['per_page'] ?? $perPage),
        ];

        // defaults caso a API não mande algum campo
        $totals = array_merge([
            'saldoTotal'   => 0,
            'recebimentos' => 0,
            'taxas'        => 0,
        ], $totals);

        return view('financial.financial_movi.extract', [
            'extratos'   => $extratos,
            'pagination' => $pagination,
            'totals'     => $totals,
        ]);
    }
}
