<?php
  class InstructeurModel {
    // Properties, fields
    private $db;
    public $helper;

    public function __construct() {
      $this->db = new Database();
    }


    public function getInstructeurs() {
      $sql = "SELECT  Instructeur1.Voornaam
                     ,Instructeur1.Tussenvoegsel
                     ,Instructeur1.Achternaam
                     ,Instructeur1.Mobiel
                     ,Instructeur1.DatumInDienst
                     ,Instructeur1.AantalSterren
                     ,Instructeur1.Id
              FROM `Instructeur1` 
              ORDER BY AantalSterren DESC;";
      $this->db->query($sql);
      $result = $this->db->resultSet();
      return $result;
    }

    public function getInstructeurById($Id) 
    {
        $sql = "SELECT  Instructeur1.Voornaam
                        ,Instructeur1.Tussenvoegsel
                        ,Instructeur1.Achternaam
                        ,Instructeur1.DatumInDienst
                        ,Instructeur1.AantalSterren
                        FROM Instructeur1 
                        WHERE Id = :Id;";
        $this->db->query($sql);
        $this->db->bind(':Id', $Id, PDO::PARAM_INT);
        $result = $this->db->single();
        return $result;
    }

    public function getGebruikteVoertuigen($Id) 
    {
        $sql = "SELECT   TypeVoertuig.TypeVoertuig
                        ,Typevoertuig.Rijbewijscategorie
                        ,Voertuig.Type
                        ,Voertuig.Kenteken
                        ,Voertuig.Bouwjaar
                        ,Voertuig.Brandstof

                FROM    Instructeur1
                INNER JOIN VoertuigInstructeur
                ON         VoertuigInstructeur.Instructeur1Id = Instructeur1.Id
                INNER JOIN Voertuig
                ON         VoertuigInstructeur.VoertuigId = Voertuig.Id
                INNER JOIN TypeVoertuig
                ON         Voertuig.TypeVoertuigId = TypeVoertuig.Id
                WHERE   Instructeur1.Id = :Id
                ORDER BY TypeVoertuig.Rijbewijscategorie ASC";
        $this->db->query($sql);
        $this->db->bind(':Id', $Id, PDO::PARAM_INT);
        $result = $this->db->resultSet();
        return $result;
    }

   
  }