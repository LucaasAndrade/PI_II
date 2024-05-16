import { renderURL } from "../../renderDynamic/renderURL.js";

export async function editCateg() {
  document.addEventListener("click", async function (event) {
    if (event.target.classList.contains("edit-categ-button")) {
      let userId = event.target.getAttribute("data-id");

      try {
        const response = await fetch(
          "../utils/PHP/categorias/getCategInfo.php?id=" + userId
        );
        if (!response.ok) {
          throw new Error("Erro ao buscar informações da categoria");
        }

        const data = await response.json();

        const { categoria } = data;


        var myModal = new bootstrap.Modal(document.getElementById('editCategModal'), {
          keyboard: false
        });
        myModal.show();

        document.getElementById("edit-id").value = categoria.CATEGORIA_ID;
        document.getElementById("edit-nome").value = categoria.CATEGORIA_NOME;
        document.getElementById("edit-desc").value = categoria.CATEGORIA_DESC;
        document.getElementById("edit-ativo").checked =
          categoria.CATEGORIA_ATIVO === 1;

      } catch (error) {
        console.log(error);
      }
    }
  });

  document.addEventListener("submit", function (event) {
    if (event.target && event.target.classList.contains("edit-categ-form")) {
      event.preventDefault();

      var formData = new FormData(event.target);

      fetch("../utils/PHP/categorias/editarCategoria.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => {

          if (response.ok) {
            // Fecha o modal após o post
            var myModal = new bootstrap.Modal(document.getElementById('editCategModal'));
            myModal.hide();
            renderURL("categorias/categorias.php");
          }
        })
        .catch((error) => {
          console.log(`Erro ao enviar informações para edição: ${error}`);
        });
    }
  });
}
