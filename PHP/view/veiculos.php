 <?php
    require_once('../../conn/conn.php');

    $sql = "SELECT * FROM veiculos";
    $resultVeiculos = mysqli_query($conn, $sql);

?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>CADASTRO DE VEICULOS</title>
         <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/modal.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
 </head>

 <body>



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
             <a href="./veiculos.php"  class="active">
                 <i class="fas fa-car"></i>
                 <span>Cadastrar Veículos</span>
             </a>
             <a href="./cliente.php">
                 <i class="fas fa-users"></i>
                 <span>Cadastrar Clientes</span>
             </a>
             <a href="./forma_pagamento.php">
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

             <div class="menu-title">Relatórios</div>
                <a onclick="window.open('../utils/PDF/gerar_pdf');" target="_BLANK">
                    <i class="fas fa-chart-line"></i>
                    <span>Vendas</span>
                </a>
                <a href="#">
                    <i class="fas fa-chart-pie"></i>
                    <span>Estoque</span>
                </a>

             
         </div>
     </div>

        <div class="main-content">
           <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content modal-content-custom">
                        <div class="modal-header modal-header-custom">
                            <h5 class="modal-title" id="staticBackdropLabel">
                                <i class="fas fa-car me-2"></i>Cadastrar Veículo
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <form action="../insert/veiculos.php" method="POST">
                                <!-- Seção 1: Identificação do Veículo -->
                                <div class="mb-4">
                                    <h6 class="section-title mb-3">
                                        <i class="fas fa-car-alt me-2"></i>Identificação do Veículo
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="marca" name="marca" required 
                                                    placeholder="Ex: Ford, Volkswagen, Chevrolet">
                                                <label for="marca">Marca</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="modelo" name="modelo" required
                                                    placeholder="Ex: Fiesta, Gol, Onix">
                                                <label for="modelo">Modelo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="ano_fabricacao" name="ano_fabricacao" 
                                                    min="1900" max="<?= date('Y')+1 ?>" required
                                                    placeholder="Ex: 2020">
                                                <label for="ano_fabricacao">Ano Fabricação</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="ano_modelo" name="ano_modelo" 
                                                    min="1900" max="<?= date('Y')+1 ?>" required
                                                    placeholder="Ex: 2021">
                                                <label for="ano_modelo">Ano Modelo</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="chassi" name="chassi" required
                                                    placeholder="Número do chassi (17 caracteres)">
                                                <label for="chassi">Chassi</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="cor" name="cor" required
                                                    placeholder="Ex: Preto, Branco, Prata">
                                                <label for="cor">Cor</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Seção 2: Detalhes do Veículo -->
                                <div class="mb-4">
                                    <h6 class="section-title mb-3">
                                        <i class="fas fa-info-circle me-2"></i>Detalhes do Veículo
                                    </h6>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="">Selecione um status</option>
                                                    <option value="disponivel" selected>Disponível</option>
                                                    <option value="consignado">Consignado</option>
                                                    <option value="reservado">Reservado</option>
                                                    <option value="vendido">Vendido</option>
                                                </select>
                                                <label for="status">Status</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="combustivel" name="combustivel" required
                                                    placeholder="Ex: Flex, Gasolina, Diesel">
                                                <label for="combustivel">Combustível</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <div class="mb-4">
                                        <h6 class="section-title mb-3">
                                            <i class="fas fa-dollar-sign me-2"></i>Valores
                                        </h6>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="preco_custo" class="form-label">Preço de Custo</label>
                                                <div class="input-group input-group-floating">
                                                    <!-- <span class="input-group-text">R$</span> -->
                                                    <div class="form-floating">
                                                        <input type="number" step="0.01" class="form-control" id="preco_custo" name="preco_custo" required
                                                            placeholder="0,00">
                                                        <label for="preco_custo">Preço de Custo</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="preco_venda" class="form-label">Preço de Venda</label>
                                                <div class="input-group input-group-floating">
                                                    <!-- <span class="input-group-text">R$</span> -->
                                                    <div class="form-floating">
                                                        <input type="number" step="0.01" class="form-control" id="preco_venda" name="preco_venda" required
                                                            placeholder="0,00">
                                                        <label for="preco_venda">Preço de Venda</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <div class="modal-footer border-top-0 pt-4">
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
                <div class="form-group col-md-4 ml-auto">
                    <input type="text" class="form-control" id="filtro-pagina" name="filtro-pagina" oninput="filtro()"
                        placeholder="Pesquisa">
                </div>
                 <button type="button" class="btn btn-primary btn-cadastro" data-bs-toggle="modal"
                     data-bs-target="#staticBackdrop">
                     Cadastrar veiculo
                 </button>
                 <button onclick="window.open('../utils/PDF/gerar_pdf.php');" target="_BLANK" type="button" class="btn btn-primary btn-cadastro">
                    Imprimir Relatório
                 </button>
                
              <!-- <a  class="btn btn-primary btn-add ml-2"></a>
              <a onClick="imprimirRelatorio('csv')" target="_BLANK" class="btn btn-primary btn-add ml-2" >Baixar CSV</a> -->
             </div>
             <h2 class="titulo-tabela">Lista de Veiculos</h2>
             <div id="conteudo-os" class="table-responsive">
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
            </div>
         </div>
        </div>

        
     </div>
 </body>


      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
    function filtro() {
        var pagina = $('#filtro-pagina').val();
        console.log(pagina);

        var spinner =
            "<div id='spinner' class='spinner-border' role='status' style='margin-left: 47%;margin-top: 20%;margin-bottom: 20%; color:#2e2e2e; width:5rem; height:5rem;'><span class='sr-only'>Loading...</span></div>";
        $('#conteudo-os').html(spinner);

            $.get('../filters/veiculos.php', {   
            pagina: pagina || "", 
        
        }, (data) => {
            $('#conteudo-os').html(data);
        });
    }
    function edit_veiculo(id_veiculo) {
        window.location.href = `../edit/veiculos.php?id=${id_veiculo}`;
    }

    function excluir_veiculo(id_veiculo) {
        window.location.href = `../delete/veiculos.php?id=${id_veiculo}`;
    }

     function imprimirRelatorio(tipo) {
        if(tipo === "pdf"){
            var url = "../utils/PDF/gerar_pdf.php";
            $('#modalFiltro').modal('hide');
        }
        window.open(url, '_blank'); 
    }
        $('#modalFiltro').on('shown.bs.modal', function () {
            $('#filtro-loja2').val('');
            $('#modelo_filtro').val('');
            $('#tipo').val('');
        });

        $(document).ready(function () {
            $(".btn-add1").click(function () {
                $("#modalFiltro").modal("show");
            });
        });


    // Máscara para o campo de chassi "para lembrar na apresentação"
    document.getElementById('chassi').addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^a-zA-Z0-9]/g, '');
        e.target.value = value;
    });

    //  preço de venda seja maior que preço de custo "para lembrar na apresentação"
    document.querySelector('form').addEventListener('submit', function(e) {
        const precoCusto = parseFloat(document.getElementById('preco_custo').value);
        const precoVenda = parseFloat(document.getElementById('preco_venda').value);

        if (precoVenda <= precoCusto) {
            alert('O preço de venda deve ser maior que o preço de custo!');
            e.preventDefault();
        }
    });
      // Atualiza o badge de status quando o select muda "para lembrar na apresentação"
    document.getElementById('status').addEventListener('change', function() {
        const badge = document.querySelector('.status-badge');
        badge.classList.remove('vendido', 'consignado', 'disponivel', 'reservado');
        badge.classList.add(this.value);
    });

    // Máscara para valores monetários "para lembrar na apresentação"
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
 </script>




 </html>