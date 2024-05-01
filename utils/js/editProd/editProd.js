function clearModal() {
  document.getElementById("edit-id").value = "";
  document.getElementById("edit-nome").value = "";
  document.getElementById("edit-desc").innerText = "";
  document.getElementById("edit-preco").value = "";
  document.getElementById("edit-desconto").value = "";
  document.getElementById("edit-qtd").value = "";
  document.getElementById("edit-ativo").checked = false;

  const imagensContainer = document.getElementById("imagens-container");
  imagensContainer.innerHTML = "";

  const selectCategoria = document.getElementById("edit-categoria");
  selectCategoria.innerHTML = "";
}

export async function editProd() {
  document.addEventListener("click", async function (event) {
    if (event.target.matches(".edit-prod-button")) {
      let userId = event.target.getAttribute("data-id");

      try {
        const response = await fetch(
          "../utils/produtos/getProdInfo.php?id=" + userId
        );
        if (!response.ok) {
          throw new Error("Erro ao buscar informações do produto");
        }

        const data = await response.json();

        if (!data.produto) {
          throw new Error("Nenhum produto encontrado com o ID fornecido");
        }

        if (!data.imagens || data.imagens.length === 0) {
          throw new Error("Nenhuma imagem encontrada para o produto");
        }

        if (!data.categorias || data.categorias.length === 0) {
          throw new Error("Nenhuma categoria encontrada");
        }

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

          const novaLabelURL = document.createElement("label");
          novaLabelURL.for = "imagem_url[]";
          novaLabelURL.innerText = "Imagem URL:";
          div.appendChild(novaLabelURL);

          const urlInput = document.createElement("input");
          urlInput.type = "text";
          urlInput.name = "imagem_url[]";
          urlInput.classList.add("form-control");
          urlInput.value = imagem.IMAGEM_URL;
          div.appendChild(urlInput);

          const novaLabelOrdem = document.createElement("label");
          novaLabelOrdem.for = "imagem_Ordem[]";
          novaLabelOrdem.innerText = "Imagem Ordem:";
          div.appendChild(novaLabelOrdem);

          const ordemInput = document.createElement("input");
          ordemInput.type = "number";
          ordemInput.name = "imagem_Ordem[]";
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

        const modal = document.getElementById("exampleModal");
        modal.addEventListener("hidden.bs.modal", function (e) {
          clearModal();
        });
      } catch (error) {
        console.log(error);
      }
    }
  });
}
