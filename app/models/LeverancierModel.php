<?php

class LeverancierModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllLeveranciers()
    {
        try {
            // Roep de stored procedure spViewLeveranciers
            $this->db->query("SELECT 
            Leverancier.Id,
            Leverancier.bedrijfsnaam, 
            Leverancier.contactpersoon, 
            Leverancier.email, 
            Leverancier.telefoonnummer,
            Adres.adres,
            ProductPerLeverancier.id AS pplId,
            Product.id AS productId,
            Product.productnaam,
            ProductPerLeverancier.datumeerstvolgendelevering,
            ProductPerLeverancier.tijdeerstvolgendelevering
        FROM Leverancier
        INNER JOIN Adres ON Adres.leverancierId = Leverancier.id
        INNER JOIN ProductPerLeverancier ON ProductPerLeverancier.leverancierId = Leverancier.id
        INNER JOIN Product ON Product.id = ProductPerLeverancier.productId");
            $result = $this->db->resultSet();
            return $result;
        } catch (PDOEXception $e) {
            echo $e->getMessage();
        }
    }

    public function getLeverancierById($leverancierId)
    {
        try {
            // Call the stored procedure spViewLeveranciers
            $this->db->query("SELECT 
                Leverancier.Id,
                Leverancier.bedrijfsnaam, 
                Leverancier.contactpersoon, 
                Leverancier.email, 
                Leverancier.telefoonnummer,
                Adres.adres,
                ProductPerLeverancier.id AS pplId,
                Product.id AS productId,
                Product.productnaam,
                ProductPerLeverancier.datumeerstvolgendelevering,
                ProductPerLeverancier.tijdeerstvolgendelevering
    
                FROM Leverancier
                INNER JOIN Adres
                ON Adres.leverancierId = Leverancier.Id
                INNER JOIN ProductPerLeverancier
                ON ProductPerLeverancier.leverancierId = Leverancier.id
                INNER JOIN Product
                ON Product.id = ProductPerLeverancier.productId
                WHERE leverancier.id = :leverancierId");
            $this->db->bind(':leverancierId', $leverancierId);
            $result = $this->db->Single();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function addLeveranciers($post)
    {
        try {
            $query_leverancier = "INSERT INTO Leverancier (bedrijfsnaam, contactpersoon, email, telefoonnummer, isActive, comment, createdAt, updatedAt)
            VALUES (:bedrijfsnaam, :contactpersoon, :email, :telefoonnummer, 1, NULL, SYSDATE(6), SYSDATE(6))";

            $query_adres = "INSERT INTO Adres (leverancierId, adres, isActive, comment, createdAt, updatedAt)
            VALUES (:leverancierId, :adres, 1, NULL, SYSDATE(6), SYSDATE(6))";

            $query_productPerLeverancier = "INSERT INTO ProductPerLeverancier (leverancierId, productId, datumeerstvolgendelevering, tijdeerstvolgendelevering, isActive, comment, createdAt, updatedAt)
            VALUES (:leverancierId, :productId, now(), now(), 1, NULL, SYSDATE(6), SYSDATE(6))";

            // Begin a transaction
            $this->db->beginTransaction();

            $this->db->query($query_leverancier);
            $this->db->bind(':bedrijfsnaam', $post['bedrijfsnaam']);
            $this->db->bind(':contactpersoon', $post['contactpersoon']);
            $this->db->bind(':email', $post['email']);
            $this->db->bind(':telefoonnummer', $post['telefoonnummer']);
            $this->db->execute();
            $leverancierId = $this->db->lastInsertId();

            $this->db->query($query_adres);
            $this->db->bind(':leverancierId', $leverancierId, PDO::PARAM_INT);
            $this->db->bind(':adres', $post['adres']);
            $this->db->execute();

            $this->db->query($query_productPerLeverancier);
            $this->db->bind(':leverancierId', $leverancierId, PDO::PARAM_INT);
            $this->db->bind(':productId', $post['productId']);

            $this->db->execute();
            $this->db->commit();
        } catch (PDOException $e) {

            $e->getMessage();
        }
    }



    public function editLeverancier($leverancierId, $post)
    {
        try {
            $query_leverancier = "UPDATE Leverancier
            SET bedrijfsnaam = :bedrijfsnaam,
                contactpersoon = :contactpersoon,
                email = :email,
                telefoonnummer = :telefoonnummer,
                updatedAt = SYSDATE(6)
            WHERE id = :leverancierId";


            $query_adres = "UPDATE Adres SET adres = :adres WHERE leverancierId = :leverancierId";


            $query_productPerLeverancier = "UPDATE ProductPerLeverancier
            SET productId = :productId,
                updatedAt = SYSDATE(6)
            WHERE leverancierId = :leverancierId";
            // Begin a transaction
            $this->db->beginTransaction();

            $this->db->query($query_leverancier);
            $this->db->bind(':bedrijfsnaam', $post['bedrijfsnaam']);
            $this->db->bind(':contactpersoon', $post['contactpersoon']);
            $this->db->bind(':email', $post['email']);
            $this->db->bind(':telefoonnummer', $post['telefoonnummer']);
            $this->db->bind(':leverancierId', $leverancierId, PDO::PARAM_INT);

            $this->db->execute();


            $this->db->query($query_adres);
            $this->db->bind(':adres', $post['adres']);
            $this->db->bind(':leverancierId', $leverancierId, PDO::PARAM_INT);
            $this->db->execute();

            $this->db->query($query_productPerLeverancier);
            $this->db->bind(':leverancierId', $leverancierId, PDO::PARAM_INT);
            $this->db->bind(':productId', $post['productId']);
            $this->db->execute();

            $this->db->commit();
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function deleteLeverancier($leverancierId)
    {
        try {
            $delete_productPerLeverancier = "DELETE FROM ProductPerLeverancier WHERE leverancierId = :leverancierId";
            $this->db->query($delete_productPerLeverancier);
            $this->db->bind(':leverancierId', $leverancierId, PDO::PARAM_INT);
            $this->db->execute();

            $delete_adres = "DELETE FROM Adres WHERE leverancierId = :leverancierId";
            $this->db->query($delete_adres);
            $this->db->bind(':leverancierId', $leverancierId, PDO::PARAM_INT);
            $this->db->execute();

            $delete_leverancier = "DELETE FROM Leverancier WHERE id = :leverancierId";
            $this->db->query($delete_leverancier);
            $this->db->bind(':leverancierId', $leverancierId, PDO::PARAM_INT);
            $this->db->execute();
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
