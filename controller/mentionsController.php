<?php
$pageTitle = 'Mentions légales';
$mainClass = 'info-layout';

ob_start();
require_once __DIR__ . '/../vue/html/mentions.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
