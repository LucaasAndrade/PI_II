export function renderURL(url) {
  fetch(url)
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
        console.log("Não foi possível carregar .dynamic-section");
      }
    })
    .catch((error) => {
      console.log("Error fetching content:", error);
    });
}
