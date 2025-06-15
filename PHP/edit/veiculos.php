<?php
         include_once('../../conn/conn.php');
         $id = $_GET['id'];

         $sql = "SELECT * FROM veiculos WHERE id = $id";
         $result_veiculo = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição DE VEICULOS</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    
     <main class="main-container">
        <?php foreach($result_veiculo as $row) { ?>
        <div class="card">
            <h1 class="page-title">Editar Veículo #<?= $row['id'] ?></h1>
            
            <form action="../update/veiculos.php" method="POST">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <div class="form-row">
                    <div class="form-group">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="marca" name="marca" 
                               value="<?= htmlspecialchars($row['marca']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" 
                               value="<?= htmlspecialchars($row['modelo']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="ano_fabricacao" class="form-label">Ano de Fabricação</label>
                        <input type="number" class="form-control" id="ano_fabricacao" name="ano_fabricacao" 
                               value="<?= $row['ano_fabricacao'] ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="ano_modelo" class="form-label">Ano do Modelo</label>
                        <input type="number" class="form-control" id="ano_modelo" name="ano_modelo" 
                               value="<?= $row['ano_modelo'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="chassi" class="form-label">Chassi</label>
                        <input type="text" class="form-control" id="chassi" name="chassi" 
                               value="<?= htmlspecialchars($row['chassi']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="cor" class="form-label">Cor</label>
                        <input type="text" class="form-control" id="cor" name="cor" 
                               value="<?= htmlspecialchars($row['cor']) ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group status-select">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">Selecione um status</option>
                            <option value="vendido" <?= $row['status'] == 'vendido' ? 'selected' : '' ?>>Vendido</option>
                            <option value="consignado" <?= $row['status'] == 'consignado' ? 'selected' : '' ?>>Consignado</option>
                            <option value="disponivel" <?= $row['status'] == 'disponivel' ? 'selected' : '' ?>>Disponível</option>
                            <option value="reservado" <?= $row['status'] == 'reservado' ? 'selected' : '' ?>>Reservado</option>
                        </select>
                        <div class="status-badge <?= $row['status'] ?>"></div>
                    </div>

                    <div class="form-group">
                        <label for="combustivel" class="form-label">Combustível</label>
                        <input type="text" class="form-control" id="combustivel" name="combustivel" 
                               value="<?= htmlspecialchars($row['combustivel']) ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group price-inputs">
                        <label for="preco_custo" class="form-label">Preço de Custo</label>
                        <input type="number" step="0.01" class="form-control" id="preco_custo" name="preco_custo"
                               value="<?= number_format($row['preco_custo'], 2, '.', '') ?>" required>
                    </div>

                    <div class="form-group price-inputs">
                        <label for="preco_venda" class="form-label">Preço de Venda</label>
                        <input type="number" step="0.01" class="form-control" id="preco_venda" name="preco_venda"
                               value="<?= number_format($row['preco_venda'], 2, '.', '') ?>" required>
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
        <?php } ?>
    </main>

</body>

<script>
    // Máscara para valores monetários
        document.querySelectorAll('.price-inputs input').forEach(input => {
            input.addEventListener('input', function(e) {
                let value = this.value.replace(/[^\d.]/g, '');
                
                let decimalSplit = value.split('.');
                if (decimalSplit.length > 2) {
                    value = decimalSplit[0] + '.' + decimalSplit.slice(1).join('');
                }
                
                if (decimalSplit.length > 1) {
                    value = decimalSplit[0] + '.' + decimalSplit[1].slice(0, 2);
                }
                
                this.value = value;
            });
        });
        
        // Atualiza o badge de status quando o select muda
        document.getElementById('status').addEventListener('change', function() {
            const badge = document.querySelector('.status-badge');
            // Remove todas as classes de status
            badge.classList.remove('vendido', 'consignado', 'disponivel', 'reservado');
            // Adiciona a classe correspondente ao novo status
            badge.classList.add(this.value);
</script>

</html>