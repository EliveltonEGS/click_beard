<?php

namespace Source\Entities;

class Especialidade
{

    private $especialidade_id;
    private $descricao;

    function getEspecialidade_id()
    {
        return $this->especialidade_id;
    }

    function getDescricao()
    {
        return $this->descricao;
    }

    function setEspecialidade_id($especialidade_id): void
    {
        $this->especialidade_id = $especialidade_id;
    }

    function setDescricao($descricao): void
    {
        $this->descricao = $descricao;
    }
}
