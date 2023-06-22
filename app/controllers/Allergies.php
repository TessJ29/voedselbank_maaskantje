<?php

class Allergies extends Controller
{
  // Properties, field
  private $allergyModel;

  // Dit is de constructor
  public function __construct()
  {
    $this->allergyModel = $this->model('Allergy');
  }

  public function index()
  {
    /**
     * Haal via de method getAllergies() uit de model Allergy de records op
     * uit de database
     */
    if (isset($_POST['allergie'])) {
      $allergies = $this->allergyModel->getAllergiesByAllergy((int)$_POST['allergie']);
    } else {
      $allergies = $this->allergyModel->getAllergies();
    }

    /**
     * Maak de inhoud voor de tbody in de view
     */
    $error = '';
    $rows = '';
    if (isset($allergies[0])) {
      foreach ($allergies as $value) {
        $rows .= "<tr>
                      <td>$value->Naam</td>
                      <td>$value->Omschrijving</td>
                      <td>$value->AantalVolwassenen</td>
                      <td>$value->AantalKinderen</td>
                      <td>$value->AantalBabys</td>
                      <td>$value->Vertegenwoordiger</td>
                      
                      
                      <td><a href='" . URLROOT . "/allergies/details/$value->gezinId/'>Details</a></td>
                      </tr>";
      }
    } else {
      $error = "er zijn geen gezinnen die de geselecteerde allergie hebben";
    }


    $data = [
      'title' => '<h1>Overzicht gezinnen met allergieen</h1>',
      'allergies' => $rows,
      'error' => $error
    ];
    $this->view('allergies/index', $data);
  }


  public function details($id)
  {

    $allergies = $this->allergyModel->viewFamilyDetails((int)$id);

    $rows = '';
    $details = '';
    foreach ($allergies as $value) {
      $rows .= "<tr>
      <td>$value->Naam</td>
      <td>$value->TypePersoon</td>
      <td>$value->Gezinsrol</td>
      <td>$value->Allergie</td>
      <td><a href='" . URLROOT . "/allergies/edit/$value->persoonId/$value->gezinId'>✎</a></td>
      </tr>";
    }

    $gezinsId = $allergies[0]->gezinId;

    $details .= "<tr>
    <td>" . $allergies[0]->Gezinsnaam . "</td>
    <td>" . $allergies[0]->Omschrijving . "</td>
    <td>" . $allergies[0]->TotaalAantalPersonen . "</td>
    </tr>";

    $data = [

      'title' => '<h1>Allergieen in het gezin</h1>',
      'Allergies' => $rows,
      'Details' => $details,
      'personId' => $id,
      'gezinsId' => $gezinsId,
    ];

    $this->view('allergies/details', $data);
  }

  public function edit($id, $gezinsId)
  {

    $allergies = $this->allergyModel->viewPersonAllergy((int)$id);


    $data = [
      'title' => '<h1>Wijzig allergie</h1>',
      'currentAlergy' => $allergies[0]->AllergyId,
      'persoonsId' => $id,
      'gezinsId' => $gezinsId
    ];

    $this->view('allergies/edit', $data);
  }

  public function editscript()
  {

    $this->allergyModel->UpdatePersonAllergy((int)$_POST['personId'], (int)$_POST['allergie']);

    $data = [
      'title' => '<h1>Wijziging success!</h1>',

    ];
    $this->view('allergies/editsuccess', $data);
    header('Refresh:3; URL=' . URLROOT . '/allergies/details/' . $_POST['gezinsId']);
  }
}
