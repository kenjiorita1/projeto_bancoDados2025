<?php
    include_once('../../conn/conn.php');
    $id = $_GET['id'];


    $sql = "DELETE FROM veiculos WHERE id = $id";
    $result_delete = mysqli_query($conn, $sql);

    
    if (!$conn) {
        die("Erro ao conectar: " . mysqli_connect_error());
    }

    if($result_delete){
        echo "VEICULOS EXCLUIDO COM SUCESSO!";
        header('Location: ../view/veiculos.php');
    }else{
        echo "ERRO AO EXCLUIR UM VEICULO!";
        header('Location: ../view/veiculos.php');
    }
?>