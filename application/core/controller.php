<?php
class Controller {

    public $models;
    public $view;

    function __construct()
    {
        $this->view = new View();
    }

    function index()
    {
    }

    public function is_admin() {
        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
    }

    public function redirect($url = "") {
        $host = 'http://'.$_SERVER['HTTP_HOST'];

        header('Location:'.$host.$url);
    }
}