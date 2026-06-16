<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php?route=connexion");
    exit();
}

require_once __DIR__ . '/../model/traitnote.php';

$id_user = $_SESSION['user']['id'];

/* TRAITEMENT DU FORMULAIRE */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {

    $description = trim($_POST['description']);

    if (!empty($description)) {

        $result = ajouterNote($description, $id_user);

        if (!$result) {
            die("Erreur lors de l'enregistrement de la note.");
        }
    }

    // Empêche le double envoi lors d'un rafraîchissement
    header("Location: index.php?route=accueil");
    exit();
}

/* RÉCUPÉRATION DES NOTES */
$notes = getNotesByUser($id_user);

/* AFFICHAGE */
$pageTitle = 'Mes Notes';
$pageStyles = ['note.css'];
$pageScripts = [];

ob_start();
require_once __DIR__ . '/../vue/html/note.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
