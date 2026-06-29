<?php

require_once __DIR__ . '/bdd-config.php';

// ─── HUMEURS ─────────────────────────────────────────────────────────────────

function getAllHumeurs()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM humeur ORDER BY id");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getHumeurById($id)
{
    global $conn;
    $stmt = mysqli_prepare($conn, "SELECT * FROM humeur WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($res);
}

function creerHumeur($nom, $icone, $theme, $couleur_haut, $couleur_bas)
{
    global $conn;
    $stmt = mysqli_prepare($conn, "INSERT INTO humeur (nom, icone, theme, couleur_haut, couleur_bas) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $nom, $icone, $theme, $couleur_haut, $couleur_bas);
    return mysqli_stmt_execute($stmt);
}

function modifierHumeur($id, $nom, $icone, $theme, $couleur_haut, $couleur_bas)
{
    global $conn;
    $stmt = mysqli_prepare($conn, "UPDATE humeur SET nom=?, icone=?, theme=?, couleur_haut=?, couleur_bas=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssssi", $nom, $icone, $theme, $couleur_haut, $couleur_bas, $id);
    return mysqli_stmt_execute($stmt);
}

function supprimerHumeur($id)
{
    global $conn;
    $stmt = mysqli_prepare($conn, "DELETE FROM humeur WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

// ─── REPAS ────────────────────────────────────────────────────────────────────

function getAllRepas()
{
    global $conn;
    $sql = "SELECT r.*, h.nom AS humeur_nom, t.nom AS type_nom, c.nom AS cat_nom
            FROM repas r
            LEFT JOIN humeur h ON r.id_humeur = h.id
            LEFT JOIN type_repas t ON r.id_type = t.id
            LEFT JOIN categorie c ON r.id_categorie = c.id
            ORDER BY r.id DESC";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getRepasById($id)
{
    global $conn;
    $stmt = mysqli_prepare($conn, "SELECT * FROM repas WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

function creerRepas($titre, $description, $duree, $photo, $id_humeur, $id_type, $id_categorie)
{
    global $conn;
    $stmt = mysqli_prepare($conn,
        "INSERT INTO repas (titre, description, duree, photo, date_creation, id_humeur, id_type, id_categorie)
         VALUES (?, ?, ?, ?, NOW(), ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssisiii", $titre, $description, $duree, $photo, $id_humeur, $id_type, $id_categorie);
    return mysqli_stmt_execute($stmt);
}

function modifierRepas($id, $titre, $description, $duree, $photo, $id_humeur, $id_type, $id_categorie)
{
    global $conn;
    $stmt = mysqli_prepare($conn,
        "UPDATE repas SET titre=?, description=?, duree=?, photo=?, id_humeur=?, id_type=?, id_categorie=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssisiiii", $titre, $description, $duree, $photo, $id_humeur, $id_type, $id_categorie, $id);
    return mysqli_stmt_execute($stmt);
}

function supprimerRepas($id)
{
    global $conn;
    $stmt = mysqli_prepare($conn, "DELETE FROM repas WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

// ─── EXERCICES ────────────────────────────────────────────────────────────────

function getAllExercices()
{
    global $conn;
    $sql = "SELECT e.*, h.nom AS humeur_nom
            FROM exercice e
            LEFT JOIN humeur h ON e.id_humeur = h.id
            ORDER BY e.id DESC";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getExerciceById($id)
{
    global $conn;
    $stmt = mysqli_prepare($conn, "SELECT * FROM exercice WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

function creerExercice($titre, $description, $duree, $video, $id_humeur)
{
    global $conn;
    $stmt = mysqli_prepare($conn,
        "INSERT INTO exercice (titre, description, duree, video, date_creation, id_humeur)
         VALUES (?, ?, ?, ?, NOW(), ?)");
    mysqli_stmt_bind_param($stmt, "ssisi", $titre, $description, $duree, $video, $id_humeur);
    return mysqli_stmt_execute($stmt);
}

function modifierExercice($id, $titre, $description, $duree, $video, $id_humeur)
{
    global $conn;
    $stmt = mysqli_prepare($conn,
        "UPDATE exercice SET titre=?, description=?, duree=?, video=?, id_humeur=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "ssissi", $titre, $description, $duree, $video, $id_humeur, $id);
    return mysqli_stmt_execute($stmt);
}

function supprimerExercice($id)
{
    global $conn;
    $stmt = mysqli_prepare($conn, "DELETE FROM exercice WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

// ─── UTILISATEURS ─────────────────────────────────────────────────────────────

function getAllUsers()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT id, nom, prenom, mail, role, date_inscription FROM user ORDER BY id");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function changerRoleUser($id, $role)
{
    global $conn;
    $stmt = mysqli_prepare($conn, "UPDATE user SET role=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "si", $role, $id);
    return mysqli_stmt_execute($stmt);
}

function supprimerUser($id)
{
    global $conn;
    $stmt = mysqli_prepare($conn, "DELETE FROM user WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}

// ─── CATÉGORIES & TYPES ───────────────────────────────────────────────────────

function getAllCategories()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM categorie ORDER BY id");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function getAllTypesRepas()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM type_repas ORDER BY id");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// ─── STATISTIQUES DASHBOARD ───────────────────────────────────────────────────

function getStats()
{
    global $conn;
    $stats = [];
    foreach (['user', 'humeur', 'repas', 'exercice', 'citation'] as $table) {
        $r = mysqli_query($conn, "SELECT COUNT(*) as n FROM `$table`");
        $stats[$table] = mysqli_fetch_assoc($r)['n'];
    }
    return $stats;
}
