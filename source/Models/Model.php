<?php

namespace Source\Models;

use PDO;

class Model
{   
    private function getConnect()
    {
        $conn = new PDO(DB_CONFIG["driver"].":host=".DB_CONFIG["host"].";dbname=".DB_CONFIG["dbname"], DB_CONFIG["username"], DB_CONFIG["passwd"]);
        return $conn;
    }

    private function setParams($statement, $parameters = array())
    {

        foreach ($parameters as $key => $value) {

            $this->setParam($statement, $key, $value);
        }
    }

    private function setParam($statement, $key, $value)
    {

        $statement->bindParam($key, $value);
    }

    //insert, update, delete, getById
    public function query($rawQuery, $params = array())
    {

        $stmt = $this->getConnect()->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;
    }

    //getAll
    public function select($rawQuery, $params = array()): array
    {

        $stmt = $this->query($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}