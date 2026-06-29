<?php
$pageTitle = 'Contact';
$mainClass = 'info-layout';

ob_start();
require_once __DIR__ . '/../vue/html/contact.php';
$contenu = ob_get_clean();

require_once __DIR__ . '/../vue/layout/main.php';
