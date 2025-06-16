<?php
header('Content-Type: application/json');
require_once('../../conn/conn.php');

if (isset($_GET['veiculo'])) {
    $veiculo_id = $_GET['veiculo'];

    $sql = "SELECT preco_venda FROM veiculos WHERE id = $veiculo_id";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        header('Content-Type: application/json');
        echo json_encode($row);
    } else {
        echo json_encode(["erro" => "Veículo não encontrado"]);
    }
} else {
    echo json_encode(["erro" => "Parâmetro 'veiculo' não informado"]);
}

mysqli_close($conn);
?>