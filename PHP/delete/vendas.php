<?php
include_once('../../conn/conn.php');

// Recebendo o ID da venda a ser deletada
$id = $_GET['id'];

if (!$conn) {
    die("Erro ao conectar: " . mysqli_connect_error());
}

$sql = "DELETE FROM vendas WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Venda deletada com sucesso!";
    header('Location: ../view/vendas.php');
} else {
    echo "Erro ao deletar venda: " . mysqli_error($conn);
    header('Location: ../view/vendas.php');
}

mysqli_close($conn);
?>