<?php
    include_once('../../conn/conn.php');
  

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    if (!$conn) {
        die("Erro ao conectar: " . mysqli_connect_error());
    }

    $sql = "UPDATE forma_de_pagamento SET nome = '$nome', descricao = '$descricao' WHERE id = '$id' ";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Forma de pagamento editada com sucesso!";
        header('Location: ../view/forma_pagamento.php');
    }else{
        echo "Erro ao editar uma Forma de pagamento!" . mysqli_error($conn) ;

        header('Location: ../view/forma_pagamento.php');
    }
?>