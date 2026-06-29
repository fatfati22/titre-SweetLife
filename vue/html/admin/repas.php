        <h1 class="admin-title">🥗 Gestion des repas</h1>

        <!-- Formulaire -->
        <div class="admin-form-card glass-card">
            <?php
                $editR = $editRepas ?? null;
                $editAction = $editR ? 'modifier_repas' : 'creer_repas';
                $editLabel  = $editR ? '💾 Enregistrer' : '➕ Créer le repas';
                ?>
            <h3><?= $editR ? '✏️ Modifier le repas' : '➕ Nouveau repas' ?></h3>
            <form method="POST" action="/index.php?route=admin&action=<?= $editAction ?>">
                <?php if ($editR): ?>
                <input type="hidden" name="id" value="<?= $editR['id'] ?>">
                <?php endif; ?>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label>Titre *</label>
                        <input type="text" name="titre" required value="<?= htmlspecialchars($editR['titre'] ?? '') ?>"
                            placeholder="Nom du repas" />
                    </div>
                    <div class="admin-form-group">
                        <label>Durée (min)</label>
                        <input type="number" name="duree" min="0" value="<?= intval($editR['duree'] ?? 0) ?>" />
                    </div>
                </div>

                <div class="admin-form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3"
                        placeholder="Description du repas…"><?= htmlspecialchars($editR['description'] ?? '') ?></textarea>
                </div>

                <div class="admin-form-group">
                    <label>URL photo</label>
                    <input type="text" name="photo" value="<?= htmlspecialchars($editR['photo'] ?? '') ?>" placeholder="https://…" />
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label>Humeur associée *</label>
                        <select name="id_humeur" required>
                            <option value="">— Choisir —</option>
                            <?php foreach ($humeurs as $h): ?>
                            <option value="<?= $h['id'] ?>"
                                <?= ($editR && $editR['id_humeur'] == $h['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($h['icone'] . ' ' . $h['nom']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="admin-form-group">
                        <label>Type de repas *</label>
                        <select name="id_type" required>
                            <option value="">— Choisir —</option>
                            <?php foreach ($types as $t): ?>
                            <option value="<?= $t['id'] ?>"
                                <?= ($editR && $editR['id_type'] == $t['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($t['nom']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="admin-form-group">
                        <label>Catégorie *</label>
                        <select name="id_categorie" required>
                            <option value="">— Choisir —</option>
                            <?php foreach ($categories as $c): ?>
                            <option value="<?= $c['id'] ?>"
                                <?= ($editR && $editR['id_categorie'] == $c['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c['nom']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="admin-form-actions">
                    <?php if ($editR): ?>
                    <a href="/index.php?route=admin&section=repas" class="btn-annuler">Annuler</a>
                    <?php endif; ?>
                    <button type="submit" class="btn-primary"><?= $editLabel ?></button>
                </div>
            </form>
        </div>

        <!-- Liste repas -->
        <div class="admin-table-card glass-card">
            <h3>📋 Liste des repas (<?= count($repas) ?>)</h3>
            <?php if (empty($repas)): ?>
            <p class="empty-msg">Aucun repas enregistré.</p>
            <?php else: ?>
            <div class="table-scroll">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Humeur</th>
                            <th>Type</th>
                            <th>Catégorie</th>
                            <th>Durée</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($repas as $r): ?>
                        <tr>
                            <td><?= $r['id'] ?></td>
                            <td><?= htmlspecialchars($r['titre']) ?></td>
                            <td><?= htmlspecialchars($r['humeur_nom'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($r['type_nom']   ?? '—') ?></td>
                            <td><?= htmlspecialchars($r['cat_nom']    ?? '—') ?></td>
                            <td><?= $r['duree'] ? $r['duree'] . ' min' : '—' ?></td>
                            <td class="actions">
                                <a href="/index.php?route=admin&section=repas&action=edit_repas&id=<?= $r['id'] ?>"
                                    class="btn-edit">✏️</a>
                                <form method="POST" action="/index.php?route=admin&action=supprimer_repas"
                                    onsubmit="return confirm('Supprimer ce repas ?')">
                                    <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                    <button type="submit" class="btn-delete">🗑️</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
