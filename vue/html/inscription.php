<?php
// Vue inscription — contenu uniquement, incluse par inscritController.php
?>
<main class="page-inscription">
    <section class="auth-card">
        <!-- LOGO -->
        <header class="auth-logo-card">
            <img src="/vue/image/logo.png" alt="logo du site SweetLife" />
            <h1>Sweet<span>life</span></h1>
            <p>Ton espace bien-être & émotions</p>
            <p>Créer ton espace bien-être personnel — gratuit et sans engagement</p>
        </header>

        <!-- INFORMATIONS -->
        <section class="auth-info-card">
            <p>Suivi de tes humeurs au quotidien</p>
            <p>Exercices & repas adaptés à toi</p>
            <p>Citations inspirantes personnalisées</p>
        </section>

        <!-- ERREUR -->
        <?php if (!empty($erreur)): ?>
            <p style="color:red;text-align:center;"><?= htmlspecialchars($erreur) ?></p>
        <?php endif; ?>

        <form class="auth-card form-inscription" action="/index.php?route=inscription" method="POST">
            <section class="auth-field">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" class="input input-nom" placeholder="Martin" required />
            </section>

            <section class="auth-field">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" class="input input-prenom" placeholder="Sophie" required />
            </section>

            <section class="auth-field">
                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="mail" class="input input-email" placeholder="sophie@email.com" required />
            </section>

            <section class="auth-field">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" class="input input-password" placeholder="••••••••" minlength="6" required />
            </section>

            <section class="auth-field">
                <label for="confirm-password">Confirmer le mot de passe</label>
                <input type="password" id="confirm-password" name="confirm-password" class="input input-confirm-password" placeholder="••••••••" required />
            </section>

            <section class="auth-field">
                <label for="naissance">Date de naissance</label>
                <input type="date" id="naissance" name="naissance" class="input input-naissance"
                       max="<?= date('Y-m-d', strtotime('-5 years')) ?>"
                       min="1900-01-01" />
            </section>

            <button type="submit" class="btn-envoyer">🌸 Créer mon compte</button>
        </form>

        <p class="auth-login-link">
            Déjà membre ? <a href="/index.php?route=connexion">Se connecter</a>
        </p>

        <nav class="auth-retour">
            <a href="/index.php?route=accueil">← Retour à l'accueil</a>
        </nav>
    </section>
</main>
