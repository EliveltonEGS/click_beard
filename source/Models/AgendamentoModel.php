<?php

namespace Source\Models;

use Source\Entities\Agendamento;

class AgendamentoModel extends Model
{
    public function listaBarbeiros(): array
    {
        return $this->select("SELECT * FROM barbeiros");
    }

    public function cadastrar(Agendamento $agendamento): void
    {
        $this->query("INSERT INTO agendamentos (data, barbeiro_id, cliente_id, horario_id, status) 
            VALUES 
        (:data, :barbeiro_id, :cliente_id, :horario_id, :status)", [
            ":data" => $agendamento->getData(),
            ":barbeiro_id" => $agendamento->getBarbeiro()->getBarbeiro_id(),
            ":cliente_id" => $agendamento->getCliente()->getCliente_id(),
            ":horario_id" => $agendamento->getHorario()->getHorario_id(),
            ":status" => $agendamento->getStatus()
        ]);
    }

    public function listaAgendamentosPorClienteNormais($id, $nome): array
    {
        $agendamento = $this->select("SELECT
            a.horario_id,
            a.agendamento_id, 
            c.nome 'cliente',
            b.nome 'barbeiro',
            DATE_FORMAT(a.data, '%d/%m/%Y %h:%i:%s') 'data',
            CASE
                WHEN a.status = 'A' THEN 'Agendado'
                WHEN a.status = 'C' THEN 'Cancelado'
                ELSE 'Finalizado'
            END 'status'
        FROM 
                agendamentos a
            INNER JOIN 
                clientes c ON c.cliente_id = a.cliente_id
            INNER JOIN 
                barbeiros b ON b.barbeiro_id = a.barbeiro_id
            
        WHERE c.cliente_id = :id AND c.nome LIKE :nome", [":id" => intval($id), ":nome" => '%' . $nome . '%']);

        if (!empty($agendamento)) {
            return $agendamento;
        } else {
            return [];
        }
    }

    public function listaTodosAgendamentos($nome): array
    {
        return $this->select("SELECT
            a.horario_id,
            a.agendamento_id, 
            c.nome 'cliente',
            b.nome 'barbeiro',
            DATE_FORMAT(a.data, '%d/%m/%Y %h:%i:%s') 'data',
            CASE
                WHEN a.status = 'A' THEN 'Agendado'
                WHEN a.status = 'C' THEN 'Cancelado'
                ELSE 'Finalizado'
            END 'status'
        FROM 
                agendamentos a
            INNER JOIN 
                clientes c ON c.cliente_id = a.cliente_id
            INNER JOIN 
                barbeiros b ON b.barbeiro_id = a.barbeiro_id
        WHERE c.nome LIKE :nome", [":nome" => '%' . $nome . '%']);
    }

    public function verificarIntervaloCancelamento($id): string
    {
        $agendamento = $this->select("SELECT data FROM agendamentos WHERE agendamento_id = :id", [":id" => intval($id)]);

        date_default_timezone_set('America/Sao_Paulo');
        $horaAgendamento = $agendamento[0];
        $horaAtutal = date("Y-m-d H:i:s");
        $tempo = gmdate('H:i:s', strtotime($horaAgendamento["data"]) - strtotime($horaAtutal));
        if ($tempo > "02:00:00") {
            return "OK";
        } else {
            return "NOK";
        }
    }

    public function cancelarAgendamento($id): void
    {
        $this->query("UPDATE agendamentos SET status = 'C' WHERE agendamento_id = :id", [":id" => intval($id)]);
    }

    public function concluirAgendamento($id): void
    {
        $this->query("UPDATE agendamentos SET status = 'F' WHERE agendamento_id = :id", [":id" => intval($id)]);
    }
}
