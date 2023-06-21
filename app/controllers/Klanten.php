<?php

    Class Klanten Extends Controller
    {
        private $klantModel;
        public function __construct()
        {
            $this->klantModel = $this->model('KlantModel');
        }

        public function overzichtKlant()
        {
            $klanten = $this->klantModel->getAllKlanten();
            $data = [
                'title' => 'Overzicht Klanten',
                'klanten' => $klanten,
                'message' => $message ?? '',
            ];
            $this->view('Klant/overzichtKlant',$data);
        }
    }

?>