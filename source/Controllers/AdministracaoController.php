<?php

namespace Source\Controllers;

use CoffeeCode\Router\Router;
use League\Plates\Engine;

class AdministracaoController
{

    private Engine $view;

    public function __construct(Router $router)
    {
        $this->view = new Engine(dirname(__DIR__, 2) . "/theme", "php");
        $this->view->addData(["router" => $router]);
    }


    public function home()
    {
        if (!isset($_SESSION["USUARIO"])) {
            echo $this->view->render('usuario/login');
            return;
        }

        echo $this->view->render('adm/home');
    }
}
