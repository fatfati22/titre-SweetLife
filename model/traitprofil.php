<?php

require_once __DIR__ . '/bdd-config.php';

function getUserByMail(string $mail)
{
    global $conn;

    $sql = "
        SELECT id, nom, prenom, mail, date_inscription,role
        FROM user
        WHERE mail = ?
        LIMIT 1
    ";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return null;
    }

    mysqli_stmt_bind_param($stmt, "s", $mail);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $user = mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $user;
}
