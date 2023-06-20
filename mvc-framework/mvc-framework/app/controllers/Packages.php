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
    $rows = '';
    foreach ($packages as $value) {
      $rows .= "<tr>
                  <td>$value->pakketid</td>
                  <td>$value->gezinsnaam</td>
                  <td>$value->totaal</td>
                  
                  <td><a href='" . URLROOT . "/packages/update/$value->pakketid'>update</a></td>
                  <td><a href='" . URLROOT . "/packages/delete/$value->pakketid'>delete</a></td>
                </tr>";
    }


    $data = [
      'title' => '<h1>Overzicht pakketen</h1>',
      'packages' => $rows
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
                  <td>$value->aantal</td>
                  
                  <td><a href='" . URLROOT . "/packages/increase/$value->pakketid'>+</a></td>
                  <td><a href='" . URLROOT . "/packages/decrease/$value->pakketid'>-</a></td>
                </tr>";
    }


    $data = [
      'name' => $packages[0]->gezinsnaam,
      'title' => '<h1>bewerk pakket</h1>',
      'packages' => $rows
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
    $this->packageModel->addPackage($_POST['uitgifteDatum']);
    header('Location: ' . URLROOT . '/packages');
  }
}
