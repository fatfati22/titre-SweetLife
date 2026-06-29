<?php

require_once __DIR__ . '/../model/traitCitation.php';
require_once __DIR__ . '/../model/traitUserHumeur.php';

/**
 * Contrôleur Citation
 * Prépare la citation affichée sur l'accueil.
 *
 * Important : on ne fait PAS de ORDER BY RAND() ici.
 * La citation aléatoire est choisie uniquement au moment où
 * l'utilisateur enregistre une nouvelle humeur/note.
 * Ici on relit seulement la citation stockée dans user_humeur.id_citation.
 */
$citationActuelle = null;
$humeurActuelle = null;

if (!empty($_SESSION['user']['id'])) {
    $humeurActuelle = getDerniereHumeurUtilisateur((int) $_SESSION['user']['id']);

    if (!empty($humeurActuelle['citation_texte'])) {
        $citationActuelle = [
            'texte' => $humeurActuelle['citation_texte'],
            'auteur' => $humeurActuelle['citation_auteur'] ?: 'SweetLife',
            'icone' => $humeurActuelle['icone'] ?? '🌸',
            'humeur_nom' => $humeurActuelle['nom'] ?? '',
            'date_enregistrement' => $humeurActuelle['date_enregistrement'] ?? null,
        ];
    }
}
