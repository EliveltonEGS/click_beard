<?php

namespace Source\Models;

use Source\Entities\Barbeiro;
use Source\Entities\BarbeirosEspecialidade;

class BarbeiroModel extends Model
{

    public function cadastrar(Barbeiro $barbeiro): array
    {
        $this->query(
            'INSERT INTO barbeiros (nome, cpf, data_contratacao) VALUES (:nome, :cpf, :data_contratacao)',
            [':nome' => $barbeiro->getNome(), ':cpf' => $barbeiro->getCpf(), ':data_contratacao' => $barbeiro->getDataContratacao()]
        );

        $barbeiro_id = $this->select("SELECT MAX(barbeiro_id) 'barbeiro_id' FROM barbeiros");
        return $barbeiro_id[0];
    }

    public function cadastarBarbiroEspecialidade($barbeiro_id, $especialidade_id)
    {
        $this->query("INSERT INTO barbeiros_especialidades (barbeiro_id, especialidade_id) VALUES (:barbeiro_id, :especialidade_id)", [
            ":barbeiro_id" => $barbeiro_id, ":especialidade_id" => $especialidade_id
        ]);
    }

    public function listarTodos(): array
    {
        $barbeiros = $this->select("SELECT
        barbeiro_id,
        nome,
        DATE_FORMAT(data_contratacao, '%d/%m/%Y') 'data_contratacao'
    FROM 
        barbeiros");

        return $barbeiros;
    }

    public function deletar($id): void
    {
        $this->query("DELETE FROM barbeiros WHERE barbeiro_id = :id", [":id" => intval($id)]);
        $this->query("DELETE FROM barbeiros_especialidades WHERE barbeiro_id = :id", [":id" => intval($id)]);
    }

    public function especialidadBarbeiro($id)
    {
        $barbeiro = $this->select("SELECT 
                (SELECT nome FROM barbeiros WHERE barbeiro_id = be.barbeiro_id) 'nome',
                GROUP_CONCAT(e.descricao) 'especialidade' 
            FROM 
                barbeiros_especialidades be
                    INNER JOIN 
                especialidades e ON e.especialidade_id = be.especialidade_id
            WHERE be.barbeiro_id = :id", [":id" => $id]);

        return $barbeiro[0];
    }
}
