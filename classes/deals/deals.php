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

    public function createDeal($uid, $vid, $did, $dtitle, $ddesc, $ddate, $dtime, $rec, $daily){
        try{

            $newDate = $ddate . ' ' . $dtime;

            $deal = $this->conn->prepare("INSERT INTO ds_deals (dealTypeID, venueID, dealTitle,
                                                         dealDescription, dealDate, recurring, daily, active)
                                                         VALUES (:did, :vid, :dtitle, :ddesc, :ddate, :rec, :daily, 1)");
            $deal->bindParam(":did", $did);
            $deal->bindParam(":vid", $vid);
            $deal->bindParam(":dtitle", $dtitle);
            $deal->bindParam(":ddesc", $ddesc);
            $deal->bindParam(":ddate", $newDate);
            $deal->bindParam(":rec", $rec);
            $deal->bindParam(":daily", $daily);

            if($deal->execute()){
                return array("data" => array("created" => 1, "deal" => $this->conn->lastInsertId()));
            } else {
                Throw new Exception(json_encode($deal->errorInfo()));
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

}