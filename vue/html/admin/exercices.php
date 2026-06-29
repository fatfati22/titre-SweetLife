        <h1 class="admin-title">🧘 Gestion des exercices</h1>

        <!-- Formulaire -->
        <div class="admin-form-card glass-card">
            <?php
                $editE = $editExercice ?? null;
                $editAction = $editE ? 'modifier_exercice' : 'creer_exercice';
                $editLabel  = $editE ? '💾 Enregistrer' : '➕ Créer l\'exercice';
                ?>
            <h3><?= $editE ? '✏️ Modifier l\'exercice' : '➕ Nouvel exercice' ?></h3>
            <form method="POST" action="/index.php?route=admin&action=<?= $editAction ?>">
                <?php if ($editE): ?>
                <input type="hidden" name="id" value="<?= $editE['id'] ?>">
                <?php endif; ?>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label>Titre *</label>
                        <input type="text" name="titre" required value="<?= htmlspecialchars($editE['titre'] ?? '') ?>"
                            placeholder="Nom de l'exercice" />
                    </div>
                    <div class="admin-form-group">
                        <label>Durée (min)</label>
                        <input type="number" name="duree" min="0" value="<?= intval($editE['duree'] ?? 0) ?>" />
                    </div>
                </div>

                <div class="admin-form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3"
                        placeholder="Décrivez l'exercice…"><?= htmlspecialchars($editE['description'] ?? '') ?></textarea>
                </div>

                <div class="admin-form-group">
                    <label> vidéo (YouTube embed ou lien direct)</label>
                    <input type="text" name="video" value="<?= htmlspecialchars($editE['video'] ?? '') ?>"
                        placeholder="" />
                </div>

                <div class="admin-form-group">
                    <label>Humeur associée *</label>
                    <select name="id_humeur" required>
                        <option value="">— Choisir —</option>
                        <?php foreach ($humeurs as $h): ?>
                        <option value="<?= $h['id'] ?>"
                            <?= ($editE && $editE['id_humeur'] == $h['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($h['icone'] . ' ' . $h['nom']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="admin-form-actions">
                    <?php if ($editE): ?>
                    <a href="/index.php?route=admin&section=exercices" class="btn-annuler">Annuler</a>
                    <?php endif; ?>
                    <button type="submit" class="btn-primary"><?= $editLabel ?></button>
                </div>
            </form>
        </div>

        <!-- Liste exercices -->
        <div class="admin-table-card glass-card">
            <h3>📋 Liste des exercices (<?= count($exercices) ?>)</h3>
            <?php if (empty($exercices)): ?>
            <p class="empty-msg">Aucun exercice enregistré.</p>
            <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Humeur</th>
                        <th>Durée</th>
                        <th>Vidéo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($exercices as $e): ?>
                    <tr>
                        <td><?= $e['id'] ?></td>
                        <td><?= htmlspecialchars($e['titre']) ?></td>
                        <td><?= htmlspecialchars($e['humeur_nom'] ?? '—') ?></td>
                        <td><?= $e['duree'] ? $e['duree'] . ' min' : '—' ?></td>
                        <td><?= $e['video'] ? '<a href="' . htmlspecialchars($e['video']) . '" target="_blank">▶️</a>' : '—' ?>
                        </td>
                        <td class="actions">
                            <a href="/index.php?route=admin&section=exercices&action=edit_exercice&id=<?= $e['id'] ?>"
                                class="btn-edit">✏️</a>
                            <form method="POST" action="/index.php?route=admin&action=supprimer_exercice"
                                onsubmit="return confirm('Supprimer cet exercice ?')">
                                <input type="hidden" name="id" value="<?= $e['id'] ?>">
                                <button type="submit" class="btn-delete">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
