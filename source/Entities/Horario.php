<?php

namespace Source\Entities;

class Horario
{

    private $horario_id;
    private $data;
    private $hora;
    private $status;

    function getHorario_id()
    {
        return $this->horario_id;
    }

    function getData()
    {
        return $this->data;
    }

    function getHora()
    {
        return $this->hora;
    }

    function getStatus()
    {
        return $this->status;
    }

    function setHorario_id($horario_id): void
    {
        $this->horario_id = $horario_id;
    }

    function setData($data): void
    {
        $this->data = $data;
    }

    function setHora($hora): void
    {
        $this->hora = $hora;
    }

    function setStatus($status): void
    {
        $this->status = $status;
    }
}
