<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php?route=connexion");
    exit();
}

require_once __DIR__ . '/../model/traitHistorique.php';

$id_user = (int) $_SESSION['user']['id'];

$filtre = $_GET['periode'] ?? 'tout';
$annee = isset($_GET['annee']) ? (int) $_GET['annee'] : null;
$mois = isset($_GET['mois']) ? (int) $_GET['mois'] : null;

if ($filtre === '24h') {
    $libellePeriode = 'Dernières 24h';
    $historique = getHistoriqueUtilisateur($id_user, '24h');
} elseif ($annee && $mois) {
    $filtre = 'mois';
    $nomsMois = [
        1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
        5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
        9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
    ];
    $libellePeriode = ($nomsMois[$mois] ?? 'Mois') . ' ' . $annee;
    $historique = getHistoriqueUtilisateur($id_user, 'mois', $annee, $mois);
} else {
    $filtre = 'tout';
    $libellePeriode = 'Tout l’historique';
    $historique = getHistoriqueUtilisateur($id_user);
}

$anneesDisponibles = getAnneesHistoriqueUtilisateur($id_user);

if (empty($anneesDisponibles)) {
    $anneesDisponibles = [(int) date('Y')];
}

$statsHistorique = getStatsHistoriqueUtilisateur($id_user);
$messageHistorique = isset($_GET['oubli']) ? 'Ton émotion oubliée a bien été ajoutée automatiquement dans ton historique.' : '';
$highlightHistoriqueId = isset($_GET['highlight']) ? (int) $_GET['highlight'] : 0;

$pageTitle   = 'Historique';
$mainClass   = 'contenu-principal-hist page-layout';
$pageStyles  = ['historique.css'];
$pageScripts = ['historique.js'];

ob_start();
require_once __DIR__ . '/../vue/html/historique.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
