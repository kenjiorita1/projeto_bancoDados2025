<?php
    require_once ('./conn/conn.php');

    $sql = "SELECT COUNT(*) AS TOTAL FROM veiculos where status = 'disponivel'";
    $resultVeiculos = mysqli_query($conn, $sql);
    $linha = mysqli_fetch_assoc($resultVeiculos); 
    $qtdDisponivel  = $linha['TOTAL'];

    $sql = "SELECT COUNT(*) AS TOTALCLIENTES FROM clientes";
    $resultClientes = mysqli_query($conn, $sql);
    $cliente = mysqli_fetch_assoc($resultClientes); 
    $qtdCliente  = $cliente['TOTALCLIENTES'];

    $sql = " SELECT COUNT(*) AS total_vendas FROM vendas 
    WHERE data_venda BETWEEN DATE_FORMAT(CURDATE(), '%Y-%m-01') AND LAST_DAY(CURDATE())";
    $resultVendasMes= mysqli_query($conn, $sql);
    $linha = mysqli_fetch_assoc($resultVendasMes); 
    $qtdVendas = $linha['total_vendas'];

    $sql = "SELECT SUM(valor_venda) AS faturamento FROM vendas ";
    $resultFaturamento = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($resultFaturamento);
    $faturamento  = $row['faturamento'] ?? 0; 

    $sql = "SELECT 
        v.id as id,
        ve.modelo as nome_veiculo,
        v.valor_venda, 
        v.data_venda,
        ve.marca,
        ve.ano_fabricacao,
        ve.status
        FROM vendas v 
        INNER JOIN veiculos ve ON ve.id = v.id_veiculo "; 
    $resultVendas = mysqli_query($conn, $sql);
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoElite - Sistema Administrativo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./PHP/assets/css/style.css">
</head>
<body>
      <div class="sidebar">
        <div class="sidebar-brand">
            Lobo<span>Veiculos</span>
        </div>
        
        <div class="sidebar-menu">
            <div class="menu-title">Principal</div>
            <a href="#" class="active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            
            <div class="menu-title">Cadastros</div>
            <a href="./PHP/view/veiculos.php">
                <i class="fas fa-car"></i>
                <span>Cadastrar Veículos</span>
            </a>
            <a href="./PHP/view/cliente.php">
                <i class="fas fa-users"></i>
                <span>Cadastrar Clientes</span>
            </a>
            <a href="./PHP/view/forma_pagamento.php">
                <i class="fas fa-money-bill-wave"></i>
                <span>Formas de Pagamento</span>
            </a>
            <a href="./PHP/view/funcionario.php">
                <i class="fas fa-user-tie"></i>
                <span>Cadastrar Funcionários</span>
            </a>
            <a href="./PHP/view/vendas.php">
                <i class="fas fa-handshake"></i>
                <span>Registrar Vendas</span>
            </a>
            
          
        </div>
    </div> 

    <div class="main-content">
        <h2 class="mb-4">Dashboard</h2>
        
        <div class="row">
            <div class="col-md-3">
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <div class="card-title">Veículos em Estoque</div>
                    <div class="card-value" id="vehicle-count"><?php echo $qtdDisponivel ?></div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="card-title">Vendas este Mês</div>
                    <div class="card-value"><?php echo  $qtdVendas ?> </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-title">Clientes Cadastrados</div>
                    <div class="card-value"><?php echo  $qtdCliente ?></div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-title">Faturamento de venda</div>
                    <div class="card-value"><?php echo "R$" . number_format($faturamento, 2, ',', '.') ?></div>
                </div>
            </div>
        </div>
        
        <div class="dashboard-card mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>Veículos Recentes</h4>
                <a href="./PHP/view/veiculos.php" class="btn btn-primary btn-sm">Ver Todos</a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Modelo</th>
                            <th>Marca</th>
                            <th>Ano</th>
                            <th>Preço</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($resultVendas as $row) { ?>
                        <tr> 
                            <td><?php echo htmlspecialchars($row['nome_veiculo'])?></td>
                            <td><?php echo htmlspecialchars($row['marca'])?></td>
                            <td><?php echo htmlspecialchars($row['ano_fabricacao'])?></td>
                            <td>R$<?php echo number_format($row['valor_venda'], 2, ',', '.')?></td>
                            <td><span class="badge bg-success"><?php echo htmlspecialchars($row['status'])?></span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-primary" onclick="editar(<?php echo $row['id']; ?>)" >Editar</a>
                            </td>
                        </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.querySelector('.toggle-sidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
        
        function animateValue(id, start, end, duration) {
            var obj = document.getElementById(id);
            var range = end - start;
            var minTimer = 50;
            var stepTime = Math.abs(Math.floor(duration / range));
            
            stepTime = Math.max(stepTime, minTimer);
            
            var startTime = new Date().getTime();
            var endTime = startTime + duration;
            var timer;
            
            function run() {
                var now = new Date().getTime();
                var remaining = Math.max((endTime - now) / duration, 0);
                var value = Math.round(end - (remaining * range));
                obj.innerHTML = value;
                if (value == end) {
                    clearInterval(timer);
                }
            }
            
            timer = setInterval(run, stepTime);
            run();
        }
        
        window.addEventListener('load', function() {
            animateValue("vehicle-count", 0, 42, 2000);
        });

        function editar(id) {
            window.location.href = `./PHP/edit/vendas.php?id=${id}`;
        }

    </script>
</body>
</html>