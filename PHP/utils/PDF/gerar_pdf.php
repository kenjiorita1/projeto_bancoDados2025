<?php
require_once '../../../vendor/autoload.php';
require_once '../../../conn/conn.php'; // Arquivo com a conexão ao banco

try {
    // Configuração do MPDF
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'orientation' => 'L'
    ]);

    $sql = "SELECT v.marca, v.modelo, v.ano_fabricacao, v.ano_modelo, v.chassi, v.preco_custo,v.preco_venda, v.cor,v.combustivel, v.status  FROM veiculos v ";
    $res_relatorio = mysqli_query($conn, $sql);

    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Relatório de Veículos</title>
        <style>
            body { font-family: Arial; }
            h1 { text-align: center; color: #333; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; }
            th { background-color: #f2f2f2; font-weight: bold; text-align: left; padding: 8px; border: 1px solid #ddd; }
            td { padding: 8px; border: 1px solid #ddd; }
            .valor { text-align: right; }
            .data { text-align: center; }
            .footer { margin-top: 30px; text-align: right; font-size: 12px; }
        </style>
    </head>
    <body>
        <h1>Relatório de Veículos</h1>
        
        <table>
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ano fabricacao</th>
                    <th>Ano Modelo</th>
                    <th>Chassi</th>
                    <th>combustivel</th>
                    <th>Valor custo</th>
                    <th>Valor Venda</th>
                    <th>Status</th>
                    <th>Cor</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = mysqli_fetch_assoc($res_relatorio)) {
        $html .= '
                <tr>
                    <td>'.htmlspecialchars($row['marca']).'</td>
                    <td>'.htmlspecialchars($row['modelo']).'</td>
                    <td class="data">'.htmlspecialchars($row['ano_fabricacao']).'</td>
                    <td class="data">'.htmlspecialchars($row['ano_modelo']).'</td>
                    <td>'.htmlspecialchars($row['chassi']).'</td>
                    <td>'.htmlspecialchars($row['combustivel']).'</td>
                    <td class="valor">R$'.number_format($row['preco_custo'], 2, ',', '.').'</td>
                    <td class="valor">R$'.number_format($row['preco_venda'], 2, ',', '.').'</td>
                    <td>'.htmlspecialchars($row['status']).'</td>
                    <td>'.htmlspecialchars($row['cor']).'</td>
                    
                </tr>';
    }

    $html .= '
            </tbody>
        </table>
        
        <div class="footer">
            Relatório gerado em: '.date('d/m/Y H:i:s').'
        </div>
    </body>
    </html>';

    $mpdf->WriteHTML($html);
    $mpdf->Output('relatorio_veiculos.pdf', 'I');

} catch (\Mpdf\MpdfException $e) {
    die('Erro ao gerar PDF: ' . $e->getMessage());
}