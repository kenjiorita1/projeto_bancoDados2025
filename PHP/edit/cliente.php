
<?php
    require_once('../../conn/conn.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM clientes where id = $id";
    $resultClientes = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DE CLIENTES</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
</head>

<body>
   
    <main class="main-container">
        <?php foreach ($resultClientes as $row) { ?>
        <div class="card">
            <h1 class="page-title">Editar Cliente #<?= $row['id'] ?></h1>
            
            <form action="../update/cliente.php" method="POST">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <div class="form-row">
                    <div class="form-group">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" 
                               value="<?= htmlspecialchars($row['nome']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="sobrenome" class="form-label">Sobrenome</label>
                        <input type="text" class="form-control" id="sobrenome" name="sobrenome" 
                               value="<?= htmlspecialchars($row['sobrenome']) ?>" required>
                    </div>

                    <div class="form-group phone-input">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" 
                               value="<?= htmlspecialchars($row['telefone']) ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group cep-input">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep" 
                               value="<?= htmlspecialchars($row['cep']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" 
                               value="<?= htmlspecialchars($row['cidade']) ?>" required>
                    </div>

                    <div class="form-group state-select">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="">Selecione um estado</option>
                            <option value="AC" <?= $row['estado'] == 'AC' ? 'selected' : '' ?>>Acre (AC)</option>
                            <option value="AL" <?= $row['estado'] == 'AL' ? 'selected' : '' ?>>Alagoas (AL)</option>
                            <option value="AM" <?= $row['estado'] == 'AM' ? 'selected' : '' ?>>Amazonas (AM)</option>
                            <option value="AP" <?= $row['estado'] == 'AP' ? 'selected' : '' ?>>Amapá (AP)</option>
                            <option value="BA" <?= $row['estado'] == 'BA' ? 'selected' : '' ?>>Bahia (BA)</option>
                            <option value="CE" <?= $row['estado'] == 'CE' ? 'selected' : '' ?>>Ceará (CE)</option>
                            <option value="DF" <?= $row['estado'] == 'DF' ? 'selected' : '' ?>>Distrito Federal (DF)</option>
                            <option value="ES" <?= $row['estado'] == 'ES' ? 'selected' : '' ?>>Espírito Santo (ES)</option>
                            <option value="GO" <?= $row['estado'] == 'GO' ? 'selected' : '' ?>>Goiás (GO)</option>
                            <option value="MA" <?= $row['estado'] == 'MA' ? 'selected' : '' ?>>Maranhão (MA)</option>
                            <option value="MG" <?= $row['estado'] == 'MG' ? 'selected' : '' ?>>Minas Gerais (MG)</option>
                            <option value="MS" <?= $row['estado'] == 'MS' ? 'selected' : '' ?>>Mato Grosso do Sul (MS)</option>
                            <option value="MT" <?= $row['estado'] == 'MT' ? 'selected' : '' ?>>Mato Grosso (MT)</option>
                            <option value="PA" <?= $row['estado'] == 'PA' ? 'selected' : '' ?>>Pará (PA)</option>
                            <option value="PB" <?= $row['estado'] == 'PB' ? 'selected' : '' ?>>Paraíba (PB)</option>
                            <option value="PE" <?= $row['estado'] == 'PE' ? 'selected' : '' ?>>Pernambuco (PE)</option>
                            <option value="PI" <?= $row['estado'] == 'PI' ? 'selected' : '' ?>>Piauí (PI)</option>
                            <option value="PR" <?= $row['estado'] == 'PR' ? 'selected' : '' ?>>Paraná (PR)</option>
                            <option value="RJ" <?= $row['estado'] == 'RJ' ? 'selected' : '' ?>>Rio de Janeiro (RJ)</option>
                            <option value="RN" <?= $row['estado'] == 'RN' ? 'selected' : '' ?>>Rio Grande do Norte (RN)</option>
                            <option value="RO" <?= $row['estado'] == 'RO' ? 'selected' : '' ?>>Rondônia (RO)</option>
                            <option value="RR" <?= $row['estado'] == 'RR' ? 'selected' : '' ?>>Roraima (RR)</option>
                            <option value="RS" <?= $row['estado'] == 'RS' ? 'selected' : '' ?>>Rio Grande do Sul (RS)</option>
                            <option value="SC" <?= $row['estado'] == 'SC' ? 'selected' : '' ?>>Santa Catarina (SC)</option>
                            <option value="SE" <?= $row['estado'] == 'SE' ? 'selected' : '' ?>>Sergipe (SE)</option>
                            <option value="SP" <?= $row['estado'] == 'SP' ? 'selected' : '' ?>>São Paulo (SP)</option>
                            <option value="TO" <?= $row['estado'] == 'TO' ? 'selected' : '' ?>>Tocantins (TO)</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="rua" class="form-label">Rua</label>
                        <input type="text" class="form-control" id="rua" name="rua" 
                               value="<?= htmlspecialchars($row['rua']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" class="form-control" id="numero" name="numero" 
                               value="<?= htmlspecialchars($row['numero']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" class="form-control" id="complemento" name="complemento" 
                               value="<?= htmlspecialchars($row['complemento']) ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" 
                               value="<?= htmlspecialchars($row['bairro']) ?>" required>
                    </div>

                    <div class="form-group email-input">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="<?= htmlspecialchars($row['email']) ?>" required>
                    </div>

                    <div class="form-group cpf-input">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" 
                               value="<?= htmlspecialchars($row['cpf']) ?>" required>
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
    // Máscara para telefone
    document.getElementById('telefone').addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 11) value = value.substring(0, 11);
        
        // Formata como (XX) XXXXX-XXXX ou (XX) XXXX-XXXX
        if (value.length > 2) {
            value = '(' + value.substring(0, 2) + ') ' + value.substring(2);
        }
        if (value.length > 10) {
            value = value.substring(0, 10) + '-' + value.substring(10);
        }
        
        this.value = value;
    });
    
    // Máscara para CEP
    document.getElementById('cep').addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 8) value = value.substring(0, 8);
        
        if (value.length > 5) {
            value = value.substring(0, 5) + '-' + value.substring(5);
        }
        
        this.value = value;
    });
    
    // Máscara para CPF
    document.getElementById('cpf').addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 11) value = value.substring(0, 11);
        
        if (value.length > 3) {
            value = value.substring(0, 3) + '.' + value.substring(3);
        }
        if (value.length > 7) {
            value = value.substring(0, 7) + '.' + value.substring(7);
        }
        if (value.length > 11) {
            value = value.substring(0, 11) + '-' + value.substring(11);
        }
        
        this.value = value;
    });
    
    // Busca CEP via API
    document.getElementById('cep').addEventListener('blur', function(e) {
        const cep = this.value.replace(/\D/g, '');
        
        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById('rua').value = data.logradouro || '';
                        document.getElementById('bairro').value = data.bairro || '';
                        document.getElementById('cidade').value = data.localidade || '';
                        document.getElementById('estado').value = data.uf || '';
                    }
                })
                .catch(error => console.error('Erro ao buscar CEP:', error));
        }
    });
    function editar(id) {
        window.location.href = `../edit/cliente.php?id=${id}`;
    }

    function excluir(id) {
        window.location.href = `../delete/cliente.php?id=${id}`;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

</html>
