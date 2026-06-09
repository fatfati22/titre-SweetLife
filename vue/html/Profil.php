<?php
// sécurité : évite les erreurs si accès direct
$user = $_SESSION['user'];
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SweetLife – Mon Profil</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="/vue/css/theme-initial.css" />
    <link rel="stylesheet" href="/vue/css/element-theme.css" />
    <link rel="stylesheet" href="/vue/css/navbar.css" />
    <link rel="stylesheet" href="/vue/css/style.css" />
    <link rel="stylesheet" href="/vue/css/humeur.css" />
    <link rel="stylesheet" href="/vue/css/theme.css" />
    <link rel="stylesheet" href="/vue/css/profil.css" />
</head>

<body class="theme-calme">
    <header>

        <?php include(__DIR__ . '/navbar.php'); ?>

    </header>

    <main class="conteneur-page">
        <section class="enveloppe-profil">
            <!-- HERO -->
            <header class="en-tete-profil glass-card">
                <figure class="grand-avatar">
                    <span class="point-en-ligne"></span>
                </figure>

                <section>
                    <h1 class="nom-profil">
                        <?= htmlspecialchars($user['prenom']) ?>

                        <?= htmlspecialchars($user['nom']) ?>
                        !</h1>
                    <p class="email-profil"> <?= htmlspecialchars($user['mail']) ?>
                    </p>
                </section>
            </header>
            <p></p>

            <!-- CARDS -->
            <section class="bas-profil">
                <!-- MOOD -->
                <article class="mood-card glass-card">
                    <p>💫 État émotionnel actuel</p>

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
                            <p class="libelle-info">
                                Votre prénom et votre nom:
                            </p>
                            <p class="valeur-info">
                                <?= $user['prenom'] ?>

                                <?= $user['nom'] ?>
                            </p>
                        </div>

                        <div class="champ-info">
                            <p class="libelle-info">Email:</p>
                            <p class="valeur-info">
                            <p class="email-profil"> <?= $user['mail'] ?>
                            </p>
                            </p>
                        </div>
                        <div class="champ-info">
                            <p class="libelle-info">Membre depuis:</p>
                            <p class="valeur-info">
                            <p class="email-profil">
                                <?= $user['date_inscription'] ?>

                            </p>
                            </p>
                            </p>
                        </div>

                        <div class="champ-info">
                            <p class="libelle-info">Rôle:</p>
                            <p class="valeur-info">
                            <p class="email-profil"> <?= $user['role'] ?> </p>
                            </p>
                        </div>
                    </div>
                </article>
            </section>

            <span class="ligne-actions">
                <a class="btn-ghost" href="inscription.html">Modifier votre profil</a>
                <a class="btn-ghost" href="connexion.html">deconnexioion</a>
                <!-- <a class="btn-danger" href="index.html">🔒 Déconnexion</a> -->
            </span>
        </section>
    </main>

    <!-- ================= JS ================= -->
    <script src="/vue/js/animationCard.js"></script>
</body>

</html>