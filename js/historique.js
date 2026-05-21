// ============================================================
//   HISTORIQUE — logique dropdown uniquement
//   Les cards sont injectées par le backend dans #grille-cartes
// ============================================================

function toggleYear(year) {
    const panel  = document.getElementById('panneau-mois-' + year);
    const arrow  = document.getElementById('arrow-' + year);
    const btn    = document.getElementById('btn-' + year);
    const isOpen = panel.classList.contains('ouvert');

    // fermer le panneau de l'autre année
    ['2025', '2026'].forEach(function(y) {
        if (y !== year) {
            document.getElementById('panneau-mois-' + y).classList.remove('ouvert');
            document.getElementById('arrow-'  + y).style.transform = '';
            document.getElementById('btn-'    + y).classList.remove('actif');
        }
    });

    if (isOpen) {
        panel.classList.remove('ouvert');
        arrow.style.transform = '';
        btn.classList.remove('actif');
    } else {
        panel.classList.add('ouvert');
        arrow.style.transform = 'rotate(180deg)';
        btn.classList.add('actif');
        document.getElementById('btn-24h').classList.remove('actif');
    }
}

function selectPeriod(period) {
    // fermer les panneaux de toutes les années
    ['2025', '2026'].forEach(function(y) {
        document.getElementById('panneau-mois-' + y).classList.remove('ouvert');
        document.getElementById('arrow-'  + y).style.transform = '';
        document.getElementById('btn-'    + y).classList.remove('actif');
    });

    document.getElementById('btn-24h').classList.add('actif');
    document.querySelectorAll('.btn-mois').forEach(function(b) {
        b.classList.remove('actif');
    });

    setPeriodLabel('Dernières 24h');

    // TODO : appel backend → charger les cards des 24 dernières heures
}

function selectMonth(year, month, btn) {
    document.querySelectorAll('.btn-mois').forEach(function(b) {
        b.classList.remove('actif');
    });
    btn.classList.add('actif');

    var label = month.charAt(0).toUpperCase() + month.slice(1) + ' ' + year;
    setPeriodLabel(label);

    // TODO : appel backend → charger les cards du mois sélectionné
    // Paramètres disponibles : year (ex: "2025"), month (ex: "janvier")
}

function setPeriodLabel(label) {
    document.getElementById('texte-periode').textContent = '📌 ' + label;
}
