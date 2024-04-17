const body = document.querySelector("body");
const sidebar = body.querySelector(".sidebar");
const toggle = body.querySelector(".toggle");
const mode = body.querySelector(".mode");
const modeSwitch = body.querySelector(".toggle-switch");
const modeText = body.querySelector(".mode__text");

modeSwitch.addEventListener("click", () => {
  body.classList.toggle("dark");
  if (modeText.innerHTML === "Dark Mode") {
    modeText.innerHTML = "Light Mode";
  } else {
    modeText.innerHTML = "Dark Mode";
  }
});
