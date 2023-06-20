<?php
class Packages extends Controller
{
  // Properties, field
  private $packageModel;

  // Dit is de constructor
  public function __construct()
  {
    $this->packageModel = $this->model('Package');
  }

  public function index()
  {
    /**
     * Haal via de method getPackages() uit de model Package de records op
     * uit de database
     */
    $packages = $this->packageModel->getPackages();

    /**
     * Maak de inhoud voor de tbody in de view
     */
    $error = '';
    $rows = '';
    if (isset($packages[0])) {
      foreach ($packages as $value) {
        $rows .= "<tr>
                      <td>$value->pakketid</td>
                      <td>$value->uitgiftedatum</td>
                      <td>$value->gezinsnaam</td>
                      <td>$value->totaal</td>
                      
                      <td><a href='" . URLROOT . "/packages/update/$value->pakketid'>✎</a></td>";

        if ($value->totaal == 0) {
          $rows .= "<td><a href='" . URLROOT . "/packages/delete/$value->pakketid'>🗑</a></td>";
        } else {
          $rows .= "<td>🗑</td>";
          $error = 'gevulde pakketten kunnen niet verwijderd worden';
        }

        $rows .= "</tr>";
      }
    } else {
      $error = "er zijn momenteel geen pakketen";
    }


    $data = [
      'title' => '<h1>Overzicht pakketen</h1>',
      'packages' => $rows,
      'error' => $error
    ];
    $this->view('packages/index', $data);
  }

  public function update($id)
  {
    $packages = $this->packageModel->getPackageContent($id);


    $rows = '';
    foreach ($packages as $value) {
      $rows .= "<tr>
                  <td>$value->productnaam</td>
                  <td>$value->aantal</td>";

      if ($value->vooraad != 0) {
        $rows .= "<td><a href='" . URLROOT . "/packages/increase/$value->packageid/$value->productid'>+</a></td>";
      } else {
        $rows .= "<td>+</td>";
      }

      if ($value->aantal != 0) {
        $rows .= "<td><a href='" . URLROOT . "/packages/decrease/$value->packageid/$value->productid'>-</a></td>";
      } else {
        $rows .= "<td>-</td>";
      }

      $rows .= "<td>$value->vooraad</td>
                </tr>";
    }




    $data = [

      'title' => '<h1>bewerk pakket</h1>',
      'packages' => $rows,
      'id' => $id
    ];


    $this->view('packages/update', $data);
  }

  public function create()
  {
    $data = [
      'title' => '<h1>maak pakket</h1>',
    ];

    $this->view('packages/create', $data);
  }

  public function addPackage()
  {
    try {

      $this->packageModel->addPackage($_POST['uitgifteDatum']);
      $this->packageModel->link();
      header('Location: ' . URLROOT . '/packages');
    } catch (Exception $e) {
      // Handle the exception here
      // You can log the error, display a custom error message, or take other actions
      echo "<span style='color: red;'> Er is iets mis gegaan </span> <br> bericht: " . $e->getMessage();
    }
  }


  public function delete($id)
  {
    $this->packageModel->deletePackage($id);
  }

  public function increase($packageId, $productId)
  {
    var_dump($_POST);
    $this->packageModel->increase($packageId, $productId);
    header('Location: ' . URLROOT . '/packages/update/' . $packageId);
  }

  public function decrease($packageId, $productId)
  {
    $this->packageModel->decrease($packageId, $productId);
    header('Location: ' . URLROOT . '/packages/update/' . $packageId);
  }
}
