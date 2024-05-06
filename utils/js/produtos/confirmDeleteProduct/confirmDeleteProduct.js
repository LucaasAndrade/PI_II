import { renderURL } from "../../rederDynamic/renderURL.js";

export function confirmDeleteProduct() {
    let productId;

    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("delete-prod-button")) {
            productId = event.target.getAttribute('data-id');
            document.getElementById('confirmDeleteProd').setAttribute('data-id', productId);
        }
    });

    document.addEventListener("click", function (event) {
        if (event.target.id === "confirmDeleteProd") {
            productId = event.target.getAttribute('data-id');
            fetch("../utils/produtos/excluirProd.php", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + productId
            }).then(response => {
                if (response.ok) {
                    renderURL('produtos/listar_produtos.php')
                }
            })
                .catch(error => console.error('Erro ao excluir usuário:', error));
        }
    });
}