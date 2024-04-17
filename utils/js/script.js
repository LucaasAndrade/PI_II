const body = document.querySelector("body");
const sidebar = body.querySelector(".sidebar");
const toggle = body.querySelector(".toggle");
const mode = body.querySelector(".mode");
const modeSwitch = body.querySelector(".toggle-switch");
const modeText = body.querySelector(".mode__text");

modeSwitch.addEventListener("click", () => {
  if (body.classList.contains("light")) {
    body.classList.toggle("dark");
  } else {
    body.classList.toggle("dark");
  }
  if (modeText.innerHTML === "Dark Mode") {
    modeText.innerHTML = "Light Mode";
  } else {
    modeText.innerHTML = "Dark Mode";
  }
});
