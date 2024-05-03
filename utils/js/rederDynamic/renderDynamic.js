export function renderDynamic() {
  const links = document.querySelectorAll(".nav__link a");

  links.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();

      fetch(link.href)
        .then((response) => response.text())
        .then((data) => {
          const tempDiv = document.createElement("div");
          tempDiv.innerHTML = data;
          const formContainer = tempDiv.querySelector(".dynamic-section");
          if (formContainer) {
            document.querySelectorAll("#dynamic-content").forEach((element) => {
              element.innerHTML = formContainer.innerHTML;

              // Inicializa o Glide.js após o conteúdo ser renderizado
              const glideElements = element.querySelectorAll(".glide");
              glideElements.forEach((glideElement, index) => {
                const productId = index + 1;
                const glide = new Glide(glideElement);
                glide.mount();
                glide.on("mounted", () => {
                  glideElement.setAttribute("id", "glide_" + productId);
                });
              });
            });
          } else {
            console.log("Não foi possível carregar .dynamic-section");
          }
        })
        .catch((error) => {
          console.log("Error fetching content:", error);
        });
    });
  });
}
