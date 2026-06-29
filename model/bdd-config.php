<?php

// Évite les erreurs fatales mysqli : les modèles gèrent les erreurs proprement.
mysqli_report(MYSQLI_REPORT_OFF);

// Fuseau horaire utilisé pour les formulaires date/heure et l'historique
date_default_timezone_set('Europe/Paris');

// Adresse du serveur de base de données
$host = "localhost";

// Nom d'utilisateur
$user = "root";

// Mot de passe
$password = "admin";

// Nom de la base de données
$database = "sweetlife";

// Connexion
$conn = mysqli_connect($host, $user, $password, $database);
mysqli_set_charset($conn, "utf8mb4");

// Synchroniser la session MySQL avec l'heure PHP actuelle
$offsetSeconds = (new DateTime())->getOffset();
$offsetSign = $offsetSeconds >= 0 ? '+' : '-';
$offsetSeconds = abs($offsetSeconds);
$offsetHours = floor($offsetSeconds / 3600);
$offsetMinutes = floor(($offsetSeconds % 3600) / 60);
$mysqlTimeZone = sprintf('%s%02d:%02d', $offsetSign, $offsetHours, $offsetMinutes);
mysqli_query($conn, "SET time_zone = '$mysqlTimeZone'");

// Vérification de la connexion
if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Fonction pour fermer la connexion
function closeDB($conn)
{
    if ($conn) {
        mysqli_close($conn);
    }
}