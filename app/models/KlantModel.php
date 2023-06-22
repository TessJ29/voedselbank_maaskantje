<?php

class KlantModel
{
    private $db;
    public $helper;

    public function __construct()
    {
        $this->db = new Database();
    }

// Dag 3
    public function getAllKlanten()
    {
        try {
            $this->db->query("SELECT
                Persoon.Id AS PersoonId,
                Persoon.IsVertegenwoordiger,
                Gezin.Naam,
                Persoon.VolledigNaam,
                Contact.Email,
                Contact.Mobiel,
                Contact.Adres,
                Contact.Postcode,
                Contact.Woonplaats
              FROM Persoon
              INNER JOIN Gezin ON Gezin.Id = Persoon.GezinId
              INNER JOIN ContactPerGezin ON ContactPerGezin.GezinId = Gezin.Id
              INNER JOIN Contact ON Contact.Id = ContactPerGezin.ContactId");
            $result = $this->db->resultSet();
            return $result;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    public function getKlantenByPostcode($postcode)
    {
        try {
            $this->db->query("SELECT
            Persoon.Id AS PersoonId,
            Persoon.IsVertegenwoordiger,
            Gezin.Naam,
            Persoon.VolledigNaam,
            Contact.Email,
            Contact.Mobiel,
            Contact.Adres,
            Contact.Postcode,
            Contact.Woonplaats
          FROM Persoon
          INNER JOIN Gezin ON Gezin.Id = Persoon.GezinId
          INNER JOIN ContactPerGezin ON ContactPerGezin.GezinId = Gezin.Id
          INNER JOIN Contact ON Contact.Id = ContactPerGezin.ContactId
          WHERE Contact.Postcode = :postcode");

            $this->db->bind(':postcode', $postcode);
            $result = $this->db->resultSet();
            return $result;
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    public function getKlantenById($klantId)
    {
        $this->db->query("SELECT
        Persoon.Id AS PersoonId,
        Persoon.IsVertegenwoordiger,
        Persoon.voornaam,
        Persoon.Tussenvoegsel,
        Persoon.Achternaam,
        Persoon.Geboortedatum,
        Persoon.TypePersoon,
        Persoon.IsVertegenwoordiger,
        Persoon.VolledigNaam,
        Contact.Straat,
        Contact.Huisnummer,
        Contact.Toevoeging,
        Contact.Postcode,
        Contact.Woonplaats,
        Contact.Email,
        Contact.Mobiel
      FROM Persoon
      INNER JOIN Gezin ON Gezin.Id = Persoon.GezinId
      INNER JOIN ContactPerGezin ON ContactPerGezin.GezinId = Gezin.Id
      INNER JOIN Contact ON Contact.Id = ContactPerGezin.ContactId
      WHERE Persoon.Id = :klantId");
        $this->db->bind(':klantId', $klantId);
        $result = $this->db->single();
        return $result;
    }

    public function editKlant($klantId, $post)
    {
        $this->db->query("UPDATE Persoon
        INNER JOIN Gezin ON Gezin.Id = Persoon.GezinId
        INNER JOIN ContactPerGezin ON ContactPerGezin.GezinId = Gezin.Id
        INNER JOIN Contact ON Contact.Id = ContactPerGezin.ContactId
        SET Persoon.IsVertegenwoordiger = :IsVertegenwoordiger,
            Persoon.voornaam = :voornaam,
            Persoon.Tussenvoegsel = :Tussenvoegsel,
            Persoon.Achternaam = :Achternaam,
            Persoon.Geboortedatum = :Geboortedatum,
            Persoon.TypePersoon = :TypePersoon,
            Contact.Straat = :Straat,
            Contact.Huisnummer = :Huisnummer,
            Contact.Toevoeging = :Toevoeging,
            Contact.Postcode = :Postcode,
            Contact.Woonplaats = :Woonplaats,
            Contact.Email = :Email,
            Contact.Mobiel = :Mobiel
            WHERE Persoon.Id = :persoonId AND Contact.Postcode LIKE '5271%'");

        $this->db->bind(':persoonId', $klantId);
        $this->db->bind(':IsVertegenwoordiger', $post['IsVertegenwoordiger']);
        $this->db->bind(':voornaam', $post['voornaam']);
        $this->db->bind(':Tussenvoegsel', $post['Tussenvoegsel']);
        $this->db->bind(':Achternaam', $post['Achternaam']);
        $this->db->bind(':Geboortedatum', $post['Geboortedatum']);
        $this->db->bind(':TypePersoon', $post['TypePersoon']);
        $this->db->bind(':Straat', $post['Straat']);
        $this->db->bind(':Huisnummer', $post['Huisnummer']);
        $this->db->bind(':Toevoeging', $post['Toevoeging']);
        $this->db->bind(':Postcode', $post['Postcode']);
        $this->db->bind(':Woonplaats', $post['Woonplaats']);
        $this->db->bind(':Email', $post['Email']);
        $this->db->bind(':Mobiel', $post['Mobiel']);
        $this->db->execute();
    }
//       Dag 2
    public function getKlanten()
    {
        $this->db->query('SELECT Klant.id
                                ,Klant.gezinsnaam
                                ,Klant.adres
                                ,Klant.postcode
                                ,Klant.telefoon
                                ,Klant.email
                                ,Klant.aantalvolwassenen
                                ,Klant.aantalkinderen
                                ,Klant.aantalbaby
                                ,KlantWens.wens
                          from Wensperklant
                          inner join Klant on Wensperklant.klantid = Klant.id
                          inner join Klantwens on Wensperklant.klantwensid = Klantwens.id;');
        $result = $this->db->resultSet();
        return $result;
    }

    public function getKlantById($Id)
    {
        $this->db->query('SELECT Klant.id
                                ,Klant.gezinsnaam
                                ,Klant.adres
                                ,Klant.postcode
                                ,Klant.telefoon
                                ,Klant.email
                                ,Klant.aantalvolwassenen
                                ,Klant.aantalkinderen
                                ,Klant.aantalbaby
                                ,KlantWens.wens
                          from Wensperklant
                          inner join Klant on Wensperklant.klantid = Klant.id
                          inner join Klantwens on Wensperklant.klantwensid = Klantwens.id
                          where Klant.Id = :Id;');
        $this->db->bind(':Id', $Id, PDO::PARAM_INT);
        return $this->db->single();
    }

    public function KlantCreate($post)
    {
        $this->db->query("INSERT INTO Klant (gezinsnaam, adres, postcode, telefoon, email, aantalvolwassenen, aantalkinderen, aantalbaby)
        VALUES(:gezinsnaam, :adres, :postcode, :telefoon, :email, :aantalvolwassenen, :aantalkinderen, :aantalbaby)");

        $this->db->bind(':gezinsnaam', $post["gezinsnaam"], PDO::PARAM_STR);
        $this->db->bind(':adres', $post["adres"], PDO::PARAM_STR);
        $this->db->bind(':postcode', $post["postcode"], PDO::PARAM_STR);
        $this->db->bind(':telefoon', $post["telefoon"], PDO::PARAM_STR);
        $this->db->bind(':email', $post["email"], PDO::PARAM_STR);
        $this->db->bind(':aantalvolwassenen', $post["aantalvolwassenen"], PDO::PARAM_INT);
        $this->db->bind(':aantalkinderen', $post["aantalkinderen"], PDO::PARAM_INT);
        $this->db->bind(':aantalbaby', $post["aantalbaby"], PDO::PARAM_INT);

        $this->db->execute();

        $this->db->query("SELECT MAX(id) AS last_id FROM Klant");
        $result = $this->db->single();
        $klantId = $result['last_id'];

        $this->db->query("INSERT INTO Wensperklant (klantid)
        VALUES(:klantid)");

        $this->db->bind(':klantid', $klantId, PDO::PARAM_INT);

        return $this->db->execute();
    }




    public function KlantDelete($id)
    {
        $this->db->query('DELETE Wensperklant from Wensperklant
        inner join Klant on Wensperklant.klantid = Klant.id
        where Klant.id = :Id');
        $this->db->bind(':Id', $id, PDO::PARAM_INT);
        $this->db->execute();

        $this->db->query('DELETE FROM Klant WHERE Klant.id = :Id');
        $this->db->bind(':Id', $id, PDO::PARAM_INT);
        $this->db->execute();

        return $this->db->execute();
    }

    public function KlantUpdate($post)
    {
        $this->db->query("UPDATE `Wensperklant`
                         inner join `Klant`on Wensperklant.klantid = Klant.id
                         inner join `Klantwens` on Wensperklant.klantwensid = Klantwens.id
                         set Klant.gezinsnaam = :gezinsnaam,
                             Klant.adres = :adres,
                             Klant.postcode = :postcode,
                             Klant.telefoon = :telefoon,
                             Klant.email = :email,
                             Klant.aantalvolwassenen = :aantalvolwassenen,
                             Klant.aantalkinderen = :aantalkinderen,
                             Klant.aantalbaby = :aantalbaby,
                             Klantwens.wens = :wens
                         where Klant.id = :Id");
        $this->db->bind(':gezinsnaam', $post["gezinsnaam"], PDO::PARAM_STR);
        $this->db->bind(':adres', $post["adres"], PDO::PARAM_STR);
        $this->db->bind(':postcode', $post["postcode"], PDO::PARAM_STR);
        $this->db->bind(':telefoon', $post["telefoon"], PDO::PARAM_STR);
        $this->db->bind(':email', $post["email"], PDO::PARAM_STR);
        $this->db->bind(':aantalvolwassenen', $post["aantalvolwassenen"], PDO::PARAM_INT);
        $this->db->bind(':aantalkinderen', $post["aantalkinderen"], PDO::PARAM_INT);
        $this->db->bind(':aantalbaby', $post["aantalbaby"], PDO::PARAM_INT);
        $this->db->bind(':wens', $post["wens"], PDO::PARAM_STR);
        $this->db->bind(':Id', $post["id"], PDO::PARAM_INT);
        return $this->db->execute();
    }
}
