<?php

class State extends model
{
    private $uid;

    function __construct()
    {
        parent::__construct();
        $this->tableName = "states";
    }

    public function index()
    {
        $array = array();
        $dataReturn = array();

        $sql = "SELECT s.*, count(u.id) user_amount FROM " . $this->tableName . " s";
        $sql .= " LEFT JOIN cities c on s.id = c.state_id";
        $sql .= " LEFT JOIN addresses a on c.id = a.city_id";
        $sql .= " LEFT JOIN users u on a.id = u.address_id";
        $sql .= " GROUP BY s.id";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
            foreach ($array as $data) {
                $dataReturn[] = [
                    'id' => $data['id'],
                    'uf' => $data['uf'],
                    'name' => $data['name'],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['updated_at'],
                    'user_amount' => $data['user_amount']
                ];
            }
        } else {
            $dataReturn = [
                'success' => false,
                'message' => 'State not found'
            ];
        }

        return $dataReturn;
    }

    public function create($params)
    {
        $dataReturn = array();

        $sql = "INSERT INTO " . $this->tableName . " (uf, name, created_at, updated_at) VALUES (:uf, :name, :created_at, :updated_at)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':uf', $params['uf']);
        $sql->bindValue(':name', $params['name']);
        $sql->bindValue(':created_at', date("Y-m-d H:i:s"));
        $sql->bindValue(':updated_at', date("Y-m-d H:i:s"));
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $dataReturn = [
                'id' => $this->db->lastInsertId(),
                'uf' => $params['uf'],
                'name' => $params['name'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
        } else {
            $dataReturn = [
                'success' => false,
                'message' => 'State not created'
            ];
        }

        return $dataReturn;
    }

    public function read($params)
    {
        $array = array();
        $dataReturn = array();

        $sql = "SELECT s.*, count(u.id) user_amount FROM " . $this->tableName . " s";
        $sql .= " LEFT JOIN cities c on s.id = c.state_id";
        $sql .= " LEFT JOIN addresses a on c.id = a.city_id";
        $sql .= " LEFT JOIN users u on a.id = u.address_id";
        $sql .= " WHERE s.id = :id";
        $sql .= " GROUP BY s.id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $params['id']);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $dataReturn = [
                'id' => $array['id'],
                'uf' => $array['uf'],
                'name' => $array['name'],
                'created_at' => $array['created_at'],
                'updated_at' => $array['updated_at'],
                'user_amount' => $array['user_amount']
            ];
        } else {
            $dataReturn = [
                'success' => false,
                'message' => 'State not found'
            ];
        }

        return $dataReturn;
    }

    public function update($params)
    {
        $dataReturn = array();

        $sql = "UPDATE " . $this->tableName . " SET uf = :uf, name = :name, updated_at = :updated_at WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':uf', $params['uf']);
        $sql->bindValue(':name', $params['name']);
        $sql->bindValue(':updated_at', date("Y-m-d H:i:s"));
        $sql->bindValue(':id', $params['id']);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dataReturn = ['success' => true, 'message' => 'State successfully updated'];
        } else {
            $dataReturn = ['success' => false, 'message' => 'State not updated'];
        }

        return $dataReturn;
    }

    public function delete($params)
    {
        $dataReturn = array();

        $sql = "DELETE FROM " . $this->tableName . " WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $params['id']);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dataReturn = ['success' => true, 'message' => 'State successfully deleted'];
        } else {
            $dataReturn = ['success' => false, 'message' => 'State not deleted'];
        }

        return $dataReturn;
    }

    public function readOrCreate($params)
    {
        $array = array();
        $dataReturn = array();

        $sql = "SELECT * FROM " . $this->tableName;
        $sql .= " WHERE name = :name AND uf = :uf";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':name', $params['name']);
        $sql->bindValue(':uf', $params['uf']);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $dataReturn = [
                'id' => $array['id'],
                'uf' => $array['uf'],
                'name' => $array['name'],
                'created_at' => $array['created_at'],
                'updated_at' => $array['updated_at']
            ];
        } else {
            $dataReturn = $this->create($params);
        }

        return $dataReturn;
    }
}
