/* Filtrage des éléments par catégorie */

document.addEventListener("DOMContentLoaded", () => {
    /* Récupère tous les éléments à filtrer */
    const items = document.querySelectorAll(".item");
    /* Récupère tous les boutons radio de filtre */
    const radios = document.querySelectorAll('input[name="type"]');

    /* Filtre les éléments selon la catégorie choisie */
    function filter(category) {
        items.forEach((item) => {
            if (category === "all") {
                /* Affiche tous les éléments si la catégorie est "all" */
                item.style.display = "block";
            } else {
                /* Affiche uniquement les éléments de la catégorie sélectionnée */
                item.style.display = item.classList.contains(category)
                    ? "block"
                    : "none";
            }
        });
    }

    /* Écoute les changements sur les boutons radio */
    radios.forEach((radio) => {
        radio.addEventListener("change", (e) => {
            filter(e.target.id); /* filtre selon l'identifiant du bouton coché */
        });
    });

    filter("all"); /* affiche tout au chargement de la page */
});
