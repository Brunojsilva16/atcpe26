<?php

namespace Dsource;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'dataConnection.php';

use DataConnection\DatabaseConnection;
use PDO;

class DataSource
{
    private $conn; // Propriedade para guardar a conexão

    // O construtor obtém a instância da conexão
    public function __construct()
    {
        $this->conn = DatabaseConnection::getInstance();
    }


    private function bindParams(\PDOStatement $stmt, array $params = [])
    {
        if ($params) {
            foreach ($params as $key => $val) {
                $type = (is_null($val)
                    ? \PDO::PARAM_NULL
                    : (is_numeric($val) ? \PDO::PARAM_INT : \PDO::PARAM_STR)
                );
                $stmt->bindValue($key + 1, $val, $type);
            }
        }
    }

    public function select(string $query, array $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $this->bindParams($stmt, $params);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function selectAll(string $query, array $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $this->bindParams($stmt, $params);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insert(string $query, array $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $this->bindParams($stmt, $params);
        return $stmt->execute();
    }

    public function update(string $query, array $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $this->bindParams($stmt, $params);
        return $stmt->execute();
    }

    public function delete(string $query, array $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $this->bindParams($stmt, $params);
        return $stmt->execute();
    }

    public function getOnlyCount(string $query, array $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $this->bindParams($stmt, $params);
        $count = $stmt->fetchColumn(); // pega a primeira coluna da primeira linha
        return (int)$count;
    }


    public function insertWithLastId(string $query, array $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $this->bindParams($stmt, $params);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }
}
