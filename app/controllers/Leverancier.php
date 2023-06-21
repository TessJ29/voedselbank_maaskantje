<?php

class Leverancier extends Controller
{
    private $LeverancierModel;

    public function __construct()
    {
        $this->LeverancierModel = $this->model('LeverancierModel');
    }

    public function pdetails($Id = null)
    {
        $Leverancier = $this->LeverancierModel->getLeverancierById($Id);
        $Products = $this->LeverancierModel->getLeverancierProducts($Id);

        $data = [
            'title' => 'Overzicht Product',
            'leverancier' => $Leverancier,
            'products' => $Products
        ];

        $this->view('/leverancier/pdetails', $data);
    }


    public function index()
    {
        $Leveranciers = $this->LeverancierModel->getLeveranciers();

        $rows = '';
        foreach ($Leveranciers as $value) {
            $rows .= "<tr>
                      <td>$value->Naam</td>
                      <td>$value->ContactPersoon</td>
                      <td>$value->Email</td>
                      <td>$value->Mobiel</td>
                      <td>$value->LeverancierNummer</td>
                      <td>$value->LeverancierType</td>
                      <td><a href='" . URLROOT . "/leverancier/pdetails/$value->leverId'>Details</a></td>
                    </tr>";
        }

        $data = [
            'title' => 'Overzicht Leveranciers',
            'rows' => $rows
        ];
        $this->view('/leverancier/index', $data);
    }

    public function update($Id = null)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->LeverancierModel->ProductUpdate($_POST);
            header("Refresh:3; url=" . URLROOT . "/leverancier/index");
            echo "<h1>Het product is geüpdatet</h1>";
        } else {
            $row = $this->LeverancierModel->getProductById($Id);
            $data = [
                'title' => '<h1>Update Houdbaarheidsdatum</h1>',
                'row' => $row
            ];
            $this->view("leverancier/update", $data);
        }
    }
}
