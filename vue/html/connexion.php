<?php
// Vue connexion — contenu uniquement, incluse par connexionController.php
?>
<main class="page-connexion">
    <section class="auth-card">
        <!-- LOGO -->
        <header class="auth-logo-card">
            <img src="/vue/image/logo.png" alt="logo du site SweetLife" />
            <h1>Sweet<span>life</span></h1>
            <span>Bon Retour 🌸</span>
            <p>Ton espace bien-être & émotions</p>
            <p>Connecte-toi à ton espace bien-être</p>
        </header>

        <!-- INFOS -->
        <section class="auth-info-card">
            <p>Retrouve ton suivi émotionnel</p>
            <p>Accède à tes exercices personnalisés</p>
            <p>Continue ton voyage bien-être</p>
        </section>

        <!-- ERREUR -->
        <?php if (!empty($erreur)): ?>
            <p style="color:red;text-align:center;"><?= htmlspecialchars($erreur) ?></p>
        <?php endif; ?>

        <!-- FORMULAIRE -->
        <form class="auth-field" action="/index.php?route=connexion" method="POST">
            <label for="mail">Adresse e-mail</label>
            <input type="email" id="mail" name="mail" placeholder="Email" required />

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required />

            <button type="submit" class="btn-envoyer">Connexion</button>
        </form>

        <!-- OPTIONS -->
        <section class="connexion-options">
            <label class="souvenir-moi" for="remember">
                <input type="checkbox" id="remember" name="remember" />
                Se souvenir de moi
            </label>
            <a href="#" class="mot-passe-oublie">Mot de passe oublié ?</a>
        </section>

        <!-- INSCRIPTION -->
        <p class="lien-sinscrire">
            Pas encore membre ?
            <a href="/index.php?route=inscription">Créer un compte</a>
        </p>

        <!-- RETOUR -->
        <nav class="auth-retour">
            <a href="/index.php?route=accueil">← Retour à l'accueil</a>
        </nav>
    </section>
</main>
