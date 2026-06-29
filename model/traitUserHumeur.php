<?php

require_once __DIR__ . '/bdd-config.php';
require_once __DIR__ . '/traitCitation.php';

/**
 * MODEL USER_HUMEUR
 * Jointure dans le model : user_humeur.id_citation -> citation.id
 */

function ajouterHumeurUtilisateur($id_user, $id_humeur)
{
    global $conn;

    installerCitationSchemaSiBesoin();

    $id_user = (int) $id_user;
    $id_humeur = (int) $id_humeur;

    if ($id_user <= 0 || $id_humeur <= 0) {
        return false;
    }

    $id_citation = null;

    if (userHumeurPossedeCitation()) {
        $citation = getCitationAleatoireParHumeur($id_humeur);
        if (!empty($citation['id'])) {
            $id_citation = (int) $citation['id'];
        }
    }

    if ($id_citation !== null) {
        $sql = "INSERT INTO user_humeur
                (id_user, id_humeur, id_citation, date_enregistrement)
                VALUES (?, ?, ?, NOW())";

        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) return false;

        mysqli_stmt_bind_param($stmt, 'iii', $id_user, $id_humeur, $id_citation);
    } else {
        $sql = "INSERT INTO user_humeur
                (id_user, id_humeur, date_enregistrement)
                VALUES (?, ?, NOW())";

        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) return false;

        mysqli_stmt_bind_param($stmt, 'ii', $id_user, $id_humeur);
    }

    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $ok;
}

function getDerniereHumeurUtilisateur($id_user)
{
    global $conn;

    installerCitationSchemaSiBesoin();

    $id_user = (int) $id_user;

    if ($id_user <= 0) {
        return null;
    }

    $avecCitation = userHumeurPossedeCitation();
    $selectAuteur = citationPossedeColonneAuteur()
        ? "c.auteur AS citation_auteur"
        : "'SweetLife' AS citation_auteur";

    if ($avecCitation) {
        $sql = "SELECT
                    h.id,
                    h.icone,
                    h.nom,
                    h.theme,
                    h.couleur_haut,
                    h.couleur_bas,
                    uh.id AS id_user_humeur,
                    uh.id_humeur,
                    uh.id_citation,
                    uh.date_enregistrement,
                    c.id AS citation_id,
                    c.texte AS citation_texte,
                    $selectAuteur
                FROM user_humeur uh
                INNER JOIN humeur h ON h.id = uh.id_humeur
                LEFT JOIN citation c ON c.id = uh.id_citation
                WHERE uh.id_user = ?
                ORDER BY uh.date_enregistrement DESC, uh.id DESC
                LIMIT 1";
    } else {
        $sql = "SELECT
                    h.id,
                    h.icone,
                    h.nom,
                    h.theme,
                    h.couleur_haut,
                    h.couleur_bas,
                    uh.id AS id_user_humeur,
                    uh.id_humeur,
                    NULL AS id_citation,
                    uh.date_enregistrement,
                    NULL AS citation_id,
                    NULL AS citation_texte,
                    NULL AS citation_auteur
                FROM user_humeur uh
                INNER JOIN humeur h ON h.id = uh.id_humeur
                WHERE uh.id_user = ?
                ORDER BY uh.date_enregistrement DESC, uh.id DESC
                LIMIT 1";
    }

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) return null;

    mysqli_stmt_bind_param($stmt, 'i', $id_user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $humeur = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$humeur) {
        return null;
    }

    // Si l'ancienne dernière humeur n'a pas encore de citation,
    // on lui en attribue une seule fois, puis on relit.
    if ($avecCitation && empty($humeur['citation_texte']) && !empty($humeur['id_user_humeur'])) {
        $citation = getCitationAleatoireParHumeur((int) $humeur['id_humeur']);

        if (!empty($citation['id'])) {
            lierCitationAUserHumeur((int) $humeur['id_user_humeur'], (int) $citation['id']);

            $stmt = mysqli_prepare($conn, $sql);
            if (!$stmt) return $humeur;

            mysqli_stmt_bind_param($stmt, 'i', $id_user);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $humeur = mysqli_fetch_assoc($result) ?: $humeur;
            mysqli_stmt_close($stmt);
        }
    }

    return $humeur;
}
