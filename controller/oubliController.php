<?php

if (!isset($_SESSION['user'])) {
    header('Location: index.php?route=connexion');
    exit();
}

require_once __DIR__ . '/../model/traitHumeur.php';
require_once __DIR__ . '/../model/traitOubli.php';

$id_user = (int) $_SESSION['user']['id'];
$humeurs = getHumeurs();
$messageSucces = '';
$messageErreur = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_humeur = (int) ($_POST['id_humeur'] ?? 0);
    $date = trim($_POST['date_oubli'] ?? '');
    $heure = trim($_POST['heure_oubli'] ?? '');
    $note = trim($_POST['note'] ?? '');

    if ($id_humeur <= 0 || $date === '' || $heure === '') {
        $messageErreur = "Merci de choisir une date, une heure et une humeur.";
    } else {
        // Le champ time peut envoyer HH:MM ou HH:MM:SS selon le navigateur.
        if (preg_match('/^\d{2}:\d{2}$/', $heure)) {
            $heure .= ':00';
        }

        $date_enregistrement = $date . ' ' . $heure;
        $dateObjet = DateTime::createFromFormat('Y-m-d H:i:s', $date_enregistrement, new DateTimeZone('Europe/Paris'));
        $erreursDate = DateTime::getLastErrors();

        if (!$dateObjet || ($erreursDate !== false && ($erreursDate['warning_count'] > 0 || $erreursDate['error_count'] > 0))) {
            $messageErreur = "La date ou l'heure n'est pas valide.";
        } elseif ($dateObjet > new DateTime('now', new DateTimeZone('Europe/Paris'))) {
            $messageErreur = "Tu ne peux pas ajouter une humeur oubliée dans le futur.";
        } else {
            $date_enregistrement = $dateObjet->format('Y-m-d H:i:s');
            $idHistorique = enregistrerHumeurOubliee($id_user, $id_humeur, $date_enregistrement, $note);

            if ($idHistorique !== false) {
                header('Location: index.php?route=historique&oubli=1&highlight=' . (int) $idHistorique . '#humeur-' . (int) $idHistorique);
                exit();
            }

            $messageErreur = "Erreur : l'humeur oubliée n'a pas pu être enregistrée.";
        }
    }
}

if (isset($_GET['success'])) {
    $messageSucces = "Ton humeur oubliée a bien été ajoutée dans ton historique.";
}

$pageTitle = 'Humeur oubliée';
$mainClass = 'page-layout oubli-page-layout';
$pageScripts = [];

ob_start();
require_once __DIR__ . '/../vue/html/oubli.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
