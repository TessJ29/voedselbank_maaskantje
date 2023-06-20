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
            $this->db->query("CALL spViewLeveranciers()");
            $result = $this->db->resultSet();
            return $result;
        } catch (PDOEXception $e) {
            echo $e->getMessage();
        }
    }
}
