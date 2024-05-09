import { renderURL } from "../../renderDynamic/renderURL.js";

function clearModal() {
  document.getElementById("edit-id").value = "";
  document.getElementById("edit-nome").value = "";
  document.getElementById("edit-email").value = "";
  document.getElementById("edit-senha").innerText = "";
  document.getElementById("edit-ativo").checked = false;
}

export function editAdm() {
  document.addEventListener("click", async function (event) {
    if (event.target && event.target.classList.contains("edit-adm-button")) {
      let userId = event.target.getAttribute("data-id");

      try {
        const response = await await fetch(
          "../utils/PHP/adm/getAdmInfo.php?id=" + userId
        );

        const data = await response.json();

        const { admin } = data;

        document.getElementById("edit-id").value = admin.ADM_ID;
        document.getElementById("edit-nome").value = admin.ADM_NOME;
        document.getElementById("edit-email").value = admin.ADM_EMAIL;
        document.getElementById("edit-senha").value = admin.ADM_SENHA;
        document.getElementById("edit-ativo").checked = admin.ADM_ATIVO == 1;

        const modal = new bootstrap.Modal(
          document.getElementById("editAdmModal")
        );
        modal.show();

        modal.addEventListener("hidden.bs.modal", function (e) {
          clearModal();
        });
      } catch (error) {
        console.log(error);
      }
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
          renderURL("adm/adm.php");
        })
        .catch((error) => {
          console.log(`Erro ao enviar informações para edição: ${error}`);
        });
    }
  });
}
