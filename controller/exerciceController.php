<?php
if (!isset($_SESSION['user'])) {
    header("Location: /index.php?route=connexion");
    exit();
}

$pageTitle   = 'Exercices';
$mainClass   = 'container';
$pageStyles  = ['humeur.css', 'carte.css', 'mise-en-page.css'];
$pageScripts = ['animationCard.js'];

ob_start();
require_once __DIR__ . '/../vue/html/exercice.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
