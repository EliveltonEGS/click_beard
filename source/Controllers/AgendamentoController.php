<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Entities\Agendamento;
use Source\Entities\Barbeiro;
use Source\Entities\Cliente;
use Source\Entities\Horario;
use Source\Models\AgendamentoModel;
use Source\Models\BarbeiroModel;
use Source\Models\HorarioModel;

class AgendamentoController
{

    private $barbeiroModel;
    private $barbeiro;
    private $agendamentoModel;
    private $agendamento;
    private $horarioModel;
    private $horario;
    private $cliente;
    private $view;

    public function __construct($router)
    {
        $this->barbeiroModel = new BarbeiroModel();
        $this->barbeiro = new Barbeiro();
        $this->agendamentoModel = new AgendamentoModel();
        $this->agendamento = new Agendamento();
        $this->horarioModel = new HorarioModel();
        $this->horario = new Horario();
        $this->cliente = new Cliente();

        $this->view = new Engine(dirname(__DIR__, 2) . "/theme", "php");
        $this->view->addData(["router" => $router]);
    }

    public function novo()
    {
        if (!isset($_SESSION["USUARIO"])) {
            echo $this->view->render('usuario/login');
            return;
        }

        echo $this->view->render('agendamento/novo');
    }

    public function listaBarbeiros(): void
    {
        echo json_encode($this->barbeiroModel->listarTodos());
    }

    public function horarios(): void
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);



        echo json_encode($this->horarioModel->horarios($data['data']));
    }

    public function cadastrar(): void
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $this->horario->setData($data['data']);
        $this->horario->setHora($data['horario']);
        $this->horarioModel->alteraStatusHora($this->horario);

        $dataAgendamento = "{$data['data']} {$data['horario']}";
        $cliente_id = $_SESSION["USUARIO"]["cliente_id"];
        $barbeiro_id = $data["barbeiro_id"];
        $horario_id = $data["horario_id"];

        $this->barbeiro->setBarbeiro_id($barbeiro_id);
        $this->cliente->setCliente_id($cliente_id);
        $this->horario->setHorario_id($horario_id);

        $this->agendamento->setData($dataAgendamento);
        $this->agendamento->setBarbeiro($this->barbeiro);
        $this->agendamento->setCliente($this->cliente);
        $this->agendamento->setHorario($this->horario);
        $this->agendamento->setStatus("A");
        $this->agendamentoModel->cadastrar($this->agendamento);
    }

    public function listaAgendamentos(): void
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if ($_SESSION["USUARIO"]["tipo"] == "A") {
            echo json_encode($this->agendamentoModel->listaTodosAgendamentos($data['nome']));
        } else {
            echo json_encode($this->agendamentoModel->listaAgendamentosPorClienteNormais($_SESSION["USUARIO"]["cliente_id"], $data['nome']));
        }
    }

    public function cancelar(): void
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if ($_SESSION["USUARIO"]["tipo"] == "A") {
            $this->agendamentoModel->cancelarAgendamento($data['agendamento_id']);
            $this->horarioModel->cancelar($data['horario_id']);
        } else {
            if ($this->agendamentoModel->verificarIntervaloCancelamento($data['agendamento_id']) == "OK") {
                $this->agendamentoModel->cancelarAgendamento($data['agendamento_id']);
                $this->horarioModel->cancelar($data['horario_id']);
            } else {
                echo json_encode("NOK");
            }
        }
    }

    public function concluirAgendamento(array $data): void
    {
        $this->agendamentoModel->concluirAgendamento($data['id']);
    }

    public function especialidade(array $data): void
    {
        $barbeiro = $this->barbeiroModel->especialidadBarbeiro($data['id']);
        echo json_encode($barbeiro);
    }
}
