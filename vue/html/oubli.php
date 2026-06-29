<section class="oubli-container">
    <article class="oubli-card glass-card">
        <span class="oubli-icon" aria-hidden="true">⏰✨</span>

        <h1 class="oubli-title">J'ai oublié de noter mon émotion</h1>

        <p class="oubli-subtitle">
            Choisis la date, l'heure et l'humeur que tu as oublié d'enregistrer.
            Elle sera ajoutée automatiquement dans ton historique.
        </p>

        <?php if (!empty($messageSucces)): ?>
            <div class="oubli-alert oubli-alert-success">
                ✅ <?= htmlspecialchars($messageSucces) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($messageErreur)): ?>
            <div class="oubli-alert oubli-alert-error">
                ⚠️ <?= htmlspecialchars($messageErreur) ?>
            </div>
        <?php endif; ?>

        <form class="oubli-form" method="post" action="index.php?route=oubli">
            <section class="oubli-form-row">
                <div class="oubli-form-group">
                    <label class="oubli-form-label" for="date_oubli">📅 Date</label>
                    <input
                        id="date_oubli"
                        name="date_oubli"
                        type="date"
                        class="oubli-form-input"
                        max="<?= date('Y-m-d') ?>"
                        value="<?= htmlspecialchars($_POST['date_oubli'] ?? date('Y-m-d')) ?>"
                        required
                    />
                </div>

                <div class="oubli-form-group">
                    <label class="oubli-form-label" for="heure_oubli">🕐 Heure</label>
                    <input
                        id="heure_oubli"
                        name="heure_oubli"
                        type="time"
                        class="oubli-form-input"
                        value="<?= htmlspecialchars($_POST['heure_oubli'] ?? date('H:i')) ?>"
                        required
                    />
                </div>
            </section>

            <section class="oubli-form-group">
                <p class="oubli-form-label">😌 Quelle était ton humeur ?</p>

                <div class="mood-grid">
                    <?php foreach ($humeurs as $humeur): ?>
                        <?php $checked = ((int) ($_POST['id_humeur'] ?? 0) === (int) $humeur['id']); ?>
                        <label class="mood-option <?= $checked ? 'selected' : '' ?>"
                               style="--humeur-haut: <?= htmlspecialchars($humeur['couleur_haut'] ?? '#ffffff') ?>; --humeur-bas: <?= htmlspecialchars($humeur['couleur_bas'] ?? '#e8f5f0') ?>;">
                            <input
                                type="radio"
                                name="id_humeur"
                                value="<?= (int) $humeur['id'] ?>"
                                <?= $checked ? 'checked' : '' ?>
                                required
                            />
                            <span class="mood-emoji"><?= htmlspecialchars($humeur['icone'] ?? '🌸') ?></span>
                            <span class="mood-label"><?= htmlspecialchars($humeur['nom'] ?? 'Humeur') ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </section>

            <section class="oubli-form-group">
                <label class="oubli-form-label" for="note">📝 Note optionnelle</label>
                <textarea
                    id="note"
                    name="note"
                    class="oubli-form-textarea"
                    rows="4"
                    placeholder="Exemple : j'étais stressée après le déjeuner..."
                ><?= htmlspecialchars($_POST['note'] ?? '') ?></textarea>
            </section>

            <button type="submit" class="oubli-btn-primary">
                ✅ Enregistrer cette émotion oubliée
            </button>

            <aside class="info-message">
                <span aria-hidden="true">💡</span>
                <p>
                    La date choisie sera utilisée dans l'historique, et la note sera reliée à cette émotion.
                </p>
            </aside>
        </form>

        <section class="oubli-form-footer">
            <a href="index.php?route=accueil" class="back-link">← Retour à l'accueil</a>
            <a href="index.php?route=historique" class="back-link">Voir mon historique →</a>
        </section>
    </article>
</section>

<script>
    document.querySelectorAll('.mood-option input[type="radio"]').forEach((radio) => {
        radio.addEventListener('change', () => {
            document.querySelectorAll('.mood-option').forEach((item) => item.classList.remove('selected'));
            radio.closest('.mood-option').classList.add('selected');
        });
    });
</script>
