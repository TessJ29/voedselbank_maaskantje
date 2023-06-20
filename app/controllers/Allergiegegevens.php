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
        // var_dump($contacts);
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
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->allergieModel->createAllergie($_POST);
            header("Location:" . URLROOT . "/allergiegegevens/index");
        } 
        else 
        {
            $data = ['title' => "Voeg een nieuw gegevens in"];

            $this->view("allergiegegevens/create", $data);
        }
    }


    // De server filtert de gegevens en werkt het opgegeven contactrecord bij door een object van de klasse ContactModel te maken
    // public function update($id = null)
    // {
    //      var_dump($id);exit();
    //     // var_dump($_SERVER);exit();
    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //         $this->allergieModel->updateAllergie($_POST);
    //         header("Location:" . URLROOT . "/allergiegegevens/index");
    //     } else {
    //         $data = [
    //             'title' => '<h1>Update allergiegegevens</h1>',
    //         ];
    //         $this->view("allergiegegevens/update", $data);
    //     }
    // }

    public function update($id = null)
        {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // var_dump("Ik ben bıj post update");
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // var_dump($_POST);
                // exit();
                // Check if allergienaam is Vrijgezellenfeest and if AantalKinderen is groot 0
                if ($_POST['allergienaam'] ==  'Vrijgezellenfeest' && $_POST['AantalKinderen'] ) {
                    echo "Het optiepakket vrijgezellenfeest is niet bedoelt voor kinderen";
                    header("Refresh:2; url=" . URLROOT . "/allergiegegevens/index");
                    return;
                }

                $this->allergieModel->ReserveringUpdate($_POST);

                echo "Het optiepakket is gewijzigd";
                header("Refresh:2; url=" . URLROOT . "/allergiegegevens/index");
            } else {
                //var_dump("Ik ben bıj get update");
                $row = $this->allergieModel->getReserveringUpdate($id);
                $data = ['title' => 'Detail Optiepakket', 'row' => $row];
                $this->view('allergiegegevens/update', $data);
            }
        }

        
}


