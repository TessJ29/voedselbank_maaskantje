<?php

class KlantModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

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

    public function getKlantById($klantId)
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
}
