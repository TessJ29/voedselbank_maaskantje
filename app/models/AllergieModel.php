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
                   Klant.comment
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


    



    // haalt het id op
    public function getSingleAllergie($id)
    {
        $this->db->query("SELECT email, mobile, opmerking, Id
                        FROM contact WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    // Voornaam contactrecords ophalen
    public function getAllergiesWithVoornaam()
    {
        $this->db->query("
          SELECT Persoon.Voornaam
          FROM Contact
          JOIN Persoon ON Contact.PersoonId = Persoon.Id
        ");
        return $this->db->resultSet();
    }

    private function CreatePersoon($post) : void
    {        //exit();
        $query = "INSERT INTO Allergie(   allergienaam
                                        ,isActive
                                        ,comment
                                        ,createdAt
                                        ,updatedAt)
                VALUE(:allergienaam, :isActive, :comment, :createdAt, :updatedAt);";

        $this->db->query($query);       

        $this->db->bind(':allergienaam', $post["allergienaam"], PDO::PARAM_STR);
        $this->db->bind(':isActive', $post["isActive"], PDO::PARAM_STR);
        $this->db->bind(':comment', $post["comment"], PDO::PARAM_STR);
        $this->db->bind(':createdAt', 1, PDO::PARAM_BOOL);
        $this->db->bind(':opmerking', $post["opmerking"], PDO::PARAM_STR);
        $this->db->bind(':datumAangemaakt', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);
        $this->db->bind(':datumGewijzigd', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);

        $this->db->execute();
    }

    private function GetLastPersoonId() : mixed
    {
        $query = "SELECT Id FROM Klant ORDER BY Id DESC LIMIT 1;"; 
        $this->db->query($query); 
        $result = $this->db->single();
        return $result;
    }

    // maakt een nieuw contactrecord aan
    public function createAllergie($post) : void
    {
        $this->CreatePersoon($post);
        $laatstePersoonId = $this->GetLastPersoonId()->Id;

        $this->db->query("INSERT INTO contact(PersoonId, Email, Mobile, createdAt, Opmerking, DatumAangemaakt, DatumGewijzigd) 
                              VALUES(:persoonId, :email, :mobile, :createdAt, :opmerking, :datumAangemaakt, :datumGewijzigd)");

        $this->db->bind(':persoonId', $laatstePersoonId, PDO::PARAM_INT);
        $this->db->bind(':email', $post["email"], PDO::PARAM_STR);
        $this->db->bind(':mobile', $post["mobile"], PDO::PARAM_STR);
        $this->db->bind(':createdAt', 1, PDO::PARAM_BOOL);
        $this->db->bind(':opmerking', $post["opmerking"], PDO::PARAM_STR);
        $this->db->bind(':datumAangemaakt', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);
        $this->db->bind(':datumGewijzigd', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);

        $this->db->execute();
    }


    //Werkt het opgegeven contactrecord bij op basis van de opgegeven informatie
    public function updateAllergie($post)
    {
        try {
            //$this->db->dbHandler()->beginTransaction();
            //var_dump($post);
            //exit();

            $this->db->query("UPDATE contact 
                          SET Email = :email,
                              Mobile = :mobile,
                              Opmerking = :opmerking
                          WHERE Id = :id");

            $this->db->bind(':id', $post["Id"], PDO::PARAM_INT);
            $this->db->bind(':email', $post["email"], PDO::PARAM_STR);
            $this->db->bind(':mobile', $post["mobile"], PDO::PARAM_STR);
            $this->db->bind(':opmerking', $post["opmerking"], PDO::PARAM_STR);

            $result = $this->db->execute();

            //$this->db->dbHandler()->commit();

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage() . " Rollback";
            //$this->db->dbHandler()->rollBack();
            return false;
        }
    }
}
