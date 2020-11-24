<?php

class Home extends Controller {
    public function index()
    {
        //var_dump($_SESSION);
        $this->view('common/header');
        $this->view('common/footer');
    }
}