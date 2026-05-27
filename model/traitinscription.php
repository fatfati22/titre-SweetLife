<?php

require_once __DIR__ . '/bdd-config.php';

function inscrireUtilisateur($nom, $prenom, $mail, $password)
{
    global $conn;

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
