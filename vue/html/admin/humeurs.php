        <h1 class="admin-title">😊 Gestion des humeurs</h1>

        <!-- Formulaire création / édition -->
        <div class="admin-form-card glass-card">
            <?php
                $editH = $editHumeur ?? null;
                $editAction = $editH ? 'modifier_humeur' : 'creer_humeur';
                $editLabel  = $editH ? '💾 Enregistrer les modifications' : '➕ Créer l\'humeur';
                ?>
            <h3><?= $editH ? '✏️ Modifier l\'humeur' : '➕ Nouvelle humeur' ?></h3>
            <form method="POST" action="/index.php?route=admin&action=<?= $editAction ?>">
                <?php if ($editH): ?>
                <input type="hidden" name="id" value="<?= $editH['id'] ?>">
                <?php endif; ?>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label>Nom de l'humeur *</label>
                        <input type="text" name="nom" required value="<?= htmlspecialchars($editH['nom'] ?? '') ?>"
                            placeholder="ex: Joie, Tristesse…" />
                    </div>
                    <div class="admin-form-group">
                        <label>Icône (emoji) *</label>
                        <input type="text" name="icone" required value="<?= htmlspecialchars($editH['icone'] ?? '') ?>"
                            placeholder="ex: 😊" />
                    </div>
                </div>

                <div class="admin-form-group">
                    <label>Nom du thème</label>
                    <input type="text" name="theme"
                        value="<?= htmlspecialchars($editH['theme'] ?? '') ?>" placeholder="ex: joie, calme, stress" />
                    <small>Optionnel : si tu laisses vide, le thème est créé automatiquement avec le nom de l'humeur.</small>
                </div>

                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label>Couleur haut *</label>
                        <input type="text" name="couleur_haut" id="couleurHautInput" required
                            value="<?= htmlspecialchars($editH['couleur_haut'] ?? '') ?>" placeholder="ex: #fff9e6" />
                    </div>
                    <div class="admin-form-group">
                        <label>Couleur bas *</label>
                        <input type="text" name="couleur_bas" id="couleurBasInput" required
                            value="<?= htmlspecialchars($editH['couleur_bas'] ?? '') ?>" placeholder="ex: #ffb347" />
                    </div>
                </div>

                <div class="admin-form-group">
                    <label>Couleurs rapides</label>
                    <div class="color-presets">
                        <span class="preset-chip" style="background:linear-gradient(135deg,#fff9e6,#ffb347)"
                            onclick="setSqlColors('#fff9e6', '#ffb347', 'joie')">Joie</span>
                        <span class="preset-chip" style="background:linear-gradient(135deg,#e8ecf0,#7096b8)"
                            onclick="setSqlColors('#e8ecf0', '#7096b8', 'tristesse')">Tristesse</span>
                        <span class="preset-chip" style="background:linear-gradient(135deg,#f5e8e8,#b22222)"
                            onclick="setSqlColors('#f5e8e8', '#b22222', 'colere')">Colère</span>
                        <span class="preset-chip" style="background:linear-gradient(135deg,#eeeeee,#aaaaaa)"
                            onclick="setSqlColors('#eeeeee', '#aaaaaa', 'fatigue')">Fatigue</span>
                        <span class="preset-chip" style="background:linear-gradient(135deg,#e0f0ff,#3a86ff)"
                            onclick="setSqlColors('#e0f0ff', '#3a86ff', 'stress')">Stress</span>
                        <span class="preset-chip" style="background:linear-gradient(135deg,#e8f5f0,#5aaa8a)"
                            onclick="setSqlColors('#e8f5f0', '#5aaa8a', 'calme')">Calme</span>
                    </div>
                    <small>Les couleurs sont enregistrées dans la table humeur.</small>
                </div>

                <div class="admin-form-actions">
                    <?php if ($editH): ?>
                    <a href="/index.php?route=admin&section=humeurs" class="btn-annuler">Annuler</a>
                    <?php endif; ?>
                    <button type="submit" class="btn-primary"><?= $editLabel ?></button>
                </div>
            </form>
        </div>

        <!-- Liste des humeurs -->
        <div class="admin-table-card glass-card">
            <h3>📋 Liste des humeurs (<?= count($humeurs) ?>)</h3>
            <?php if (empty($humeurs)): ?>
            <p class="empty-msg">Aucune humeur enregistrée.</p>
            <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Icône</th>
                        <th>Nom</th>
                        <th>Thème</th>
                        <th>Couleur haut</th>
                        <th>Couleur bas</th>
                        <th>Aperçu</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($humeurs as $h): ?>
                    <tr>
                        <td><?= $h['id'] ?></td>
                        <td class="emoji-cell"><?= htmlspecialchars($h['icone'] ?? '') ?></td>
                        <td><?= htmlspecialchars($h['nom']) ?></td>
                        <td><code><?= htmlspecialchars($h['theme'] ?? '') ?></code></td>
                        <td><code><?= htmlspecialchars($h['couleur_haut'] ?? '') ?></code></td>
                        <td><code><?= htmlspecialchars($h['couleur_bas'] ?? '') ?></code></td>
                        <td>
                            <div class="theme-preview" style="background: linear-gradient(135deg, <?= htmlspecialchars($h['couleur_haut'] ?? '#e8f5f0') ?>, <?= htmlspecialchars($h['couleur_bas'] ?? '#5aaa8a') ?>);"></div>
                        </td>
                        <td class="actions">
                            <a href="/index.php?route=admin&section=humeurs&action=edit_humeur&id=<?= $h['id'] ?>"
                                class="btn-edit">✏️</a>
                            <form method="POST" action="/index.php?route=admin&action=supprimer_humeur"
                                onsubmit="return confirm('Supprimer cette humeur ?')">
                                <input type="hidden" name="id" value="<?= $h['id'] ?>">
                                <button type="submit" class="btn-delete">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
