<?php 
    $localhost = "localhost";
    $username = "root";
    $password = "";
    $dbname = "concessionaria";

    $conn = mysqli_connect($localhost, $username, $password, $dbname,3307);
    
    if ($conn) {
        // echo "Conectado com sucesso !";
    } else {
        echo "Erro na conexão com o banco de dados.";
    }
?>