<?php

require_once __DIR__ . '/bdd-config.php';

function getUtilisateurPourModification(int $id): ?array
{
    global $conn;

    $sql = "SELECT id, nom, prenom, naissance, mail, role, date_inscription
            FROM user
            WHERE id = ?
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return null;
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result) ?: null;

    mysqli_stmt_close($stmt);
    return $user;
}

function emailExistePourUnAutreUtilisateur(string $mail, int $id): bool
{
    global $conn;

    $sql = "SELECT id FROM user WHERE mail = ? AND id <> ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return true;
    }

    mysqli_stmt_bind_param($stmt, "si", $mail, $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $exists = mysqli_fetch_assoc($result) !== null;

    mysqli_stmt_close($stmt);
    return $exists;
}

function modifierProfilUtilisateur(int $id, string $nom, string $prenom, string $mail, ?string $naissance): bool
{
    global $conn;

    $sql = "UPDATE user
            SET nom = ?, prenom = ?, mail = ?, naissance = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ssssi", $nom, $prenom, $mail, $naissance, $id);
    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    return $success;
}

function modifierMotDePasseUtilisateur(int $id, string $nouveauMotDePasse): bool
{
    global $conn;

    $hash = password_hash($nouveauMotDePasse, PASSWORD_DEFAULT);

    $sql = "UPDATE user SET password = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "si", $hash, $id);
    $success = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    return $success;
}
