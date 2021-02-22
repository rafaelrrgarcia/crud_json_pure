<?php

class Model
{
    protected $db;
    protected $tableName;

    public function __construct()
    {
        global $db;
        $this->db = $db;
    }
}
