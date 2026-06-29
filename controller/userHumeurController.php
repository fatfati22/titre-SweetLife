<?php

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    exit("Utilisateur non connecté");
}

require_once __DIR__ . '/../model/traitUserHumeur.php';

$id_user = $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_humeur = (int) ($_POST['id_humeur'] ?? 0);

    if ($id_humeur <= 0) {
        http_response_code(400);
        exit("Humeur invalide");
    }

    if (ajouterHumeurUtilisateur($id_user, $id_humeur)) {
        echo "OK";
    } else {
        http_response_code(500);
        echo "Erreur";
    }

    exit();
}