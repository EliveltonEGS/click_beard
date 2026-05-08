<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Entities\Barbeiro;
use Source\Entities\BarbeirosEspecialidade;
use Source\Entities\Especialidade;
use Source\Models\BarbeiroModel;
use Source\Models\EspecialidadeModel;

class BarbeiroController
{

    private $view;
    private $especialidadeModel;
    private $barbeiroModel;
    private $barbeiro;
    private $especialidade;

    public function __construct($router)
    {

        $this->especialidadeModel = new EspecialidadeModel();
        $this->barbeiroModel = new BarbeiroModel();
        $this->barbeiro = new Barbeiro();
        $this->especialidade = new Especialidade();

        $this->view = new Engine(dirname(__DIR__, 2) . "/theme", "php");
        $this->view->addData(["router" => $router]);
    }

    public function especialidade()
    {
        echo json_encode($this->especialidadeModel->listarTodos());
    }

    public function home(): void
    {
        if (!isset($_SESSION["USUARIO"])) {
            echo $this->view->render('usuario/login');
            return;
        }

        echo $this->view->render('barbeiro/home', ['barbeiros' => $this->barbeiroModel->listarTodos()]);
    }

    public function novo()
    {
        if (!isset($_SESSION["USUARIO"])) {
            echo $this->view->render('usuario/login');
            return;
        }

        echo $this->view->render('barbeiro/novo');
    }

    public function cadastrar(): void
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $this->barbeiro->setNome($data->nome);
        $this->barbeiro->setCpf($data->cpf);
        $this->barbeiro->setDataContratacao($data->data_contratacao);
        $barbeiro_id = $this->barbeiroModel->cadastrar($this->barbeiro);
        $this->barbeiro->setBarbeiro_id($barbeiro_id["barbeiro_id"]);

        foreach ($data->especialidade as $item) {
            $this->barbeiroModel->cadastarBarbiroEspecialidade($this->barbeiro->getBarbeiro_id(), $item->especialidade_id);
        }
    }

    public function deletar(array $data)
    {
        $this->barbeiroModel->deletar($data['id']);
        echo $this->view->render('barbeiro/home', ['barbeiros' => $this->barbeiroModel->listarTodos(), 'success' => 'Barbeiro removido com sucesso!']);
    }

    public function especialidadBarbeiro(): void
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $barbeiro = $this->barbeiroModel->especialidadBarbeiro($data->barbeiro_id);
        echo json_encode($barbeiro);
    }
}
