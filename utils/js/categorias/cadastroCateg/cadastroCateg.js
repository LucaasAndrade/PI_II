import { renderURL } from "../../renderDynamic/renderURL.js";

export function cadastroCateg() {
  document.addEventListener("submit", function (event) {
    event.preventDefault();
    if (event.target.classList.contains("form__cadastro__categ")) {
      console.log("Formulário correto detectado");
      let nome = document.getElementById("nome_categoria").value;
      let desc = document.getElementById("desc_categoria").value;
      let ativo = document.getElementById("ativo_categoria").checked;

      fetch("../utils/PHP/categorias/cadastrarCateg.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `nome=${nome}&desc=${desc}&ativo=${ativo ? 1 : 0}`,
      })
        .then((response) => {
          if (response.ok) {
            renderURL("categorias/categorias.php");
          }
          var myModalEl = document.getElementById("addCategModal");
          var modal = bootstrap.Modal.getInstance(myModalEl);
          modal.hide();
        })
        .catch((error) => console.error("Erro ao cadastrar usuário:", error));
    }
  });
}
