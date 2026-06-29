<?php

require_once __DIR__ . '/bdd-config.php';
require_once __DIR__ . '/traitCitation.php';

/**
 * Enregistre une humeur oubliée avec une date/heure choisie.
 * Retourne l'id de la ligne user_humeur ajoutée, ou false en cas d'erreur.
 */
function enregistrerHumeurOubliee(int $id_user, int $id_humeur, string $date_enregistrement, string $note = '')
{
    global $conn;

    mysqli_begin_transaction($conn);

    try {
        $id_citation = null;

        if (userHumeurPossedeCitation()) {
            $citation = getCitationAleatoireParHumeur($id_humeur);
            $id_citation = !empty($citation['id']) ? (int) $citation['id'] : null;
        }

        if ($id_citation !== null) {
            $sqlHumeur = "INSERT INTO user_humeur (id_user, id_humeur, id_citation, date_enregistrement)
                          VALUES (?, ?, ?, ?)";
            $stmtHumeur = mysqli_prepare($conn, $sqlHumeur);

            if (!$stmtHumeur) {
                throw new Exception(mysqli_error($conn));
            }

            mysqli_stmt_bind_param($stmtHumeur, 'iiis', $id_user, $id_humeur, $id_citation, $date_enregistrement);
        } else {
            $sqlHumeur = "INSERT INTO user_humeur (id_user, id_humeur, date_enregistrement)
                          VALUES (?, ?, ?)";
            $stmtHumeur = mysqli_prepare($conn, $sqlHumeur);

            if (!$stmtHumeur) {
                throw new Exception(mysqli_error($conn));
            }

            mysqli_stmt_bind_param($stmtHumeur, 'iis', $id_user, $id_humeur, $date_enregistrement);
        }

        if (!mysqli_stmt_execute($stmtHumeur)) {
            throw new Exception(mysqli_stmt_error($stmtHumeur));
        }

        $id_user_humeur = mysqli_insert_id($conn);
        mysqli_stmt_close($stmtHumeur);

        $note = trim($note);

        if ($note !== '') {
            $sqlNote = "INSERT INTO note (description, date_creation, id_user)
                        VALUES (?, ?, ?)";
            $stmtNote = mysqli_prepare($conn, $sqlNote);

            if (!$stmtNote) {
                throw new Exception(mysqli_error($conn));
            }

            mysqli_stmt_bind_param($stmtNote, 'ssi', $note, $date_enregistrement, $id_user);

            if (!mysqli_stmt_execute($stmtNote)) {
                throw new Exception(mysqli_stmt_error($stmtNote));
            }

            mysqli_stmt_close($stmtNote);
        }

        mysqli_commit($conn);
        return (int) $id_user_humeur;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        return false;
    }
}
