<?php

require_once "bdd-config.php";

class TraitUserHumeurModel
{
    private $connexion;

    public function __construct($connexion)
    {
        $this->connexion = $connexion;
    }

    // Requête préparée avec INNER JOIN :
    // Afficher les humeurs d'un utilisateur
    public function getHumeursByUser($idUser)
    {
        $sql = "SELECT h.nom, uh.date_enregistrement
                FROM user_humeur uh
                INNER JOIN humeur h ON uh.id_humeur = h.id
                INNER JOIN user u ON uh.id_user = u.id
                WHERE u.id = ?";

        $stmt = mysqli_prepare($this->connexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $idUser);
        mysqli_stmt_execute($stmt);

        return mysqli_stmt_get_result($stmt);
    }

    // Requête préparée avec INNER JOIN :
    // Afficher les utilisateurs ayant une humeur donnée
    public function getUsersByHumeur($idHumeur)
    {
        $sql = "SELECT u.nom, u.prenom, h.nom AS humeur
                FROM user_humeur uh
                INNER JOIN user u ON uh.id_user = u.id
                INNER JOIN humeur h ON uh.id_humeur = h.id
                WHERE h.id = ?";

        $stmt = mysqli_prepare($this->connexion, $sql);
        mysqli_stmt_bind_param($stmt, "i", $idHumeur);
        mysqli_stmt_execute($stmt);

        return mysqli_stmt_get_result($stmt);
    }
}
