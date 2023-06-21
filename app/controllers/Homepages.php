<?php

class Homepages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $this->view('homepages/index');
    }
}
