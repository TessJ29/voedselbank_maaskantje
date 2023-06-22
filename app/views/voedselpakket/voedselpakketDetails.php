<?php

class Voedselpakket extends Controller
{
    private $voedselpakketModel;

    public function __construct()
    {
        $this->voedselpakketModel = $this->model('VoedselpakketModel');
    }

    public function index()
    {
        // Check of er een post request is gedaan
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Filter de post array
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Check of de post array niet leeg is
            if (empty($post)) {
                header('location: ' . URLROOT . 'voedselpakket/index');
            }

            // Haal de gegevens van het gezin op
            $gezinnen = $this->voedselpakketModel->getGezinByEetwens($post['eetwens']);

            // Check of er data is gevonden voor het gezin
            if (empty($gezinnen)) {
                // Zet de benodinge data in een array
                $data = [
                    'titel' => 'Overzicht gezinnen met voedselpakketten',
                    'rows' => '<tr><td id="error" colspan="7">Er zijn geen gezinnen bekent die de geselecteerde eetwens hebben</td></tr>'
                ];
                // Laad de view
                $this->view('voedselpakket/index', $data);
                exit;
            } else {
                // Maak een row aan met de gegevens van het gezin
                $rows = '';
                foreach ($gezinnen as $gezin) {
                    $rows .= "<tr>
                            <td>$gezin->naam</td>
                            <td>$gezin->omschrijving</td>
                            <td>$gezin->aantalvolwassenen</td>
                            <td>$gezin->aantalkinderen</td>
                            <td>$gezin->aantalbabys</td>
                            <td>$gezin->voornaam $gezin->tussenvoegsel $gezin->achternaam</td>
                            <td><a href='" . URLROOT . "voedselpakket/details/$gezin->id'>Details</a></td>
                        </tr>";
                };
            }
        } else {
            // Haal alle gezinnen op
            $gezinnen = $this->voedselpakketModel->getGezinnen();

            // Check of er data is gevonden voor het gezin
            $rows = '';
            foreach ($gezinnen as $gezin) {
                $rows .= "<tr>
                            <td>$gezin->naam</td>
                            <td>$gezin->omschrijving</td>
                            <td>$gezin->aantalvolwassenen</td>
                            <td>$gezin->aantalkinderen</td>
                            <td>$gezin->aantalbabys</td>
                            <td>$gezin->voornaam $gezin->tussenvoegsel $gezin->achternaam</td>
                            <td><a href='" . URLROOT . "voedselpakket/details/$gezin->id'>Details</a></td>
                        </tr>";
            };
        }

        // Haal alle eetwensen op
        $eetwensen = $this->voedselpakketModel->getEetwensen();

        // Maak een optie aan voor elke eetwens
        $eetwensenOptions = '';
        foreach ($eetwensen as $eetwens) {
            $eetwensenOptions .= "<option value='$eetwens->id'>$eetwens->naam</option>";
        }

        // Maak een array aan met alle benodigde data voor de view
        $data = [
            'titel' => 'Overzicht gezinnen met voedselpakketten',
            'rows' => $rows,
            'eetwensenOptions' => $eetwensenOptions
        ];

        // Laad de view
        $this->view('voedselpakket/index', $data);
    }

    public function details($id = NULL)
    {
        // Haal de gegevens van het gezin op
        $gezin = $this->voedselpakketModel->getGezinById($id);

        // Check of er data is gevonden voor het gezin
        if (empty($gezin)) {
            $gezin = $this->voedselpakketModel->getGezinGegevensById($id);

            // Maak een row aan met de melding dat er geen voedselpakketten bekent zijn voor dit gezin
            $rows = "<tr><td colspan='6'>Er zijn geen voedselpakketten bekent voor dit gezin</td></tr>";
        } else {
            // Kijk of de status van het voedselpakket nietuitgereikt is, als dit zo is dan splits de string in 2 delen
            $rows = '';
            foreach ($gezin as $gez) {
                if ($gez->status == 'NietUitgereikt') {
                    $halfLength = 4;

                    $part1 = substr($gez->status, 0, $halfLength);
                    $part2 = substr($gez->status, $halfLength);

                    $gez->status = $part1 . ' ' . $part2;
                }

                $gez->datumsamenstelling = date("d-m-Y", strtotime($gez->datumsamenstelling));
                if($gez->datumuitgifte != NULL){
                    $gez->datumuitgifte = date("d-m-Y", strtotime($gez->datumuitgifte));
                };
                
                // Maak een row aan met de gegevens van het voedselpakket
                $rows .= "<tr>
                            <td>$gez->pakketnummer</td>
                            <td>$gez->datumsamenstelling</td>
                            <td>$gez->datumuitgifte</td>
                            <td>$gez->status</td>
                            <td>$gez->total_amount</td>
                            <td><a href='" . URLROOT . "voedselpakket/statuswijzigen/$gez->voedselpakketid'>Details</a></td>
                        </tr>";
            };
        }

        // Maak een array aan met alle benodigde data voor de view
        $data = [
            'titel' => 'Overzicht Voedselpakketten ',
            'naam' => $gezin[0]->naam,
            'omschrijving' => $gezin[0]->omschrijving,
            'totaalaantalpersonen' => $gezin[0]->totaalaantalpersonen,
            'rows' => $rows,
        ];

        // Laad de view
        $this->view('voedselpakket/details', $data);
    }

    public function statuswijzigen($id = NULL)
    {
        // check of er een post request is gedaan
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // filter de post array
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // check of de status nietuitgereikt is, als dit zo is dan verwijder de spatie
            if ($post['status'] == 'Niet Uitgereikt') {
                $string = $post['status'];
                $post['status'] = str_replace(' ', '', $string);
                $post['datumuitgifte'] = NULL;
            }
            // check of de status uitgereikt is, als dit zo is dan voeg de datum van vandaag toe in de post array
            if ($post['status'] == 'Uitgereikt') {
                $date = date('Y-m-d');
                $post['datumuitgifte'] = $date;
            }

            // update de status van het voedselpakket
            $this->voedselpakketModel->updateVoedselpakketStatus($post);

            // redirect naar de details pagina van het voedselpakket
            header('location: ' . URLROOT . 'voedselpakket/details/' . $post['gezid'] . '');
        } else {
            // Haal de status op van het voedselpakket
            $voedselpakketStatus = $this->voedselpakketModel->getVoedselpakketStatusById($id);

            // Check of de status nietuitgereikt is, als dit zo is dan splits de string in 2 delen
            if ($voedselpakketStatus->status == 'NietUitgereikt') {
                $halfLength = 4;

                $part1 = substr($voedselpakketStatus->status, 0, $halfLength);
                $part2 = substr($voedselpakketStatus->status, $halfLength);

                $status = $part1 . ' ' . $part2;
            } else {
                $status = $voedselpakketStatus->status;
            }

            // Haal alle statussen op die niet gelijk zijn aan de status van het voedselpakket
            $voedselpakketStatusAll = $this->voedselpakketModel->getVoedselpakketStatusAll($voedselpakketStatus->status);

            if ($voedselpakketStatusAll[0]->status == 'NietUitgereikt') {
                $halfLength = 4;

                $part1 = substr($voedselpakketStatusAll[0]->status, 0, $halfLength);
                $part2 = substr($voedselpakketStatusAll[0]->status, $halfLength);

                $voedselpakketStatusAll[0]->status = $part1 . ' ' . $part2;
            }

            // Maak een optie aan voor elke status
            $statusOptions = '';
            foreach ($voedselpakketStatusAll as $statusOption) {
                $statusOptions .= "<option value='$statusOption->status'>$statusOption->status</option>";
            }

            // Maak een array aan met alle benodigde data voor de view
            $data = [
                'titel' => 'Wijzig voedselpakket status',
                'status' => $status,
                'statusOptions' => $statusOptions,
                'vpId' => $id,
                'gezId' => $voedselpakketStatus->gezId,
                'isActief' => $voedselpakketStatus->isactief
            ];

            // Laad de view
            $this->view('voedselpakket/statuswijzigen', $data);
        }
    }