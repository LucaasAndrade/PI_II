import { renderURL } from "../../rederDynamic/renderURL.js";

export function confirmDeleteCateg() {
  document.addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-categ-button")) {
      const userId = event.target.getAttribute("data-id");
      document
        .getElementById("confirmDeleteCateg")
        .setAttribute("data-id", userId);

      document
        .getElementById("confirmDeleteCateg")
        .addEventListener("click", function () {
          fetch("../utils/PHP/categorias/excluirCategoria.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: "id=" + userId,
          })
            .then((response) => {
              if (response.ok) {
                renderURL("categorias/listar_categorias.php");
              }
            })
            .catch((error) => console.error("Erro ao excluir categoria:", error));
        });
    }
  });
}
