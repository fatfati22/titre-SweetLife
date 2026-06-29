<?php

require_once __DIR__ . '/bdd-config.php';

/**
 * MODEL CITATION - SweetLife
 *
 * But :
 * - choisir une citation aléatoire selon l'humeur au moment de l'enregistrement ;
 * - garder cette citation dans user_humeur.id_citation ;
 * - ne pas changer la citation au refresh de l'accueil ;
 * - changer uniquement quand l'utilisateur choisit une nouvelle humeur.
 */

function tableExiste(string $table): bool
{
    global $conn;

    $sql = "SELECT COUNT(*) AS total
            FROM INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = DATABASE()
            AND TABLE_NAME = ?";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) return false;

    mysqli_stmt_bind_param($stmt, 's', $table);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    return !empty($row['total']);
}

function colonneExiste(string $table, string $colonne): bool
{
    global $conn;

    $sql = "SELECT COUNT(*) AS total
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = DATABASE()
            AND TABLE_NAME = ?
            AND COLUMN_NAME = ?";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) return false;

    mysqli_stmt_bind_param($stmt, 'ss', $table, $colonne);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    return !empty($row['total']);
}

function indexExiste(string $table, string $index): bool
{
    global $conn;

    $sql = "SELECT COUNT(*) AS total
            FROM INFORMATION_SCHEMA.STATISTICS
            WHERE TABLE_SCHEMA = DATABASE()
            AND TABLE_NAME = ?
            AND INDEX_NAME = ?";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) return false;

    mysqli_stmt_bind_param($stmt, 'ss', $table, $index);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    return !empty($row['total']);
}

function installerCitationSchemaSiBesoin(): void
{
    global $conn;

    static $dejaFait = false;
    if ($dejaFait) return;
    $dejaFait = true;

    if (!tableExiste('citation') || !tableExiste('user_humeur')) {
        return;
    }

    // Colonne auteur optionnelle dans citation
    if (!colonneExiste('citation', 'auteur')) {
        @mysqli_query($conn, "ALTER TABLE `citation`
            ADD COLUMN `auteur` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'SweetLife' AFTER `texte`");
    }

    // Colonne id_citation obligatoire pour garder la même citation
    if (!colonneExiste('user_humeur', 'id_citation')) {
        @mysqli_query($conn, "ALTER TABLE `user_humeur`
            ADD COLUMN `id_citation` INT NULL AFTER `id_humeur`");
    }

    if (colonneExiste('user_humeur', 'id_citation') && !indexExiste('user_humeur', 'user_humeur_id_citation_index')) {
        @mysqli_query($conn, "ALTER TABLE `user_humeur`
            ADD KEY `user_humeur_id_citation_index` (`id_citation`)");
    }
}

function citationPossedeColonneAuteur(): bool
{
    installerCitationSchemaSiBesoin();
    return colonneExiste('citation', 'auteur');
}

function userHumeurPossedeCitation(): bool
{
    installerCitationSchemaSiBesoin();
    return colonneExiste('user_humeur', 'id_citation');
}

function getCitationAleatoireParHumeur(int $id_humeur): ?array
{
    global $conn;

    installerCitationSchemaSiBesoin();

    if ($id_humeur <= 0 || !tableExiste('citation')) {
        return null;
    }

    $selectAuteur = citationPossedeColonneAuteur()
        ? "auteur"
        : "'SweetLife' AS auteur";

    $sql = "SELECT id, texte, $selectAuteur
            FROM citation
            WHERE id_humeur = ?
            ORDER BY RAND()
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) return null;

    mysqli_stmt_bind_param($stmt, 'i', $id_humeur);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $citation = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    return $citation ?: null;
}

function lierCitationAUserHumeur(int $id_user_humeur, int $id_citation): bool
{
    global $conn;

    installerCitationSchemaSiBesoin();

    if ($id_user_humeur <= 0 || $id_citation <= 0 || !userHumeurPossedeCitation()) {
        return false;
    }

    $sql = "UPDATE user_humeur
            SET id_citation = ?
            WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) return false;

    mysqli_stmt_bind_param($stmt, 'ii', $id_citation, $id_user_humeur);
    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $ok;
}

function getCitationActuelleUtilisateur(int $id_user): ?array
{
    global $conn;

    installerCitationSchemaSiBesoin();

    if ($id_user <= 0 || !userHumeurPossedeCitation()) {
        return null;
    }

    $selectAuteur = citationPossedeColonneAuteur()
        ? "c.auteur AS auteur"
        : "'SweetLife' AS auteur";

    $sql = "SELECT
                uh.id AS id_user_humeur,
                uh.id_humeur,
                uh.date_enregistrement,
                h.icone,
                h.nom AS humeur_nom,
                c.id AS id_citation,
                c.texte,
                $selectAuteur
            FROM user_humeur uh
            INNER JOIN humeur h ON h.id = uh.id_humeur
            LEFT JOIN citation c ON c.id = uh.id_citation
            WHERE uh.id_user = ?
            ORDER BY uh.date_enregistrement DESC, uh.id DESC
            LIMIT 1";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) return null;

    mysqli_stmt_bind_param($stmt, 'i', $id_user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $citation = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$citation || empty($citation['texte'])) {
        return null;
    }

    return $citation;
}
