export function searchAdm() {
  document.addEventListener("click", function (event) {
    if (event.target && event.target.id === "search-button") {
      event.preventDefault();

      const searchInput = document.getElementById("search-input");
      const searchTerm = searchInput.value.toLowerCase();
      const rows = document.querySelectorAll(".tableADM tbody tr");

      rows.forEach((row) => {
        const cells = row.querySelectorAll(".searchable");
        let found = false;

        cells.forEach((cell) => {
          const text = cell.textContent.toLocaleLowerCase();
          if (text.includes(searchTerm)) {
            found = true;
          }
        });

        if (found) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });
    }
  });
}
