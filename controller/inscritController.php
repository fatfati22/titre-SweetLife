<?php

require_once __DIR__ . '/../model/traitinscription.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $ok = inscrireUtilisateur($nom, $prenom, $mail, $password);

    if ($ok) {
        header("Location: ../vue/html/connexion.html");
        exit();
    } else {
        echo "Erreur inscription";
    }
}
