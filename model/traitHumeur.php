<?php

require_once __DIR__ . '/bdd-config.php';

function getHumeurs()
{
    global $conn;

    $sql = "SELECT id, icone, nom, theme, couleur_haut, couleur_bas FROM humeur ORDER BY id";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        throw new Exception("Erreur SQL : " . mysqli_error($conn));
    }

    $humeurs = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $humeurs[] = $row;
    }

    return $humeurs;
}
