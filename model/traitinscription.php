<?php

require_once __DIR__ . '/bdd-config.php';

function inscrireUtilisateur(string $nom, string $prenom, string $mail, string $password)
{
    global $conn;

    // Vérification des champs obligatoires
    if (
        empty(trim($nom)) ||
        empty(trim($prenom)) ||
        empty(trim($mail)) ||
        empty(trim($password))
    ) {
        return false;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (nom, prenom, mail, password)
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ssss", $nom, $prenom, $mail, $hash);

    $result = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $result;
}
