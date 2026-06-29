<?php

require_once __DIR__ . '/bdd-config.php';

function getAnneesHistoriqueUtilisateur(int $id_user): array
{
    global $conn;

    $sql = "SELECT DISTINCT YEAR(date_enregistrement) AS annee
            FROM user_humeur
            WHERE id_user = ?
            ORDER BY annee DESC";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return [];
    }

    mysqli_stmt_bind_param($stmt, "i", $id_user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $annees = [];
    while ($row = mysqli_fetch_assoc($result)) {
        if (!empty($row['annee'])) {
            $annees[] = (int) $row['annee'];
        }
    }

    mysqli_stmt_close($stmt);
    return $annees;
}

function getHistoriqueUtilisateur(int $id_user, string $filtre = 'tout', ?int $annee = null, ?int $mois = null): array
{
    global $conn;

    $where = "uh.id_user = ?";
    $types = "i";
    $params = [$id_user];

    if ($filtre === '24h') {
        $where .= " AND uh.date_enregistrement >= DATE_SUB(NOW(), INTERVAL 1 DAY)";
    } elseif ($filtre === 'mois' && $annee !== null && $mois !== null) {
        $where .= " AND YEAR(uh.date_enregistrement) = ? AND MONTH(uh.date_enregistrement) = ?";
        $types .= "ii";
        $params[] = $annee;
        $params[] = $mois;
    }

    $sql = "SELECT
                uh.id,
                uh.date_enregistrement,
                h.id AS id_humeur,
                h.icone,
                h.nom,
                h.theme,
                h.couleur_haut,
                h.couleur_bas,
                (
                    SELECT n.description
                    FROM note n
                    WHERE n.id_user = uh.id_user
                      AND ABS(TIMESTAMPDIFF(SECOND, n.date_creation, uh.date_enregistrement)) <= 15
                    ORDER BY ABS(TIMESTAMPDIFF(SECOND, n.date_creation, uh.date_enregistrement)) ASC, n.id DESC
                    LIMIT 1
                ) AS note_description
            FROM user_humeur uh
            INNER JOIN humeur h ON h.id = uh.id_humeur
            WHERE $where
            ORDER BY uh.date_enregistrement DESC, uh.id DESC";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return [];
    }

    mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $historique = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $historique[] = $row;
    }

    mysqli_stmt_close($stmt);
    return $historique;
}

function getStatsHistoriqueUtilisateur(int $id_user): array
{
    global $conn;

    $sql = "SELECT
                COUNT(*) AS total,
                COUNT(CASE WHEN date_enregistrement >= DATE_SUB(NOW(), INTERVAL 1 DAY) THEN 1 END) AS dernieres_24h,
                COUNT(CASE WHEN MONTH(date_enregistrement) = MONTH(CURRENT_DATE())
                            AND YEAR(date_enregistrement) = YEAR(CURRENT_DATE()) THEN 1 END) AS ce_mois
            FROM user_humeur
            WHERE id_user = ?";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        return ['total' => 0, 'dernieres_24h' => 0, 'ce_mois' => 0];
    }

    mysqli_stmt_bind_param($stmt, "i", $id_user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $stats = mysqli_fetch_assoc($result) ?: [];
    mysqli_stmt_close($stmt);

    return [
        'total' => (int) ($stats['total'] ?? 0),
        'dernieres_24h' => (int) ($stats['dernieres_24h'] ?? 0),
        'ce_mois' => (int) ($stats['ce_mois'] ?? 0),
    ];
}
