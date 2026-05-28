<?php
session_start();
?>

<header>
    <nav class="navbar glass">
        <img class="img" src="../image/logo.png" alt="logo SweetLife" />

        <ul class="nav-links">
            <li><a href="index.html" class="actif">🏠 Accueil</a></li>
            <li><a href="exercice.html">🧘 Exercices</a></li>
            <li><a href="repas.html">🥗 Repas</a></li>
            <li><a href="historique.html">📊 Historique</a></li>
            <li><a href="Profil.html">👤 Profil</a></li>
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
                    S'inscrire
                </button>
            </a>
        <?php endif; ?>
    </nav>

    <?php if (isset($_SESSION['user'])) : ?>
        <a class="btn-mobile btn-inscription-fixe" href="../../controller/deconnexion.php">
            <button class="btn-primary" type="button">
                🔓 Déconnexion
            </button>
        </a>
    <?php else : ?>
        <a class="btn-mobile btn-inscription-fixe" href="inscription.html">
            <button class="btn-primary" type="button">
                S'inscrire
            </button>
        </a>
    <?php endif; ?>
</header>