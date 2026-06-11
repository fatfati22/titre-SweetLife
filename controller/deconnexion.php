<?php
// session déjà démarrée dans le router

session_unset();
session_destroy();

header('Location: /index.php?route=accueil');
exit();
