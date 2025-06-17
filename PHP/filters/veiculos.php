<?php
session_start();
include_once('../../conn/conn.php');

$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : "";
$where = "";

if ($pagina != "") {
    $where .= "WHERE v.marca LIKE '%$pagina%'
    OR v.modelo LIKE '%$pagina%'
    OR v.preco_venda LIKE '%$pagina%'
    OR v.ano_modelo LIKE '%$pagina%' 
    OR v.combustivel LIKE '%$pagina%'
    OR v.cor LIKE '%$pagina%'
    OR v.status LIKE '%$pagina%'";
}

$sql = "SELECT * FROM veiculos v $where";
$resultVeiculos = mysqli_query($conn, $sql);

if (!$resultVeiculos) {
    die("Error in query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CADASTRO DE VEICULOS</title>
        <link rel="stylesheet" href="../assets/css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/all.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    </head>

    <body>
         <table>
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Preço Venda</th>
                    <th>Ano Modelo</th>
                    <th>Combustivel</th>
                    <th>Cor</th>
                    <th>status</th>
                    <th colspan="2">Ações </th>

                </tr>
            </thead>
            <tbody>
                <?php foreach($resultVeiculos as $row) { ?>
                <tr>
                    <td class="text-center"><?php echo htmlspecialchars($row['marca']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['modelo']); ?></td>
                    <td class="text-center">R$ <?php echo number_format($row['preco_venda'], 2, ',', '.'); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['ano_modelo']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['combustivel']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['cor']); ?></td>
                    <td class="text-center"><?php echo htmlspecialchars($row['status']); ?></td>
                    
                    <td class="text-center">
                        <button class="btn-editar"
                            onclick="edit_veiculo(<?php echo $row['id']; ?>)">Editar</button>
                    </td>
                    <td class="text-center">
                        <button class="btn-excluir"
                            onclick="excluir_veiculo(<?php echo $row['id']; ?>)">Excluir</button>
                    </td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
    </body>
</html>

    <script>
        function edit_veiculo(id_veiculo) {
            window.location.href = `../edit/veiculos.php?id=${id_veiculo}`;
        }

        function excluir_veiculo(id_veiculo) {
            window.location.href = `../delete/veiculos.php?id=${id_veiculo}`;
        }
    </script>

    <?php mysqli_close($conn); ?>