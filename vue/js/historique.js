// Historique MVC : les données viennent du contrôleur PHP.
// Ce fichier gère seulement l'ouverture/fermeture des mois.

function toggleYear(year) {
    const panel = document.getElementById('panneau-mois-' + year);
    const arrow = document.getElementById('arrow-' + year);

    if (!panel) return;

    document.querySelectorAll('.panneau-mois').forEach(function(otherPanel) {
        if (otherPanel !== panel) {
            otherPanel.classList.remove('ouvert');
        }
    });

    document.querySelectorAll('.fleche-menu').forEach(function(otherArrow) {
        if (otherArrow !== arrow) {
            otherArrow.style.transform = '';
        }
    });

    panel.classList.toggle('ouvert');

    if (arrow) {
        arrow.style.transform = panel.classList.contains('ouvert') ? 'rotate(180deg)' : '';
    }
}


document.addEventListener('DOMContentLoaded', () => {
    const highlighted = document.querySelector('.carte-hist-highlight');
    if (highlighted) {
        setTimeout(() => {
            highlighted.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 250);
    }
});
