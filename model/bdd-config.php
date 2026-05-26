<?php

// Adresse du serveur de base de données (localhost = ton ordinateur)
$host = "localhost";

// Nom d'utilisateur pour se connecter à la base de données
$user = "root";

// Mot de passe de l'utilisateur
$password = "admin";

// Nom de la base de données que tu veux utiliser
$database = "Sweetlife";

// Connexion à la base de données MySQL avec les informations ci-dessus
$conn = mysqli_connect($host, $user, $password, $database);

// Vérifie si la connexion a échoué
if (!$conn) {
    // Si erreur, on arrête le programme et on affiche le message d'erreur
    die("Erreur de connexion : " . mysqli_connect_error());
}
