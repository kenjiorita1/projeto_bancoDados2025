<?php
include_once('../../conn/conn.php');

// Recebendo os dados do formulário
$id = $_POST['id']; // ID da venda que será atualizada
$cliente = $_POST['cliente'];
$funcionario = $_POST['funcionario'];
$veiculo = $_POST['veiculo'];
$forma_pagto = $_POST['forma_pagto'];
$valor_venda = $_POST['valor_venda'];
$data_venda = $_POST['data_venda'];

if (!$conn) {
    die("Erro ao conectar: " . mysqli_connect_error());
}

$sql = "UPDATE vendas 
        SET id_cliente = '$cliente',
            id_funcionario = '$funcionario',
            id_veiculo = '$veiculo',
            id_forma_pagto = '$forma_pagto',
            valor_venda = '$valor_venda',
            data_venda = '$data_venda'
        WHERE id = '$id'";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Venda atualizada com sucesso!";
    header('Location: ../view/vendas.php');
} else {
    echo "Erro ao atualizar venda: " . mysqli_error($conn);
    header('Location: ../view/vendas.php');
}

mysqli_close($conn);
?>