let themeAvantSelection = null;
let humeurSelectionnee = null;

function lireThemeBody() {
    return {
        haut: document.body.style.getPropertyValue('--couleur-haut'),
        bas: document.body.style.getPropertyValue('--couleur-bas'),
        texte: document.body.style.getPropertyValue('--couleur-texte')
    };
}

function appliquerCouleursSql(couleurHaut, couleurBas, couleurTexte = '#0d2520') {
    document.body.style.setProperty('--couleur-haut', couleurHaut || '#e8f5f0');
    document.body.style.setProperty('--couleur-bas', couleurBas || '#5aaa8a');
    document.body.style.setProperty('--couleur-texte', couleurTexte || '#0d2520');
}

function restaurerThemePrecedent() {
    if (!themeAvantSelection) return;

    appliquerCouleursSql(
        themeAvantSelection.haut || '#e8f5f0',
        themeAvantSelection.bas || '#5aaa8a',
        themeAvantSelection.texte || '#0d2520'
    );

    themeAvantSelection = null;
    humeurSelectionnee = null;
    nettoyerCarteNote();
}

function validerThemeSelectionne() {
    themeAvantSelection = null;
}

function enregistrerHumeur(idHumeur) {
    if (!idHumeur) return;

    const formData = new FormData();
    formData.append('id_humeur', idHumeur);

    fetch('index.php?route=UserHumeur', {
        method: 'POST',
        body: formData
    }).catch(() => {
        console.log('Humeur non enregistrée.');
    });
}

function nettoyerCarteNote() {
    const carte = document.getElementById('modal-carte');
    const inputHumeur = document.getElementById('modal-id-humeur');
    const emoji = document.getElementById('modal-emoji');

    if (inputHumeur) inputHumeur.value = '';
    if (emoji) emoji.textContent = '😊';

    if (!carte) return;

    carte.removeAttribute('data-theme-sql');
    carte.style.removeProperty('--note-couleur-haut');
    carte.style.removeProperty('--note-couleur-bas');

    [...carte.classList].forEach((classe) => {
        if (classe.startsWith('note-')) {
            carte.classList.remove(classe);
        }
    });
}

function mettreAJourCarteNote(idHumeur, icone, theme, couleurHaut, couleurBas) {
    const emoji = document.getElementById('modal-emoji');
    const inputHumeur = document.getElementById('modal-id-humeur');
    const carte = document.getElementById('modal-carte');

    if (emoji) emoji.textContent = icone || '😊';
    if (inputHumeur) inputHumeur.value = idHumeur || '';

    if (!carte) return;

    [...carte.classList].forEach((classe) => {
        if (classe.startsWith('note-')) {
            carte.classList.remove(classe);
        }
    });

    carte.dataset.themeSql = '1';
    carte.style.setProperty('--note-couleur-haut', couleurHaut || '#e8f5f0');
    carte.style.setProperty('--note-couleur-bas', couleurBas || '#5aaa8a');

    if (theme) {
        carte.classList.add('note-' + String(theme).toLowerCase().trim());
    }
}

function setThemeFromSql(couleurHaut, couleurBas, idHumeur = null, icone = '😊', theme = '') {
    if (!themeAvantSelection) {
        themeAvantSelection = lireThemeBody();
    }

    humeurSelectionnee = {
        id: idHumeur,
        icone: icone,
        theme: theme,
        couleurHaut: couleurHaut,
        couleurBas: couleurBas
    };

    appliquerCouleursSql(couleurHaut, couleurBas);
    mettreAJourCarteNote(idHumeur, icone, theme, couleurHaut, couleurBas);
}

function choisirHumeurDepuisBouton(bouton) {
    if (!bouton) return;

    // Avant connexion : les humeurs sont visibles mais bloquées.
    // Aucun changement de thème et aucune ouverture de note.
    if (bouton.disabled || bouton.dataset.connecte === '0') {
        return;
    }

    const idHumeur = bouton.dataset.idHumeur || '';
    const icone = bouton.dataset.icone || bouton.textContent.trim() || '😊';
    const theme = bouton.dataset.theme || '';
    const couleurHaut = bouton.dataset.couleurHaut || '#e8f5f0';
    const couleurBas = bouton.dataset.couleurBas || '#5aaa8a';

    setThemeFromSql(couleurHaut, couleurBas, idHumeur, icone, theme);

    if (typeof ouvrirModal === 'function') {
        ouvrirModal();
    }
}

/* Les humeurs ajoutées par l'admin fonctionnent automatiquement ici. */
document.addEventListener('click', function (event) {
    const bouton = event.target.closest('.js-mood-button');
    if (!bouton) return;

    event.preventDefault();
    choisirHumeurDepuisBouton(bouton);
});

/* Compatibilité avec les anciens boutons/admin qui appellent setTheme(). */
function setTheme(theme) {
    const themes = {
        'theme-calme': ['#e8f5f0', '#5aaa8a'],
        'theme-joie': ['#fff9e6', '#ffb347'],
        'theme-tristesse': ['#e8ecf0', '#7096b8'],
        'theme-colere': ['#f5e8e8', '#b22222'],
        'theme-fatigue': ['#eeeeee', '#aaaaaa'],
        'theme-stress': ['#e0f0ff', '#3a86ff']
    };

    const couleurs = themes[theme] || themes['theme-calme'];
    appliquerCouleursSql(couleurs[0], couleurs[1]);
}
