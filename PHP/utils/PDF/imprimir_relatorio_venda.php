<?php
require_once '../../../vendor/autoload.php';
require_once '../../../conn/conn.php'; // Arquivo com a conexão ao banco



try {


$data1 = $_GET['data1'] ?? '';
$data2 = $_GET['data2'] ?? '';
$filtros = [];

    if (!empty($data1) && !empty($data2)) {
        $filtros[] = "v.data_venda BETWEEN '$data1' AND '$data2'";
    } elseif (!empty($data1)) {
        $filtros[] = "v.data_venda >= '$data1'";
    } elseif (!empty($data2)) {
        $filtros[] = "v.data_venda <= '$data2'";
    }

    if (isset($_GET['funcionario']) && $_GET['funcionario'] !== '') {
        $funcionario = $_GET['funcionario'];
        $filtros[] = "v.id_funcionario = $funcionario";
    }

    $where = '';

    if (!empty($filtros)) {
        $where = 'WHERE ' . implode(' AND ', $filtros);
    }

    $sql = "

        SELECT v.id, 
            c.nome AS cliente, 
            f.nome AS funcionario, 
            ve.modelo AS modelo,
            ve.ano_fabricacao AS ano_fabricacao, 
            ve.ano_modelo, 
            ve.chassi, 
            ve.preco_custo AS preco_custo, 
            v.valor_venda AS preco_venda,
            ve.status, 
            ve.cor,
            v.data_venda 
        FROM vendas v 
            INNER JOIN clientes c ON c.id = v.id_cliente 
            INNER JOIN funcionarios f ON f.id = v.id_funcionario 
            INNER JOIN veiculos ve ON ve.id = v.id_veiculo 
            INNER JOIN forma_de_pagamento fp ON fp.id = v.id_forma_pagto 
        $where
        ORDER BY v.data_venda DESC;
    ";
    echo $sql;
    $res_relatorio = mysqli_query($conn, $sql);

    // Configuração do MPDF
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'orientation' => 'L'
    ]);

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
                    <th>Cliente</th>
                    <th>Funcionario</th>
                    <th>Modelo</th>
                    <th>Ano fabricacao</th>
                    <th>Ano Modelo</th>
                    <th>Chassi</th>
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
                    <td> '.htmlspecialchars($row['cliente']).'</td>
                    <td> '.htmlspecialchars($row['funcionario']).'</td>
                    <td>'.htmlspecialchars($row['modelo']).'</td>
                    <td class="data">'.htmlspecialchars($row['ano_fabricacao']).'</td>
                    <td class="data">'.htmlspecialchars($row['ano_modelo']).'</td>
                    <td>'.htmlspecialchars($row['chassi']).'</td>
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
//    echo $sql;
    $mpdf->WriteHTML($html);
    $mpdf->Output('relatorio_veiculos.pdf', 'I');

} catch (\Mpdf\MpdfException $e) {
    die('Erro ao gerar PDF: ' . $e->getMessage());
}