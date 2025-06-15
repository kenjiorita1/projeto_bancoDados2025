<?php
require_once('../../conn/conn.php');

if (!isset($_GET['id'])) {
    die("ID da venda não informado.");
}

$id_venda = $_GET['id'];

$sql = "SELECT * FROM vendas WHERE id = $id_venda";
$resultVenda = mysqli_query($conn, $sql);
$venda = mysqli_fetch_assoc($resultVenda);

if (!$venda) {
    die("Venda não encontrada.");
}

$sql = "SELECT * FROM veiculos";
$veiculos = mysqli_query($conn, $sql);

$sql = "SELECT * FROM clientes";
$clientes = mysqli_query($conn, $sql);

$sql = "SELECT * FROM funcionarios";
$funcionarios = mysqli_query($conn, $sql);

$sql = "SELECT * FROM forma_de_pagamento";
$formas_pagamento = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR VENDA - Sistema de Vendas</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>

<body>
    <!-- <header class="header">
        <div class="header-container">
            <div class="logo">AutoVendas</div>
            <div class="user-info">
                <span>Olá, Administrador</span>
                <img src="https://via.placeholder.com/40" alt="Usuário">
            </div>
        </div>
    </header> -->

    <main class="main-container">
        <div class="card">
            <h1 class="page-title">Editar Venda</h1>
            
            <form action="../update/vendas.php" method="POST">
                <input type="hidden" name="id" value="<?= $venda['id'] ?>">

                <div class="form-row">
                    <div class="form-group">
                        <label for="cliente" class="form-label">Cliente</label>
                        <select class="form-control" id="cliente" name="cliente" required>
                            <option value="">Selecione um cliente</option>
                            <?php foreach ($clientes as $row) { ?>
                                <option value="<?= $row['id'] ?>" <?= $row['id'] == $venda['id_cliente'] ? 'selected' : '' ?>>
                                    <?= $row['nome'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="funcionario" class="form-label">Funcionário</label>
                        <select class="form-control" id="funcionario" name="funcionario" required>
                            <option value="">Selecione um funcionário</option>
                            <?php foreach ($funcionarios as $row) { ?>
                                <option value="<?= $row['id'] ?>" <?= $row['id'] == $venda['id_funcionario'] ? 'selected' : '' ?>>
                                    <?= $row['nome'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="veiculo" class="form-label">Veículo</label>
                        <select class="form-control" id="veiculo" name="veiculo" required>
                            <option value="">Selecione um veículo</option>
                            <?php foreach ($veiculos as $row) { ?>
                                <option value="<?= $row['id'] ?>" <?= $row['id'] == $venda['id_veiculo'] ? 'selected' : '' ?>>
                                    <?= $row['modelo'] ?> (<?= $row['ano'] ?>)
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="forma_pagto" class="form-label">Forma de Pagamento</label>
                        <select class="form-control" id="forma_pagto" name="forma_pagto" required>
                            <option value="">Selecione a forma de pagamento</option>
                            <?php foreach ($formas_pagamento as $row) { ?>
                                <option value="<?= $row['id'] ?>" <?= $row['id'] == $venda['id_forma_pagto'] ? 'selected' : '' ?>>
                                    <?= $row['nome'] ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="valor_venda" class="form-label">Valor da Venda (R$)</label>
                        <div class="input-with-icon">
                            <i class="fas fa-dollar-sign"></i>
                            <input type="number" step="0.01" class="form-control" id="valor_venda" name="valor_venda" 
                                   value="<?= number_format($venda['valor_venda'], 2, '.', '') ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="data_venda" class="form-label">Data da Venda</label>
                        <div class="input-with-icon">
                            <i class="fas fa-calendar-alt"></i>
                            <input type="date" class="form-control" id="data_venda" name="data_venda" 
                                   value="<?= $venda['data_venda'] ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-editar" onclick="window.history.back()">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </button>
                    <button type="submit" class="btn btn-afll">
                        <i class="fas fa-save"></i> Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Adiciona máscara para o campo de valor
        document.getElementById('valor_venda').addEventListener('input', function(e) {
            // Remove tudo que não é dígito ou ponto decimal
            let value = this.value.replace(/[^\d.]/g, '');
            
            // Garante que há no máximo um ponto decimal
            let decimalSplit = value.split('.');
            if (decimalSplit.length > 2) {
                value = decimalSplit[0] + '.' + decimalSplit.slice(1).join('');
            }
            
            // Limita a 2 casas decimais
            if (decimalSplit.length > 1) {
                value = decimalSplit[0] + '.' + decimalSplit[1].slice(0, 2);
            }
            
            this.value = value;
        });
    </script>
</body>
</html>