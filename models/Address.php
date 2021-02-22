<?php

class Address extends model
{
    private $uid;

    function __construct()
    {
        parent::__construct();
        $this->tableName = "addresses";
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
                    'city_id' => $data['city_id'],
                    'address' => $data['address'],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['updated_at']
                ];
            }
        } else {
            $dataReturn = [
                'success' => false,
                'message' => 'Address not found'
            ];
        }

        return $dataReturn;
    }

    public function create($params)
    {
        $dataReturn = array();

        $sql = "INSERT INTO " . $this->tableName . " (city_id, address, created_at, updated_at) VALUES (:city_id, :address, :created_at, :updated_at)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':city_id', $params['city_id']);
        $sql->bindValue(':address', $params['address']);
        $sql->bindValue(':created_at', date("Y-m-d H:i:s"));
        $sql->bindValue(':updated_at', date("Y-m-d H:i:s"));
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $dataReturn = [
                'id' => $this->db->lastInsertId(),
                'city_id' => $params['city_id'],
                'address' => $params['address'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
        } else {
            $dataReturn = [
                'success' => false,
                'message' => 'Address not created'
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
                'city_id' => $array['city_id'],
                'address' => $array['address'],
                'created_at' => $array['created_at'],
                'updated_at' => $array['updated_at'],
            ];
        } else {
            $dataReturn = [
                'success' => false,
                'message' => 'Address not found'
            ];
        }

        return $dataReturn;
    }

    public function update($params)
    {
        $dataReturn = array();

        $sql = "UPDATE " . $this->tableName . " SET city_id = :city_id, address = :address, updated_at = :updated_at WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':city_id', $params['city_id']);
        $sql->bindValue(':address', $params['address']);
        $sql->bindValue(':updated_at', date("Y-m-d H:i:s"));
        $sql->bindValue(':id', $params['id']);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dataReturn = ['success' => true, 'message' => 'Address successfully updated'];
        } else {
            $dataReturn = ['success' => false, 'message' => 'Address not updated'];
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
            $dataReturn = ['success' => true, 'message' => 'Address successfully deleted'];
        } else {
            $dataReturn = ['success' => false, 'message' => 'Address not deleted'];
        }

        return $dataReturn;
    }

    public function readOrCreate($params){
        $array = array();
        $dataReturn = array();

        $sql = "SELECT * FROM " . $this->tableName;
        $sql .= " WHERE address = :address AND city_id = :city_id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':address', $params['address']);
        $sql->bindValue(':city_id', $params['city_id']);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $dataReturn = [
                'id' => $array['id'],
                'city_id' => $array['city_id'],
                'address' => $array['address'],
                'created_at' => $array['created_at'],
                'updated_at' => $array['updated_at']
            ];
        } else {
            $dataReturn = $this->create($params);
        }

        return $dataReturn;
    }
}
