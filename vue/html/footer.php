<footer class="site-footer" aria-label="Pied de page SweetLife">
    <div class="site-footer-inner">
        <section class="site-footer-brand" aria-label="Présentation SweetLife">
            <a class="site-footer-logo" href="index.php?route=accueil" aria-label="Retour à l'accueil SweetLife">
                <img class="site-footer-img" src="vue/image/logo.png" alt="Logo SweetLife" />
                <span>SweetLife</span>
            </a>
            <p class="site-footer-description">
                Application de suivi émotionnel : choisis ton humeur, écris une note,
                puis découvre des repas, exercices et citations adaptés à ton état du moment.
            </p>
        </section>

        <section class="site-footer-column" aria-label="Navigation principale">
            <h3>Navigation</h3>
            <nav class="site-footer-links">
                <a href="index.php?route=accueil">Accueil</a>
                <a href="index.php?route=repas">Repas</a>
                <a href="index.php?route=exercice">Exercices</a>
                <a href="index.php?route=historique">Historique</a>
            </nav>
        </section>

        <section class="site-footer-column" aria-label="Informations">
            <h3>Informations</h3>
            <nav class="site-footer-links">
                <a href="index.php?route=about">À propos</a>
                <a href="index.php?route=contact">Contact</a>
                <a href="index.php?route=mentions">Mentions légales</a>
                <a href="index.php?route=profil">Mon profil</a>
                <a href="index.php?route=oubli">Humeur oubliée</a>
            </nav>
        </section>

        <section class="site-footer-column site-footer-contact" aria-label="Contact rapide">
            <h3>Contact</h3>
            <p>Besoin d'aide ou envie d'améliorer ton bien-être ?</p>
            <a class="site-footer-button" href="index.php?route=contact">Nous contacter</a>
        </section>
    </div>

    <div class="site-footer-bottom">
        <p>&copy; <?= date('Y'); ?> SweetLife. Tous droits réservés.</p>
        <p>Créé avec soin pour le suivi émotionnel et le bien-être quotidien.</p>
    </div>
</footer>
