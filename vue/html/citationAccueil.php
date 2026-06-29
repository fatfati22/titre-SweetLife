<?php if (!empty($_SESSION['user']) && !empty($citationActuelle['texte'])) : ?>
    <section class="citation-accueil-card glass-card" id="citation-apres-note">
        <div class="citation-accueil-header">
            <span class="citation-accueil-icone">
                <?= htmlspecialchars($citationActuelle['icone'] ?? ($humeurActuelle['icone'] ?? '🌸'), ENT_QUOTES, 'UTF-8') ?>
            </span>

            <div>
                <h2>💬 Citation de ton humeur</h2>
                <p>Elle reste la même jusqu’à ton prochain changement d’humeur.</p>
            </div>
        </div>

        <blockquote class="citation-accueil-texte">
            “<?= htmlspecialchars($citationActuelle['texte'], ENT_QUOTES, 'UTF-8') ?>”
        </blockquote>

        <p class="citation-accueil-meta">
            <?= htmlspecialchars($citationActuelle['auteur'] ?: 'SweetLife', ENT_QUOTES, 'UTF-8') ?>
            <?php if (!empty($citationActuelle['humeur_nom'])) : ?>
                · <?= htmlspecialchars($citationActuelle['humeur_nom'], ENT_QUOTES, 'UTF-8') ?>
            <?php endif; ?>
        </p>
    </section>
<?php endif; ?>
