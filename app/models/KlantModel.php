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
}
