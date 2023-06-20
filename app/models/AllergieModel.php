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
                   Allergie.comment,
                   Allergie.Id
            FROM Klant
            JOIN Product ON Klant.allergieId = Product.allergieId
            JOIN Allergie ON Klant.allergieId = Allergie.Id";

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
        $this->db->query("INSERT INTO Allergie(allergienaam, isActive, comment, createdAt, updatedAt)
                          VALUES(:allergienaam, :isActive, :comment, :createdAt, :updatedAt)");

        $this->db->bind(':allergienaam', $post["allergienaam"], PDO::PARAM_STR);
        $this->db->bind(':isActive', 1, PDO::PARAM_BOOL);
        $this->db->bind(':comment', $post["comment"], PDO::PARAM_STR);
        $this->db->bind(':createdAt', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);
        $this->db->bind(':updatedAt', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);

        $this->db->execute();
    }



    //Werkt het opgegeven contactrecord bij op basis van de opgegeven informatie
    public function updateAllergie($post)
{
    try {
        // $this->db->dbHandler()->beginTransaction();
        // var_dump($post);
        // exit();

        $this->db->query("UPDATE Allergie 
                        SET allergienaam = :allergienaam,
                            comment = :comment
                        WHERE Id = :id");

        $this->db->bind(':id', $post["Id"], PDO::PARAM_INT);
        $this->db->bind(':allergienaam', $post["allergienaam"], PDO::PARAM_STR);
        $this->db->bind(':comment', $post["comment"], PDO::PARAM_STR);

        $result = $this->db->execute();

        // $this->db->dbHandler()->commit();

        return $result;
    } catch (PDOException $e) {
        echo $e->getMessage() . " Rollback";
        //$this->db->dbHandler()->rollBack();
        return false;
    }
}

    // haalt het id op
    public function getSingleAllergie($id)
    {
        $this->db->query("SELECT allergienaam, comment, Id
                        FROM Allergie WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }


    // Voornaam contactrecords ophalen
    public function getAllergiesWithVoornaam()
    {
        $this->db->query("
          SELECT Klant.gezinsnaam
          FROM Klant
          JOIN Allergie ON Klant.allergieId = Allergie.Id
        ");
        return $this->db->resultSet();
    }
}




