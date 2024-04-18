const body = document.querySelector("body");
const sidebar = body.querySelector(".sidebar");
const toggle = body.querySelector(".toggle");
const mode = body.querySelector(".mode");
const modeSwitch = body.querySelector(".toggle-switch");
const modeText = body.querySelector(".mode__text");

toggle.addEventListener("click", () => {
  if (sidebar.classList.contains("close")) {
    sidebar.classList.replace("close", "open");
  } else if (sidebar.classList.contains("open")) {
    sidebar.classList.replace("open", "close");
  }
});

modeSwitch.addEventListener("click", () => {
  if (body.classList.contains("light")) {
    body.classList.replace("light", "dark");
    modeText.innerHTML = "Light Mode";
  } else {
    body.classList.replace("dark", "light");
    modeText.innerHTML = "Dark Mode";
  }
});
