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

  public function addPackage($date)
  {
    echo "create";
    $this->db->query(
      'CALL `spCreatePackage`(:date);'
    );

    $this->db->bind(':date', $date);
    $result = $this->db->resultSet();

    echo "get";
    $this->db->query(
      'CALL `spGetProductCount`();'
    );
    $result = $this->db->resultSet();

    for ($i = 1; $i < $result[0]->count; $i++) {
      echo $i;
      'CALL `spLinkProduct`(:i);';
      $this->db->bind(':i', $i);
      $result = $this->db->resultSet();
    }




    return $result;
  }
}
