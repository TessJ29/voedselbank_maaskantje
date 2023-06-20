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
    $this->db->bind(':date', $date, PDO::PARAM_STR);
    $result = $this->db->resultSet();
    return $result;
  }

  public function deletePackage($id)
  {
    $this->db->query(
      'CALL `spDeletePackage`(:id);'
    );
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    $result = $this->db->resultSet();
    header('Location: ' . URLROOT . '/packages');
    return $result;
  }

  public function viewAllProducts()
  {

    $this->db->query(
      'CALL `spViewAllProducts`();'
    );

    $result = $this->db->resultSet();
    return $result;
  }

  public function increase($packageId, $productId)
  {
    $this->db->query(
      'CALL `spAddProductToPackage`(:packageId, :productId);'
    );
    $this->db->bind(':packageId', $packageId, PDO::PARAM_INT);
    $this->db->bind(':productId', $productId, PDO::PARAM_INT);
    $result = $this->db->resultSet();
    return $result;
  }

  public function decrease($packageId, $productId)
  {
    $this->db->query(
      'CALL `spRemoveProductFromPackage`(:packageId, :productId);'
    );
    $this->db->bind(':packageId', $packageId, PDO::PARAM_INT);
    $this->db->bind(':productId', $productId, PDO::PARAM_INT);
    $result = $this->db->resultSet();
    return $result;
  }

  public function link()
  {

    $this->db->query(
      'CALL `spLinkPackageProduct`();'
    );

    $result = $this->db->resultSet();
    return $result;
  }
}
