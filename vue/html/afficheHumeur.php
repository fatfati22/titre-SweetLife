<?php if (!empty($humeurs)) : ?>
<?php $utilisateurConnecte = isset($_SESSION['user']); ?>
<section class="mood-wheel" id="mood-wheel">
    <?php
    $total = count($humeurs);
    $rayon = 110;
    ?>

    <?php foreach ($humeurs as $index => $humeur) : ?>
        <?php
        $angle = ($index * 360) / max($total, 1);
        $couleurHaut = $humeur['couleur_haut'] ?? '#e8f5f0';
        $couleurBas = $humeur['couleur_bas'] ?? '#5aaa8a';
        $theme = $humeur['theme'] ?? '';
        $icone = $humeur['icone'] ?? '😊';
        $titre = $utilisateurConnecte
            ? ($humeur['nom'] ?? '')
            : 'Connecte-toi pour choisir cette humeur';
        ?>

        <button
            type="button"
            class="mood-btn js-mood-button <?= !$utilisateurConnecte ? 'mood-btn-locked disabled' : '' ?>"
            data-id-humeur="<?= (int) $humeur['id'] ?>"
            data-icone="<?= htmlspecialchars($icone, ENT_QUOTES, 'UTF-8') ?>"
            data-theme="<?= htmlspecialchars($theme, ENT_QUOTES, 'UTF-8') ?>"
            data-couleur-haut="<?= htmlspecialchars($couleurHaut, ENT_QUOTES, 'UTF-8') ?>"
            data-couleur-bas="<?= htmlspecialchars($couleurBas, ENT_QUOTES, 'UTF-8') ?>"
            data-connecte="<?= $utilisateurConnecte ? '1' : '0' ?>"
            <?= !$utilisateurConnecte ? 'disabled aria-disabled="true"' : '' ?>
            title="<?= htmlspecialchars($titre, ENT_QUOTES, 'UTF-8') ?>"
            style="--angle: <?= $angle ?>deg; --rayon: <?= $rayon ?>px; --couleur-haut-btn: <?= htmlspecialchars($couleurHaut, ENT_QUOTES, 'UTF-8') ?>; --couleur-bas-btn: <?= htmlspecialchars($couleurBas, ENT_QUOTES, 'UTF-8') ?>;">
            <?= htmlspecialchars($icone, ENT_QUOTES, 'UTF-8') ?>
            <?php if (!$utilisateurConnecte) : ?>
                <span class="mood-lock" aria-hidden="true">🔒</span>
            <?php endif; ?>
        </button>
    <?php endforeach; ?>

    <button type="button" class="mood-btn center" aria-label="SweetLife">🌸</button>
</section>

<?php endif; ?>
