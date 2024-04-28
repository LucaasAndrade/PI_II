export function sideBarOpen() {
  const body = document.querySelector("body");
  const sidebar = body.querySelector(".sidebar");
  const toggle = body.querySelector(".toggle");

  toggle.addEventListener("click", () => {
    if (sidebar.classList.contains("close")) {
      sidebar.classList.replace("close", "open");
    } else if (sidebar.classList.contains("open")) {
      sidebar.classList.replace("open", "close");
    }
  });
}
