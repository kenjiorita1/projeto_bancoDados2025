<?php
    include_once('../../conn/conn.php');
    
    $matricula = $_POST['matricula'];
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
    $cargo = $_POST['cargo'];

    if (!$conn) {
        die("Erro ao conectar: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO funcionarios (matricula, nome, telefone, email, cpf, rua, numero, cep, complemento, sobrenome, cidade, estado, bairro, cargo)
            VALUES ('$matricula', '$nome', '$telefone', '$email', '$cpf', '$rua', '$numero', '$cep', '$complemento', '$sobrenome', '$cidade', '$estado', '$bairro','$cargo')";
    $result = mysqli_query($conn, $sql);

    if($result){
        echo "Funcionario cadastrado com sucesso!";
        header('Location: ../view/funcionario.php');
    }else{
        echo "Erro ao cadastrar Funcionario!" . mysqli_error($conn) ;

        header('Location: ../view/funcionario.php');
    }
?>