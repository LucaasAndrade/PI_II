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
            });
          } else {
            console.log("Não foi possível carregar .form__container");
          }
        })
        .catch((error) => {
          console.log("Error fetching content:", error);
        });
    });
  });
}
