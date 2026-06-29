<?php
$nomsMois = [
    1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
    5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
    9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
];
?>

<section class="en-tete-hist">
    <h1 class="titre-hist">📊 Historique</h1>
    <p class="sous-titre-hist">Retrouve toutes tes émotions enregistrées</p>
</section>

<?php if (!empty($messageHistorique)): ?>
    <section class="historique-alert-success glass-card">
        ✅ <?= htmlspecialchars($messageHistorique) ?><?php if (!empty($highlightHistoriqueId)): ?><br><small>La carte ajoutée est mise en évidence automatiquement.</small><?php endif; ?>
    </section>
<?php endif; ?>

<section class="resume-hist glass-card">
    <article class="resume-item">
        <span class="resume-nombre"><?= (int) $statsHistorique['total'] ?></span>
        <span class="resume-label">émotions enregistrées</span>
    </article>
    <article class="resume-item">
        <span class="resume-nombre"><?= (int) $statsHistorique['dernieres_24h'] ?></span>
        <span class="resume-label">dernières 24h</span>
    </article>
    <article class="resume-item">
        <span class="resume-nombre"><?= (int) $statsHistorique['ce_mois'] ?></span>
        <span class="resume-label">ce mois-ci</span>
    </article>
</section>

<section class="filtres-hist glass-card">
    <div class="ligne-filtres">
        <div class="enveloppe-menu-deroulant">
            <a class="btn-menu-deroulant <?= $filtre === 'tout' ? 'actif' : '' ?>" href="index.php?route=historique">
                <span class="icone-menu">🌸</span>
                <span class="libelle-menu">Tout</span>
            </a>
        </div>

        <div class="enveloppe-menu-deroulant">
            <a class="btn-menu-deroulant <?= $filtre === '24h' ? 'actif' : '' ?>" href="index.php?route=historique&periode=24h">
                <span class="icone-menu">⏰</span>
                <span class="libelle-menu">Dernières 24h</span>
            </a>
        </div>

        <?php foreach ($anneesDisponibles as $anneeItem): ?>
            <div class="enveloppe-menu-deroulant">
                <button class="btn-menu-deroulant <?= ($annee === (int) $anneeItem) ? 'actif' : '' ?>" type="button" onclick="toggleYear('<?= (int) $anneeItem ?>')">
                    <span class="icone-menu">📅</span>
                    <span class="libelle-menu"><?= (int) $anneeItem ?></span>
                    <span class="fleche-menu" id="arrow-<?= (int) $anneeItem ?>">▾</span>
                </button>

                <div class="panneau-mois <?= ($annee === (int) $anneeItem) ? 'ouvert' : '' ?>" id="panneau-mois-<?= (int) $anneeItem ?>">
                    <?php foreach ($nomsMois as $numeroMois => $nomMois): ?>
                        <a class="btn-mois <?= ($annee === (int) $anneeItem && $mois === (int) $numeroMois) ? 'actif' : '' ?>"
                           href="index.php?route=historique&annee=<?= (int) $anneeItem ?>&mois=<?= (int) $numeroMois ?>">
                            <?= htmlspecialchars($nomMois) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="libelle-periode">
        <span>📌 <?= htmlspecialchars($libellePeriode) ?></span>
    </div>
</section>

<section class="resultats-hist">
    <?php if (empty($historique)): ?>
        <div class="etat-vide">
            <span class="icone-vide">🌸</span>
            <p>Aucune émotion enregistrée pour cette période.</p>
            <a class="btn-retour-accueil" href="index.php?route=accueil">Choisir une humeur</a>
        </div>
    <?php else: ?>
        <div class="grille-cartes">
            <?php foreach ($historique as $ligne): ?>
                <?php
                    $date = new DateTime($ligne['date_enregistrement'], new DateTimeZone('Europe/Paris'));
                    $couleurHaut = $ligne['couleur_haut'] ?: '#ffffff';
                    $couleurBas = $ligne['couleur_bas'] ?: '#e8f5f0';
                ?>
                <article id="humeur-<?= (int) $ligne['id'] ?>" class="carte-hist <?= (!empty($highlightHistoriqueId) && (int) $highlightHistoriqueId === (int) $ligne['id']) ? 'carte-hist-highlight' : '' ?>" style="--hist-haut: <?= htmlspecialchars($couleurHaut) ?>; --hist-bas: <?= htmlspecialchars($couleurBas) ?>;">
                    <div class="dessus-carte">
                        <span class="emoji-carte"><?= htmlspecialchars($ligne['icone'] ?? '🌸') ?></span>
                        <div class="info-carte">
                            <span class="emotion-carte"><?= htmlspecialchars($ligne['nom'] ?? 'Humeur') ?></span>
                            <span class="heure-carte">
                                <?= htmlspecialchars($date->format('d/m/Y à H:i')) ?>
                            </span>
                        </div>
                        <span class="point-carte"></span>
                    </div>

                    <?php if (!empty($ligne['note_description'])): ?>
                        <p class="note-carte"><?= nl2br(htmlspecialchars($ligne['note_description'])) ?></p>
                    <?php else: ?>
                        <p class="note-carte note-carte-vide">Aucune note ajoutée.</p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
