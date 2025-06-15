<?php
include_once('../../conn/conn.php');

// Recebendo os dados do formulário
$cliente = $_POST['cliente'];
$funcionario = $_POST['funcionario'];
$veiculo = $_POST['veiculo'];
$forma_pagto = $_POST['forma_pagto'];
$valor_venda = $_POST['valor_venda'];
$data_venda = $_POST['data_venda']; // Ex: 2025-05-01

if (!$conn) {
    die("Erro ao conectar: " . mysqli_connect_error());
}

// Query de inserção
$sql = "INSERT INTO vendas (id_cliente, id_funcionario, id_veiculo, id_forma_pagto, valor_venda, data_venda)
        VALUES ($cliente, $funcionario, $veiculo, $forma_pagto, $valor_venda, '$data_venda')";

echo $sql;
$result = mysqli_query($conn, $sql);


if ($result) {

    $sql = "UPDATE veiculos SET status = 'vendido' WHERE id = $veiculo";
    $resultUpdate = mysqli_query($conn, $sql);

    if($resultUpdate){
        echo "Venda cadastrada com sucesso!";
        header('Location: ../view/vendas.php');
    }
    
} else {
    echo "Erro ao cadastrar venda: " . mysqli_error($conn);
    header('Location: ../view/vendas.php');
}

mysqli_close($conn);
?>