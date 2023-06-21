<?php
//om databasebewerkingen uit te voeren
class VoedselpakketModel
{
    // Properties, fields
    private $db;
    public $helper;

    public function __construct()
    {
        $this->db = new Database();
    }
    // genereert een SQL-query om reserveringen op te halen
    public function getVoedselpakketten()
    {
        $sql = "SELECT  persoon.Voornaam, 
                        gezin.Omschrijving, 
                        gezin.AantalVolwassenen, 
                        gezin.AantalKinderen, 
                        gezin.AantalBabys, 
                        persoon.IsVertegenwoordiger, 
                        eetwens.Naam,
                        gezin.id
                FROM gezin
                INNER JOIN Persoon persoon ON gezin.id = persoon.GezinId
                INNER JOIN EetwensPerGezin eetwensPerGezin ON gezin.id = eetwensPerGezin.GezinId
                INNER JOIN Eetwens eetwens ON eetwensPerGezin.EetwensId = eetwens.id;";
        $this->db->query($sql);
        $result = $this->db->resultSet();
        return $result;
    }


    // public function getVoedselpakketUpdate()
    // {
    //     $this->db->query(" SELECT Persoon.Voornaam, ProductPerVoedselpakket.AantalProductEenheden, Product.Omschrijving
    //     FROM Persoon
    //     INNER JOIN Gezin ON Persoon.GezinId = Gezin.id
    //     INNER JOIN Voedselpakket ON Voedselpakket.GezinId = Gezin.id
    //     INNER JOIN ProductPerVoedselpakket ON ProductPerVoedselpakket.VoedselpakketId = Voedselpakket.id
    //     INNER JOIN Product ON Product.id = ProductPerVoedselpakket.ProductId;
    //     ");

        


        public function getVoedselpakketByEetwens($eetwens)
    {
        try {
            $this->db->query("SELECT
                                Persoon.Id AS PersoonId,
                                Persoon.Voornaam,
                                ProductPerVoedselpakket.AantalProductEenheden,
                                Product.Omschrijving,
                            FROM Persoon
                            INNER JOIN Gezin ON Gezin.Id = Persoon.GezinId
                            INNER JOIN Voedselpakket ON Voedselpakket.GezinId = Gezin.id
                            INNER JOIN ProductPerVoedselpakket ON ProductPerVoedselpakket.VoedselpakketId = Voedselpakket.id
                            INNER JOIN Product ON Product.id = ProductPerVoedselpakket.ProductId;
                            WHERE Eetwens.eetwens = :eetwens");

            $this->db->bind(':eetwens', $eetwens);
            $result = $this->db->resultSet();
            return $result;
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }






    // $this->db->query("SELECT  persoon.Voornaam, 
    //                     gezin.Omschrijving, 
    //                     gezin.AantalVolwassenen, 
    //                     gezin.AantalKinderen, 
    //                     gezin.AantalBabys, 
    //                     persoon.IsVertegenwoordiger, 
    //                     eetwens.Naam,
    //                     gezin.id
    //             FROM gezin
    //             INNER JOIN Persoon persoon ON gezin.id = persoon.GezinId
    //             INNER JOIN EetwensPerGezin eetwensPerGezin ON gezin.id = eetwensPerGezin.GezinId
    //             INNER JOIN Eetwens eetwens ON eetwensPerGezin.EetwensId = eetwens.id;");




    // // Maakt een SQL-query om het optiepakket uit de database te halen.
    // public function ($id)
    // {
    //     $this->db->query("  SELECT
    //                             Gezin.Naam AS naam,
    //                             Gezin.Omschrijving AS Omschrijving,
    //                             Gezin.TotaalAantalPersonen AS TotaalAantalPersonen,
    //                             Voedselpakket.PakketNummer AS PakketNummer,
    //                             Voedselpakket.DatumSamenstelling AS DatumSamenstelling,
    //                             Voedselpakket.DatumUitgifte AS DatumUitgifte,
    //                             Voedselpakket.Status AS Status,
    //                             SUM(ProductPerVoedselpakket.AantalProductEenheden) AS AantalProductEenheden
    //                         FROM
    //                             Gezin
    //                         JOIN
    //                             Voedselpakket ON Gezin.id = Voedselpakket.GezinId
    //                         JOIN
    //                             ProductPerVoedselpakket ON Voedselpakket.id = ProductPerVoedselpakket.VoedselpakketId

    //     ");
    //     $this->db->bind(':Id', $id, PDO::PARAM_INT);
    //     return $this->db->single();

    //     $result = $this->db->resultSet();

    //     return $result;
    // }







    // private function GetPakketOptieId($pakketOptieNaam)
    // {
    //     // var_dump($pakketOptieNaam);
    //     //exit();
    //     $sql = ("SELECT Id FROM Eetwens WHERE Naam = :naam");
    //     $this->db->query($sql);
    //     $this->db->bind(':naam', $pakketOptieNaam,  PDO::PARAM_STR);
    //     return $this->db->single();
    // }
}
