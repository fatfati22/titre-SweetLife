<?php
// session déjà démarrée dans le router

require_once __DIR__ . '/../model/traitinscription.php';

$erreur = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom        = $_POST['nom']        ?? '';
    $prenom     = $_POST['prenom']     ?? '';
    $mail       = $_POST['mail']       ?? '';
    $password   = $_POST['password']  ?? '';
    $naissance  = $_POST['naissance']  ?? null;
    // Valider le format date
    if ($naissance === '' || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $naissance)) {
        $naissance = null;
    }

    $ok = inscrireUtilisateur($nom, $prenom, $mail, $password, $naissance);

    if ($ok) {
        header("Location: /index.php?route=connexion");
        exit();
    } else {
        $erreur = "Erreur lors de l'inscription, veuillez réessayer.";
    }
}

$pageTitle  = 'Inscription';
$pageStyles = [];

ob_start();
require_once __DIR__ . '/../vue/html/inscription.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/auth.php';
