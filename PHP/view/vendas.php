<?php
    require_once('../../conn/conn.php');

    $sql = "SELECT * FROM veiculos WHERE status = 'disponivel'"; 
    $veiculos = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM clientes";
    $clientes = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM funcionarios";
    $funcionarios = mysqli_query($conn, $sql);

    $sql = "SELECT *  FROM forma_de_pagamento";
    $formas_pagamento = mysqli_query($conn, $sql);


    $sql = "SELECT 
        v.id as id,
        c.nome as nome_cliente,
        ve.modelo as nome_veiculo,
        f1.nome as nome_funcionario,
        f2.nome as nome_forma_pagamento,
        v.valor_venda, v.data_venda 
        FROM vendas v 
        INNER JOIN clientes c ON c.id = v.id_cliente 
        INNER JOIN veiculos ve ON ve.id = v.id_veiculo 
        INNER JOIN funcionarios f1 ON f1.id = v.id_funcionario
        INNER JOIN forma_de_pagamento f2 ON f2.id = v.id_forma_pagto;"; 
    $resultVendas = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DE VENDAS</title>
    <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/modal.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
      <!-- Modal de Filtro -->
        <div class="modal fade" id="modalFiltro" tabindex="-1" aria-labelledby="modalFiltroLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header modal-header-custom  text-white">
                        <h5 class="modal-title" id="modalFiltroLabel">
                            <i class="fas fa-filter me-2"></i>Filtrar Relatório
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="filtro-data1" name="filtro-data1" require>
                                    <label for="filtro-data1">Data Inicio</label>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="filtro-data2" name="filtro-data2" require>
                                    <label for="filtro-data">Data Fim</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-select form-control" id="funcionario_venda" name="funcionario_venda" required>
                                        <option value="" selected disabled>Selecione um funcionário</option>
                                        <?php foreach ($funcionarios as $row) { ?>
                                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nome']) ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="funcionario">Funcionário</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Fechar
                        </button>
                        <button type="button" class="btn btn-danger" onclick="imprimirRelatorio('pdf')">
                            <i class="fas fa-file-pdf me-2"></i>Gerar PDF
                        </button>
                        <button type="button" class="btn btn-success" onclick="imprimirRelatorio('csv')">
                            <i class="fas fa-file-excel me-2"></i>Exportar CSV
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            Lobo<span>Veiculos</span>
        </div>

        <div class="sidebar-menu">
            <div class="menu-title">Principal</div>
            <a href="../../index.php">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-title">Cadastros</div>
            <a href="../../PHP/view/veiculos.php">
                <i class="fas fa-car"></i>
                <span>Cadastrar Veículos</span>
            </a>
            <a href="../../PHP/view/cliente.php">
                <i class="fas fa-users"></i>
                <span>Cadastrar Clientes</span>
            </a>
            <a href="../../PHP/view/forma_pagamento.php">
                <i class="fas fa-money-bill-wave"></i>
                <span>Formas de Pagamento</span>
            </a>
            <a href="../../PHP/view/funcionario.php">
                <i class="fas fa-user-tie"></i>
                <span>Cadastrar Funcionários</span>
            </a>
            <a href="../../PHP/view/vendas.php"  class="active">
                <i class="fas fa-handshake"></i>
                <span>Registrar Vendas</span>
            </a>

      
        </div>
    </div>



    <div class="main-content">
        <div class="container">
    
               <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content modal-content-custom">
                            <div class="modal-header modal-header-custom">
                                <h5 class="modal-title" id="staticBackdropLabel">
                                    <i class="fas fa-handshake me-2"></i>Cadastrar Nova Venda
                                </h5>
                                
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <form action="../insert/vendas.php" method="POST">
                                
                                    <div class="mb-4">
                                        <h6 class="section-title mb-3">
                                            <i class="fas fa-users me-2"></i>Participantes
                                        </h6>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="cliente" name="cliente" required>
                                                        <option value="" selected disabled>Selecione um cliente</option>
                                                        <?php foreach ($clientes as $row) { ?>
                                                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nome']) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="cliente">Cliente</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="funcionario" name="funcionario" required>
                                                        <option value="" selected disabled>Selecione um funcionário</option>
                                                        <?php foreach ($funcionarios as $row) { ?>
                                                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nome']) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="funcionario">Funcionário</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <select onChange="getValorSugerido()" class="form-select" id="veiculo" name="veiculo" required>
                                                        <option value="" selected disabled>Selecione um veículo</option>
                                                        <?php foreach ($veiculos as $row) { ?>
                                                            <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['modelo']) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="veiculo">Veículo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                  
                                    <div class="mb-4">
                                        <h6 class="section-title mb-3">
                                            <i class="fas fa-file-invoice-dollar me-2"></i>Detalhes da Venda
                                        </h6>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="forma_pagto" name="forma_pagto" required>
                                                        <option value="" selected disabled>Selecione a forma de pagamento</option>
                                                        <?php foreach ($formas_pagamento as $row) { ?>
                                                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['nome']) ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="forma_pagto">Forma de Pagamento</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="valor_venda" name="valor_venda" required placeholder="0,00">
                                                    <label for="valor_venda">Valor da Venda (R$)</label>
                                                </div>
                                                <div style="display: flex; justify-content: center;">
                                                     <p>Valor sugerido: </p><span id="valor_sugerido"></span>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" id="data_venda" name="data_venda" required>
                                                    <label for="data_venda">Data da Venda</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                            
                                    <div class="mb-4">
                                        <h6 class="section-title mb-3">
                                            <i class="fas fa-comment me-2"></i>Observações
                                        </h6>
                                        <div class="form-floating">
                                            <textarea class="form-control" id="observacoes" name="observacoes" style="height: 100px" placeholder="Observações"></textarea>
                                            <label for="observacoes">Observações (opcional)</label>
                                        </div>
                                    </div>

                                    <div class="modal-footer border-top-0 pt-4">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times me-2"></i>Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Cadastrar Venda
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabela-container">
                    <div class="container-div">
                        <div class="container-btn">
                            <button type="button" class="btn btn-primary btn-cadastro" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Cadastrar venda
                            </button>

                            <button type="button" class="btn btn-primary btn-cadastro" data-bs-toggle="modal"
                                data-bs-target="#modalFiltro">
                                Imprimir Relatório filtrado
                            </button>
                        
                        </div>
                        <h2 class="titulo-tabela">Lista de Vendas</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Veiculo</th>
                                    <th>Funcionario</th>
                                    <th>Forma de pagamento</th>
                                    <th>Valor Da venda</th>
                                    <th>Data Vendida</th>
                                    <th colspan="1">Ações </th>

                                </tr>
                            </thead>
                            <tbody>
                            
                                    <?php foreach($resultVendas as $row) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo htmlspecialchars($row['nome_cliente']); ?></td>
                                        <td class="text-center"><?php echo htmlspecialchars($row['nome_veiculo']); ?></td>
                                        <td class="text-center"><?php echo htmlspecialchars($row['nome_funcionario']); ?></td>
                                        <td class="text-center"><?php echo htmlspecialchars($row['nome_forma_pagamento']); ?></td>
                                        <td class="text-center"><?php echo htmlspecialchars($row['valor_venda']); ?></td>
                                        <td class="text-center">
                                            <?php echo htmlspecialchars(date("d/m/Y", strtotime($row['data_venda']))); ?></td>
                                        <!-- <td class="text-center">
                                            <button class="btn-editar" onclick="editar(<?php echo $row['id']; ?>)">Editar</button>
                                        </td> -->
                                        <td class="text-center">
                                            <button class="btn-excluir"
                                                onclick="excluir(<?php echo $row['id']; ?>)">Excluir</button>
                                        </td>
                                    </tr>
                                    <?php  }?> 

                        
                            </tbody>
                        </table>
                </div>
        </div>
    </div>

    <script>
        function editar(id) {
            window.location.href = `../edit/vendas.php?id=${id}`;
        }


        function excluir(id) {
            window.location.href = `../delete/vendas.php?id=${id}`;
        }

       function getValorSugerido() {
            var veiculo = $('#veiculo').val();
            console.log("Veículo selecionado:", veiculo); 

            if (!veiculo) return;

            var url = "../get/veiculoValor.php?veiculo=" + veiculo;

            $.getJSON(url, function(response) {
                console.log("Resposta da API:", response);
                if (response.preco_venda !== undefined) {
                   $('#valor_sugerido').text(response.preco_venda);
                } else {
                    alert("Veículo não encontrado.");
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Erro AJAX:", textStatus, errorThrown);
            });
        }

        function imprimirRelatorio(tipo) {
            var funcionario = $('#funcionario_venda').val() ? $('#funcionario_venda').val()  : '';
            var data1 = $('#filtro-data1').val();
            var data2 = $('#filtro-data2').val();

            if(tipo === "pdf"){
                var url = "../utils/PDF/imprimir_relatorio_venda.php?funcionario=" + funcionario +
                        "&data1=" + data1 + 
                        "&data2=" + data2
                        $('#modalFiltro').modal('hide');
            }
            if(tipo === "csv"){
                var url = "../utils/CSV/imprimir_relatorio_venda.php?funcionario=" + funcionario +
                        "&data1=" + data1 + 
                        "&data2=" + data2
                        $('#modalFiltro').modal('hide');
            }

            window.open(url, '_blank');
        }
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

<script>
    
</script>
</body>




</html>