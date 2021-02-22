<?php

class City extends model
{
    private $uid;

    function __construct()
    {
        parent::__construct();
        $this->tableName = "cities";
    }

    public function index()
    {
        $array = array();
        $dataReturn = array();

        $sql = "SELECT c.*, count(u.id) user_amount FROM " . $this->tableName . " c";
        $sql .= " LEFT JOIN addresses a ON c.id = a.city_id";
        $sql .= " LEFT JOIN users u ON a.id = u.address_id";
        $sql .= " GROUP BY c.id";


        $sql = $this->db->prepare($sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
            foreach ($array as $data) {
                $dataReturn[] = [
                    'id' => $data['id'],
                    'state_id' => $data['state_id'],
                    'name' => $data['name'],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['updated_at'],
                    'user_amount' => $data['user_amount']
                ];
            }
        } else {
            $dataReturn = [
                'success' => false,
                'message' => 'City not found'
            ];
        }

        return $dataReturn;
    }

    public function create($params)
    {
        $dataReturn = array();

        $sql = "INSERT INTO " . $this->tableName . " (state_id, name, created_at, updated_at) VALUES (:state_id, :name, :created_at, :updated_at)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':state_id', $params['state_id']);
        $sql->bindValue(':name', $params['name']);
        $sql->bindValue(':created_at', date("Y-m-d H:i:s"));
        $sql->bindValue(':updated_at', date("Y-m-d H:i:s"));
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $dataReturn = [
                'id' => $this->db->lastInsertId(),
                'state_id' => $params['state_id'],
                'name' => $params['name'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
        } else {
            $dataReturn = [
                'success' => false,
                'message' => 'City not created'
            ];
        }

        return $dataReturn;
    }

    public function read($params)
    {
        $array = array();
        $dataReturn = array();

        $sql = "SELECT c.*, count(u.id) user_amount FROM " . $this->tableName . " c";
        $sql .= " LEFT JOIN addresses a ON c.id = a.city_id";
        $sql .= " LEFT JOIN users u ON a.id = u.address_id";
        $sql .= " WHERE c.id = :id";
        $sql .= " GROUP BY c.id";

        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $params['id']);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $dataReturn = [
                'id' => $array['id'],
                'state_id' => $array['state_id'],
                'name' => $array['name'],
                'created_at' => $array['created_at'],
                'updated_at' => $array['updated_at'],
                'user_amount' => $array['user_amount']
            ];
        } else {
            $dataReturn = [
                'success' => false,
                'message' => 'City not found'
            ];
        }

        return $dataReturn;
    }

    public function update($params)
    {
        $dataReturn = array();

        $sql = "UPDATE " . $this->tableName . " SET state_id = :state_id, name = :name, updated_at = :updated_at WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':state_id', $params['state_id']);
        $sql->bindValue(':name', $params['name']);
        $sql->bindValue(':updated_at', date("Y-m-d H:i:s"));
        $sql->bindValue(':id', $params['id']);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dataReturn = ['success' => true, 'message' => 'City successfully updated'];
        } else {
            $dataReturn = ['success' => false, 'message' => 'City not updated'];
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
            $dataReturn = ['success' => true, 'message' => 'City successfully deleted'];
        } else {
            $dataReturn = ['success' => false, 'message' => 'City not deleted'];
        }

        return $dataReturn;
    }

    public function readOrCreate($params){
        $array = array();
        $dataReturn = array();

        $sql = "SELECT * FROM " . $this->tableName;
        $sql .= " WHERE name = :name AND state_id = :state_id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':name', $params['name']);
        $sql->bindValue(':state_id', $params['state_id']);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $dataReturn = [
                'id' => $array['id'],
                'state_id' => $array['state_id'],
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
