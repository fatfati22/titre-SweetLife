/* Animation flottante de l'emoji et effet au clic */

/* Récupère l'élément emoji par son identifiant */
const emojiEl = document.getElementById("moodEmoji");

let y = 0;         /* position verticale courante */
let direction = 1; /* sens du mouvement : 1 = vers le bas, -1 = vers le haut */

/* Fonction d'animation en boucle */
function animate() {
    y += 0.2 * direction; /* avance de 0.2 pixel dans la direction courante */

    /* Inverse la direction quand les limites sont atteintes */
    if (y > 10 || y < -10) {
        direction *= -1;
    }

    /* Applique le déplacement vertical à l'élément */
    emojiEl.style.transform = `translateY(${y}px)`;
    requestAnimationFrame(animate); /* rappelle la fonction au prochain rendu */
}

animate(); /* démarre l'animation */

/* Effet d'agrandissement et rotation au clic */
emojiEl.addEventListener("click", () => {
    emojiEl.style.transform = "scale(1.4) rotate(10deg)"; /* agrandit et pivote */

    /* Remet la transformation normale après 200ms */
    setTimeout(() => {
        emojiEl.style.transform = `translateY(${y}px) scale(1)`;
    }, 200);
});
