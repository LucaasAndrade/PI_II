function updateTableClass(mainContainer, table) {
  if (mainContainer.classList.contains("light")) {
    table.classList.remove("table-dark");
    table.classList.add("table-light");
  } else {
    table.classList.remove("table-light");
    table.classList.add("table-dark");
  }
}

export function alterMode() {
  const body = document.querySelector("body");
  const mainContainer = body.querySelector(".main__container");
  const modeSwitch = body.querySelector(".toggle-switch");
  const modeText = body.querySelector(".mode__text");
  const logo = body.querySelector(".logo"); // Selecione a imagem do logo

  modeSwitch.addEventListener("click", () => {
    if (mainContainer.classList.contains("light")) {
      mainContainer.classList.replace("light", "dark");
      modeText.innerHTML = "Tema claro";
      logo.src = "../images/logo2.svg"; // Altere o src para o logo do tema escuro
    } else {
      mainContainer.classList.replace("dark", "light");
      modeText.innerHTML = "Tema escuro";
      logo.src = "../images/logo.svg"; // Altere o src para o logo do tema claro
    }
  });
}
