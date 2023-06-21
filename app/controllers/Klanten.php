<?php

class Klanten extends Controller
{
    private $klantModel;
    public function __construct()
    {
        $this->klantModel = $this->model('KlantModel');
    }

    public function overzichtKlant()
    {
        // Kijkt of er data wordt mee gegeven vanuit de form.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Geeft de variabele $postcode de waarde van de gekozen postcode
            $postcode = $_POST["Postcode"];
            try {
                $klanten = $this->klantModel->getKlantenByPostcode($postcode);

                // Kijkt of de terug gestuurde array $klanten leeg is en geeft $message een waarde
                if (empty($klanten)) {
                    $message = "Er zijn geen klanten bekent die de geselecteerde postcode hebben";
                }
            } catch (Exception $e) {
                $e->getMessage();
            }
        } else {
            try {
                $klanten = $this->klantModel->getAllKlanten();
            } catch (Exception $e) {
                $e->getMessage();
            }
        }
        $data = [
            'title' => 'Overzicht Klanten',
            'klanten' => $klanten,
            'message' => $message ?? NULL,
        ];
        $this->view('Klant/overzichtKlant', $data);
    }

    public function klantDetails($klantId)
    {
        $klant = $this->klantModel->getKlantById($klantId);
        $data = [
            'title' => 'Klant Details' . ' ' . $klant->VolledigNaam,
            'klant' => $klant,
        ];

        $this->view('Klant/klantDetails', $data);
    }
    public function editKlant($klantId)
    {
        $klant = $this->klantModel->getKlantById($klantId);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            var_dump($_POST);
            $email = $_POST['Email'];
            $tel = $_POST['Mobiel'];
            $postcode = $_POST['Postcode'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = "Ongeldig e-mailadres";
                $data = [
                    'title' => 'Klant Details' . ' ' . $klant->VolledigNaam,
                    'klant' => $klant,
                    'telmessage' => $message ?? ''
                ];
                $this->view('Klant/editKlant', $data);
                return;
            }
            // checkt of de invulde telefoonnummer het goede formaat is
            if (!preg_match('/^\+31 \d{9}$/', $tel)) {
                $message = "Ongeldig formaat";
                $data = [
                    'title' => 'Klant Details' . ' ' . $klant->VolledigNaam,
                    'klant' => $klant,
                    'telmessage' => $message ?? ''
                ];
                $this->view('Klant/editKlant', $data);
                return;
            }
            if (substr($postcode, 0, 4) !== "5271") {
                $message = "De postcode komt niet uit de regio Maaskantje";
                $data = [
                    'title' => 'Klant Details' . ' ' . $klant->VolledigNaam,
                    'klant' => $klant,
                    'postmessage' => $message ?? ''
                ];
                $this->view('Klant/editKlant', $data);
                return;
            }
            try {
                $this->klantModel->editKlant($klantId, $_POST);
                $message = "De klantgegevens zijn gewijzigd";
                header("Refresh:3; url=" . URLROOT . "/Klanten/overzichtKlant");
            } catch (Exception $e) {
                //  als de code in try niet werkt dan wordt er een errormessage weergegeven.
                $message = "De contactgegevens van de geselecteerde klant kunnen niet gewijzigd worden";
                header("Refresh:2; url=" . URLROOT . "/Klanten/editKlant");
            }
        }
        var_dump($klant);
        $data = [
            'title' => 'Klant Details' . ' ' . $klant->VolledigNaam,
            'klant' => $klant,
            'message' => $message ?? '',
            'telmessage' => NULL
        ];
        $this->view('Klant/editKlant', $data);
    }
}
