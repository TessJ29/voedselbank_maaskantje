<?php

class Allergiegegevens extends Controller
{
    private $allergieModel;


    public function __construct()
    {
        $this->allergieModel = $this->model('AllergieModel');
    }

    //formatteert de gegevens en verzendt deze met de weergave
    public function index()
    {

        $allergies = $this->allergieModel->getAllergie();
        var_dump($allergies);

        $rows = '';
        foreach ($allergies as $value) {
            $rows .= "<tr>
                  <td>$value->gezinsnaam</td>
                  <td>$value->productnaam</td>
                  <td>$value->allergienaam</td>
                  <td>$value->comment</td>
                  <td><a href='" . URLROOT . "/allergiegegevens/update/$value->Id'><img src='\img\kale.png' alt='klaem'></a></td>
                  <td><a href='" . URLROOT . "/allergiegegevens/delete/$value->Id'><img src='\img\si.png' alt='dele'></a></td>

                 </tr>";
        }

        $data = [
            'title' => 'allergies in dienst',
            'rows' => $rows,
        ];

        $this->view('allergiegegevens/index', $data);
    }


    // verwijdert een contactrecord met id en leidt de gebruiker vervolgens door naar de bijgewerkte pagina"
    public function delete($id)
    {
        $this->allergieModel->deleteAllergie($id);

        $data = [
            'deleteStatus' => "Het record met id = $id is verwijdert"
        ];
        $this->view("allergiegegevens/delete", $data);
        header("Refresh:3; url=" . URLROOT . "/allergiegegevens/index");
    }


    // Maak een nieuw contactrecord door een object van de klasse ContactModel te maken
    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->allergieModel->createAllergie($_POST);
            header("Location:" . URLROOT . "/allergiegegevens/index");
        } else {
            $data = ['title' => "Voeg een nieuw gegevens in"];

            $this->view("allergiegegevens/create", $data);
        }
    }


    // De server filtert de gegevens en werkt het opgegeven contactrecord bij door een object van de klasse ContactModel te maken
    public function update($id = null)
    {
        // var_dump($id);exit();
        // var_dump($_SERVER);exit();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            var_dump($_POST);
            //exit;
            $this->allergieModel->updateAllergie($_POST);
            header("Location:" . URLROOT . "/allergiegegevens/index");
        } else {
            echo "test";
            $row = $this->allergieModel->getSingleAllergie($id);
            $rows = '';
            $contacts = $this->allergieModel->getAllergiesWithVoornaam();
            foreach ($contacts as $value) {
                $rows .= "<tr>
                   <td>$value->gezinsnaam</td>
                  </tr>";
            }
            $data = [
                'title' => '<h1>Update allergiegegevens</h1>',
                'row' => $row,
                'isim' => $value->gezinsnaam
            ];
            $this->view("allergiegegevens/update", $data);
        }
    }
}
