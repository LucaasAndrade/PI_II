import { renderURL } from "../../renderDynamic/renderURL.js";

export function confirmDeleteUser() {
  let userId;

  document.addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-adm-button")) {
      userId = event.target.getAttribute("data-id");
      document
        .getElementById("confirmDeleteAdm")
        .setAttribute("data-id", userId);
    }
  });

  document.addEventListener("click", function (event) {
    if (event.target.id === "confirmDeleteAdm") {
      fetch("../utils/PHP/adm/excluirAdm.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: "id=" + userId,
      })
        .then((response) => {
          if (response.ok) {
            renderURL("adm/adm.php");
          }
        })
        .catch((error) => console.error("Erro ao excluir usuário:", error));
    }
  });
}
