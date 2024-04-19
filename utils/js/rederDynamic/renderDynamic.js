export function renderDynamic() {
  const links = document.querySelectorAll(".nav__link a");

  links.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();

      fetch(link.href)
        .then((response) => response.text())
        .then((data) => {
          document.querySelector("#dynamic-content").innerHTML = data;
        });
    });
  });
}
