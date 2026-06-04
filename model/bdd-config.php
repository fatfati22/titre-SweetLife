<?php

// Adresse du serveur de base de données
$host = "localhost";

// Nom d'utilisateur
$user = "root";

// Mot de passe
$password = "admin";

// Nom de la base de données
$database = "Sweetlife";

// Connexion
$conn = mysqli_connect($host, $user, $password, $database);

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
