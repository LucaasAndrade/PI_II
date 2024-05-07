import { renderURL } from "../../renderDynamic/renderURL.js";

export function confirmDeleteCateg() {
 let categId;

 document.addEventListener("click", function (event) {
   if (event.target.classList.contains("delete-categ-button")) {
     categId = event.target.getAttribute("data-id");
     document.getElementById("confirmDeleteCateg").setAttribute("data-id", categId);
   }
 });

 document.addEventListener("click", function (event) {
   if (event.target.id === "confirmDeleteCateg") {
     fetch("../utils/PHP/categorias/excluirCategoria.php", {
       method: "POST",
       headers: {
         "Content-Type": "application/x-www-form-urlencoded",
       },
       body: "id=" + categId,
     })
       .then((response) => {
         if (response.ok) {
           renderURL("categorias/listar_categorias.php");
         }
       })
       .catch((error) => console.error("Erro ao excluir categoria:", error));
   }
 });
}