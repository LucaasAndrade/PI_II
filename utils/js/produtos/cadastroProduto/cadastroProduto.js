import { renderURL } from "../../renderDynamic/renderURL.js";

export function cadastroProduto() {
  document.addEventListener("submit", function (event) {
    event.preventDefault();
    if (event.target.classList.contains("form__cadastro__prod")) {
      console.log("Formulário correto detectado");
      let nome = document.getElementById("nome").value;
      let descricao = document.getElementById("descricao").value;
      let preco = document.getElementById("preco").value;
      let desconto = document.getElementById("desconto").value;
      let qtd = document.getElementById("qtd").value;
      let categoria_id = document.getElementById("categoria_id").value;
      let ativo = document.querySelector('input[name="ativo"]').checked;

      // Obter todos os campos de imagem URL e Ordem
      let imagemUrls = document.querySelectorAll('input[name="imagem_url[]"]');
      let imagemOrdens = document.querySelectorAll(
        'input[name="imagem_Ordem[]"]'
      );

      // Criar arrays para armazenar os valores de imagem URL e Ordem
      let imagemUrlsArray = [];
      let imagemOrdensArray = [];

      // Iterar sobre os campos de imagem para obter os valores
      imagemUrls.forEach((input) => {
        imagemUrlsArray.push(input.value);
      });

      imagemOrdens.forEach((input) => {
        imagemOrdensArray.push(input.value);
      });

      let formData = new FormData();
      formData.append("nome", nome);
      formData.append("descricao", descricao);
      formData.append("preco", preco);
      formData.append("desconto", desconto);
      formData.append("qtd", qtd);
      formData.append("categoria_id", categoria_id);
      formData.append("ativo", ativo ? 1 : 0);

      // Adicionar os arrays de imagem URL e Ordem ao FormData
      imagemUrlsArray.forEach((url, index) => {
        formData.append("imagem_url[]", url);
        formData.append("imagem_Ordem[]", imagemOrdensArray[index]);
      });

      fetch("../utils/PHP/produtos/cadastrarProd.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (response.ok) {
            renderURL("produtos/produtos.php");
          }
        })
        .catch((error) => console.error("Erro ao cadastrar produto:", error));
    }
  });
}
