<?php
// Bloc réutilisable : État émotionnel actuel
// Il affiche automatiquement la dernière humeur enregistrée par l'utilisateur.

if (!isset($humeurActuelle)) {
    $humeurActuelle = null;

    if (!empty($_SESSION['user']['id'])) {
        require_once __DIR__ . '/../../model/traitUserHumeur.php';
        $humeurActuelle = getDerniereHumeurUtilisateur((int) $_SESSION['user']['id']);
    }
}

$iconeActuelle = $humeurActuelle['icone'] ?? '😌';
$nomActuel = $humeurActuelle['nom'] ?? 'Aucune humeur sélectionnée';
$texteAide = !empty($humeurActuelle)
    ? 'Dernière humeur enregistrée'
    : 'Choisis une humeur sur l’accueil';
?>

<!-- ÉTAT ÉMOTIONNEL ACTUEL -->
<section class="etat-emotionnel-section">
    <article class="mood-card mood-glass-card glass-card">
        <p class="mood-card-text couleur">💫 État émotionnel actuel</p>

        <section class="affichage-humeur">
            <span class="big-emoji" id="moodEmoji">
                <?= htmlspecialchars($iconeActuelle) ?>
            </span>

            <div>
                <h3 id="moodName">
                    <?= htmlspecialchars($nomActuel) ?>
                </h3>
                <p class="mood-helper couleur">
                    <?= htmlspecialchars($texteAide) ?>
                </p>
            </div>
        </section>
    </article>
</section>
