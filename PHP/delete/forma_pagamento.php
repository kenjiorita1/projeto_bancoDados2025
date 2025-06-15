<?php
    include_once('../../conn/conn.php');
    $id = $_GET['id'];


    $sql = "DELETE FROM forma_de_pagamento WHERE id = $id";
    $result_delete = mysqli_query($conn, $sql);

    
    if (!$conn) {
        die("Erro ao conectar: " . mysqli_connect_error());
    }

    if($result_delete){
        echo "FORMA DE PAGAMENTO EXCLUIDA COM SUCESSO!";
        header('Location: ../view/forma_pagamento.php');
    }else{
        echo "ERRO AO EXCLUIR UM VEICULO!";
        header('Location: ../view/forma_pagamento.php');
    }
?>