<?php

class VoedselPakketModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function VoedselPakkettenByEetwens($eetwens)
    {
        // error catcher
        try {
            $this->db->query('SELECT 
                                gezin.Id as id,
                                gezin.Naam,
                                gezin.Omschrijving ,
                                gezin.AantalVolwassenen,
                                gezin.AantalKinderen,
                                gezin.AantalBabys,
                                persoon.Voornaam,
                                persoon.Tussenvoegsel,
                                persoon.Achternaam,
                                eetwens.naam as eetwens
                                
                            from gezin
                            inner join persoon
                            on gezin.Id = persoon.GezinId
                            inner join eetwenspergezin 
                            on gezin.Id = eetwenspergezin.GezinId
                            inner join eetwens
                            on eetwens.Id = eetwenspergezin.EetwensId
                            where (persoon.IsVertegenwoordiger = 1) and (eetwens.Naam = :Eetwens)
                            ');
            $this->db->bind(':Eetwens', $eetwens, PDO::PARAM_STR);

            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function VoedselPakkettenById($id)
    {

        // error catcher
        try {
            $this->db->query('SELECT DISTINCT
                                gezin.Id as id,
                                gezin.Naam ,
                                gezin.Omschrijving ,
                                gezin.TotaalAantalPersonen ,
                                voedselpakket.PakketNummer ,
                                voedselpakket.DatumSamenstelling ,
                                voedselpakket.DatumUitgifte ,
                                voedselpakket.Status,
        
                                voedselpakket.Id as pakketid  
                                
                            from gezin 
                            inner join voedselpakket
                            on gezin.Id = voedselpakket.GezinId
                            inner join productpervoedselpakket
                            on voedselpakket.Id = productpervoedselpakket.VoedselpakketId
                            where (gezin.Id = :Id)
                            ');
            $this->db->bind(':Id', $id, PDO::PARAM_INT);

            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function VoedselPakketten()
    {
        // error catcher
        try {
            $this->db->query('SELECT 
                                gezin.Id as id,
                                gezin.Naam as naam,
                                gezin.Omschrijving as omschrijving,
                                gezin.AantalVolwassenen as volwassenen,
                                gezin.AantalKinderen as kinderen,
                                gezin.AantalBabys as babys,
                                persoon.Voornaam as voornaam,
                                persoon.Tussenvoegsel as tussenvoegsel,
                                persoon.Achternaam as achternaam
                                
                            from gezin
                            inner join persoon
                            on gezin.Id = persoon.GezinId
                            where persoon.IsVertegenwoordiger = 1
                            ');
            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function VoedselPakketById($id)
    {

        // error catcher
        try {
            $this->db->query('SELECT 
                            Status as status,
                            Id as id,
                            GezinId as gezinid,
                            isActief as isactief
                            from voedselpakket
                            where (Id = :Id)
                            ');
            $this->db->bind(':Id', $id, PDO::PARAM_INT);

            return $this->db->single();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateStatus($data)
    {
        $datum = '';
        if ($data['status'] == "Uitgereikt") {
            $datum = date('Y-m-d');
        } else {
            $datum = null;
        }

        $this->db->query("UPDATE voedselpakket
                        set     Status = :status,
                                DatumUitgifte = :datumuitgifte,
                                DatumGewijzigd = :datumgewijzigd
                        where Id = :id;");
        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind(':status', $data['status'], PDO::PARAM_STR);
        $this->db->bind(':datumuitgifte', $datum, PDO::PARAM_STR);
        $this->db->bind(':datumgewijzigd', date('Y-m-d H:i:s'), PDO::PARAM_STR);


        return $this->db->execute();
    }
}

?>


<!-- 

ublic function viewFamilyDetails($id)
    {

        $this->db->query('  SELECT  Gezin.Naam, 
                                    Gezin.Omschrijving, 
                                    ProductPerVoedselpakket.AantalProductEenheden
                            FROM Gezin
                            INNER JOIN Voedselpakket ON Gezin.id = Voedselpakket.GezinId
                            INNER JOIN ProductPerVoedselpakket ON Voedselpakket.id = ProductPerVoedselpakket.VoedselpakketId;');

        $this->db->bind(':id', $id);
        $result = $this->db->resultSet();
        return $result;
    }



    public function getVoedselPakkettenByEetwens($eetwens)
    {
        // error catcher
        try {
            $this->db->query('SELECT 
                                gezin.Id as id,
                                gezin.Naam as naam,
                                gezin.Omschrijving as omschrijving,
                                gezin.AantalVolwassenen as volwassenen,
                                gezin.AantalKinderen as kinderen,
                                gezin.AantalBabys as babys,
                                persoon.Voornaam as voornaam,
                                persoon.Tussenvoegsel as tussenvoegsel,
                                persoon.Achternaam as achternaam,
                                eetwens.naam as eetwens
                                
                            from gezin
                            inner join persoon 
                            on gezin.Id = persoon.GezinId
                            inner join eetwenspergezin 
                            on gezin.Id = eetwenspergezin.GezinId
                            inner join eetwens
                            on eetwens.Id = eetwenspergezin.EetwensId
                            where (persoon.IsVertegenwoordiger = 1) and (eetwens.Naam = :Eetwens)
                            ');
            $this->db->bind(':Eetwens', $eetwens, PDO::PARAM_STR);

            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function VoedselPakkettenById($id)
    {
        // error catcher
        try {
            $this->db->query('SELECT DISTINCT
                                gezin.Id as id,
                                gezin.Naam as naam,
                                gezin.Omschrijving as omschrijving,
                                gezin.TotaalAantalPersonen as totaalaantalpersonen,
                                voedselpakket.PakketNummer as pakketnummer,
                                voedselpakket.DatumSamenstelling as datumsamengesteld,
                                voedselpakket.DatumUitgifte as datumuitgifte,
                                voedselpakket.Status as status,
                                productpervoedselpakket.AantalProductEenheden as aantalproducteenheden
                            from gezin 
                            inner join voedselpakket 
                            on gezin.Id = voedselpakket.GezinId
                            inner join productpervoedselpakket 
                            on voedselpakket.Id = productpervoedselpakket.VoedselpakketId
                            where (gezin.Id = :Id)
                            ');
            $this->db->bind(':Id', $id, PDO::PARAM_INT);

            return $this->db->resultSet();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


   



    p
} -->