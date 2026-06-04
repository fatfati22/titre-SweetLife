<?php



session_start();



?>



<!doctype html>
<html lang="fr" class="theme-calme">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SweetLife</title>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Cormorant+Garamond&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="../css/footer.css" />
    <link rel="stylesheet" href="../css/element-theme.css" />
    <link rel="stylesheet" href="../css/theme.css" />
    <link rel="stylesheet" href="../css/position-cercle-emojis.css" />
    <link rel="stylesheet" href="../css/navbar.css" />
    <link rel="stylesheet" href="../css/theme-initial.css" />
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body class="theme-calme">
    <?php include(__DIR__ . '/navbar.php'); ?>



    <main>
        <section class="hero">
            <article class="hero-content">
                <img
                    class="mobile"
                    src="../image/logo.png"
                    alt="le logo de site SweetLife" />
                <section class="centrer">
                    <h1>
                        Comment vas-tu
                        <span class="couleur">aujourd’hui <?php if (isset($_SESSION['user'])): ?>

                                <?php echo $_SESSION['user']['prenom']; ?>
                                <?php echo $_SESSION['user']['nom']; ?> !
                            <?php else: ?>
                                Invité!
                            <?php endif; ?> </span>
                    </h1>


                    <p>
                        Choisis ton humeur pour recevoir des
                        recommandations.
                    </p>

                    <div class="alig">
                        <button class="btn-primary marg">
                            🌸 Choisir mon humeur
                        </button>
                        <button class="btn-ghost">
                            <a href="oubli.html">
                                😬 vous avez oublier de noter votre
                                humeurs</a>
                        </button>
                    </div>
                </section>

                <!-- FLEUR -->
                <section class="mood-wheel">
                    <button
                        class="mood-btn"
                        onclick="setTheme('theme-joie')">
                        😊
                    </button>
                    <button
                        class="mood-btn"
                        onclick="setTheme('theme-tristesse')">
                        😢
                    </button>
                    <button
                        class="mood-btn"
                        onclick="setTheme('theme-colere')">
                        😠
                    </button>
                    <button
                        class="mood-btn"
                        onclick="setTheme('theme-fatigue')">
                        😴
                    </button>
                    <button
                        class="mood-btn"
                        onclick="setTheme('theme-calme')">
                        😌
                    </button>
                    <button
                        class="mood-btn"
                        onclick="setTheme('theme-stress')">
                        😰
                    </button>

                    <!-- CENTRE -->
                    <button class="mood-btn center">🌸</button>
                </section>
            </article>
        </section>
    </main>

    <footer class="glass-card">
        <img src="../image/logo.png" alt="logo footer" />
        <p>site Public</p>
        <p>Panel admin V3.SweetLife2025</p>
    </footer>

    <script>
        function setTheme(theme) {
            document.body.className = theme;
        }
    </script>
</body>

</html>