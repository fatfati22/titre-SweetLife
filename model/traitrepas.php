

<?php

class Repas
{
    private $conn;

    public function __construct($connexion)
    {
        $this->conn = $connexion;
    }

    public function getRepasById($id_repas)
    {
        $sql = "SELECT
        r.titre,
        r.description,
        c.nom AS categorie,
        t.nom AS type_repas,
        h.nom AS humeur
        FROM repas r
        INNER JOIN categorie c ON r.id_categorie = c.id
        INNER JOIN type_repas t ON r.id_type = t.id
        INNER JOIN humeur h ON r.id_humeur = h.id
        WHERE r.id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_repas);
        $stmt->execute();

        return $stmt->get_result();
    }
}
