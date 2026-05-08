<?php

namespace Source\Models;

use Source\Entities\Horario;

class HorarioModel extends Model
{

    private function verificaHorarios($data): array
    {
        return $this->select("SELECT horario_id, hora FROM horarios WHERE data = :data AND status = '0'", [":data" => $data]);
    }

    private function  horariosInsercao(): array
    {
        return [
            '08:00:00',
            '08:30:00',
            '09:00:00',
            '09:30:00',
            '10:00:00',
            '10:30:00',
            '11:00:00',
            '11:30:00',
            '12:00:00',
            '12:30:00',
            '13:00:00',
            '13:30:00',
            '14:00:00',
            '14:30:00',
            '15:00:00',
            '15:30:00',
            '16:00:00',
            '16:30:00',
            '17:00:00',
            '17:30:00'
        ];
    }

    public function horarios($data): array
    {
        if (empty($this->verificaHorarios($data))) {

            //insert data com todos os horário e status 0
            foreach ($this->horariosInsercao() as $item) {
                $this->query("INSERT INTO horarios (data, hora) VALUES (:data, :hora)", [":data" => $data, ":hora" => $item]);
            }

            return $this->verificaHorarios($data);
        } else {
            return $this->verificaHorarios($data);
        }
    }

    public function alteraStatusHora(Horario $horario): void
    {
        $this->query(
            "UPDATE horarios SET STATUS = '1' WHERE data = :data AND hora = :hora",
            [":data" => $horario->getData(), ":hora" => $horario->getHora()]
        );
    }

    public function cancelar($id): void
    {
        $this->query("UPDATE horarios SET status = 0 WHERE horario_id = :id", [":id" => intval($id)]);
    }
}
