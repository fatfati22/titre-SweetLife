<?php
if (!isset($_SESSION['user'])) {
    header("Location: /index.php?route=connexion");
    exit();
}

$pageTitle   = 'Historique';
$mainClass   = 'contenu-principal-hist';
$pageStyles  = ['humeur.css', 'historique.css'];
$pageScripts = ['historique.js'];

ob_start();
require_once __DIR__ . '/../vue/html/historique.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
