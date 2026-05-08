<?php

namespace Source\Entities;

class Agendamento
{

    private $agendamento_id;
    private $data;
    private Barbeiro $barbeiro;
    private Cliente $cliente;
    private Horario $horario;
    private $status;

    function getAgendamento_id()
    {
        return $this->agendamento_id;
    }

    function getBarbeiro(): Barbeiro
    {
        return $this->barbeiro;
    }

    function getCliente(): Cliente
    {
        return $this->cliente;
    }

    function setAgendamento_id($agendamento_id): void
    {
        $this->agendamento_id = $agendamento_id;
    }

    function setBarbeiro(Barbeiro $barbeiro): void
    {
        $this->barbeiro = $barbeiro;
    }

    function setCliente(Cliente $cliente): void
    {
        $this->cliente = $cliente;
    }

    function getData()
    {
        return $this->data;
    }

    function getHorario(): Horario
    {
        return $this->horario;
    }

    function getStatus()
    {
        return $this->status;
    }

    function setData($data): void
    {
        $this->data = $data;
    }

    function setHorario(Horario $horario): void
    {
        $this->horario = $horario;
    }

    function setStatus($status): void
    {
        $this->status = $status;
    }
}
