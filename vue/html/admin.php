<?php
// Vue admin principale : elle charge une page séparée selon la section.
$section = $_GET['section'] ?? 'dashboard';

$adminPages = [
    'dashboard'    => __DIR__ . '/admin/dashboard.php',
    'humeurs'      => __DIR__ . '/admin/humeurs.php',
    'repas'        => __DIR__ . '/admin/repas.php',
    'exercices'    => __DIR__ . '/admin/exercices.php',
    'utilisateurs' => __DIR__ . '/admin/utilisateurs.php',
    'themes'       => __DIR__ . '/admin/themes.php',
];

if (!isset($adminPages[$section])) {
    $section = 'dashboard';
}
?>

<div class="admin-wrapper">
    <?php require __DIR__ . '/admin/sidebar.php'; ?>

    <div class="admin-content">
        <?php if (!empty($message)): ?>
            <div class="admin-alert success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <?php if (!empty($erreur)): ?>
            <div class="admin-alert error"><?= htmlspecialchars($erreur) ?></div>
        <?php endif; ?>

        <?php require $adminPages[$section]; ?>
    </div>
</div>
