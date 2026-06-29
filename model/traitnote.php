<?php
require_once __DIR__ . '/bdd-config.php';

function ajouterNote($description, $id_user)
{
    global $conn;
    $sql = "INSERT INTO note (description, date_creation, id_user) VALUES (?, NOW(), ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) return false;
    mysqli_stmt_bind_param($stmt, "si", $description, $id_user);
    $resultat = mysqli_stmt_execute($stmt);

    if (!$resultat) {
        die(mysqli_error($conn));
    }
    mysqli_stmt_close($stmt);
    return $resultat;
}

function getNotesByUser($id_user)
{
    global $conn;
    $sql = "SELECT id, description, date_creation FROM note WHERE id_user = ? ORDER BY date_creation DESC";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) return [];
    mysqli_stmt_bind_param($stmt, "i", $id_user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $notes = [];
    while ($row = mysqli_fetch_assoc($result)) $notes[] = $row;
    mysqli_stmt_close($stmt);
    return $notes;
}
