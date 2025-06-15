<?php
    include_once('../../conn/conn.php');
    $id_exame = $_GET['id'];


    $sql = "DELETE FROM exames WHERE id_exame = $id_exame";
    $result_delete = mysqli_query($conn, $sql);

    
    if (!$conn) {
        die("Erro ao conectar: " . mysqli_connect_error());
    }

    if($result_delete){
        echo "EXAME EXCLUIDO COM SUCESSO!";
        header('Location: ../../view/exame.php');
    }else{
        echo "ERRO AO EXCLUIR UM EXAME!";
        header('Location: ../../view/exame.php');
    }
?>