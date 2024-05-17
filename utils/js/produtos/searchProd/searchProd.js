export function searchProd() {
    document.addEventListener("click", function (event) {
        if (event.target && event.target.id === "search-button") {
            event.preventDefault();

            const searchInput = document.getElementById("search-input");
            const searchTerm = searchInput.value.trim().toLowerCase();
            const cardsContainer = document.querySelector(".card__container");
            const cards = document.querySelectorAll(".searchable.product-card");

            cards.forEach((card) => {
                const productName = card.querySelector(".text-product h3").textContent.toLowerCase();
                if (searchTerm === "" || productName.includes(searchTerm)) {
                    card.style.display = ""; // Exibe o cartão se a pesquisa estiver vazia ou se o termo de pesquisa estiver presente

                    // Move o cartão para o início do contêiner se o termo de pesquisa estiver presente no nome do produto
                    cardsContainer.insertBefore(card, cardsContainer.firstChild);
                } else {
                    card.style.display = "none"; // Oculta o cartão se o termo de pesquisa não estiver presente
                }
            });
        }
    });
}
