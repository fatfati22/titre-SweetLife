<?php
if (!isset($_SESSION['user'])) {
    header("Location: /index.php?route=connexion");
    exit();
}

require_once __DIR__ . '/../model/traitprofil.php';
$user = getUserByMail($_SESSION['user']['mail']);

$pageTitle   = 'Mon Profil';
$mainClass   = 'conteneur-page';
$pageStyles  = ['humeur.css', 'profil.css'];
$pageScripts = ['animationCard.js'];

ob_start();
require_once __DIR__ . '/../vue/html/Profil.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
