export function editProd() {
  document.addEventListener("click", function (event) {
    if (event.target && event.target.classList.contains("edit-prod-button")) {
      let userId = event.target.getAttribute("data-id");

      fetch("../utils/produtos/getProdInfo.php?id=" + userId)
        .then((response) => {
          if (!response.ok) {
            throw new Error("Erro ao buscar informações do produto");
          }
          return response.json();
        })
        .then((data) => {
          const { produto, imagens, categorias } = data;

          document.getElementById("edit-id").value = produto.PRODUTO_ID;
          document.getElementById("edit-nome").value = produto.PRODUTO_NOME;
          document.getElementById("edit-desc").innerText = produto.PRODUTO_DESC;
          document.getElementById("edit-preco").value = produto.PRODUTO_PRECO;
          document.getElementById("edit-desconto").value =
            produto.PRODUTO_DESCONTO;
          document.getElementById("edit-qtd").value = produto.PRODUTO_QTD;
          document.getElementById("edit-ativo").checked =
            produto.PRODUTO_ATIVO == 1;

          const selectCategoria = document.getElementById("edit-categoria");
          selectCategoria.innerHTML = "";
          categorias.forEach((categoria) => {
            const option = document.createElement("option");
            option.value = categoria.CATEGORIA_ID;
            option.textContent = categoria.CATEGORIA_NOME;
            selectCategoria.appendChild(option);
          });

          const imagensContainer = document.getElementById("imagens-container");
          imagensContainer.innerHTML = "";

          imagens.forEach((imagem) => {
            const div = document.createElement("div");
            div.classList.add("mb-3");

            const urlInput = document.createElement("input");
            urlInput.type = "text";
            urlInput.name = "imagem_url[]";
            urlInput.classList.add("form-control");
            urlInput.value = imagem.IMAGEM_URL;
            div.appendChild(urlInput);

            const ordemInput = document.createElement("input");
            ordemInput.type = "number";
            ordemInput.name = "imagem_ordem[]";
            ordemInput.classList.add("form-control");
            ordemInput.value = imagem.IMAGEM_ORDEM;
            div.appendChild(ordemInput);

            const idInput = document.createElement("input");
            idInput.type = "hidden";
            idInput.name = "imagem_id";
            idInput.value = imagem.IMAGEM_ID;
            div.appendChild(idInput);

            imagensContainer.appendChild(div);
          });
        })
        .catch((error) => {
          console.log(error);
        });
    }
  });
}
