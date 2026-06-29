document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".repas-grille .recette-card:not(.repas-no-result)");
    const buttons = document.querySelectorAll(".filtre-btn");
    const noResult = document.querySelector(".repas-no-result");

    if (!cards.length || !buttons.length) {
        return;
    }

    const filters = {
        category: "all",
        type: "all",
    };

    function updateActiveButton(clickedButton) {
        const group = clickedButton.dataset.filterGroup;

        document
            .querySelectorAll(`.filtre-btn[data-filter-group="${group}"]`)
            .forEach((button) => button.classList.remove("active"));

        clickedButton.classList.add("active");
    }

    function applyFilters() {
        let visibleCount = 0;

        cards.forEach((card) => {
            const cardCategory = card.dataset.categoryId || "";
            const cardType = card.dataset.typeId || "";

            const matchCategory = filters.category === "all" || cardCategory === filters.category;
            const matchType = filters.type === "all" || cardType === filters.type;
            const isVisible = matchCategory && matchType;

            card.hidden = !isVisible;

            if (isVisible) {
                visibleCount += 1;
            }
        });

        if (noResult) {
            noResult.hidden = visibleCount !== 0;
        }
    }

    buttons.forEach((button) => {
        button.addEventListener("click", () => {
            const group = button.dataset.filterGroup;
            const value = button.dataset.filterValue || "all";

            if (!group || !(group in filters)) {
                return;
            }

            filters[group] = value;
            updateActiveButton(button);
            applyFilters();
        });
    });

    applyFilters();
});
