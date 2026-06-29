<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php?route=connexion");
    exit();
}

require_once __DIR__ . '/../model/traitnote.php';
require_once __DIR__ . '/../model/traitUserHumeur.php';

$id_user = (int) $_SESSION['user']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {

    $description = trim($_POST['description'] ?? '');
    $id_humeur = (int) ($_POST['id_humeur'] ?? 0);

    if ($description === '') {
        header("Location: index.php?route=accueil&note=empty");
        exit();
    }

    if ($id_humeur <= 0) {
        die("Erreur : aucune humeur sélectionnée.");
    }

    // 1) Enregistrer l'humeur avec une citation aléatoire liée
    $humeurOk = ajouterHumeurUtilisateur($id_user, $id_humeur);

    if (!$humeurOk) {
        die("Erreur lors de l'enregistrement de l'humeur.");
    }

    // 2) Enregistrer la note
    $noteOk = ajouterNote($description, $id_user);

    if (!$noteOk) {
        die("Erreur lors de l'enregistrement de la note.");
    }

    header("Location: index.php?route=accueil&note=ok");
    exit();
}

$notes = getNotesByUser($id_user);

$pageTitle = 'Mes Notes';
$pageStyles = ['note.css'];
$pageScripts = [];

ob_start();
require_once __DIR__ . '/../vue/html/note.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
