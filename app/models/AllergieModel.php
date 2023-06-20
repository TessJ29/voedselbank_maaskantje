<?php
class AllergieModel
{
    // Properties, fields
    private $db;
    public $helper;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Voert de SQL-query uit en haalt de resultaatset op


    public function getAllergie()
    {
        $sql = "SELECT Klant.gezinsnaam, 
                   Product.productnaam, 
                   Allergie.allergienaam, 
                   Klant.comment,
                   Allergie.id
            FROM Klant
            JOIN Product ON Klant.allergieid = Product.allergieid
            JOIN Allergie ON Klant.allergieid = Allergie.id";

        $this->db->query($sql);
        $result = $this->db->resultSet();
        return $result;
    }



    // Verwijdert een communicatierecord met de opgegeven id
    public function deleteAllergie($id)
    {
        $this->db->query("DELETE FROM Allergie WHERE id = :id");
        $this->db->bind("id", $id, PDO::PARAM_INT);
        return $this->db->execute();
    }


    // maakt een nieuw contactrecord aan
    public function createAllergie($post): void
    {
        $this->db->query("INSERT INTO Allergie(allergienaam,  comment, createdAt, updatedAt)
                          VALUES(:allergienaam,  :comment, :createdAt, :updatedAt)");

        $this->db->bind(':allergienaam', $post["allergienaam"], PDO::PARAM_STR);
        $this->db->bind(':comment', $post["comment"], PDO::PARAM_STR);
        $this->db->bind(':createdAt', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);
        $this->db->bind(':updatedAt', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);

        $this->db->execute();
    }

    //Werkt het opgegeven contactrecord bij op basis van de opgegeven informatie
    public function updateAllergie($post)
    {
        try {
            $this->db->query("UPDATE Allergie 
                      SET allergienaam = :allergienaam,
                          comment = :comment
                      WHERE id = :id");

            $this->db->bind(':id', $post["id"], PDO::PARAM_INT);
            $this->db->bind(':allergienaam', $post["allergienaam"], PDO::PARAM_STR);
            $this->db->bind(':comment', $post["comment"], PDO::PARAM_STR);

            $result = $this->db->execute();

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage() . " Rollback";
            return false;
        }
    }


    public function getUpdate($id)
    {
        $this->db->query("  SELECT       Klant.gezinsnaam, 
                                Product.productnaam, 
                                Allergie.allergienaam,
                                Allergie.id,
                                Klant.comment
                    FROM Klant
                    JOIN Product ON Klant.allergieid = Product.allergieid
                    JOIN Allergie ON Klant.allergieid = Allergie.id;");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();

        $result = $this->db->resultSet();

        return $result;
    }
}
