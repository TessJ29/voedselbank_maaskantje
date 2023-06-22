<?php
class Allergy
{
  // Eigenschappen, velden
  private $db;
  public $helper;

  public function __construct()
  {
    $this->db = new Database();
    // $this->helper = new SqlHelper();
  }

  /**
   * Haalt alle pakketten op met hun details
   * @return array Array van pakketten
   */
  public function getAllergies()
  {
    $this->db->query(
      'CALL `spViewAllergies`();'
    );
    $result = $this->db->resultSet();
    return $result;
  }

  public function getAllergiesByAllergy($id)
  {

    $this->db->query(
      'CALL `spViewAllergiesByAllergy`(:id);'
    );
    $this->db->bind(':id', $id);
    $result = $this->db->resultSet();
    return $result;
  }

  public function viewFamilyDetails($id)
  {

    $this->db->query(
      'CALL `spViewFamilyDetails`(:id);'
    );
    $this->db->bind(':id', $id);
    $result = $this->db->resultSet();
    return $result;
  }

  public function viewPersonAllergy($id)
  {

    $this->db->query(
      'CALL `spViewPersonAllergy`(:id);'
    );
    $this->db->bind(':id', $id);
    $result = $this->db->resultSet();
    return $result;
  }

  public function UpdatePersonAllergy($personId, $alergyId)
  {

    $this->db->query(
      'CALL `spUpdatePersonAllergy`(:personId, :allergyId);'
    );
    $this->db->bind(':personId', $personId);
    $this->db->bind(':allergyId', $alergyId);
    $result = $this->db->resultSet();
    return $result;
  }
}
