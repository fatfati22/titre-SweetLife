<?php

session_start();

require_once __DIR__ . '/../model/traitconnexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $user = connecterUtilisateur($mail, $password);

    if ($user) {

        // créer session
        $_SESSION['user'] = [
            'id' => $user['id'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'mail' => $user['mail'],
            'role' => $user['role']
        ];

        // redirection
        header("Location: ../../vue/html/index.php");
        exit();
    } else {
        echo "Email ou mot de passe incorrect";
    }
}
