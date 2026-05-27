<?php

require_once __DIR__ . '/bdd-config.php';

function connecterUtilisateur($mail, $password)
{
    global $conn;

    $sql = "SELECT * FROM user WHERE mail = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $mail);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    // si utilisateur trouvé
    if ($user) {

        // vérifie le mot de passe hashé
        if (password_verify($password, $user['password'])) {
            return $user;
        }
    }

    return false;
}
