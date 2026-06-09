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




        require_once __DIR__ . '/../bdd-config.php';

        $stmt = $conn->prepare("SELECT id, nom, prenom, mail, date_inscription FROM user WHERE mail = ?");
        $stmt->bind_param("s", $mail);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        session_start();
        $_SESSION['user'] = $user;

        header("Location: ../vue/html/profil.php");
        exit();
    } else {
        echo "Erreur inscription";
    }
}
