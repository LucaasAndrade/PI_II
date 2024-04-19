export function alterMode() {
  const body = document.querySelector("body");
  const mainContainer = body.querySelector(".main__container");
  const modeSwitch = body.querySelector(".toggle-switch");
  const modeText = body.querySelector(".mode__text");

  modeSwitch.addEventListener("click", () => {
    if (mainContainer.classList.contains("light")) {
      mainContainer.classList.replace("light", "dark");
      modeText.innerHTML = "Light Mode";
    } else {
      mainContainer.classList.replace("dark", "light");
      modeText.innerHTML = "Dark Mode";
    }
  });
}
