<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SweetLife<?= isset($pageTitle) ? ' – ' . htmlspecialchars($pageTitle) : '' ?></title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&family=Cormorant+Garamond:wght@300;400;500;600&display=swap" rel="stylesheet" />

    <!-- CSS communs auth -->
    <link rel="stylesheet" href="/vue/css/theme-initial.css" />
    <link rel="stylesheet" href="/vue/css/authentification.css" />

    <!-- CSS spécifiques à la page -->
    <?php if (!empty($pageStyles)): ?>
        <?php foreach ($pageStyles as $css): ?>
            <link rel="stylesheet" href="/vue/css/<?= htmlspecialchars($css) ?>" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body>
    <!-- Éléments décoratifs flottants -->
    <div class="flottant flottant-1"></div>
    <div class="flottant flottant-2"></div>

    <?= $contenu ?>

    <?php if (!empty($pageScripts)): ?>
        <?php foreach ($pageScripts as $js): ?>
            <script src="/vue/js/<?= htmlspecialchars($js) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
