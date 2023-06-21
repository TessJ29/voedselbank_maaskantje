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
            'message' => $message ?? '',
        ];
        $this->view('Klant/overzichtKlant', $data);
    }
}
