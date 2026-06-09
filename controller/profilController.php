<?php


session_start();

require_once __DIR__ . '/../model/traitprofil.php';

// 🔒 sécurité
// if (!isset($_SESSION['user'])) {
//     header("Location: ../../vue/html/connexion.html");
//     exit();
// }

// 👤 récupération depuis BDD (optionnel mais propre)
$user = getUserByMail($_SESSION['user']['mail']);
// var_dump($user);


require_once __DIR__ . '/../vue/html/profil.php';
