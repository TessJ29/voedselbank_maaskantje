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
    // public function updateAllergie($post)
    // {
    //     try {
    //         //$this->db->dbHandler()->beginTransaction();
    //         var_dump($post);
    //         exit();

    //         $this->db->query("UPDATE Allergie 
    //                       SET allergienaam = :allergienaam,
    //                           comment = :comment
    //                       WHERE id = :id");

    //         $this->db->bind(':id', $post["id"], PDO::PARAM_INT);
    //         $this->db->bind(':allergienaam', $post["allergienaam"], PDO::PARAM_STR);
    //         $this->db->bind(':comment', $post["comment"], PDO::PARAM_STR);

    //         $result = $this->db->execute();

    //         //$this->db->dbHandler()->commit();

    //         return $result;
    //     } catch (PDOException $e) {
    //         echo $e->getMessage() . " Rollback";
    //         //$this->db->dbHandler()->rollBack();
    //         return false;
    //     }
    // }



    public function getReserveringUpdate($id)
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

    private function GetPakketOptieId($pakketOptieNaam)
    {
        // var_dump($pakketOptieNaam);
        //exit();
        $sql = ("SELECT id FROM Allergie WHERE allergienaam = :allergienaam");
        $this->db->query($sql);
        $this->db->bind(':allergienaam', $pakketOptieNaam,  PDO::PARAM_STR);
        return $this->db->single();
    }



    public function ReserveringUpdate($post)
    {
        $pakketOptieNaam = $post['allergienaam'];
        $ReserveringId   = $post['id'];

        $pakketOptieId = $this->GetPakketOptieId($pakketOptieNaam);

        // var_dump($pakketOptieId);
        // exit();

        // var_dump($pakketOptieId);
        // var_dump($ReserveringId);
        // exit();
        $sql = ("UPDATE 	Allergie
                  SET 		PakketOptieId = :rra
                  WHERE	    id = :id");

        //$sql = ("UPDATE 	Reservering
        //SET 		PakketOptieId = 3
        //WHERE	    Id = 18");

        $this->db->query($sql);
        // $this->db->bind(':test', $pakketOptieId,  PDO::PARAM_INT);
        $this->db->bind(':id', $ReserveringId, PDO::PARAM_INT);
        $this->db->bind(':rra', $pakketOptieId->id, PDO::PARAM_INT);
        return $this->db->execute();
    }

    
}






/**


<?php
class AllergieModel
{
    private $db;
    public $helper;

    public function __construct()
    {
        $this->db = new Database();
    }

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

    public function deleteAllergie($id)
    {
        $this->db->query("DELETE FROM Allergie WHERE id = :id");
        $this->db->bind("id", $id, PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function getSingleAllergie($id)
    {
        $this->db->query("SELECT email, mobile, opmerking, Id
                        FROM contact WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    private function createAllergie($post) : void
    {
        $query = "INSERT INTO Allergie (allergienaam, isActive, comment, createdAt, updatedAt)
                  VALUES (:allergienaam, :isActive, :comment, :createdAt, :updatedAt)";

        $this->db->query($query);

        $this->db->bind(':allergienaam', $post["allergienaam"], PDO::PARAM_STR);
        $this->db->bind(':isActive', $post["isActive"], PDO::PARAM_STR);
        $this->db->bind(':comment', $post["comment"], PDO::PARAM_STR);
        $this->db->bind(':createdAt', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);
        $this->db->bind(':updatedAt', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);

        $this->db->execute();
    }

    private function getLastAllergieId() : mixed
    {
        $query = "SELECT id FROM Allergie ORDER BY id DESC LIMIT 1";
        $this->db->query($query);
        $result = $this->db->single();
        return $result;
    }

    public function create($post) : void
    {
        $this->createAllergie($post);
        $lastAllergieId = $this->getLastAllergieId()->id;

        $this->db->query("INSERT INTO contact (AllergieId, Email, Mobile, createdAt, Opmerking, DatumAangemaakt, DatumGewijzigd) 
                          VALUES (:allergieId, :email, :mobile, :createdAt, :opmerking, :datumAangemaakt, :datumGewijzigd)");

        $this->db->bind(':allergieId', $lastAllergieId, PDO::PARAM_INT);
        $this->db->bind(':email', $post["email"], PDO::PARAM_STR);
        $this->db->bind(':mobile', $post["mobile"], PDO::PARAM_STR);
        $this->db->bind(':createdAt', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);
        $this->db->bind(':opmerking', $post["opmerking"], PDO::PARAM_STR);
        $this->db->bind(':datumAangemaakt', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);
        $this->db->bind(':datumGewijzigd', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);

        $this->db->execute();
    }

    public function updateAllergie($post)
    {
        try {
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

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage() . " Rollback";
            return false;
        }
    }
}















<?php
class AllergieModel
{
    private $db;
    public $helper;

    public function __construct()
    {
        $this->db = new Database();
    }

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

    public function deleteAllergie($id)
    {
        $this->db->query("DELETE FROM Allergie WHERE id = :id");
        $this->db->bind("id", $id, PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function getSingleAllergie($id)
    {
        $this->db->query("SELECT email, mobile, opmerking, Id
                        FROM contact WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function getAllergiesWithVoornaam()
    {
        $this->db->query("
          SELECT Persoon.Voornaam
          FROM Contact
          JOIN Persoon ON Contact.PersoonId = Persoon.Id
        ");
        return $this->db->resultSet();
    }

    public function createAllergie($post)
    {
        try {
            $this->db->dbHandler()->beginTransaction();

            $this->db->query("INSERT INTO Allergie (allergienaam, isActive, comment, createdAt, updatedAt) 
                              VALUES (:allergienaam, :isActive, :comment, :createdAt, :updatedAt)");

            $this->db->bind(':allergienaam', $post["allergienaam"], PDO::PARAM_STR);
            $this->db->bind(':isActive', $post["isActive"], PDO::PARAM_BOOL);
            $this->db->bind(':comment', $post["comment"], PDO::PARAM_STR);
            $this->db->bind(':createdAt', date("Y-m-d H:i:s"), PDO::PARAM_STR);
            $this->db->bind(':updatedAt', date("Y-m-d H:i:s"), PDO::PARAM_STR);

            $this->db->execute();

            $lastAllergieId = $this->db->dbHandler()->lastInsertId();

            $this->db->query("INSERT INTO Klant (allergieid, gezinsnaam, adres, postcode, telefoon, email, isActive, comment, createdAt, updatedAt) 
                              VALUES (:allergieid, :gezinsnaam, :adres, :postcode, :telefoon, :email, :isActive, :comment, :createdAt, :updatedAt)");

            $this->db->bind(':allergieid', $lastAllergieId, PDO::PARAM_INT);
            $this->db->bind(':gezinsnaam', $post["gezinsnaam"], PDO::PARAM_STR);
            $this->db->bind(':adres', $post["adres"], PDO::PARAM_STR);
            $this->db->bind(':allergieid', $lastAllergieId, PDO::PARAM_INT);
            $this->db->bind(':gezinsnaam', $post["gezinsnaam"], PDO::PARAM_STR);
            $this->db->bind(':adres', $post["adres"], PDO::PARAM_STR);
            $this->db->bind(':postcode', $post["postcode"], PDO::PARAM_STR);
            $this->db->bind(':telefoon', $post["telefoon"], PDO::PARAM_STR);
            $this->db->bind(':email', $post["email"], PDO::PARAM_STR);
            $this->db->bind(':isActive', $post["isActive"], PDO::PARAM_BOOL);
            $this->db->bind(':comment', $post["comment"], PDO::PARAM_STR);
            $this->db->bind(':createdAt', date("Y-m-d H:i:s"), PDO::PARAM_STR);
            $this->db->bind(':updatedAt', date("Y-m-d H:i:s"), PDO::PARAM_STR);

            $this->db->execute();

            $this->db->dbHandler()->commit();

            return true;
        } catch (PDOException $e) {
            $this->db->dbHandler()->rollBack();
            return false;
        }
    }
}
?>






class AllergieModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

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

    public function deleteAllergie($id)
    {
        $this->db->query("DELETE FROM Allergie WHERE id = :id");
        $this->db->bind(":id", $id, PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function getSingleAllergie($id)
    {
        $this->db->query("SELECT gezinsnaam, Id
                        FROM Klant WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function getAllergiesWithVoornaam()
    {
        $this->db->query("SELECT Klant.gezinsnaam
                            FROM Klant");
        return $this->db->resultSet();
    }

    private function CreatePersoon($post): void
    {
        $query = "INSERT INTO Klant (allergieid, gezinsnaam, adres, postcode, telefoon, email, isActive, comment, createdAt, updatedAt) 
                  VALUES (:allergieid, :gezinsnaam, :adres, :postcode, :telefoon, :email, :isActive, :comment, :createdAt, :updatedAt)";

        $this->db->bind(':allergieid', $lastAllergieId, PDO::PARAM_INT);
        $this->db->bind(':gezinsnaam', $post["gezinsnaam"], PDO::PARAM_STR);
        $this->db->bind(':adres', $post["adres"], PDO::PARAM_STR);
        $this->db->bind(':postcode', $post["postcode"], PDO::PARAM_STR);
        $this->db->bind(':telefoon', $post["telefoon"], PDO::PARAM_STR);
        $this->db->bind(':email', $post["email"], PDO::PARAM_STR);
        $this->db->bind(':isActive', $post["isActive"], PDO::PARAM_BOOL);
        $this->db->bind(':comment', $post["comment"], PDO::PARAM_STR);
        $this->db->bind(':createdAt', date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $this->db->bind(':updatedAt', date("Y-m-d H:i:s"), PDO::PARAM_STR);

        $this->db->query($query);
        $this->db->execute();
    }

    private function GetLastPersoonId(): mixed
    {
        $query = "SELECT Id FROM Klant ORDER BY Id DESC LIMIT 1";
        $this->db->query($query);
        $result = $this->db->single();
        return $result;
    }

    public function createAllergie($post): void
    {
        $this->CreatePersoon($post);
        $laatstePersoonId = $this->GetLastPersoonId()->Id;

        $this->db->query("INSERT INTO Allergie(allergienaam, isActive, comment, createdAt, updatedAt)
                        VALUES(:allergienaam, :isActive, :comment, :createdAt, :updatedAt)");

        $this->db->bind(':allergienaam', $post["allergienaam"], PDO::PARAM_STR);
        $this->db->bind(':isActive', $post["isActive"], PDO::PARAM_STR);
        $this->db->bind(':comment', $post["comment"], PDO::PARAM_STR);
        $this->db->bind(':createdAt', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);
        $this->db->bind(':updatedAt', DateTimeHelper::ConvertDateTimeToString(), PDO::PARAM_STR);

        $this->db->execute();
    }

    public function updateAllergie($post)
    {
        try {
            $this->db->query("UPDATE Allergie 
                          SET allergienaam = :allergienaam,
                              comment = :comment
                          WHERE Id = :id");

            $this->db->bind(':id', $post["Id"], PDO::PARAM_INT);
            $this->db->bind(':allergienaam', $post["allergienaam"], PDO::PARAM_STR);
            $this->db->bind(':comment', $post["comment"], PDO::PARAM_STR);

            $result = $this->db->execute();

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage() . " Rollback";
            return false;
        }
    }
}


 */
