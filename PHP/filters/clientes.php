<?php
session_start();
include_once('../../conn/conn.php');

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : "";
$where = "";

if ($pagina != "") {
    $where .= "WHERE c.cpf LIKE '%$pagina%'
    OR c.nome LIKE '%$pagina%'
    OR c.sobrenome LIKE '%$pagina%'
    OR c.email LIKE '%$pagina%' 
    OR c.rua LIKE '%$pagina%'
    OR c.telefone LIKE '%$pagina%'
    OR c.cidade LIKE '%$pagina%'";
}

$sql = "SELECT * FROM clientes c $where";
$resultClientes = mysqli_query($conn, $sql);

if (!$resultClientes) {
    die("Error in query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CADASTRO DE CLIENTES</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    </head>

    <body>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>E-mail</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Cidade</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($resultClientes)) { ?>
                <tr>
                    <td class="text-center"><?php echo htmlspecialchars($row['nome']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['sobrenome']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['email']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['cpf']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['telefone']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['cidade']); ?></td>
                    <td class="text-center">
                        <button class="btn-editar" onclick="editar(<?php echo $row['id']; ?>)">Editar</button>
                    </td>
                    <td class="text-center">
                        <button class="btn-excluir" onclick="excluir(<?php echo $row['id']; ?>)">Excluir</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>

    <?php mysqli_close($conn); ?>