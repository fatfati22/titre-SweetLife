<?php

if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=connexion');
    exit;
}

require_once __DIR__ . '/../model/traitrepas.php';
require_once __DIR__ . '/../model/traitUserHumeur.php';

$id_user = (int) $_SESSION['user']['id'];
$humeurActuelle = getDerniereHumeurUtilisateur($id_user);

if (!empty($humeurActuelle)) {
    $repas = getRepasByHumeur((int) $humeurActuelle['id']);
} else {
    $repas = [];
}

$pageTitle = 'Repas';
$mainClass = 'page-layout';

ob_start();
require_once __DIR__ . '/../vue/html/repas.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
