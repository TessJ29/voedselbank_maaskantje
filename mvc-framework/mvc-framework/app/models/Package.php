<?php
class Package
{
  // Eigenschappen, velden
  public $db;
  public $helper;
  public $packageModel;


  public function __construct()
  {
    $this->db = new Database();
    // $this->helper = new SqlHelper();
  }

  /**
   * Haalt alle pakketten op met hun details
   * @return array Array van pakketten
   */
  public function getPackages()
  {
    $this->db->query(
      'CALL `spViewPackages`();'
    );
    $result = $this->db->resultSet();
    return $result;
  }

  /**
   * Haalt de inhoud van een specifiek pakket op
   * @param int $id Het ID van het pakket
   * @return array Array van pakketinhoud
   */
  public function getPackageContent($id)
  {
    $this->db->query(
      'CALL `spViewPackageContent`(:id);'
    );
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    $result = $this->db->resultSet();
    return $result;
  }

  /**
   * Voegt een nieuw pakket toe met de opgegeven datum
   * @param string $date De datum van het pakket
   * @return mixed Resultaat van de operatie
   */
  public function addPackage($date)
  {
    try {
      $this->db->query('CALL `spCreatePackage`(:date);');
      $this->db->bind(':date', $date, PDO::PARAM_STR);
      $result = $this->db->resultSet();
      return $result;
    } catch (PDOException $e) {
      echo "Er is een fout opgetreden: " . $e->getMessage();
    }
  }

  /**
   * Verwijdert een pakket met het opgegeven ID
   * @param int $id Het ID van het te verwijderen pakket
   * @return mixed Resultaat van de operatie
   */
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

  /**
   * Bekijkt alle producten
   * @return array Array van producten
   */
  public function viewAllProducts()
  {
    $this->db->query(
      'CALL `spViewAllProducts`();'
    );
    $result = $this->db->resultSet();
    return $result;
  }

  /**
   * Verhoogt de hoeveelheid van een product in een pakket
   * @param int $packageId Het ID van het pakket
   * @param int $productId Het ID van het product
   * @return mixed Resultaat van de operatie
   */
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

  /**
   * Verlaagt de hoeveelheid van een product in een pakket
   * @param int $packageId Het ID van het pakket
   * @param int $productId Het ID van het product
   * @return mixed Resultaat van de operatie
   */
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

  /**
   * Koppelt producten aan pakketten
   * @return mixed Resultaat van de operatie
   */
  public function link()
  {
    $this->db->query(
      'CALL `spLinkPackageProduct`();'
    );
    $result = $this->db->resultSet();
    return $result;
  }
}
