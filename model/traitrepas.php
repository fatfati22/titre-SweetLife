<?php

require_once __DIR__ . '/bdd-config.php';

function fetchRepasFromResult($resultat)
{
    $repas = [];

    if ($resultat) {
        while ($row = mysqli_fetch_assoc($resultat)) {
            $repas[] = $row;
        }
    }

    return $repas;
}

function getTousLesRepas()
{
    global $conn;

    $sql = "
        SELECT
            r.*,
            h.nom AS humeur,
            h.icone AS humeur_icone,
            t.id AS type_id,
            t.nom AS type,
            c.id AS categorie_id,
            c.nom AS categorie
        FROM repas r
        LEFT JOIN humeur h ON r.id_humeur = h.id
        LEFT JOIN type_repas t ON r.id_type = t.id
        LEFT JOIN categorie c ON r.id_categorie = c.id
        ORDER BY r.date_creation DESC, r.id DESC
    ";

    $resultat = mysqli_query($conn, $sql);

    return fetchRepasFromResult($resultat);
}

function getRepasByHumeur($id_humeur)
{
    global $conn;

    $sql = "
        SELECT
            r.*,
            h.nom AS humeur,
            h.icone AS humeur_icone,
            t.id AS type_id,
            t.nom AS type,
            c.id AS categorie_id,
            c.nom AS categorie
        FROM repas r
        LEFT JOIN humeur h ON r.id_humeur = h.id
        LEFT JOIN type_repas t ON r.id_type = t.id
        LEFT JOIN categorie c ON r.id_categorie = c.id
        WHERE r.id_humeur = ?
        ORDER BY r.date_creation DESC, r.id DESC
    ";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return [];
    }

    mysqli_stmt_bind_param($stmt, "i", $id_humeur);
    mysqli_stmt_execute($stmt);
    $resultat = mysqli_stmt_get_result($stmt);
    $repas = fetchRepasFromResult($resultat);
    mysqli_stmt_close($stmt);

    return $repas;
}

function getRepasByDerniereHumeurUtilisateur($id_user)
{
    global $conn;

    $sql = "
        SELECT
            r.*,
            h.nom AS humeur,
            h.icone AS humeur_icone,
            t.id AS type_id,
            t.nom AS type,
            c.id AS categorie_id,
            c.nom AS categorie
        FROM user_humeur uh
        INNER JOIN repas r ON r.id_humeur = uh.id_humeur
        LEFT JOIN humeur h ON r.id_humeur = h.id
        LEFT JOIN type_repas t ON r.id_type = t.id
        LEFT JOIN categorie c ON r.id_categorie = c.id
        WHERE uh.id_user = ?
          AND uh.id_humeur = (
              SELECT uh2.id_humeur
              FROM user_humeur uh2
              WHERE uh2.id_user = ?
              ORDER BY uh2.date_enregistrement DESC, uh2.id DESC
              LIMIT 1
          )
        ORDER BY r.date_creation DESC, r.id DESC
    ";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return [];
    }

    mysqli_stmt_bind_param($stmt, "ii", $id_user, $id_user);
    mysqli_stmt_execute($stmt);
    $resultat = mysqli_stmt_get_result($stmt);
    $repas = fetchRepasFromResult($resultat);
    mysqli_stmt_close($stmt);

    return $repas;
}
