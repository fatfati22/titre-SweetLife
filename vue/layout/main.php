<?php
$themeCouleurHaut = '#e8f5f0';
$themeCouleurBas = '#5aaa8a';
$themeCouleurTexte = '#0d2520';

if (!empty($_SESSION['user']['id'])) {
    require_once __DIR__ . '/../../model/traitUserHumeur.php';
    $themeHumeur = getDerniereHumeurUtilisateur((int) $_SESSION['user']['id']);

    if (!empty($themeHumeur)) {
        $themeCouleurHaut = $themeHumeur['couleur_haut'] ?: $themeCouleurHaut;
        $themeCouleurBas = $themeHumeur['couleur_bas'] ?: $themeCouleurBas;
    }
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SweetLife<?= isset($pageTitle) ? ' – ' . htmlspecialchars($pageTitle) : '' ?></title>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Cormorant+Garamond:wght@300;400;500;600&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="vue/css/admin.css" />
    <link rel="stylesheet" href="vue/css/historique.css" />
    <link rel="stylesheet" href="vue/css/filtre-repas.css" />
    <link rel="stylesheet" href="vue/css/mise-en-page.css" />
    <link rel="stylesheet" href="vue/css/theme-initial.css" />
    <link rel="stylesheet" href="vue/css/element-theme.css" />
    <link rel="stylesheet" href="vue/css/theme.css" />
    <link rel="stylesheet" href="vue/css/footer.css" />
    <link rel="stylesheet" href="vue/css/about.css" />
    <link rel="stylesheet" href="vue/css/humeur.css" />
    <link rel="stylesheet" href="vue/css/carte.css" />
    <link rel="stylesheet" href="vue/css/authentification.css" />
    <link rel="stylesheet" href="vue/css/modifProfil.css" />
    <link rel="stylesheet" href="vue/css/note.css" />
    <link rel="stylesheet" href="vue/css/oubli.css" />
    <link rel="stylesheet" href="vue/css/profil.css" />
    <link rel="stylesheet" href="vue/css/navbar.css" />
    <link rel="stylesheet" href="vue/css/style.css" />
    <link rel="stylesheet" href="vue/css/citation.css" />
    <link rel="stylesheet" href="vue/css/position-cercle-emojis.css" />

    <?php if (!empty($pageStyles)): ?>
        <?php foreach ($pageStyles as $css): ?>
            <link rel="stylesheet" href="vue/css/<?= htmlspecialchars($css) ?>" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body style="--couleur-haut: <?= htmlspecialchars($themeCouleurHaut) ?>; --couleur-bas: <?= htmlspecialchars($themeCouleurBas) ?>; --couleur-texte: <?= htmlspecialchars($themeCouleurTexte) ?>;">

    <?php include __DIR__ . '/../html/navbar.php'; ?>

    <main<?= !empty($mainClass) ? ' class="' . htmlspecialchars($mainClass) . '"' : '' ?>>
        <?= $contenu ?? ''; ?>
    </main>

    <?php include __DIR__ . '/../html/footer.php'; ?>

    <?php if (!empty($pageScripts)): ?>
        <?php foreach ($pageScripts as $js): ?>
            <script src="vue/js/<?= htmlspecialchars($js) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <script src="vue/js/theme.js"></script>
    <script src="vue/js/choisirHumeurMessage.js"></script>
    <script src="vue/js/citationScroll.js"></script>
    <script src="vue/js/animationCard.js"></script>
    <script src="vue/js/filtre.js"></script>
    <script src="vue/js/note.js"></script>
</body>

</html>
