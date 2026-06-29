<?php
// Vue profil — contenu uniquement, incluse par profilController.php
if (!isset($user)) {
    die('Variable $user non définie');
}
?>
<section class="enveloppe-profil">
    <!-- HERO -->
    <header class="en-tete-profil glass-card">
        <figure class="grand-avatar">
            <span class="point-en-ligne"></span>
        </figure>
        <section>
            <h1 class="profil-title nom-profil couleur">
                <?= htmlspecialchars($user['prenom']) ?>
                <?= htmlspecialchars($user['nom']) ?> !
            </h1>
            <p class="profil-text email-profil"><?= htmlspecialchars($user['mail']) ?></p>
        </section>
    </header>

    <!-- CARDS -->
    <section class="bas-profil">
        <!-- MOOD -->
        <article class="mood-card mood-glass-card glass-card">
            <p class="mood-card-text couleur">💫 État émotionnel actuel</p>
            <section class="affichage-humeur">
                <span class="big-emoji" id="moodEmoji">😌</span>
                <h3>Calme & Sereine</h3>
            </section>
        </article>

        <!-- INFOS -->
        <article class="carte-info-profil glass-card">
            <h3>👤 Mes informations</h3>
            <div class="liste-info">
                <div class="champ-info">
                    <p class="profil-text libelle-info couleur">Prénom et nom :</p>
                    <p class="profil-text valeur-info"><?= htmlspecialchars($user['prenom']) ?>
                        <?= htmlspecialchars($user['nom']) ?></p>
                </div>
                <div class="champ-info">
                    <p class="profil-text libelle-info couleur">Email :</p>
                    <p class="profil-text valeur-info"><?= htmlspecialchars($user['mail']) ?></p>
                </div>
                <?php if (!empty($user['naissance'])): ?>
                    <div class="champ-info">
                        <p class="profil-text libelle-info couleur">Date de naissance :</p>
                        <p class="profil-text valeur-info">
                            <?php
                            $d = new DateTime($user['naissance']);
                            $age = $d->diff(new DateTime())->y;
                            echo $d->format('d/m/Y') . ' <span class="badge-age glass-card">' . $age . ' ans</span>';
                            ?>
                        </p>
                    </div>
                <?php endif; ?>
                <div class="champ-info">
                    <p class="profil-text libelle-info couleur">Membre depuis :</p>
                    <p class="profil-text valeur-info"><?= htmlspecialchars($user['date_inscription']) ?></p>
                </div>
                <div class="champ-info">
                    <p class="profil-text libelle-info couleur">Rôle :</p>
                    <p class="profil-text valeur-info"><?= htmlspecialchars($user['role']) ?></p>
                </div>
            </div>
        </article>
    </section>

    <span class="ligne-actions">
        <a class="btn-ghost" href="/index.php?route=modifProfil">Modifier votre profil</a>
        <a class="btn-ghost" href="/index.php?route=deconnexion">🔒 Déconnexion</a>
    </span>
</section>
