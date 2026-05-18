// ============================================================
//   HISTORIQUE — logique dropdown uniquement
//   Les cards sont injectées par le backend dans #cards-grid
// ============================================================

function toggleYear(year) {
    const panel  = document.getElementById('months-' + year);
    const arrow  = document.getElementById('arrow-' + year);
    const btn    = document.getElementById('btn-' + year);
    const isOpen = panel.classList.contains('open');

    // fermer l'autre année
    ['2025', '2026'].forEach(function(y) {
        if (y !== year) {
            document.getElementById('months-' + y).classList.remove('open');
            document.getElementById('arrow-'  + y).style.transform = '';
            document.getElementById('btn-'    + y).classList.remove('active');
        }
    });

    if (isOpen) {
        panel.classList.remove('open');
        arrow.style.transform = '';
        btn.classList.remove('active');
    } else {
        panel.classList.add('open');
        arrow.style.transform = 'rotate(180deg)';
        btn.classList.add('active');
        document.getElementById('btn-24h').classList.remove('active');
    }
}

function selectPeriod(period) {
    // fermer toutes les années
    ['2025', '2026'].forEach(function(y) {
        document.getElementById('months-' + y).classList.remove('open');
        document.getElementById('arrow-'  + y).style.transform = '';
        document.getElementById('btn-'    + y).classList.remove('active');
    });

    document.getElementById('btn-24h').classList.add('active');
    document.querySelectorAll('.month-btn').forEach(function(b) {
        b.classList.remove('active');
    });

    setPeriodLabel('Dernières 24h');

    // TODO : appel backend → charger les cards des 24 dernières heures
}

function selectMonth(year, month, btn) {
    document.querySelectorAll('.month-btn').forEach(function(b) {
        b.classList.remove('active');
    });
    btn.classList.add('active');

    var label = month.charAt(0).toUpperCase() + month.slice(1) + ' ' + year;
    setPeriodLabel(label);

    // TODO : appel backend → charger les cards du mois sélectionné
    // Paramètres disponibles : year (ex: "2025"), month (ex: "janvier")
}

function setPeriodLabel(label) {
    document.getElementById('period-text').textContent = '📌 ' + label;
}
