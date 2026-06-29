function setSqlColors(couleurHaut, couleurBas, theme) {
    const haut = document.getElementById('couleurHautInput');
    const bas = document.getElementById('couleurBasInput');
    const themeInput = document.querySelector('input[name="theme"]');

    if (haut) haut.value = couleurHaut;
    if (bas) bas.value = couleurBas;
    if (themeInput) themeInput.value = theme;

    if (typeof appliquerCouleursSql === 'function') {
        appliquerCouleursSql(couleurHaut, couleurBas);
    }
}
