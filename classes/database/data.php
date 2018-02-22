<?php
include "../settings/settings.php";

class data{

    private $conn;

    function __construct(){
        try{
            $this->conn = new PDO('mysql:dbname=' . DS_DATABASE_NAME . ';host=' . DS_DATABASE_HOST, DS_DATABASE_USERNAME, DS_DATABASE_PASSWORD);
        } catch (Exception $e) {
            header("HTTP/1.1 400 Bad Request");
            Throw new Exception($e->getMessage());
        }
    }

    public function startConnection(){
        return $this->conn;
    }

}