<?php

namespace Source\Models;

use IntlChar;
use Source\Entities\Cliente;

class ClienteModel extends Model
{
    public function cadastrar(Cliente $cliente): void
    {
        $this->query("INSERT INTO clientes (nome, email, senha, confirm_senha) VALUES (:nome, :email, :senha, :confirm_senha)", [
            ":nome" => $cliente->getNome(), ":email" => $cliente->getEmail(), ":senha" => md5($cliente->getSenha()), ":confirm_senha" => md5($cliente->getConfirm_senha())
        ]);
    }

    public function buscarPorEmail($email): int
    {
        $email = $this->select("SELECT email FROM clientes WHERE email = :email", [":email" => $email]);
        if (empty($email[0])) {
            return 0;
        } else {
            return 1;
        }
    }

    public function logar(string $email, string $senha)
    {
        $usuario = $this->select("SELECT cliente_id, nome, tipo FROM clientes WHERE email = :email AND senha = :senha", [
            ":email" => $email, ":senha" => md5($senha)
        ]);

        if (!empty($usuario)) {
            return $usuario[0];
        }
    }

    public function buscarPodId($id): array
    {
        $usuario = $this->select("SELECT nome, email FROM clientes WHERE cliente_id = :id", [":id" => intval($id)]);
        return $usuario[0];
    }
}
