<?php

class Leveranciers extends Controller
{
    private $leverancierModel;

    public function __construct()
    {
        $this->leverancierModel = $this->model('LeverancierModel');
    }
    public function index()
    {
        $leveranciers = $this->leverancierModel->getAllLeveranciers();

        //  als er geen leveranciers zijn dan wordt de message "Er zijn geen leveranciers" weergegeven
        if (empty($leveranciers)) {
            $data = [
                'title' => 'Overzicht Leveranciers',
                'message' => 'Er zijn geen leveranciers',
            ];
        } else {
            $data = [
                'title' => 'Overzicht Leveranciers',
                'leveranciers' => $leveranciers,
                'message' =>  '',
            ];
        }

        $this->view('Leveranciers/index', $data);
    }

    public function addLeveranciers()
    {
        $leveranciers = $this->leverancierModel->getAllLeveranciers();
        $message = '';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Email validation. checkt of het ingevulde email geldig is
            $email = $_POST['email'];
            $tel = $_POST['telefoonnummer'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $message = "Ongeldig e-mailadres";
                $data = [
                    'title' => 'Leverancier Toevoegen',
                    'leveranciers' => $leveranciers,
                    'message' => $message,
                ];
                $this->view('Leveranciers/addLeveranciers', $data);
                return;
            }
            // checkt of de invulde telefoonnummer het goede formaat is
            if (!preg_match('/^06-\d{8}$/', $tel)) {
                $message = "Dit is een Ongeldig telefoonnummer. Hetmoet het formaat '06-12345678' hebben.";
                $data = [
                    'title' => 'Leverancier Toevoegen',
                    'leveranciers' => $leveranciers,
                    'message' => $message,
                ];
                $this->view('Leveranciers/addLeveranciers', $data);
                return;
            }
            //  probeert de code uit te voeren.
            try {
                $this->leverancierModel->addLeveranciers($_POST);
                $message = "De leverancier is succesvol toegevoegd";
                header("Refresh:3; url=" . URLROOT . "/Leveranciers/index");
            } catch (Exception $e) {
                //  als de code in try niet werkt dan wordt er een errormessage weergegeven.
                $message = "Er is een fout opgetreden bij het toevoegen van de leverancier";
                header("Refresh:2; url=" . URLROOT . "/Leveranciers/addLeveranciers");
            }
        }

        $data = [
            'title' => 'Leverancier Toevoegen',
            'leveranciers' => $leveranciers,
            'message' => $message,
        ];

        $this->view('Leveranciers/addLeveranciers', $data);
    }

    public function editLeverancier($leverancierId)
    {
        $leverancier = $this->leverancierModel->getLeverancierById($leverancierId);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $this->leverancierModel->editLeverancier($leverancierId, $_POST);
                $message = "De gegevens zijn succesvol gewijzigd";
                header("Refresh:3; url=" . URLROOT . "/Leveranciers/index");
            } catch (PDOException $e) {
                $message = "Er is iets fout gegaan bij het wijzigen van de gegevens";
                throw $e;
            }
        }
        $data = [
            'title' => 'Leverancier gegevens wijzigen',
            'leverancier' => $leverancier,
            'message' => $message ?? '',
        ];
        $this->View('Leveranciers/editLeverancier', $data);
    }


    public function deleteLeverancier($leverancierId)
    {

        $this->leverancierModel->deleteLeverancier($leverancierId);

        echo "Deze leverancier is verwijderd uit de database.";
        header("Refresh:3; url=" . URLROOT . "/Leveranciers/index");
    }
}
