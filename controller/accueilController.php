<?php

require_once __DIR__ . '/../model/traitHumeur.php';

$humeurs = getHumeurs();

// MVC Citation : prépare $humeurActuelle et $citationActuelle pour la vue accueil.
require_once __DIR__ . '/citationController.php';

$pageTitle = 'Accueil';
$pageStyles = [];
$pageScripts = [];

ob_start();
require_once __DIR__ . '/../vue/html/index.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
