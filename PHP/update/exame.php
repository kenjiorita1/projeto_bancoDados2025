<?php
    include_once('../../conn/conn.php');
    $nome = $_POST['nome'];
    $sigla = $_POST['sigla'];
    $observacao = $_POST['observacao'];
    $preco_exame = $_POST['preco_exame'];
    $id_exame = $_POST['id_exame'];
    

    if (!$conn) {
        die("Erro ao conectar: " . mysqli_connect_error());
    }

    $sql = "UPDATE exames SET 
    nome = '$nome', 
    sigla = '$sigla', 
    observacao = '$observacao', 
    preco_exame = $preco_exame
    WHERE id_exame = $id_exame";

    
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "exame Editado com sucesso!";
        header('Location: ../../view/exame.php');
    }else{
        echo "Erro ao Editar exame!" . mysqli_error($conn);
        header('Location: ../../view/exame.php');
    }
?>

