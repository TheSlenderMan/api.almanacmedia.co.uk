<?php
include "classes/database/data.php";

class venues{

    private $conn;

    function __construct(){
        $connection = new data();
        $this->conn = $connection->startConnection();
    }

    public function getVenues(){
        try{
            $getVenues = $this->conn->prepare("SELECT * FROM ds_venues");
            $getVenues->execute();

            $venues = $getVenues->fetchAll();

            foreach($venues as $k => $v){
                $venues[$k]['vouchers'] = $this->getVouchers($v['id']);
                $venues[$k]['deals'] = $this->getDeals($v['id']);
            }

            if(empty($venues)){
                return array("data" => array("found" => 0, "venues" => "No venues found"));
            } else {
                return array("data" => array("found" => 1, "venues" => $venues));
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

    public function getVenue($VID, $userID){
        try{
            $getVenues = $this->conn->prepare("SELECT * FROM ds_venues WHERE id = :VID");
            $getVenues->bindParam(":VID", $VID);
            $getVenues->execute();

            $venues = $getVenues->fetch();

            $venues['vouchers'] = $this->getVouchers($VID, $userID);
            $venues['deals'] = $this->getDeals($VID, $userID);

            if(empty($venues)){
                return array("data" => array("found" => 0, "venues" => "No venues found"));
            } else {
                return array("data" => array("found" => 1, "venues" => $venues));
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

    public function getVouchers($id, $userID){
        try{
            $getVouchers = $this->conn->prepare("SELECT v.id, v.active, v.venueID, v.voucherCount, v.endDate, v.voucherDescription, d.dealName, vt.voucherName FROM ds_vouchers AS v
                                                        JOIN ds_voucher_type AS vt ON
                                                        vt.id =  v.voucherTypeID
                                                        JOIN ds_venues AS ve ON ve.id = v.venueID
                                                        JOIN ds_deal_types AS d ON d.id = v.dealType
                                                        WHERE ve.id = :vid
                                                        AND v.endDate > NOW()
                                                        AND v.active = 1
                                                        AND v.voucherCount > 0");

            $getVouchers->bindParam(":vid", $id);
            $getVouchers->execute();

            $vouchers = $getVouchers->fetchAll();

            if(empty($vouchers)){
                return array();
            } else {

                $voucherArray = array();

                foreach($vouchers AS $key => $val){
                    $findMatch = $this->conn->prepare("SELECT * FROM ds_redemptions WHERE userID = :userID AND voucherID = :voucherID");
                    $findMatch->bindParam(":userID", $userID);
                    $findMatch->bindParam(":voucherID", $val['id']);
                    $findMatch->execute();

                    $matches = $findMatch->fetchAll();

                    if(!empty($matches)){
                        $val['status'] = $matches;
                    } else {
                        $val['status'] = array();;
                    }

                    $voucherArray[] = $val;

                }

                return $voucherArray;
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

    public function getDeals($id, $userID){
        try{
            $getDeals = $this->conn->prepare("SELECT d.id, d.daily, d.active, d.venueID, d.dealDate, d.dealTypeID, d.dealDescription, de.dealName, d.dealTitle, d.recurring
                                                        FROM ds_deals AS d
                                                        JOIN ds_deal_types AS de ON
                                                        de.id =  d.dealTypeID
                                                        JOIN ds_venues AS v ON v.id = d.venueID
                                                        WHERE d.venueID = :vid
                                                        AND d.active = 1");

            $getDeals->bindParam(":vid", $id);
            $getDeals->execute();

            $deals = $getDeals->fetchAll();

            if(empty($deals)){
                return array();
            } else {

                $dealArray = array();

                foreach($deals AS $key => $val){
                    $findMatch = $this->conn->prepare("SELECT * FROM ds_imgoing WHERE userID = :userID AND dealID = :dealID");
                    $findMatch->bindParam(":userID", $userID);
                    $findMatch->bindParam(":dealID", $val['id']);
                    $findMatch->execute();

                    $matches = $findMatch->fetchAll();

                    if(!empty($matches)){
                        $val['status'] = $matches;
                    } else {
                        $val['status'] = array();;
                    }

                    $dealArray[] = $val;

                }
                return $dealArray;
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

}