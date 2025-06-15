<?php
    require_once('../../conn/conn.php');

    $sql = "SELECT * FROM funcionarios";
    $resultFuncionario = mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DE FUNCIONARIOS</title>
    <link rel="stylesheet" href="../assets/css/style.css">
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
            <a href="./forma_pagamento.php">
                <i class="fas fa-money-bill-wave"></i>
                <span>Formas de Pagamento</span>
            </a>
            <a href="./funcionario.php"  class="active">
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
<!-- 
            <div class="menu-title">Configurações</div>
            <a href="#">
                <i class="fas fa-cog"></i>
                <span>Configurações</span>
            </a> -->
             <!-- <a href="#">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sair</span>
            </a> -->
        </div>
    </div>



    <div class="container">
        <!-- <div class="title-cadastro">
            <h1>Cadastro de Funcionario</h1>
        </div> -->
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content modal-content-custom">
                    <div class="modal-header modal-header-custom">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            <i class="fas fa-user-tie me-2"></i>Cadastrar Funcionário
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form action="../insert/funcionario.php" method="POST">
                            <!-- Seção 1: Dados Pessoais -->
                            <div class="mb-4">
                                <h6 class="section-title mb-3">
                                    <i class="fas fa-id-card me-2"></i>Dados Pessoais
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="matricula" name="matricula" required placeholder="Nº Matrícula">
                                            <label for="matricula">Nº Matrícula</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="nome" name="nome" required placeholder="Nome">
                                            <label for="nome">Nome</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="sobrenome" name="sobrenome" required placeholder="Sobrenome">
                                            <label for="sobrenome">Sobrenome</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Seção 2: Contato e Cargo -->
                            <div class="mb-4">
                                <h6 class="section-title mb-3">
                                    <i class="fas fa-briefcase me-2"></i>Informações Profissionais
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="telefone" name="telefone" required placeholder="Telefone">
                                            <label for="telefone">Telefone</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="cargo" name="cargo" required placeholder="Cargo">
                                            <label for="cargo">Cargo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Seção 3: Endereço -->
                            <div class="mb-4">
                                <h6 class="section-title mb-3">
                                    <i class="fas fa-map-marker-alt me-2"></i>Endereço
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="cep" name="cep" required placeholder="CEP">
                                            <label for="cep">CEP</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="cidade" name="cidade" required placeholder="Cidade">
                                            <label for="cidade">Cidade</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <select class="form-select" id="uf" name="uf" required>
                                                <option value="" selected disabled>Selecione o estado</option>
                                                <option value="ac">Acre (AC)</option>
                                                <option value="al">Alagoas (AL)</option>
                                                <option value="am">Amazonas (AM)</option>
                                                <option value="ap">Amapá (AP)</option>
                                                <option value="ba">Bahia (BA)</option>
                                                <option value="ce">Ceará (CE)</option>
                                                <option value="df">Distrito Federal (DF)</option>
                                                <option value="es">Espírito Santo (ES)</option>
                                                <option value="go">Goiás (GO)</option>
                                                <option value="ma">Maranhão (MA)</option>
                                                <option value="mg">Minas Gerais (MG)</option>
                                                <option value="ms">Mato Grosso do Sul (MS)</option>
                                                <option value="mt">Mato Grosso (MT)</option>
                                                <option value="pa">Pará (PA)</option>
                                                <option value="pb">Paraíba (PB)</option>
                                                <option value="pe">Pernambuco (PE)</option>
                                                <option value="pi">Piauí (PI)</option>
                                                <option value="pr">Paraná (PR)</option>
                                                <option value="rj">Rio de Janeiro (RJ)</option>
                                                <option value="rn">Rio Grande do Norte (RN)</option>
                                                <option value="ro">Rondônia (RO)</option>
                                                <option value="rr">Roraima (RR)</option>
                                                <option value="rs">Rio Grande do Sul (RS)</option>
                                                <option value="sc">Santa Catarina (SC)</option>
                                                <option value="se">Sergipe (SE)</option>
                                                <option value="sp">São Paulo (SP)</option>
                                                <option value="to">Tocantins (TO)</option>
                                            </select>
                                            <label for="uf">Estado</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="rua" name="rua" required placeholder="Rua">
                                            <label for="rua">Rua</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="numero" name="numero" required placeholder="Número">
                                            <label for="numero">Número</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento">
                                            <label for="complemento">Complemento</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="bairro" name="bairro" required placeholder="Bairro">
                                            <label for="bairro">Bairro</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Seção 4: Dados de Acesso -->
                            <div class="mb-4">
                                <h6 class="section-title mb-3">
                                    <i class="fas fa-user-circle me-2"></i>Dados de Acesso
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" required placeholder="E-mail">
                                            <label for="email">E-mail</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="cpf" name="cpf" required placeholder="CPF">
                                            <label for="cpf">CPF</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer border-top-0 pt-4">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i>Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Cadastrar Funcionário
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="main-content">

        <div class="tabela-container">
            <div class="container-btn">
                <button type="button" class="btn btn-primary btn-cadastro" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">
                    Cadastrar funcionario
                </button>
            </div>
            <h2 class="titulo-tabela">Listagem de Funcionarios</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nº Matricula</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>Cargo</th>
                        <th>E-mail</th>
                        <th>CPF</th>
                        <!-- <th>Telefone</th> -->
                        <th>Cidade</th>
                        <th colspan="2">Ações </th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resultFuncionario as $row) { ?>
                    <tr>
                        <td class="text-center"><?php echo htmlspecialchars($row['matricula']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($row['sobrenome']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($row['cargo']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($row['email']); ?></td>
                        <td class="text-center"><?php echo htmlspecialchars($row['cpf']); ?></td>
                        <!-- <td class="text-center"><?php echo htmlspecialchars($row['telefone']); ?></td> -->
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
        </div>



</body>

<script>
function editar(id) {
    window.location.href = `../edit/funcionario.php?id=${id}`;
}

function excluir(id) {
    window.location.href = `../delete/funcionario.php?id=${id}`;
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
</script>

</html>