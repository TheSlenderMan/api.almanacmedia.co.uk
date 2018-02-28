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

    public function getVenueByUser($uid){
        try{
            $getVenues = $this->conn->prepare("SELECT * FROM ds_venues WHERE owner = :UID");
            $getVenues->bindParam(":UID", $uid);
            $getVenues->execute();

            $venues = $getVenues->fetch();

            if(empty($venues)){
                return array("data" => array("found" => 0, "venues" => "No venues found"));
            } else {
                return array("data" => array("found" => 1, "venues" => $venues));
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

    public function updateImage($id, $path){
        try{
            $update = $this->conn->prepare("UPDATE ds_venues SET vHeader = :path WHERE id = :id");
            $update->bindParam(":path", $path);
            $update->bindParam(":id", $id);
            if($update->execute()){
                return array("updated" => $path);
            } else {
                return array("updated" => 0);
            }
        } catch(Exception $e){
            Throw new Exception($e->getMessage());
        }
    }

    public function updateDetails($vdesc, $vweb, $vopen, $vcont, $vaone, $vatwo, $vacity, $vacounty, $vacountry, $vapostcode){
        if(empty($vdesc)){
            Throw new Exception("Description is Missing");
        }
        if(empty($vweb)){
            Throw new Exception("Website is Missing");
        }
        if(empty($vopen)){
            Throw new Exception("Open Hours is Missing");
        }
        if(empty($vcont)){
            Throw new Exception("Contact is Missing");
        }
        if(empty($vaone)){
            Throw new Exception("Address One is Missing");
        }
        if(empty($vacity)){
            Throw new Exception("City is Missing");
        }
        if(empty($vacountry)){
            Throw new Exception("Country is Missing");
        }
        if(empty($vapostcode)){
            Throw new Exception("Post Code is Missing");
        }
        try{
            $update = $this->conn->prepare("UPDATE ds_venues SET vDescription = :vdesc, vWebsite = :vweb,
                                            vOpenHours = :vopen, vContact = :vcont, vAddressOne = :vaone,
                                            vAddressTwo = :vatwo, vCityTown = :vacity, vCounty = :vacounty,
                                            vCountry = :vacountry, vPostCode = :vapostcode");
            $update->bindParam(":vdesc", $vdesc);
            $update->bindParam(":vweb", $vweb);
            $update->bindParam(":vopen", $vopen);
            $update->bindParam(":vcont", $vcont);
            $update->bindParam(":vaone", $vaone);
            $update->bindParam(":vatwo", $vatwo);
            $update->bindParam(":vacity", $vacity);
            $update->bindParam(":vacounty", $vacounty);
            $update->bindParam(":vacountry", $vacountry);
            $update->bindParam(":vapostcode", $vapostcode);
            if($update->execute()){
                return array("updated" => 1);
            } else {
                return array("updated" => 0, "message" => $update->errorInfo());
            }
        } catch (Exception $e){
            Throw new Exception($e->getMessage());
        }
    }

    public function getVenueStats($vid){
        if(empty($vid)){
            Throw new Exception("No venue ID was supplied.");
        }

        try{
            $stats = array("chartData" => array(), "voucherCount" => 0, "dealCount" => 0, "vouchers" => array(), "deals" => array());

            // First day of the month.
            $start = date('Y-m-01 00:00:00');
            // Last day of the month.
            $end = date('Y-m-t 23:59:59');

            $vouchers = $this->conn->prepare("SELECT * FROM ds_vouchers WHERE venueID = :vid");
            $vouchers->bindParam(":vid", $vid);
            $vouchers->execute();

            $getVouchers = $vouchers->fetchAll();
            foreach($getVouchers AS $k => $v){
                $redeemed = $this->conn->prepare("SELECT id, redeemed FROM ds_redemptions WHERE voucherID = :voucher
                                                  AND redeemed > :start AND redeemed < :endd");
                $redeemed->bindParam(":voucher", $v['id']);
                $redeemed->bindParam(":start", $start);
                $redeemed->bindParam(":endd", $end);
                $redeemed->execute();
                $rs = $redeemed->fetchAll();

                foreach($rs AS $rk => $rv){
                    $thisDate = date("Y-m-d", strtotime($rv['redeemed']));
                    if(isset($stats['chartData'][$thisDate])){
                        $stats['chartData'][$thisDate] = $stats['chartData'][$thisDate] + 1;
                    } else {
                        $stats['chartData'][$thisDate] = 1;
                    }
                    $stats['vouchers'][] = $rv;
                }

                $stats['voucherCount'] = ($stats['voucherCount'] + count($rs));
            }

            $deals = $this->conn->prepare("SELECT * FROM ds_deals WHERE venueID = :vid");
            $deals->bindParam(":vid", $vid);
            $deals->execute();

            $getDeals = $deals->fetchAll();
            foreach($getDeals AS $kk => $vv){
                $interested = $this->conn->prepare("SELECT id FROM ds_imgoing WHERE dealID = :deal");
                $interested->bindParam(":deal", $vv['id']);
                $interested->execute();
                $in = $interested->fetchAll();
                $stats['dealCount'] = ($stats['dealCount'] + count($in));
                $stats['deals'][] = $vv;
            }

            return $stats;
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }

    }

}