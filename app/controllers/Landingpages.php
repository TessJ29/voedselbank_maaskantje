<?php

class Landingpages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data = [
            'title' => "<h1 style='text-align: center;'>Homepage voedselbank maaskantje</h1>",
        ];
        $this->view('landingpages/index', $data);
    }
}
