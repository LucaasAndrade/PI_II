export function adicionarImagem() {
  const button = document.querySelector(".add-img-btn");

  button.addEventListener("click", () => {
    const containerImagens = document.getElementById("containerImagens");

    const novoInputURL = document.createElement("input");
    novoInputURL.className = "form-control mt-2";
    novoInputURL.type = "text";
    novoInputURL.name = "imagem_url[]";
    novoInputURL.placeholder = "URL da imagem";
    novoInputURL.required = true;

    const novoInputOrdem = document.createElement("input");
    novoInputOrdem.className = "form-control mt-2";
    novoInputOrdem.type = "number";
    novoInputOrdem.name = "imagem_Ordem[]";
    novoInputOrdem.placeholder = "Ordem";
    novoInputOrdem.required = true;

    containerImagens.appendChild(novoInputURL);
    containerImagens.appendChild(novoInputOrdem);
  });
}
