export function adicionarImagem() {
  document.addEventListener("click", (event) => {
    if (event.target && event.target.classList.contains("add-img-btn")) {
      const containerImagens = document.getElementById("containerImagens");

      const novaLabelURL = document.createElement("label");
      novaLabelURL.for = "imagem_url[]";
      novaLabelURL.innerText = "Imagem URL:";
      novaLabelURL.className = "mt-3";

      const novoInputURL = document.createElement("input");
      novoInputURL.className = "form-control mt-1";
      novoInputURL.type = "text";
      novoInputURL.name = "imagem_url[]";
      novoInputURL.placeholder = "URL da imagem";
      novoInputURL.required = true;

      const novaLabelOrdem = document.createElement("label");
      novaLabelOrdem.for = "imagem_Ordem[]";
      novaLabelOrdem.innerText = "Imagem Ordem:";
      novaLabelOrdem.className = "mt-3";

      const novoInputOrdem = document.createElement("input");
      novoInputOrdem.className = "form-control mt-1";
      novoInputOrdem.type = "number";
      novoInputOrdem.name = "imagem_Ordem[]";
      novoInputOrdem.placeholder = "Ordem";
      novoInputOrdem.required = true;

      containerImagens.appendChild(novaLabelURL);
      containerImagens.appendChild(novoInputURL);
      containerImagens.appendChild(novaLabelOrdem);
      containerImagens.appendChild(novoInputOrdem);
    }
  });
}
