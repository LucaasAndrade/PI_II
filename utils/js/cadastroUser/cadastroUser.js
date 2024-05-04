import { renderURL } from "../rederDynamic/renderURL.js";

export function cadastroUser() {

    document.addEventListener("submit", function (event) {

        event.preventDefault();
        if (event.target.classList.contains("form__cadastro")) {
            console.log("Formulário correto detectado");
            let nome = document.getElementById('nome').value;
            let email = document.getElementById('email').value;
            let senha = document.getElementById('senha').value;
            let ativo = document.querySelector('input[name="ativo"]').checked;

            fetch('../utils/adm/cadastrarAdm.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `nome=${nome}&email=${email}&senha=${senha}&ativo=${ativo ? '1' : '0'}`
            })
                .then(response => {
                    if (response.ok) {
                        renderURL("adm/listar_adm.php")
                    }
                })
                .catch(error => console.error('Erro ao cadastrar usuário:', error));

        }
    });


}

