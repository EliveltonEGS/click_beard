<?php

namespace Source\Entities;

class Cliente
{

    private $cliente_id;
    private $nome;
    private $email;
    private $senha;
    private $confirm_senha;
    private $tipo;

    function getCliente_id()
    {
        return $this->cliente_id;
    }

    function getNome()
    {
        return $this->nome;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getSenha()
    {
        return $this->senha;
    }

    function getConfirm_senha()
    {
        return $this->confirm_senha;
    }

    function getTipo()
    {
        return $this->tipo;
    }

    function setCliente_id($cliente_id): void
    {
        $this->cliente_id = $cliente_id;
    }

    function setNome($nome): void
    {
        $this->nome = $nome;
    }

    function setEmail($email): void
    {
        $this->email = $email;
    }

    function setSenha($senha): void
    {
        $this->senha = $senha;
    }

    function setConfirm_senha($confirm_senha): void
    {
        $this->confirm_senha = $confirm_senha;
    }

    function setTipo($tipo): void
    {
        $this->tipo = $tipo;
    }
}
