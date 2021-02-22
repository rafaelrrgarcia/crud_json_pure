<?php

class User extends model
{
    private $uid;

    function __construct()
    {
        parent::__construct();
        $this->tableName = "users";
    }

    public function index()
    {
        $array = array();
        $dataReturn = array();

        $sql = "SELECT * FROM " . $this->tableName;
        $sql = $this->db->prepare($sql);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
            foreach ($array as $data) {
                $dataReturn[] = [
                    'id' => $data['id'],
                    'address_id' => $data['address_id'],
                    'name' => $data['name'],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['updated_at']
                ];
            }
        } else {
            $dataReturn = [
                'success' => false,
                'message' => 'User not found'
            ];
        }

        return $dataReturn;
    }

    public function create($params)
    {
        $dataReturn = array();

        $sql = "INSERT INTO " . $this->tableName . " (address_id, name, created_at, updated_at) VALUES (:address_id, :name, :created_at, :updated_at)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':address_id', $params['address_id']);
        $sql->bindValue(':name', $params['name']);
        $sql->bindValue(':created_at', date("Y-m-d H:i:s"));
        $sql->bindValue(':updated_at', date("Y-m-d H:i:s"));
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $dataReturn = [
                'id' => $this->db->lastInsertId(),
                'address_id' => $params['address_id'],
                'name' => $params['name'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
        } else {
            $dataReturn = [
                'success' => false,
                'message' => 'User not created'
            ];
        }

        return $dataReturn;
    }

    public function read($params)
    {
        $array = array();
        $dataReturn = array();

        $sql = "SELECT * FROM " . $this->tableName . " WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $params['id']);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $dataReturn = [
                'id' => $array['id'],
                'address_id' => $array['address_id'],
                'name' => $array['name'],
                'created_at' => $array['created_at'],
                'updated_at' => $array['updated_at']
            ];
        } else {
            $dataReturn = [
                'success' => false,
                'message' => 'User not found'
            ];
        }

        return $dataReturn;
    }

    public function update($params)
    {
        $dataReturn = array();

        $sql = "UPDATE " . $this->tableName . " SET address_id = :address_id, name = :name, updated_at = :updated_at WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':address_id', $params['address_id']);
        $sql->bindValue(':name', $params['name']);
        $sql->bindValue(':updated_at', date("Y-m-d H:i:s"));
        $sql->bindValue(':id', $params['id']);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dataReturn = ['success' => true, 'message' => 'User successfully updated'];
        } else {
            $dataReturn = ['success' => false, 'message' => 'User not updated'];
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
            $dataReturn = ['success' => true, 'message' => 'User successfully deleted'];
        } else {
            $dataReturn = ['success' => false, 'message' => 'User not deleted'];
        }

        return $dataReturn;
    }
}
