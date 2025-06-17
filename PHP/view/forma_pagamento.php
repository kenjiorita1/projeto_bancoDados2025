<?php
    require_once('../../conn/conn.php');

    $sql = "SELECT * FROM forma_de_pagamento";

    echo $sql;
    $resultFormaPagamentos = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DE FORMA DE PAGAMENTO</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../css/modal.css"> 
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/all.css">
</head>

<body>


    <div class="sidebar">
        <div class="sidebar-brand">
            Lobo<span>Veiculos</span>
        </div>

        <div class="sidebar-menu">
            <div class="menu-title">Principal</div>
            <a href="../../index.php" >
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-title">Cadastros</div>
            <a href="./veiculos.php">
                <i class="fas fa-car"></i>
                <span>Cadastrar Veículos</span>
            </a>
            <a href="./cliente.php">
                <i class="fas fa-users"></i>
                <span>Cadastrar Clientes</span>
            </a>
            <a href="./forma_pagamento.php" class="active">
                <i class="fas fa-money-bill-wave"></i>
                <span>Formas de Pagamento</span>
            </a>
            <a href="./funcionario.php">
                <i class="fas fa-user-tie"></i>
                <span>Cadastrar Funcionários</span>
            </a>
            <a href="./vendas.php">
                <i class="fas fa-handshake"></i>
                <span>Registrar Vendas</span>
            </a>

     
        </div>
    </div>

    <div class="main-content">
       <div class="container">
    <!-- Modal de Cadastro -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-content-custom">
                    <div class="modal-header modal-header-custom">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            <i class="fas fa-car me-2"></i>Cadastrar Forma de Pagamento
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form action="../insert/forma_pagamento.php" method="POST">
                            <div class="mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nome" name="nome" required placeholder="Nome do veículo">
                                    <label for="nome">Nome do Veículo</label>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="form-floating">
                                    <textarea class="form-control" id="descricao" name="descricao" required placeholder="Descrição" style="height: 100px"></textarea>
                                    <label for="descricao">Descrição</label>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i>Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Cadastrar Veículo
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabela-container">

                 <div class="container-btn">
                    <button type="button" class="btn btn-primary btn-cadastro" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Cadastrar forma de pagamento
                    </button>
                </div>
            <h2 class="titulo-tabela">Lista de Forma de pagamento</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descricao</th>
                        <th colspan="2">Ações </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resultFormaPagamentos as $row) { ?>
                    <tr>
                        <td class="text-center"><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($row['descricao']); ?></td>
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
        </div>
    </div>
</body>

<script>
    function editar(id) {
        window.location.href = `../edit/forma_pagamento.php?id=${id}`;
    }

    function excluir(id) {
        window.location.href = `../delete/forma_pagamento.php?id=${id}`;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
</script>

</html>