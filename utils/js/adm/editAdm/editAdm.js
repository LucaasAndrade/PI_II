import { renderURL } from "../../renderDynamic/renderURL.js";

function clearModal() {
  document.getElementById("edit-id").value = "";
  document.getElementById("edit-nome").value = "";
  document.getElementById("edit-email").value = "";
  document.getElementById("edit-senha").innerText = "";
  document.getElementById("edit-ativo").checked = false;
}

export function editAdm() {
  document.addEventListener("click", function (event) {
    if (event.target && event.target.classList.contains("edit-adm-button")) {
      let userId = event.target.getAttribute("data-id");

      fetch("../utils/PHP/adm/getAdmInfo.php?id=" + userId)
        .then((response) => response.json())
        .then((details) => {
          document.getElementById("edit-id").value = details.ADM_ID;
          document.getElementById("edit-nome").value = details.ADM_NOME;
          document.getElementById("edit-email").value = details.ADM_EMAIL;
          document.getElementById("edit-senha").value = details.ADM_SENHA;
          document.getElementById("edit-ativo").checked =
            details.ADM_ATIVO == 1;
        })
        .catch((error) => {
          console.log(error);
        });
    }
  });

  document.addEventListener("submit", function (event) {
    if (event.target && event.target.classList.contains("edit-adm-form")) {
      event.preventDefault();

      var formData = new FormData(event.target);

      fetch("../utils/PHP/adm/editarAdm.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          console.log(
            `Sucesso ao enviar informações para edição: ${response.json()}`
          );
          const modal = document.getElementById("exampleModal");
          modal.addEventListener("hidden.bs.modal", function (e) {
            clearModal();
          });
          renderURL("adm/adm.php");
        })
        .catch((error) => {
          console.log(`Erro ao enviar informações para edição: ${error}`);
        });
    }
  });
}
