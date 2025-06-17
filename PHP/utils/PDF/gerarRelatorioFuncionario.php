<?php
require_once '../../../vendor/autoload.php';
require_once '../../../conn/conn.php'; // Arquivo com a conexão ao banco

try {

    $dataInicio = $_GET['data1']; 
    $datafim = $_GET['data2']; 

    // Configuração do MPDF
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'orientation' => 'L'
    ]);

        $sql = "SELECT 
        f.id,
        f.nome,
        COUNT(ve.id) AS total_vendas,
        SUM(ve.valor_venda) AS valor_total_vendas,
        MAX(ve.data_venda) AS ultima_venda
        FROM vendas ve 
        INNER JOIN veiculos v ON v.id = ve.id_veiculo 
        INNER JOIN funcionarios f ON f.id = ve.id_funcionario
        WHERE ve.data_venda BETWEEN '$dataInicio' AND '$datafim'
        GROUP BY f.id, f.nome
        ORDER BY total_vendas DESC
        ";
        // echo $sql;
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
                    <th>id</th>
                    <th>Funcionario</th>
                    <th>Total de Vendas</th>
                    <th>Valor total de vendas</th>
                    <th>Ultima venda</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = mysqli_fetch_assoc($res_relatorio)) {
        $html .= '
                <tr>
                    <td>'.htmlspecialchars($row['id']).'</td>
                    <td>'.htmlspecialchars($row['nome']).'</td>
                    <td>'.$row['total_vendas'].'</td>
                    <td>'.$row['valor_total_vendas'].'</td>
                    <td class="data">'.htmlspecialchars($row['ultima_venda']).'</td>
                    
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