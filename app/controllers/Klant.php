<?php

class Klant extends Controller
{
    private $KlantModel;

    public function __construct()
    {
        $this->KlantModel = $this->model('KlantModel');
    }

    public function index()
    {
        $Klanten = $this->KlantModel->getKlanten();

        $rows = '';
        foreach ($Klanten as $value) {
            $rows .= "<tr>
                      <td>$value->gezinsnaam</td>
                      <td>$value->adres</td>
                      <td>$value->postcode</td>
                      <td>$value->telefoon</td>
                      <td>$value->email</td>
                      <td>$value->aantalvolwassenen</td>
                      <td>$value->aantalkinderen</td>
                      <td>$value->aantalbaby</td>
                      <td>$value->wens</td>
                      <td><a href='" . URLROOT . "/Klant/delete/$value->id'>delete</a></td>
                      <td><a href='" . URLROOT . "/Klant/update/$value->id'>update</a></td>
                    </tr>";
        }

        $data = [
            'title' => 'Alle Klanten',
            'amountOfKlanten' => sizeof($Klanten),
            'rows' => $rows
        ];
        $this->view('/Klant/index', $data);
    }

    public function update($id = null)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->KlantModel->KlantUpdate($_POST);
            echo "<h1>De Klant is geupdate</h1>";
            header("Refresh:2; url=" . URLROOT . "/Klant/index");
        } else {
            $row = $this->KlantModel->getKlantById($id);
            $data = [
                'title' => '<h1>Update Klant</h1>',
                'row' => $row
            ];
            $this->view("Klant/update", $data);
        }
    }

    public function delete($Id)
    {
        $this->KlantModel->KlantDelete($Id);

        $data = [
            'deleteStatus' => "De klant is verwijderd"
        ];
        $this->view("Klant/delete", $data);
        header("Refresh:3; url=" . URLROOT . "/Klant/index");
    }

    public function create()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            var_dump($_POST);
            try {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $this->KlantModel->KlantCreate($_POST);
                header("Location:" . URLROOT . "/klant/index");
            } catch (PDOException $e) {
                echo "Het inserten van het record is niet gelukt";
                header("Refresh:10; url=" . URLROOT . "/klant/index");
            }
        } else {
            $data = [
                'title' => "Voeg klant toe!"
            ];

            $this->view("Klant/create", $data);
        }
    }
}
