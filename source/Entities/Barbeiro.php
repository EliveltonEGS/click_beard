<?php

namespace Source\Entities;

class Barbeiro
{

    private $barbeiro_id;
    private $nome;
    private $cpf;
    private $dataContratacao;

    function getBarbeiro_id()
    {
        return $this->barbeiro_id;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getCpf()
    {
        return $this->cpf;
    }

    function getDataContratacao()
    {
        return $this->dataContratacao;
    }

    function setBarbeiro_id($barbeiro_id): void
    {
        $this->barbeiro_id = $barbeiro_id;
    }

    function setNome($nome): void
    {
        $this->nome = $nome;
    }

    function setCpf($cpf): void
    {
        $this->cpf = $cpf;
    }

    function setDataContratacao($dataContratacao): void
    {
        $this->dataContratacao = $dataContratacao;
    }
}
