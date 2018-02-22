<?php
include "classes/database/data.php";
include "classes/email/email.php";
include "classes/content/content.php";

class vouchers{

    private $conn;
    private $email;
    private $content;

    function __construct(){
        $connection = new data();
        $this->conn = $connection->startConnection();
        $this->content = new content();
    }

    public function redeemVoucher($userID, $voucherID){
        if(empty($userID)){
            Throw new Exception("User ID not supplied.");
        }
        if(empty($voucherID)){
            Throw new Exception("Voucher ID not supplied.");
        }

        try{

            $getUser = $this->conn->prepare("SELECT fullName, email FROM ds_users WHERE id = :uid");
            $getUser->bindParam(":uid", $userID);
            $getUser->execute();
            $userDetails = $getUser->fetch();

            $uName = $userDetails['fullName'];
            $uEmail = $userDetails['email'];

            $markAs = $this->conn->prepare("INSERT INTO ds_redemptions (userID, voucherID) VALUES (:userID, :voucherID)");
            $markAs->bindParam(':userID', $userID);
            $markAs->bindParam(':voucherID', $voucherID);

            if($markAs->execute()){
                $redeemOne = $this->conn->prepare("UPDATE ds_vouchers SET voucherCount = voucherCount - 1 WHERE id = :id");
                $redeemOne->bindParam(":id", $voucherID);
                $redeemOne->execute();

                $this->email = new email($uEmail);
                $this->email->setSubject("New voucher redeemed!");
                $this->email->setBody($this->content->getContent("VOUCHERREDEEMED", array($uName)));
                $this->email->executeMail();

                return array("data" => array("created" => 1, "redeemed" => $this->conn->lastInsertId()));
            } else {
                Throw new Exception(json_encode($markAs->errorInfo()));
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

    public function getVoucher($uid, $vid){
        if(empty($uid)){
            Throw new Exception("User ID not supplied.");
        }
        if(empty($vid)){
            Throw new Exception("Voucher ID not supplied.");
        }

        try{
            $getVoucher = $this->conn->prepare("SELECT v.id, v.active, v.venueID, ve.vName, ve.vWebsite, v.voucherCount,
                                                        v.endDate, v.voucherDescription, d.dealName,
                                                        vt.voucherName FROM ds_vouchers AS v
                                                        JOIN ds_voucher_type AS vt ON
                                                        vt.id =  v.voucherTypeID
                                                        JOIN ds_venues AS ve ON ve.id = v.venueID
                                                        JOIN ds_deal_types AS d ON d.id = v.dealType
                                                        WHERE v.id = :vid");
            $getVoucher->bindParam(":vid", $vid);
            $getVoucher->execute();

            $voucher = $getVoucher->fetch();

            if(empty($voucher)){
                return array("data" => array("found" => 0, "venues" => "No voucher found"));
            } else {
                return array("data" => array("found" => 1, "voucher" => $voucher));
            }
        } catch (Exception $e){
            Throw new Exception($e->getMessage());
        }
    }

}