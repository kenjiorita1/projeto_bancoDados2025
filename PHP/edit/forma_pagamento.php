<?php
    require_once('../../conn/conn.php');

    $id = $_GET['id'];

    $sql = "SELECT * FROM forma_de_pagamento WHERE id = $id";
    $resultFormaPagamentos = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DE FORMA DE PAGAMENTO</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    
     <main class="main-container">
        <div class="card">
            <h1 class="page-title">Formas de Pagamento</h1>
            
            <?php foreach($resultFormaPagamentos as $row) { ?>
            <form action="../update/forma_pagamento.php" method="POST">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <div class="form-row">
                    <div class="form-group payment-icon">
                        <label for="nome" class="form-label">Nome da Forma de Pagamento</label>
                        <input type="text" class="form-control" id="nome" name="nome" 
                               value="<?= htmlspecialchars($row['nome']) ?>" required
                               placeholder="Ex: Cartão de Crédito, Pix, Boleto">
                    </div>

                    <div class="form-group description-icon">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" 
                               value="<?= htmlspecialchars($row['descricao']) ?>" required
                               placeholder="Ex: Parcelado em até 12x, Pagamento instantâneo">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-editar" onclick="window.history.back()">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </button>
                    <button type="submit" class="btn btn-afll">
                        <i class="fas fa-save"></i> Salvar Forma de Pagamento
                    </button>
                </div>
            </form>
            <?php } ?>
            
           
                </form>
            </div>
        </div>
    </main>
</body>

<script>
    function editar(id) {
        window.location.href = `../edit/veiculos.php?id=${id}`;
    }

    function excluir(id) {
        window.location.href = `../delete/veiculos.php?id=${id}`;
    }
</script>

</html>