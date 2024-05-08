import { renderURL } from "../../renderDynamic/renderURL.js";

export function cadastroUser() {
  document.addEventListener("submit", function (event) {
    if (event.target.classList.contains("form__cadastro__adm")) {
      event.preventDefault();
      console.log("Formulário correto detectado");
      let nome = document.getElementById("nome").value;
      let email = document.getElementById("email").value;
      let senha = document.getElementById("senha").value;
      let ativo = document.querySelector('input[name="ativo"]').checked;

      fetch("../utils/PHP/adm/cadastrarAdm.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `nome=${nome}&email=${email}&senha=${senha}&ativo=${
          ativo ? "1" : "0"
        }`,
      })
        .then((response) => {
          if (response.ok) {
            renderURL("adm/adm.php");
          }
          var myModalEl = document.getElementById("addAdmModal");
          var modal = bootstrap.Modal.getInstance(myModalEl);
          modal.hide();
        })
        .catch((error) => console.error("Erro ao cadastrar usuário:", error));
    }
  });
}
