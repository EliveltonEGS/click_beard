<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Entities\Cliente;
use Source\Models\ClienteModel;

class UsuarioController
{

    private $clienteModel;
    private $cliente;
    private $view;

    public function __construct($router)
    {
        $this->clienteModel = new ClienteModel();
        $this->cliente = new Cliente();

        $this->view = new Engine(dirname(__DIR__, 2) . "/theme", "php");
        $this->view->addData(["router" => $router]);
    }

    public function login(): void
    {
        echo $this->view->render('usuario/login');
    }

    public function sair(): void
    {
        session_destroy();
        echo $this->view->render('usuario/login');
    }

    public function registro(): void
    {
        echo $this->view->render('usuario/registro');
    }

    public function cadastrar(array $data): void
    {
        if (in_array('', $data)) {
            echo $this->view->render('usuario/registro', ['error' => 'Todos os campos são obrigatórios!']);
            return;
        }

        if ($data['senha'] != $data['confirm_senha'] || $data['confirm_senha'] != $data['senha']) {
            echo $this->view->render('usuario/registro', ['error' => 'Senha e confirmação de senha não são iguais!']);
            return;
        }

        if ($this->clienteModel->buscarPorEmail($data['email']) == 1) {
            echo $this->view->render('usuario/registro', ['error' => 'Por favor! Informe outro email.']);
            return;
        }


        $this->cliente->setNome($data['nome']);
        $this->cliente->setEmail($data['email']);
        $this->cliente->setSenha($data['senha']);
        $this->cliente->setConfirm_senha($data['confirm_senha']);
        $this->clienteModel->cadastrar($this->cliente);
        echo $this->view->render('usuario/registro', ['success' => "{$data['nome']}! Você já pode se autenticar no sistema."]);
    }

    public function logar(array $data): void
    {

        $usuario = $this->clienteModel->logar($data['email'], $data['senha']);

        if (!$usuario) {
            echo $this->view->render('usuario/login', ['error' => 'Usuário ou sennha inválido.']);
            return;
        }

        $_SESSION["USUARIO"] = $usuario;
        echo $this->view->render('adm/home');
    }

    public function perfil(): void
    {
        if (!isset($_SESSION["USUARIO"])) {
            echo $this->view->render('usuario/login');
            return;
        }
        echo $this->view->render(
            'usuario/perfil',
            [
                'usuario' => $this->clienteModel->buscarPodId($_SESSION["USUARIO"]["cliente_id"])
            ]
        );
    }
}
