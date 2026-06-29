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
                                    <option value="utilisateur" <?= $u['role'] === 'utilisateur' ? 'selected' : '' ?>>
                                        Utilisateur</option>
                                    <option value="admin" <?= $u['role'] === 'admin'       ? 'selected' : '' ?>>Admin
                                    </option>
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
