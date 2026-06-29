<?php

session_start();

$route = $_GET['route'] ?? 'accueil';

switch ($route) {

    case 'accueil':


        require_once __DIR__ . '/controller/accueilController.php';
        break;

    case 'connexion':
        require_once __DIR__ . '/controller/connexionController.php';
        break;

    case 'inscription':
        require_once __DIR__ . '/controller/inscritController.php';
        break;

    case 'profil':
        require_once __DIR__ . '/controller/profilController.php';
        break;

    case 'modifProfil':
        require_once __DIR__ . '/controller/modifProfilController.php';
        break;

    case 'historique':
        require_once __DIR__ . '/controller/historiqueController.php';
        break;

    case 'exercice':
        require_once __DIR__ . '/controller/exerciceController.php';
        break;

    case 'repas':
        require_once __DIR__ . '/controller/repasController.php';
        break;

    case 'admin':
        require_once __DIR__ . '/controller/adminController.php';
        break;

    case 'note':
        // var_dump($_SERVER);
        require_once __DIR__ . '/controller/noteController.php';

        break;
case 'UserHumeur':
    require_once __DIR__ . '/controller/userHumeurController.php';
    break;
    case 'humeur':
    require_once __DIR__ . '/controller/humeurController.php';
    break;
    case 'deconnexion':
        require_once __DIR__ . '/controller/deconnexion.php';
        break;


    case 'about':
        require_once __DIR__ . '/controller/aboutController.php';
        break;

    case 'contact':
        require_once __DIR__ . '/controller/contactController.php';
        break;

    case 'mentions':
        require_once __DIR__ . '/controller/mentionsController.php';
        break;

    case 'oubli':
        require_once __DIR__ . '/controller/oubliController.php';
        break;

 
    default:
        http_response_code(404);
        echo "<h1>404 – Page introuvable oooo</h1>";
        break;
}