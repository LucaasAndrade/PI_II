import { renderURL } from "../../renderDynamic/renderURL.js";

export async function editProd() {
  document.addEventListener("click", async function (event) {
    if (
      event.target &&
      (event.target.classList.contains("edit-prod-button") ||
        event.target.closest(".edit-prod-button"))
    ) {
      let productId = event.target
        .closest(".edit-prod-button")
        .getAttribute("data-id");

      try {
        const response = await fetch(
          "../utils/PHP/produtos/getProdInfo.php?id=" + productId
        );

        const data = await response.json();

        const { produto, imagens, categorias } = data;

        // Abre o modal aqui, após o fetch
        var myModal = new bootstrap.Modal(
          document.getElementById("editProdModal"),
          {
            keyboard: false,
          }
        );
        myModal.show();

        document.getElementById("edit-id").value = produto.PRODUTO_ID;
        document.getElementById("edit-nome").value = produto.PRODUTO_NOME;
        document.getElementById("edit-desc").innerText = produto.PRODUTO_DESC;
        document.getElementById("edit-preco").value = produto.PRODUTO_PRECO;
        document.getElementById("edit-desconto").value =
          produto.PRODUTO_DESCONTO;
        document.getElementById("edit-qtd").value = produto.PRODUTO_QTD;
        document.getElementById("edit-ativo").checked =
          produto.PRODUTO_ATIVO == 1;

        const categoriaProdutoId = produto.CATEGORIA_ID;
        const selectCategoria = document.getElementById("edit-categoria");
        selectCategoria.innerHTML = "";
        categorias.forEach((categoria) => {
          const option = document.createElement("option");
          option.value = categoria.CATEGORIA_ID;
          option.textContent = categoria.CATEGORIA_NOME;
          if (categoria.CATEGORIA_ID === categoriaProdutoId) {
            option.selected = true;
          }
          selectCategoria.appendChild(option);
        });
        const imagensContainer = document.getElementById("imagens-container");
        imagensContainer.innerHTML = "";

        imagens.forEach((imagem, index) => {
          const div = document.createElement("div");
          div.classList.add("mb-3");

          const novaLabelURL = document.createElement("label");
          novaLabelURL.htmlFor = `imagem_url[${index}]`;
          novaLabelURL.innerText = "Imagem URL:";
          div.appendChild(novaLabelURL);

          const urlInput = document.createElement("input");
          urlInput.type = "text";
          urlInput.name = `imagem_url[${index}]`; // Adicione o índice ao nome
          urlInput.classList.add("form-control");
          urlInput.classList.add("mb-3");
          urlInput.value = imagem.IMAGEM_URL;
          div.appendChild(urlInput);

          const novaLabelOrdem = document.createElement("label");
          novaLabelOrdem.htmlFor = `imagem_Ordem[${index}]`;
          novaLabelOrdem.innerText = "Imagem Ordem:";
          div.appendChild(novaLabelOrdem);

          const ordemInput = document.createElement("input");
          ordemInput.type = "number";
          ordemInput.name = `imagem_Ordem[${index}]`;
          ordemInput.classList.add("form-control");
          ordemInput.value = imagem.IMAGEM_ORDEM; // Define a ordem inicial baseada na ordem da imagem
          div.appendChild(ordemInput);

          const idInput = document.createElement("input");
          idInput.type = "hidden"; // Use 'hidden' em vez de 'none' para esconder campos de entrada
          idInput.name = `imagem_id[${index}]`;
          idInput.value = imagem.IMAGEM_ID;
          div.appendChild(idInput);

          imagensContainer.appendChild(div);
        });
      } catch (error) {
        console.log(error);
      }
    }
  });

  document.addEventListener("submit", function (event) {
    if (event.target && event.target.classList.contains("edit-produto-form")) {
      event.preventDefault();

      var formData = new FormData(event.target);

      formData.forEach((value, key) => {
        console.log(`${key}: ${value}`);
      });

      fetch("../utils/PHP/produtos/editarProd.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (response.ok) {
            renderURL("produtos/produtos.php");
            var myModal = new bootstrap.Modal(
              document.getElementById("exampleModal")
            );
            myModal.hide();
          }
        })
        .catch((error) => console.error("Erro ao editar o usuário:", error));
    }
  });
}
