<?php
class KlantModel
{
    private $db;
    public $helper;

    public function __construct()
    {
        $this->db = new Database();
    }

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
