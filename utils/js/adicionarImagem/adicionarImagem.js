export function adicionarImagem() {
  document.addEventListener("click", (event) => {
    if (event.target && event.target.classList.contains("add-img-btn")) {
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
    }
  });
}