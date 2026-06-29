<?php

if (!isset($_SESSION['user'])) {
    header('Location: /index.php?route=connexion');
    exit();
}

require_once __DIR__ . '/../model/traitModifProfil.php';

$idUser = (int) ($_SESSION['user']['id'] ?? 0);
$messages = [];
$errors = [];

if ($idUser <= 0) {
    header('Location: /index.php?route=deconnexion');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $mail = trim($_POST['mail'] ?? '');
    $naissance = trim($_POST['naissance'] ?? '');
    $nouveauPassword = trim($_POST['nouveau_password'] ?? '');
    $confirmationPassword = trim($_POST['confirmation_password'] ?? '');

    if ($nom === '') {
        $errors[] = 'Le nom est obligatoire.';
    }

    if ($prenom === '') {
        $errors[] = 'Le prénom est obligatoire.';
    }

    if ($mail === '' || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Adresse email invalide.';
    }

    if ($naissance === '') {
        $naissance = null;
    }

    if ($mail !== '' && emailExistePourUnAutreUtilisateur($mail, $idUser)) {
        $errors[] = 'Cette adresse email est déjà utilisée par un autre compte.';
    }

    if ($nouveauPassword !== '' || $confirmationPassword !== '') {
        if (strlen($nouveauPassword) < 6) {
            $errors[] = 'Le nouveau mot de passe doit contenir au moins 6 caractères.';
        }

        if ($nouveauPassword !== $confirmationPassword) {
            $errors[] = 'Les deux mots de passe ne correspondent pas.';
        }
    }

    if (empty($errors)) {
        $profilOk = modifierProfilUtilisateur($idUser, $nom, $prenom, $mail, $naissance);
        $passwordOk = true;

        if ($nouveauPassword !== '') {
            $passwordOk = modifierMotDePasseUtilisateur($idUser, $nouveauPassword);
        }

        if ($profilOk && $passwordOk) {
            $_SESSION['user']['nom'] = $nom;
            $_SESSION['user']['prenom'] = $prenom;
            $_SESSION['user']['mail'] = $mail;
            $_SESSION['flash_success'] = 'Profil modifié avec succès.';
            header('Location: /index.php?route=profil');
            exit();
        }

        $errors[] = 'Une erreur est survenue pendant la modification du profil.';
    }
}

$user = getUtilisateurPourModification($idUser);

if (!$user) {
    header('Location: /index.php?route=deconnexion');
    exit();
}

$pageTitle = 'Modifier mon profil';
$mainClass = 'page-layout modif-profil-layout';
$pageStyles = ['modifProfil.css'];
$pageScripts = [];

ob_start();
require_once __DIR__ . '/../vue/html/modifProfil.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
