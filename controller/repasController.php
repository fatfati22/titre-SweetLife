<?php
if (!isset($_SESSION['user'])) {
    header("Location: /index.php?route=connexion");
    exit();
}

$pageTitle   = 'Repas';
$mainClass   = '';
$pageStyles  = ['humeur.css', 'carte.css', 'filtre-repas.css', 'mise-en-page.css'];
$pageScripts = ['animationCard.js', 'filtre.js'];

ob_start();
require_once __DIR__ . '/../vue/html/repas.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
