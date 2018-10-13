<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.10.2018
 * Time: 13:45
 * @property mysqli $connection
 *
 */

class DB
{

    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    public function connect(){
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->connection->connect_errno) {
            return "Не удалось подключиться к MySQL: (" . $this->connection->connect_errno . ") " . $this->connection->connect_error;
        }
        return true;
    }

    public function query($query){
        $result = $this->connection->query($query);
        return $result;
    }

    public function multiple($query){
        $result = $this->connection->multi_query($query);
        return $result;
    }

    public function error(){
        return $this->connection->error;
    }



}