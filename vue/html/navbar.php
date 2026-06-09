<header>
    <nav class="navbar glass">
        <img class="img" src="/vue/image/logo.png" alt="logo SweetLife" />

        <ul class="nav-links">
            <li><a href="index.php" class="actif">🏠 Accueil</a></li>

            <?php if (isset($_SESSION['user'])) : ?>
                <li><a href="exercice.html">🧘 Exercices</a></li>
                <li><a href="repas.html">🥗 Repas</a></li>
                <li><a href="historique.html">📊 Historique</a></li>
                <li><a href="../../controller/profilController.php">👤 Profil</a></li>
            <?php else : ?>
                <li class="disabled"><a href="#">🧘 Exercices 🔒</a></li>
                <li class="disabled"><a href="#">🥗 Repas 🔒</a></li>
                <li class="disabled"><a href="#">📊 Historique 🔒</a></li>
                <li class="disabled"><a href="#">👤 Profil 🔒</a></li>
            <?php endif; ?>
        </ul>

        <?php if (isset($_SESSION['user'])) : ?>
            <a class="btn-descop" href="../../controller/deconnexion.php">
                <button class="btn-primary" type="button">
                    🔓 Déconnexion
                </button>
            </a>
        <?php else : ?>
            <a class="btn-descop" href="inscription.html">
                <button class="btn-primary" type="button">
                    ✚ S'inscrire
                </button>
            </a>
        <?php endif; ?>
    </nav>
</header>