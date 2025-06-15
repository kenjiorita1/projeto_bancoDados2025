<?php
    include_once('../../conn/conn.php');
    $nome = $_POST['nome'];
    $sigla = $_POST['sigla'];
    $observacao = $_POST['observacao'];
    $preco_exame = $_POST['preco_exame'];

    if (!$conn) {
        die("Erro ao conectar: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO exames (nome, sigla, observacao, preco_exame) VALUES ('$nome',  '$sigla', '$observacao', $preco_exame)";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "exame cadastrado com sucesso!";
        header('Location: ../../view/exame.php');
    }else{
        echo "Erro ao cadastrar exame!" . mysqli_error($conn) ;

        header('Location: ../../view/exame.php');
    }
?>