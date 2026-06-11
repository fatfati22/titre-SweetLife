<?php
// session déjà démarrée dans index.php

// 1. Vérification session + rôle admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: /index.php?route=connexion");
    exit();
}

require_once __DIR__ . '/../model/traitadmin.php';

$action  = $_GET['action']  ?? 'dashboard';
$section = $_GET['section'] ?? 'humeurs';
$message = '';
$erreur  = '';

// ─── ACTIONS POST ────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // HUMEURS
    if ($action === 'creer_humeur') {
        $nom    = trim($_POST['nom']    ?? '');
        $icone  = trim($_POST['icone']  ?? '');
        $couleur = trim($_POST['couleur'] ?? '');
        if ($nom && $icone && $couleur) {
            creerHumeur($nom, $icone, $couleur);
            $message = "✅ Humeur « $nom » créée avec succès.";
        } else {
            $erreur = "Tous les champs sont obligatoires.";
        }
        $section = 'humeurs';
        $action  = 'dashboard';
    }

    if ($action === 'modifier_humeur') {
        $id     = (int)($_POST['id']     ?? 0);
        $nom    = trim($_POST['nom']    ?? '');
        $icone  = trim($_POST['icone']  ?? '');
        $couleur = trim($_POST['couleur'] ?? '');
        if ($id && $nom && $icone && $couleur) {
            modifierHumeur($id, $nom, $icone, $couleur);
            $message = "✅ Humeur mise à jour.";
        }
        $section = 'humeurs';
        $action  = 'dashboard';
    }

    if ($action === 'supprimer_humeur') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) {
            supprimerHumeur($id);
            $message = "🗑️ Humeur supprimée.";
        }
        $section = 'humeurs';
        $action  = 'dashboard';
    }

    // REPAS
    if ($action === 'creer_repas') {
        $titre       = trim($_POST['titre']       ?? '');
        $description = trim($_POST['description'] ?? '');
        $duree       = (int)($_POST['duree']      ?? 0);
        $photo       = trim($_POST['photo']       ?? '');
        $id_humeur   = (int)($_POST['id_humeur']  ?? 0);
        $id_type     = (int)($_POST['id_type']    ?? 0);
        $id_categorie = (int)($_POST['id_categorie'] ?? 0);
        if ($titre && $id_humeur && $id_type && $id_categorie) {
            creerRepas($titre, $description, $duree, $photo, $id_humeur, $id_type, $id_categorie);
            $message = "✅ Repas « $titre » créé.";
        } else {
            $erreur = "Titre, humeur, type et catégorie sont obligatoires.";
        }
        $section = 'repas';
        $action  = 'dashboard';
    }

    if ($action === 'modifier_repas') {
        $id          = (int)($_POST['id']          ?? 0);
        $titre       = trim($_POST['titre']        ?? '');
        $description = trim($_POST['description']  ?? '');
        $duree       = (int)($_POST['duree']       ?? 0);
        $photo       = trim($_POST['photo']        ?? '');
        $id_humeur   = (int)($_POST['id_humeur']   ?? 0);
        $id_type     = (int)($_POST['id_type']     ?? 0);
        $id_categorie = (int)($_POST['id_categorie'] ?? 0);
        if ($id && $titre && $id_humeur && $id_type && $id_categorie) {
            modifierRepas($id, $titre, $description, $duree, $photo, $id_humeur, $id_type, $id_categorie);
            $message = "✅ Repas mis à jour.";
        }
        $section = 'repas';
        $action  = 'dashboard';
    }

    if ($action === 'supprimer_repas') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) { supprimerRepas($id); $message = "🗑️ Repas supprimé."; }
        $section = 'repas';
        $action  = 'dashboard';
    }

    // EXERCICES
    if ($action === 'creer_exercice') {
        $titre       = trim($_POST['titre']       ?? '');
        $description = trim($_POST['description'] ?? '');
        $duree       = (int)($_POST['duree']      ?? 0);
        $video       = trim($_POST['video']       ?? '');
        $id_humeur   = (int)($_POST['id_humeur']  ?? 0);
        if ($titre && $id_humeur) {
            creerExercice($titre, $description, $duree, $video, $id_humeur);
            $message = "✅ Exercice « $titre » créé.";
        } else {
            $erreur = "Titre et humeur sont obligatoires.";
        }
        $section = 'exercices';
        $action  = 'dashboard';
    }

    if ($action === 'modifier_exercice') {
        $id          = (int)($_POST['id']          ?? 0);
        $titre       = trim($_POST['titre']        ?? '');
        $description = trim($_POST['description']  ?? '');
        $duree       = (int)($_POST['duree']       ?? 0);
        $video       = trim($_POST['video']        ?? '');
        $id_humeur   = (int)($_POST['id_humeur']   ?? 0);
        if ($id && $titre && $id_humeur) {
            modifierExercice($id, $titre, $description, $duree, $video, $id_humeur);
            $message = "✅ Exercice mis à jour.";
        }
        $section = 'exercices';
        $action  = 'dashboard';
    }

    if ($action === 'supprimer_exercice') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) { supprimerExercice($id); $message = "🗑️ Exercice supprimé."; }
        $section = 'exercices';
        $action  = 'dashboard';
    }

    // UTILISATEURS
    if ($action === 'changer_role') {
        $id   = (int)($_POST['id']   ?? 0);
        $role = trim($_POST['role']  ?? '');
        if ($id && in_array($role, ['admin', 'utilisateur'])) {
            changerRoleUser($id, $role);
            $message = "✅ Rôle mis à jour.";
        }
        $section = 'utilisateurs';
        $action  = 'dashboard';
    }

    if ($action === 'supprimer_user') {
        $id = (int)($_POST['id'] ?? 0);
        // empêcher l'admin de se supprimer lui-même
        if ($id && $id !== (int)$_SESSION['user']['id']) {
            supprimerUser($id);
            $message = "🗑️ Utilisateur supprimé.";
        } else {
            $erreur = "Vous ne pouvez pas supprimer votre propre compte.";
        }
        $section = 'utilisateurs';
        $action  = 'dashboard';
    }
}

// ─── FORMULAIRES ÉDITION (GET) ────────────────────────────────────────────────
$editHumeur   = null;
$editRepas    = null;
$editExercice = null;

if ($action === 'edit_humeur'   && isset($_GET['id'])) $editHumeur   = getHumeurById((int)$_GET['id']);
if ($action === 'edit_repas'    && isset($_GET['id'])) $editRepas    = getRepasById((int)$_GET['id']);
if ($action === 'edit_exercice' && isset($_GET['id'])) $editExercice = getExerciceById((int)$_GET['id']);

// ─── DONNÉES ──────────────────────────────────────────────────────────────────
$humeurs    = getAllHumeurs();
$repas      = getAllRepas();
$exercices  = getAllExercices();
$users      = getAllUsers();
$categories = getAllCategories();
$types      = getAllTypesRepas();
$stats      = getStats();

// ─── VUE ─────────────────────────────────────────────────────────────────────
$pageTitle  = 'Administration';
$mainClass  = 'admin-main';
$pageStyles = ['admin.css'];

ob_start();
require_once __DIR__ . '/../vue/html/admin.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
