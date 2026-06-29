<?php
/** @var array $exercices */
/** @var array|null $humeurActuelle */
?>

<?php include(__DIR__ . '/actuel.php'); ?>

<section class="exercice-header">
    <h1 class="page-title exercice-title">🧘 Exercices</h1>

    <?php if (!empty($humeurActuelle)): ?>
        <p class="page-subtitle exercice-subtitle">
            Exercices adaptés à ta dernière humeur :
            <strong>
                <?= htmlspecialchars($humeurActuelle['icone'] ?? '') ?>
                <?= htmlspecialchars($humeurActuelle['nom'] ?? '') ?>
            </strong>
        </p>
    <?php else: ?>
        <p class="page-subtitle exercice-subtitle">
            Choisis d'abord une humeur sur l'accueil pour voir les exercices adaptés.
        </p>
    <?php endif; ?>
</section>

<section class="page-banner">
    <span class="page-banner-icon">
        <?= htmlspecialchars($humeurActuelle['icone'] ?? '🧘') ?>
    </span>
    <div>
        <h3>Exercices recommandés</h3>
        <p class="couleur bold">
            Les exercices affichés correspondent automatiquement à ta dernière humeur enregistrée.
        </p>
    </div>
</section>

<section class="grille-exercices">

    <?php if (!empty($exercices)): ?>

        <?php foreach ($exercices as $exercice): ?>

            <article class="carte-exercice">

                <iframe width="100%" height="200"
                    src="https://www.youtube.com/embed/<?= htmlspecialchars($exercice['video']) ?>" allowfullscreen>
                </iframe>

                <div class="contenu-exercice">

                    <h2 class="titre-exercice">
                        <?= htmlspecialchars($exercice['titre']) ?>
                    </h2>

                    <p class="texte-exercice">
                        <?= htmlspecialchars($exercice['description']) ?>
                    </p>

                    <div class="etiquettes">
                        <span class="etiquette"><?= (int)$exercice['duree'] ?> min</span>
                        <span class="etiquette">
                            <?= htmlspecialchars($exercice['humeur_icone'] ?? '😊') ?>
                            <?= htmlspecialchars($exercice['humeur']) ?>
                        </span>
                    </div>

                </div>

            </article>

        <?php endforeach; ?>

    <?php else: ?>

        <article class="carte-exercice">
            <div class="contenu-exercice">
                <?php if (empty($humeurActuelle)): ?>
                    <h2 class="titre-exercice">Aucune humeur sélectionnée</h2>
                    <p class="texte-exercice">Va sur l'accueil, choisis une humeur et enregistre une note pour recevoir des exercices adaptés.</p>
                <?php else: ?>
                    <h2 class="titre-exercice">Aucun exercice pour cette humeur</h2>
                    <p class="texte-exercice">L'administrateur peut ajouter des exercices pour l'humeur <?= htmlspecialchars($humeurActuelle['nom'] ?? '') ?>.</p>
                <?php endif; ?>
            </div>
        </article>

    <?php endif; ?>

</section>
