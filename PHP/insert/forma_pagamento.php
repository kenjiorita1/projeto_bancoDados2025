<?php
    include_once('../../conn/conn.php');
  

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    if (!$conn) {
        die("Erro ao conectar: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO forma_de_pagamento (nome, descricao) VALUES ('$nome', '$descricao')";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Forma de pagamento cadastrado com sucesso!";
        header('Location: ../view/forma_pagamento.php');
    }else{
        echo "Erro ao cadastrar Forma de pagamento!" . mysqli_error($conn) ;

        header('Location: ../view/forma_pagamento.php');
    }

    mysqli_close($conn);
?>