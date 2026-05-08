<?php

namespace Source\Models;

use Source\Entities\Especialidade;

class EspecialidadeModel extends Model {

    public function cadastrar(Especialidade $especialidade): void {
        $this->query('INSERT INTO especialidades (descricao) VALUES (:descricao)', [':descricao' => $especialidade->getDescricao()]);
    }
    
    public function alterar(Especialidade $especialidade): void {
        $this->query('UPDATE especialidades SET descricao = :descricao WHERE especialidade_id = :id', 
        [':descricao' => $especialidade->getDescricao(), ':id' => $especialidade->getEspecialidade_id()]);
    }

    public function listarTodos(): array {
        return $this->select('SELECT * FROM especialidades ORDER BY descricao');
    }

    public function buscarPorId($id): array {
        $especialidade = $this->select('SELECT * FROM especialidades WHERE especialidade_id = :id', [':id' => intval($id)]);
        return $especialidade[0];
    }
    
    public function deletarPorId($id): void {
        $this->query('DELETE FROM especialidades WHERE especialidade_id = :id', [':id' => intval($id)]);
    }

}