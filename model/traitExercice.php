<?php

require_once __DIR__ . '/bdd-config.php';

function fetchExercicesFromResult($result)
{
    if (!$result) {
        return [];
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getAllExercices()
{
    global $conn;

    $sql = "
        SELECT
            e.*,
            h.nom AS humeur,
            h.icone AS humeur_icone
        FROM exercice e
        INNER JOIN humeur h ON e.id_humeur = h.id
        ORDER BY e.id DESC
    ";

    $result = mysqli_query($conn, $sql);

    return fetchExercicesFromResult($result);
}

function getExercicesByHumeur($id_humeur)
{
    global $conn;

    $sql = "
        SELECT
            e.*,
            h.nom AS humeur,
            h.icone AS humeur_icone
        FROM exercice e
        INNER JOIN humeur h ON e.id_humeur = h.id
        WHERE e.id_humeur = ?
        ORDER BY e.id DESC
    ";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return [];
    }

    mysqli_stmt_bind_param($stmt, "i", $id_humeur);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $exercices = fetchExercicesFromResult($result);
    mysqli_stmt_close($stmt);

    return $exercices;
}

function getExercicesByDerniereHumeurUtilisateur($id_user)
{
    global $conn;

    $sql = "
        SELECT
            e.*,
            h.nom AS humeur,
            h.icone AS humeur_icone
        FROM user_humeur uh
        INNER JOIN exercice e ON e.id_humeur = uh.id_humeur
        INNER JOIN humeur h ON e.id_humeur = h.id
        WHERE uh.id_user = ?
          AND uh.id_humeur = (
              SELECT uh2.id_humeur
              FROM user_humeur uh2
              WHERE uh2.id_user = ?
              ORDER BY uh2.date_enregistrement DESC, uh2.id DESC
              LIMIT 1
          )
        ORDER BY e.id DESC
    ";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return [];
    }

    mysqli_stmt_bind_param($stmt, "ii", $id_user, $id_user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $exercices = fetchExercicesFromResult($result);
    mysqli_stmt_close($stmt);

    return $exercices;
}
