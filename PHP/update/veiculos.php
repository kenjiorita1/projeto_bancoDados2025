<?php
    include_once('../../conn/conn.php');
  
    $id  = $_POST['id'];
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

    $sql = "UPDATE veiculos SET 
    marca = '$marca',
    modelo = '$modelo',
    ano_fabricacao = '$ano_fabricacao',
    ano_modelO = '$ano_modelo',
    chassi = '$chassi', 
    cor = '$cor',
    combustivel = '$combustivel',
    preco_custo = '$preco_custo',
    preco_venda= '$preco_venda',
    status = '$status'
    WHERE id = $id";

    echo $sql;

    $result = mysqli_query($conn, $sql);
    

    if($result){
        echo "veiculos editado com sucesso!";
        header('Location: ../view/veiculos.php');
    }else{
        echo "Erro ao editar veiculos!" . mysqli_error($conn) ;
        header('Location: ../view/veiculos.php');
    }
?>
