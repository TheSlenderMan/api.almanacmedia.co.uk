<?php
include "classes/database/data.php";

class deals{

    private $conn;

    function __construct(){
        $connection = new data();
        $this->conn = $connection->startConnection();
    }

    public function markInterested($userID, $voucherID){
        if(empty($userID)){
            Throw new Exception("User ID not supplied.");
        }
        if(empty($voucherID)){
            Throw new Exception("Voucher ID not supplied.");
        }

        try{
            $markAs = $this->conn->prepare("INSERT INTO ds_imgoing (userID, dealID) VALUES (:userID, :dealID)");
            $markAs->bindParam(':userID', $userID);
            $markAs->bindParam(':dealID', $voucherID);

            if($markAs->execute()){
                return array("data" => array("created" => 1, "interest" => $this->conn->lastInsertId()));
            } else {
                Throw new Exception(json_encode($markAs->errorInfo()));
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

}