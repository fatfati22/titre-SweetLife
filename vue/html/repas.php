<?php
// Vue repas
/** @var array $repas */
/** @var array|null $humeurActuelle */

$categoriesRepas = [];
$typesRepas = [];

foreach ($repas ?? [] as $r) {
    if (!empty($r['categorie_id']) && !isset($categoriesRepas[$r['categorie_id']])) {
        $categoriesRepas[$r['categorie_id']] = $r['categorie'] ?? 'Catégorie';
    }

    if (!empty($r['type_id']) && !isset($typesRepas[$r['type_id']])) {
        $typesRepas[$r['type_id']] = $r['type'] ?? 'Type';
    }
}
?>

<?php include(__DIR__ . '/actuel.php'); ?>

<h1 class="page-title">🥗 Repas</h1>

<?php if (!empty($humeurActuelle)): ?>
    <p class="page-subtitle couleur">
        Repas adaptés à ta dernière humeur :
        <strong>
            <?= htmlspecialchars($humeurActuelle['icone'] ?? '') ?>
            <?= htmlspecialchars($humeurActuelle['nom'] ?? '') ?>
        </strong>
    </p>
<?php else: ?>
    <p class="page-subtitle couleur">
        Choisis d'abord une humeur sur l'accueil pour voir les repas adaptés.
    </p>
<?php endif; ?>

<section class="page-banner">
    <span class="page-banner-icon">
        <?= htmlspecialchars($humeurActuelle['icone'] ?? '🌸') ?>
    </span>
    <div>
        <h3>Repas recommandés</h3>
        <p class="couleur bold">
            Les repas affichés correspondent automatiquement à ta dernière humeur enregistrée.
        </p>
    </div>
</section>

<?php if (!empty($repas)): ?>
    <section class="repas-filtres glass-card" aria-label="Filtres repas">
        <div class="filtre-groupe">
            <h3>📂 Catégorie</h3>
            <div class="filtre-boutons">
                <button class="filtre-btn active" type="button" data-filter-group="category" data-filter-value="all">Tous</button>
                <?php foreach ($categoriesRepas as $idCategorie => $nomCategorie): ?>
                    <button class="filtre-btn" type="button" data-filter-group="category" data-filter-value="<?= (int) $idCategorie ?>">
                        <?= htmlspecialchars($nomCategorie) ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="filtre-groupe">
            <h3>🍽️ Type de repas</h3>
            <div class="filtre-boutons">
                <button class="filtre-btn active" type="button" data-filter-group="type" data-filter-value="all">Tous</button>
                <?php foreach ($typesRepas as $idType => $nomType): ?>
                    <button class="filtre-btn" type="button" data-filter-group="type" data-filter-value="<?= (int) $idType ?>">
                        <?= htmlspecialchars($nomType) ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="repas-grille">

    <?php if (!empty($repas)): ?>

        <?php foreach ($repas as $r): ?>

            <article
                class="recette-card"
                data-category-id="<?= htmlspecialchars((string) ($r['categorie_id'] ?? '')) ?>"
                data-type-id="<?= htmlspecialchars((string) ($r['type_id'] ?? '')) ?>"
            >

                <img class="recette-card-img" src="<?= htmlspecialchars($r['photo'] ?? '') ?>" alt="<?= htmlspecialchars($r['titre'] ?? '') ?>">

                <div class="repas-card-content">

                    <h2 class="recette-card-title">
                        <?= htmlspecialchars($r['titre'] ?? '') ?>
                    </h2>

                    <p class="recette-card-text">
                        <?= htmlspecialchars($r['description'] ?? '') ?>
                    </p>

                    <div class="etiquettes">
                        <span>📂 <?= htmlspecialchars($r['categorie'] ?? '') ?></span>
                        <span>🍽️ <?= htmlspecialchars($r['type'] ?? '') ?></span>
                        <span><?= htmlspecialchars($r['humeur_icone'] ?? '😊') ?> <?= htmlspecialchars($r['humeur'] ?? '') ?></span>
                    </div>

                    <div class="statistiques">
                        <div>
                            <strong><?= htmlspecialchars($r['duree'] ?? '0') ?></strong>
                            <small>MIN</small>
                        </div>
                    </div>

                    <button class="recette-card-button" type="button">
                        Ajouter
                    </button>

                </div>

            </article>

        <?php endforeach; ?>

        <article class="recette-card glass-card repas-no-result" hidden>
            <h2 class="recette-card-title">Aucun repas trouvé</h2>
            <p>Aucun repas ne correspond à cette catégorie et ce type de repas.</p>
        </article>

    <?php else: ?>

        <article class="recette-card glass-card">
            <?php if (empty($humeurActuelle)): ?>
                <h2 class="recette-card-title">Aucune humeur sélectionnée</h2>
                <p>Va sur l'accueil, choisis une humeur et enregistre une note pour recevoir des repas adaptés.</p>
            <?php else: ?>
                <h2 class="recette-card-title">Aucun repas pour cette humeur</h2>
                <p>L'administrateur peut ajouter des repas pour l'humeur <?= htmlspecialchars($humeurActuelle['nom'] ?? '') ?>.</p>
            <?php endif; ?>
        </article>

    <?php endif; ?>

</section>
