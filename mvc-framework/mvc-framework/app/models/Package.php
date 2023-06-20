<?php
class Package
{
  // Properties, fields
  private $db;
  public $helper;

  public function __construct()
  {
    $this->db = new Database();
    //   $this->helper = new SqlHelper();
  }

  public function getPackages()
  {
    $this->db->query(
      'CALL `spViewPackages`();'
    );
    $result = $this->db->resultSet();
    return $result;
  }

  public function getPackageContent($id)
  {
    $this->db->query(
      'CALL `spViewPackageContent`(:id);'
    );
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    $result = $this->db->resultSet();
    return $result;
  }

  public function createPackage($date)
  {
    $this->db->query(
      'CALL `spAddPackage`(:id);'
    );
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    $result = $this->db->resultSet();
    return $result;
  }
}
