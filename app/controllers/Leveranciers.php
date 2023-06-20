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

        public function addLeverancier()
        {
            $data = [
                'title' => 'Leverancier Toevoegen',
            ];
            $this->view('Leveranciers/addLeverancier',$data);
        }
    }
