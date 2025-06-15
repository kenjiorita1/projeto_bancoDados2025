function criarTabelaPaginada(dados, seletorTabela, seletorPaginacao, linhasPorPagina = 10) {
  let paginaAtual = 1;

  function carregarTabela() {
    const inicio = (paginaAtual - 1) * linhasPorPagina;
    const fim = inicio + linhasPorPagina;
    const dadosPagina = dados.slice(inicio, fim);

    const corpo = $(`${seletorTabela} tbody`);
    corpo.empty();

    $.each(dadosPagina, function (_, item) {
      const linha = "<tr>";
      for (const valor of Object.values(item)) {
        linha += `<td>${valor}</td>`;
      }
      linha += "</tr>";
      corpo.append(linha);
    });

    renderizarPaginacao();
  }

  function renderizarPaginacao() {
    const totalPaginas = Math.ceil(dados.length / linhasPorPagina);
    const paginacao = $(seletorPaginacao);
    paginacao.empty();

    for (let i = 1; i <= totalPaginas; i++) {
      const botao = $("<button>")
        .text(i)
        .toggleClass("active", i === paginaAtual)
        .click(function () {
          paginaAtual = i;
          carregarTabela();
        });
      paginacao.append(botao);
    }
  }

  carregarTabela();
}
