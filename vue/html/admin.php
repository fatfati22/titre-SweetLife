<?php
// Vue admin — contenu uniquement (injecté dans layout/main.php)
$section = $_GET['section'] ?? 'dashboard';
?>

<div class="admin-wrapper">

    <!-- ── SIDEBAR ─────────────────────────────────────────────────────── -->
    <aside class="admin-sidebar glass-card">
        <div class="admin-logo">
            <span>⚙️</span>
            <strong>Panel Admin</strong>
        </div>

        <nav class="admin-nav">
            <a href="/index.php?route=admin&section=dashboard"
                class="admin-nav-item <?= $section === 'dashboard'     ? 'actif' : '' ?>">
                📊 Dashboard
            </a>
            <a href="/index.php?route=admin&section=humeurs"
                class="admin-nav-item <?= $section === 'humeurs'       ? 'actif' : '' ?>">
                😊 Humeurs
            </a>
            <a href="/index.php?route=admin&section=repas"
                class="admin-nav-item <?= $section === 'repas'         ? 'actif' : '' ?>">
                🥗 Repas
            </a>
            <a href="/index.php?route=admin&section=exercices"
                class="admin-nav-item <?= $section === 'exercices'     ? 'actif' : '' ?>">
                🧘 Exercices
            </a>
            <a href="/index.php?route=admin&section=utilisateurs"
                class="admin-nav-item <?= $section === 'utilisateurs'  ? 'actif' : '' ?>">
                👥 Utilisateurs
            </a>
            <a href="/index.php?route=admin&section=themes"
                class="admin-nav-item <?= $section === 'themes'        ? 'actif' : '' ?>">
                🎨 Couleurs & Thèmes
            </a>
        </nav>

        <a href="/index.php?route=accueil" class="admin-back-btn">← Retour au site</a>
    </aside>

    <!-- ── CONTENU PRINCIPAL ────────────────────────────────────────────── -->
    <div class="admin-content">

        <?php if (!empty($message)): ?>
            <div class="admin-alert success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        <?php if (!empty($erreur)): ?>
            <div class="admin-alert error"><?= htmlspecialchars($erreur) ?></div>
        <?php endif; ?>

        <!-- ══ DASHBOARD ═════════════════════════════════════════════════ -->
        <?php if ($section === 'dashboard'): ?>
            <h1 class="admin-title">📊 Tableau de bord</h1>

            <div class="stats-grid">
                <div class="stat-card glass-card">
                    <span class="stat-icon">👥</span>
                    <div>
                        <p class="stat-val"><?= $stats['user'] ?></p>
                        <p class="stat-label">Utilisateurs</p>
                    </div>
                </div>
                <div class="stat-card glass-card">
                    <span class="stat-icon">😊</span>
                    <div>
                        <p class="stat-val"><?= $stats['humeur'] ?></p>
                        <p class="stat-label">Humeurs</p>
                    </div>
                </div>
                <div class="stat-card glass-card">
                    <span class="stat-icon">🥗</span>
                    <div>
                        <p class="stat-val"><?= $stats['repas'] ?></p>
                        <p class="stat-label">Repas</p>
                    </div>
                </div>
                <div class="stat-card glass-card">
                    <span class="stat-icon">🧘</span>
                    <div>
                        <p class="stat-val"><?= $stats['exercice'] ?></p>
                        <p class="stat-label">Exercices</p>
                    </div>
                </div>
                <div class="stat-card glass-card">
                    <span class="stat-icon">💬</span>
                    <div>
                        <p class="stat-val"><?= $stats['citation'] ?></p>
                        <p class="stat-label">Citations</p>
                    </div>
                </div>
            </div>

            <div class="admin-shortcuts glass-card">
                <h3>Raccourcis rapides</h3>
                <div class="shortcut-grid">
                    <a href="/index.php?route=admin&section=humeurs&action=new" class="shortcut-btn">➕ Nouvelle humeur</a>
                    <a href="/index.php?route=admin&section=repas&action=new" class="shortcut-btn">➕ Nouveau repas</a>
                    <a href="/index.php?route=admin&section=exercices&action=new" class="shortcut-btn">➕ Nouvel exercice</a>
                    <a href="/index.php?route=admin&section=utilisateurs" class="shortcut-btn">👥 Gérer les users</a>
                </div>
            </div>

            <!-- ══ HUMEURS  -->
        <?php elseif ($section === 'humeurs'): ?>
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

                    <div class="form-row">
                        <div class="form-group">
                            <label>Nom de l'humeur *</label>
                            <input type="text" name="nom" required
                                value="<?= htmlspecialchars($editH['nom'] ?? '') ?>"
                                placeholder="ex: Joie, Tristesse…" />
                        </div>
                        <div class="form-group">
                            <label>Icône (emoji) *</label>
                            <input type="text" name="icone" required
                                value="<?= htmlspecialchars($editH['icone'] ?? '') ?>"
                                placeholder="ex: 😊" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Couleur du thème CSS *</label>
                        <div class="color-row">
                            <input type="text" name="couleur" id="couleurInput" required
                                value="<?= htmlspecialchars($editH['couleur'] ?? '') ?>"
                                placeholder="ex: theme-joie" />
                            <div class="color-presets">
                                <span class="preset-chip" style="background:linear-gradient(135deg,#fff9e6,#ffe066,#ffb347)"
                                    onclick="setTheme('theme-joie')">Joie</span>
                                <span class="preset-chip" style="background:linear-gradient(135deg,#e8ecf0,#b8cde0,#7096b8)"
                                    onclick="setTheme('theme-tristesse')">Tristesse</span>
                                <span class="preset-chip" style="background:linear-gradient(135deg,#f5e8e8,#e8a0a0,#b22222)"
                                    onclick="setTheme('theme-colere')">Colère</span>
                                <span class="preset-chip" style="background:linear-gradient(135deg,#eeeeee,#cccccc,#aaaaaa)"
                                    onclick="setTheme('theme-fatigue')">Fatigue</span>
                                <span class="preset-chip" style="background:linear-gradient(135deg,#e0f0ff,#89c2ff,#3a86ff)"
                                    onclick="setTheme('theme-stress')">Stress</span>
                                <span class="preset-chip" style="background:linear-gradient(135deg,#e8f5f0,#a8d8c0,#5aaa8a)"
                                    onclick="setTheme('theme-calme')">Calme</span>
                            </div>
                        </div>
                        <small>Classe CSS du thème (doit correspondre à une classe dans theme.css)</small>
                    </div>

                    <div class="form-actions">
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
                                <th>Thème CSS</th>
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
                                    <td><code><?= htmlspecialchars($h['couleur'] ?? '') ?></code></td>
                                    <td>
                                        <div class="theme-preview <?= htmlspecialchars($h['couleur'] ?? '') ?>"></div>
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

            <!-- ══ REPAS ══════════════════════════════════════════════════════ -->
        <?php elseif ($section === 'repas'): ?>
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

                    <div class="form-row">
                        <div class="form-group">
                            <label>Titre *</label>
                            <input type="text" name="titre" required
                                value="<?= htmlspecialchars($editR['titre'] ?? '') ?>"
                                placeholder="Nom du repas" />
                        </div>
                        <div class="form-group">
                            <label>Durée (min)</label>
                            <input type="number" name="duree" min="0"
                                value="<?= intval($editR['duree'] ?? 0) ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="3"
                            placeholder="Description du repas…"><?= htmlspecialchars($editR['description'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>URL photo</label>
                        <input type="url" name="photo"
                            value="<?= htmlspecialchars($editR['photo'] ?? '') ?>"
                            placeholder="https://…" />
                    </div>

                    <div class="form-row">
                        <div class="form-group">
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
                        <div class="form-group">
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
                        <div class="form-group">
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

                    <div class="form-actions">
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

            <!-- ══ EXERCICES ═════════════════════════════════════════════════ -->
        <?php elseif ($section === 'exercices'): ?>
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

                    <div class="form-row">
                        <div class="form-group">
                            <label>Titre *</label>
                            <input type="text" name="titre" required
                                value="<?= htmlspecialchars($editE['titre'] ?? '') ?>"
                                placeholder="Nom de l'exercice" />
                        </div>
                        <div class="form-group">
                            <label>Durée (min)</label>
                            <input type="number" name="duree" min="0"
                                value="<?= intval($editE['duree'] ?? 0) ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" rows="3"
                            placeholder="Décrivez l'exercice…"><?= htmlspecialchars($editE['description'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>URL vidéo (YouTube embed ou lien direct)</label>
                        <input type="url" name="video"
                            value="<?= htmlspecialchars($editE['video'] ?? '') ?>"
                            placeholder="https://www.youtube.com/embed/…" />
                    </div>

                    <div class="form-group">
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

                    <div class="form-actions">
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
                                    <td><?= $e['video'] ? '<a href="' . htmlspecialchars($e['video']) . '" target="_blank">▶️</a>' : '—' ?></td>
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

            <!-- ══ UTILISATEURS ══════════════════════════════════════════════ -->
        <?php elseif ($section === 'utilisateurs'): ?>
            <h1 class="admin-title">👥 Gestion des utilisateurs</h1>

            <div class="admin-table-card glass-card">
                <h3>📋 Liste des utilisateurs (<?= count($users) ?>)</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Inscrit le</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u): ?>
                            <tr class="<?= $u['id'] === $_SESSION['user']['id'] ? 'current-user' : '' ?>">
                                <td><?= $u['id'] ?></td>
                                <td><?= htmlspecialchars($u['nom']) ?></td>
                                <td><?= htmlspecialchars($u['prenom']) ?></td>
                                <td><?= htmlspecialchars($u['mail']) ?></td>
                                <td>
                                    <form method="POST" action="/index.php?route=admin&action=changer_role" class="role-form">
                                        <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                        <select name="role" onchange="this.form.submit()"
                                            <?= $u['id'] === $_SESSION['user']['id'] ? 'disabled' : '' ?>>
                                            <option value="utilisateur" <?= $u['role'] === 'utilisateur' ? 'selected' : '' ?>>Utilisateur</option>
                                            <option value="admin" <?= $u['role'] === 'admin'       ? 'selected' : '' ?>>Admin</option>
                                        </select>
                                    </form>
                                </td>
                                <td><?= $u['date_inscription'] ? date('d/m/Y', strtotime($u['date_inscription'])) : '—' ?></td>
                                <td class="actions">
                                    <?php if ($u['id'] !== $_SESSION['user']['id']): ?>
                                        <form method="POST" action="/index.php?route=admin&action=supprimer_user"
                                            onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                            <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                            <button type="submit" class="btn-delete">🗑️</button>
                                        </form>
                                    <?php else: ?>
                                        <span class="badge-vous">Vous</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- ══ THÈMES ════════════════════════════════════════════════════ -->
        <?php elseif ($section === 'themes'): ?>
            <h1 class="admin-title">🎨 Couleurs & Thèmes</h1>

            <div class="admin-form-card glass-card">
                <h3>Thèmes disponibles dans l'application</h3>
                <p class="theme-intro">Ces thèmes sont automatiquement appliqués selon l'humeur sélectionnée par l'utilisateur. Chaque classe CSS correspond à une humeur dans la base de données.</p>

                <div class="themes-grid">

                    <div class="theme-demo-card glass-card theme-calme">
                        <div class="theme-demo-header">
                            <span>😌</span>
                            <strong>theme-calme</strong>
                        </div>
                        <p>Fond vert doux – Texte #0d2520</p>
                        <div class="theme-demo-swatches">
                            <div style="background:#e8f5f0"></div>
                            <div style="background:#a8d8c0"></div>
                            <div style="background:#5aaa8a"></div>
                        </div>
                        <code>background: linear-gradient(135deg, #e8f5f0, #a8d8c0, #5aaa8a)</code>
                    </div>

                    <div class="theme-demo-card glass-card theme-joie">
                        <div class="theme-demo-header">
                            <span>😄</span>
                            <strong>theme-joie</strong>
                        </div>
                        <p>Fond jaune-orange – Texte #2d2000</p>
                        <div class="theme-demo-swatches">
                            <div style="background:#fff9e6"></div>
                            <div style="background:#ffe066"></div>
                            <div style="background:#ffb347"></div>
                        </div>
                        <code>background: linear-gradient(135deg, #fff9e6, #ffe066, #ffb347)</code>
                    </div>

                    <div class="theme-demo-card glass-card theme-tristesse">
                        <div class="theme-demo-header">
                            <span>😢</span>
                            <strong>theme-tristesse</strong>
                        </div>
                        <p>Fond bleu doux – Texte #1a2535</p>
                        <div class="theme-demo-swatches">
                            <div style="background:#e8ecf0"></div>
                            <div style="background:#b8cde0"></div>
                            <div style="background:#7096b8"></div>
                        </div>
                        <code>background: linear-gradient(135deg, #e8ecf0, #b8cde0, #7096b8)</code>
                    </div>

                    <div class="theme-demo-card glass-card theme-colere">
                        <div class="theme-demo-header">
                            <span>😠</span>
                            <strong>theme-colere</strong>
                        </div>
                        <p>Fond rouge – Texte #2d0a0a</p>
                        <div class="theme-demo-swatches">
                            <div style="background:#f5e8e8"></div>
                            <div style="background:#e8a0a0"></div>
                            <div style="background:#b22222"></div>
                        </div>
                        <code>background: linear-gradient(135deg, #f5e8e8, #e8a0a0, #b22222)</code>
                    </div>

                    <div class="theme-demo-card glass-card theme-fatigue">
                        <div class="theme-demo-header">
                            <span>😴</span>
                            <strong>theme-fatigue</strong>
                        </div>
                        <p>Fond gris – Texte #222</p>
                        <div class="theme-demo-swatches">
                            <div style="background:#eeeeee"></div>
                            <div style="background:#cccccc"></div>
                            <div style="background:#aaaaaa"></div>
                        </div>
                        <code>background: linear-gradient(135deg, #eeeeee, #cccccc, #aaaaaa)</code>
                    </div>

                    <div class="theme-demo-card glass-card theme-stress">
                        <div class="theme-demo-header">
                            <span>😰</span>
                            <strong>theme-stress</strong>
                        </div>
                        <p>Fond bleu vif – Texte #0a1f44</p>
                        <div class="theme-demo-swatches">
                            <div style="background:#e0f0ff"></div>
                            <div style="background:#89c2ff"></div>
                            <div style="background:#3a86ff"></div>
                        </div>
                        <code>background: linear-gradient(135deg, #e0f0ff, #89c2ff, #3a86ff)</code>
                    </div>

                </div>

                <div class="theme-info glass-card">
                    <h4>📝 Pour ajouter un nouveau thème</h4>
                    <ol>
                        <li>Ajoutez la classe dans <code>vue/css/theme.css</code> — ex : <code>.theme-surprise { background: linear-gradient(…) }</code></li>
                        <li>Ajoutez les variantes de boutons dans <code>vue/css/element-theme.css</code></li>
                        <li>Créez ou modifiez une humeur (onglet Humeurs) avec la valeur <code>theme-surprise</code> dans le champ <em>Couleur</em></li>
                    </ol>
                </div>
            </div>

        <?php endif; ?>
    </div><!-- /.admin-content -->
</div><!-- /.admin-wrapper -->

<script>
    function setTheme(val) {
        document.getElementById('couleurInput').value = val;
    }
</script>