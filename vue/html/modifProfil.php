<?php
if (!isset($user)) {
    die('Variable $user non définie');
}

$initialePrenom = mb_substr($user['prenom'] ?? 'U', 0, 1, 'UTF-8');
$initialeNom = mb_substr($user['nom'] ?? '', 0, 1, 'UTF-8');
$initiales = mb_strtoupper($initialePrenom . $initialeNom, 'UTF-8');
?>

<section class="modif-profil-container">
    <header class="modif-profil-header glass-card">
        <a class="modif-profil-retour" href="/index.php?route=profil">← Retour au profil</a>
        <h1 class="modif-profil-title">✏️ Modifier mon profil</h1>
        <p class="modif-profil-subtitle">Mets à jour tes informations personnelles.</p>
    </header>

    <?php if (!empty($errors)): ?>
        <div class="modif-profil-alert modif-profil-alert-error">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form class="modif-profil-card glass-card" method="post" action="/index.php?route=modifProfil">
        <section class="modif-profil-section">
            <div class="modif-profil-avatar"><?= htmlspecialchars($initiales) ?></div>

            <div class="modif-profil-info">
                <h2><?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?></h2>
                <p><?= htmlspecialchars($user['mail']) ?></p>
                <span class="modif-profil-badge">Compte <?= htmlspecialchars($user['role'] ?? 'user') ?></span>
            </div>
        </section>

        <section class="modif-profil-form-section">
            <div class="modif-profil-row">
                <div class="modif-profil-field">
                    <label for="prenom">Prénom</label>
                    <input
                        id="prenom"
                        name="prenom"
                        type="text"
                        value="<?= htmlspecialchars($_POST['prenom'] ?? $user['prenom']) ?>"
                        required>
                </div>

                <div class="modif-profil-field">
                    <label for="nom">Nom</label>
                    <input
                        id="nom"
                        name="nom"
                        type="text"
                        value="<?= htmlspecialchars($_POST['nom'] ?? $user['nom']) ?>"
                        required>
                </div>
            </div>

            <div class="modif-profil-row">
                <div class="modif-profil-field modif-profil-full">
                    <label for="mail">Adresse email</label>
                    <input
                        id="mail"
                        name="mail"
                        type="email"
                        value="<?= htmlspecialchars($_POST['mail'] ?? $user['mail']) ?>"
                        required>
                </div>
            </div>

            <div class="modif-profil-row">
                <div class="modif-profil-field">
                    <label for="naissance">Date de naissance</label>
                    <input
                        id="naissance"
                        name="naissance"
                        type="date"
                        value="<?= htmlspecialchars($_POST['naissance'] ?? ($user['naissance'] ?? '')) ?>">
                </div>

                <div class="modif-profil-field">
                    <label>Date d'inscription</label>
                    <input
                        type="text"
                        value="<?= htmlspecialchars($user['date_inscription'] ?? '') ?>"
                        disabled>
                </div>
            </div>

            <div class="modif-profil-password-box">
                <h3>🔒 Changer le mot de passe</h3>
                <p>Laisse ces champs vides si tu ne veux pas modifier ton mot de passe.</p>

                <div class="modif-profil-row">
                    <div class="modif-profil-field">
                        <label for="nouveau_password">Nouveau mot de passe</label>
                        <input
                            id="nouveau_password"
                            name="nouveau_password"
                            type="password"
                            minlength="6"
                            autocomplete="new-password">
                    </div>

                    <div class="modif-profil-field">
                        <label for="confirmation_password">Confirmer le mot de passe</label>
                        <input
                            id="confirmation_password"
                            name="confirmation_password"
                            type="password"
                            minlength="6"
                            autocomplete="new-password">
                    </div>
                </div>
            </div>
        </section>

        <footer class="modif-profil-actions">
            <a class="modif-profil-cancel-btn" href="/index.php?route=profil">❌ Annuler</a>
            <button class="modif-profil-save-btn" type="submit">💾 Enregistrer</button>
        </footer>
    </form>
</section>
