<?php

if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=connexion');
    exit;
}

require_once __DIR__ . '/../model/traitExercice.php';
require_once __DIR__ . '/../model/traitUserHumeur.php';

$id_user = (int) $_SESSION['user']['id'];
$humeurActuelle = getDerniereHumeurUtilisateur($id_user);

if (!empty($humeurActuelle)) {
    $exercices = getExercicesByHumeur((int) $humeurActuelle['id']);
} else {
    $exercices = [];
}

$pageTitle = 'Exercices';
$mainClass = 'page-layout';

ob_start();
require_once __DIR__ . '/../vue/html/exercice.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
