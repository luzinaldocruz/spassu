<?php

namespace App\Http\Controllers\Api;

use App\Services\RelatorioLivrosPorAutorService;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class RelatorioLivrosPorAutorController extends AbstractController
{
    public function __construct(RelatorioLivrosPorAutorService $service)
    {
        parent::__construct($service);
    }

    public function gerarPdf(Request $request)
    {
        $relatorio = $this->service->getAll($request);

        if (!$relatorio) {
            return response()->json(['error' => 'Nenhum dado encontrado'], 404);
        }

        $html = '<h1 class="centralizar">Livros por Autor</h1>';

        $autores = [];
        foreach ($relatorio as $livro) {
            $keyLivro = "{$livro['Codl']}_{$livro['Titulo']}";
            if (!isset($autores[$livro['autor']][$keyLivro])) {
                $autores[$livro['autor']][$keyLivro] = [
                    'Titulo' => $livro['Titulo'],
                    'Edicao' => $livro['Edicao'],
                    'AnoPublicacao' => $livro['AnoPublicacao'],
                    'Editora' => $livro['Editora'],
                    'assuntos' => []
                ];
            }
            $autores[$livro['autor']][$keyLivro]['assuntos'][] = $livro['assunto'];
        }

        $html .= '<style>
                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; }
                .autor-header { background-color: #e0e0e0; font-weight: bold; }
                .livro-row { background-color: #f9f9f9;}
                .assunto-row { background-color: #ffffff; }
                .espaco-livro { height: 10px; }
                .centralizar {text-align: center;}
                .small-font {font-size: 12px !important;}
              </style>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%">';
        $html .= '<thead>
                <tr>
                    <th>Título do Livro</th>
                    <th>Edição</th>
                    <th>Ano de Publicação</th>
                    <th>Editora</th>
                </tr>
              </thead>';
        $html .= '<tbody>';

        foreach ($autores as $autor => $livros) {
            $html .= '<tr class="autor-header">';
            $html .= "<td colspan='4'><strong>Autor: {$autor}</strong></td>";
            $html .= '</tr>';

            foreach ($livros as $livro) {

                $html .= '<tr class="livro-row">';
                $html .= "<td class='small-font'>{$livro['Titulo']}</td>";
                $html .= "<td class='small-font'>{$livro['Edicao']}</td>";
                $html .= "<td class='small-font'>{$livro['AnoPublicacao']}</td>";
                $html .= "<td class='small-font'>{$livro['Editora']}</td>";
                $html .= '</tr>';

                $html .= '<tr class="assunto-row">';
                $html .= "<td colspan='4'><strong>Assuntos:</strong> " . implode(', ', array_unique($livro['assuntos'])) . "</td>";
                $html .= '</tr>';

                $html .= '<tr class="espaco-livro"><td colspan="4"></td></tr>';
            }
        }

        $html .= '</tbody></table>';

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="relatorio-livros-por-autor.pdf"');
    }
}
