<?php
// Definir cabeçalhos para download do CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="veiculo.csv"');

// Criar um ponteiro de saída para o CSV
$output = fopen('php://output', 'w');

// Adiciona BOM para garantir que o CSV será lido corretamente com acentuação
echo "\xEF\xBB\xBF";

// Cabeçalhos do CSV
$headers = [
    'Cliente',
    'Funcionario',
    'Modelo',
    'Ano Fabricacao',
    'Ano Modelo',
    'Chassi',
    'Preço custo',
    'Preço Venda',
    'Status',
    'Cor',
    'Data Venda'
];
 
fputcsv($output, $headers, ';'); // Usa ';' como separador

// Conexão com o banco de dados
include_once('../../../conn/conn.php');

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



$sql = "SELECT v.id, 
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
        ORDER BY v.data_venda DESC";

$result =  mysqli_query($conn, $sql);

if (!$result) {
    die("Erro no prepare: " . $conn->error);
}

if ($result-> num_rows > 0) {

} else {
    echo "Nenhum resultado encontrado.<br>";
}


while ($row = mysqli_fetch_assoc($result)) {

    $data_venda = $row['data_venda'] ? (new DateTime($row['data_venda']))->format('d/m/Y') : "";
   
    $data = [
        $row['cliente'] ?? '#',
        $row['funcionario'] ?? '#',
        $row['modelo'] ?? '#',
        $row['ano_fabricacao'] ?? '#',
        $row['ano_modelo'] ?? '#',
        $row['chassi'] ?? '#',
        $row['preco_custo'] ?? '#',
        $row['preco_venda'] ?? '#',
        $row['status'] ?? '#',
        $row['cor'] ?? '#',
        $data_venda ?: '#'
    ];

    $data = array_map(function($value) {
        return ($value === NULL || $value === '') ? '' : $value;
    }, $data);


    fputcsv($output, $data, ';');
}



fclose($output);
mysqli_close($conn)
?>
