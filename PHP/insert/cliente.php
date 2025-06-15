<?php
    include_once('../../conn/conn.php');
  

    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $cep = $_POST['cep'];
    $complemento = $_POST['complemento'];
    $sobrenome = $_POST['sobrenome'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    echo $estado;
    $bairro = $_POST['bairro'];

    if (!$conn) {
        die("Erro ao conectar: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO clientes (id, nome, telefone, email, cpf, rua, numero, cep, complemento, sobrenome, cidade, estado, bairro)
            VALUES ('$id', '$nome', '$telefone', '$email', '$cpf', '$rua', '$numero', '$cep', '$complemento', '$sobrenome', '$cidade', '$estado', '$bairro')";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Cliente cadastrado com sucesso!";
        header('Location: ../view/cliente.php');
    }else{
        echo "Erro ao cadastrar Cliente!" . mysqli_error($conn) ;

        header('Location: ../view/cliente.php');
    }
?>