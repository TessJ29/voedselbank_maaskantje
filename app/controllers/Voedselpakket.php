  <?php

    class Voedselpakket extends Controller
    { // Properties, field
        private $voedselpakketModel;
        // Dit is de constructor
        public function __construct()
        {
            $this->voedselpakketModel = $this->model('VoedselpakketModel');
        }

        public function index()
        {

            $records = $this->voedselpakketModel->getVoedselpakketten();
            if (sizeof($records) == 0) {
                $rows = "<tr style= 'text-align: center; font-size: 35px; color: red;'><td>Niemand </td></tr>";
            } else {
                $rows = '';
                foreach ($records as $value) {
                    $rows .= "<tr>
                      <td>$value->Voornaam</td>
                      <td>$value->Omschrijving</td>
                      <td>$value->AantalVolwassenen</td>
                      <td>$value->AantalKinderen</td>
                      <td>$value->AantalBabys</td>
                      <td>$value->IsVertegenwoordiger</td>
                      <td><a href='" . URLROOT . "/voedselpakket/overzichtvoedselpakket/$value->id'><img src='\img\kutu.png' alt='klaem'></a></td>
                    </tr>";
                }
            }

            $data = ['title' => 'Overzicht gezinnen met Voedselpakketten', 'rows' => $rows];
            $this->view('/voedselpakket/index', $data);
        }





        public function overzichtVoedselpakket()
        {
            // Kijkt of er data wordt mee gegeven vanuit de form.
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
                // Geeft de variabele $eetwens de waarde van de gekozen eetwens
                $eetwens = $_POST["Eetwens"];
                try {
                    $eetwens = $this->voedselpakketModel->getVoedselpakketByEetwens($eetwens);
    
                    // Kijkt of de terug gestuurde array $eetwens leeg is en geeft $message een waarde
                    if (empty($eetwens)) {
                        $message = "Er zijn geen eetwens bekent die de geselecteerde eetwens hebben";
                    }
                } catch (Exception $e) {
                    $e->getMessage();
                }
            } else {
                try {
                    $eetwens = $this->voedselpakketModel->getVoedselpakketten();
                } catch (Exception $e) {
                    $e->getMessage();
                }
            }
            $data = [
                'title' => 'Overzicht eetwens',
                'eetwens' => $eetwens,
                'message' => $message ?? NULL,
            ];
            $this->view('voedselpakket/overzichtvoedselpakket', $data);
        }




        // public function index1()
        // {
        //     $records = $this->voedselpakketModel->getVoedselpakketUpdate();

        //     $rows = '';
        //     foreach ($records as $value) {
        //         $rows1 = "<tr>
        //             <td>$value->Naam</td>
        //             <td>$value->Omschrijving</td>
        //             <td>$value->AantalProductEenheden</td>
        //           </tr>";
        //     }

        //     $data = [
        //         'rows' => $rows
        //     ];
        //     $this->view('/voedselpakket/index', $data);
        // }






        // public function update($id = null)
        // {
        //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //         // var_dump("Ik ben bıj post update");
        //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //         // var_dump($_POST);
        //         // exit();
        //         // Check if Naam is geen Id 0
        //         if ($_POST['Naam'] ==  'id' < 0) {
        //             echo "Er zijn geen gezinnen betekent die de geselecteerde eetwens hebben";
        //             header("Refresh:2; url=" . URLROOT . "/voedselpakket/index");
        //             return;
        //         }

        //         $this->voedselpakketModel->VoedselpakketUpdate($_POST);

        //         echo "Het optiepakket is gewijzigd";
        //         header("Refresh:2; url=" . URLROOT . "/voedselpakket/index");
        //     } else {
        //         //var_dump("Ik ben bıj get update");
        //         $row = $this->voedselpakketModel->getVoedselpakketUpdate($id);
        //         $data = ['title' => 'Overzicht voedselpakketten', 'row' => $row];
        //         $this->view('voedselpakket/update', $data);
        //     }
        // }
    }
