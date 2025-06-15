<?php
    include_once('../../conn/conn.php');
  

    $id = $_POST['id'];
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
    $bairro = $_POST['bairro'];
    $cargo = $_POST['cargo'];

    if (!$conn) {
        die("Erro ao conectar: " . mysqli_connect_error());
    }

    $sql = "UPDATE funcionarios SET 
            matricula = '$matricula',
            nome = '$nome',
            telefone = '$telefone',
            email = '$email',
            cpf = '$cpf',
            rua = '$rua',
            numero = '$numero',
            cep = '$cep',
            complemento = '$complemento',
            sobrenome = '$sobrenome',
            cidade = '$cidade',
            estado = '$estado',
            bairro = '$bairro',
            cargo = '$cargo'
        WHERE id = '$id'";

    // echo $sql;
    $result = mysqli_query($conn, $sql);


    if($result){
        echo "Funcionario editado com sucesso!";
        header('Location: ../view/funcionario.php');
    }else{
        echo "Erro ao editar Funcionario!" . mysqli_error($conn) ;
        header('Location: ../view/funcionario.php');
    }
?>