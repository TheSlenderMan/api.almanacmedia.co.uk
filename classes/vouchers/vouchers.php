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

    public function createVoucher($uid, $vid, $did, $void, $vcount, $vdesc, $time){
        try{
            $date = date("Y-m-d");
            $newDate = $date . ' ' . $time;

            $voucher = $this->conn->prepare("INSERT INTO ds_vouchers (voucherTypeID, venueID, dealType, voucherCount,
                                                         voucherDescription, endDate, active)
                                                         VALUES (:void, :vid, :did, :vcount, :vdesc, :vtime, 1)");
            $voucher->bindParam(":void", $void);
            $voucher->bindParam(":vid", $vid);
            $voucher->bindParam(":did", $did);
            $voucher->bindParam(":vcount", $vcount);
            $voucher->bindParam(":vdesc", $vdesc);
            $voucher->bindParam(":vtime", $newDate);

            if($voucher->execute()){
                return array("data" => array("created" => 1, "voucher" => $this->conn->lastInsertId()));
            } else {
                Throw new Exception(json_encode($voucher->errorInfo()));
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
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

    public function getVouchersByVenueId($vid){
        if(empty($vid)){
            Throw new Exception("Venue ID not supplied.");
        }
        try{
            $vouchers = $this->conn->prepare("SELECT v.id, v.active, v.venueID, ve.vName, ve.vWebsite, v.voucherCount,
                                                        v.endDate, v.voucherDescription, d.dealName,
                                                        vt.voucherName FROM ds_vouchers AS v
                                                        JOIN ds_voucher_type AS vt ON
                                                        vt.id =  v.voucherTypeID
                                                        JOIN ds_venues AS ve ON ve.id = v.venueID
                                                        JOIN ds_deal_types AS d ON d.id = v.dealType
                                                        WHERE v.venueID = :vid
                                                        AND v.endDate > NOW()
                                                        AND v.voucherCount > 0
                                                        AND v.active = 1");
            $vouchers->bindParam(":vid", $vid);
            $vouchers->execute();
            $venueVouchers = $vouchers->fetchAll();

            return array("data" => $venueVouchers);

        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

    public function getDealsByVenueId($vid){
        if(empty($vid)){
            Throw new Exception("Venue ID not supplied.");
        }
        try{
            $vouchers = $this->conn->prepare("SELECT d.id, d.daily, d.active, d.venueID, d.dealDate, d.dealTypeID,
                                                        d.dealDescription, de.dealName, d.dealTitle, d.recurring, d.daily
                                                        FROM ds_deals AS d
                                                        JOIN ds_deal_types AS de ON
                                                        de.id =  d.dealTypeID
                                                        JOIN ds_venues AS v ON v.id = d.venueID
                                                        WHERE d.venueID = :vid
                                                        AND d.active = 1");
            $vouchers->bindParam(":vid", $vid);
            $vouchers->execute();
            $venueVouchers = $vouchers->fetchAll();

            return array("data" => $venueVouchers);

        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

    public function deactivateVoucher($vid, $venue){
        if(empty($vid)){
            Throw new Exception("No voucher id was supplied.");
        }
        if(empty($venue)){
            Throw new Exception("No venue ID was supplied.");
        }

        if($this->checkVoucherOwner($venue, $vid)){
            try{
                $deactivate = $this->conn->prepare("UPDATE ds_vouchers SET active = 0 WHERE id = :vid");
                $deactivate->bindParam(":vid", $vid);
                if($deactivate->execute()){
                    return array("removed" => 1);
                } else {
                    Throw new Exception($deactivate->errorInfo());
                }
            } catch (Exception $e) {
                Throw new Exception($e->getMessage());
            }
        } else {
            Throw new Exception("End Failed: You do not own this voucher.");
        }
    }

    public function deactivateDeal($did, $venue){
        if(empty($did)){
            Throw new Exception("No deal id was supplied.");
        }
        if(empty($venue)){
            Throw new Exception("No venue ID was supplied.");
        }

        if($this->checkDealOwner($venue, $did)){
            try{
                $deactivate = $this->conn->prepare("UPDATE ds_deals SET active = 0 WHERE id = :vid");
                $deactivate->bindParam(":vid", $did);
                if($deactivate->execute()){
                    return array("removed" => 1);
                } else {
                    Throw new Exception($deactivate->errorInfo());
                }
            } catch (Exception $e) {
                Throw new Exception($e->getMessage());
            }
        } else {
            Throw new Exception("End Failed: You do not own this voucher.");
        }
    }

    public function checkVoucherOwner($venue, $vid){
        try{
            $check = $this->conn->prepare("SELECT id FROM ds_vouchers WHERE id = :vid AND venueID = :ven");
            $check->bindParam(":vid", $vid);
            $check->bindParam(":ven", $venue);
            $check->execute();
            $count = $check->fetch();
            if(!empty($count)){
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

    public function checkDealOwner($venue, $did){
        try{
            $check = $this->conn->prepare("SELECT id FROM ds_deals WHERE id = :did AND venueID = :ven");
            $check->bindParam(":did", $did);
            $check->bindParam(":ven", $venue);
            $check->execute();
            $count = $check->fetch();
            if(!empty($count)){
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }


}