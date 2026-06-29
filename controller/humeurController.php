<?php

require_once __DIR__ . '/../model/traitHumeur.php';

$humeurs = getHumeurs();

$humeurActuelle = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_humeur'])) {

    $idHumeur = (int) $_POST['id_humeur'];

    $_SESSION['id_humeur'] = $idHumeur;

    foreach ($humeurs as $humeur) {
        if ($humeur['id'] == $idHumeur) {
            $humeurActuelle = $humeur;
            break;
        }
    }
}

if (isset($_SESSION['id_humeur']) && $humeurActuelle === null) {

    foreach ($humeurs as $humeur) {
        if ($humeur['id'] == $_SESSION['id_humeur']) {
            $humeurActuelle = $humeur;
            break;
        }
    }
}

$pageTitle = 'Humeurs';

ob_start();
require_once __DIR__ . '/../vue/html/afficheHumeur.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';