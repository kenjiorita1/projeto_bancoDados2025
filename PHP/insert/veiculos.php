<?php
    include_once('../../conn/conn.php');
  

    // $id  = $_POST['id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];   
    $ano_fabricacao = $_POST['ano_fabricacao'];
    $ano_modelo  = $_POST['ano_modelo'];
    $chassi = $_POST['chassi'];
    $cor= $_POST['cor'];
    $combustivel = $_POST['combustivel'];
    $preco_custo = $_POST['preco_custo'];
    $preco_venda= $_POST['preco_venda'];
    $status = $_POST['status'];

    if (!$conn) {
        die("Erro ao conectar: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO veiculos (marca, modelo, ano_fabricacao, ano_modelo, chassi, cor, combustivel, preco_custo, preco_venda, status)
        VALUES ('$marca', '$modelo', '$ano_fabricacao', '$ano_modelo', '$chassi', '$cor', '$combustivel', '$preco_custo', '$preco_venda', '$status')";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "veiculos cadastrado com sucesso!";
        header('Location: ../view/veiculos.php');
    }else{
        echo "Erro ao cadastrar veiculos!" . mysqli_error($conn) ;

        header('Location: ../view/veiculos.php');
    }
?>