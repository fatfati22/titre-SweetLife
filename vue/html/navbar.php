<?php $route = $_GET['route'] ?? 'accueil'; ?>

<header>
    <nav class="navbar">

        <div class="nav-container">

            <a href="/index.php?route=accueil" class="logo">
                <img src="/vue/image/logo.png" alt="Logo SweetLife">
            </a>

            <ul class="nav-links">

                <li>
                    <a href="/index.php?route=accueil"
                        <?= $route === 'accueil' ? 'class="actif"' : '' ?>>
                        🏠 <span>Accueil</span>
                    </a>
                </li>

                <?php if (isset($_SESSION['user'])) : ?>

                    <li>
                        <a href="/index.php?route=exercice"
                            <?= $route === 'exercice' ? 'class="actif"' : '' ?>>
                            🧘 <span>Exercices</span>
                        </a>
                    </li>

                    <li>
                        <a href="/index.php?route=repas"
                            <?= $route === 'repas' ? 'class="actif"' : '' ?>>
                            🥗 <span>Repas</span>
                        </a>
                    </li>

                    <li>
                        <a href="/index.php?route=historique"
                            <?= $route === 'historique' ? 'class="actif"' : '' ?>>
                            📊 <span>Historique</span>
                        </a>
                    </li>

                    <li>
                        <a href="/index.php?route=profil"
                            <?= $route === 'profil' ? 'class="actif"' : '' ?>>
                            👤 <span>Profil</span>
                        </a>
                    </li>

                    <?php if (($_SESSION['user']['role'] ?? '') === 'admin') : ?>
                        <li>
                            <a href="/index.php?route=admin"
                                <?= $route === 'admin' ? 'class="actif"' : '' ?>>
                                ⚙️ <span>Admin</span>
                            </a>
                        </li>
                    <?php endif; ?>

                <?php else : ?>

                    <li class="disabled"><a href="#">🧘 <span>Exercices</span></a></li>
                    <li class="disabled"><a href="#">🥗 <span>Repas</span></a></li>
                    <li class="disabled"><a href="#">📊 <span>Historique</span></a></li>
                    <li class="disabled"><a href="#">👤 <span>Profil</span></a></li>

                <?php endif; ?>

            </ul>

            <?php if (isset($_SESSION['user'])) : ?>
                <a class="btn-primary btn-desktop"
                    href="/index.php?route=deconnexion">
                    Déconnexion
                </a>
            <?php else : ?>
                <a class="btn-primary btn-desktop"
                    href="/index.php?route=inscription">
                    S'inscrire
                </a>
            <?php endif; ?>

        </div>

    </nav>


    <?php if (isset($_SESSION['user'])) : ?>
        <a class="btn-primary btn-mobile"
            href="/index.php?route=deconnexion">
            Déconnexion
        </a>
    <?php else : ?>
        <a class="btn-primary btn-mobile"
            href="/index.php?route=inscription">
            S'inscrire
        </a>
    <?php endif; ?>




</header>