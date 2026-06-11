<?php
// session déjà démarrée dans le router

require_once __DIR__ . '/../model/traitconnexion.php';

$erreur = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mail     = $_POST['mail']     ?? '';
    $password = $_POST['password'] ?? '';

    $user = connecterUtilisateur($mail, $password);

    if ($user) {
        $_SESSION['user'] = [
            'id'               => $user['id'],
            'nom'              => $user['nom'],
            'prenom'           => $user['prenom'],
            'mail'             => $user['mail'],
            'role'             => $user['role'],
            'date_inscription' => $user['date_inscription'],
        ];
        header("Location: /index.php?route=accueil");
        exit();
    } else {
        $erreur = "Email ou mot de passe incorrect.";
    }
}

$pageTitle  = 'Connexion';
$pageStyles = [];

ob_start();
require_once __DIR__ . '/../vue/html/connexion.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/auth.php';
