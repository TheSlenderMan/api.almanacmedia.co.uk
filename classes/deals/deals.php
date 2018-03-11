<?php
include "classes/venues/venues.php";

class deals{

    private $conn;
	private $venues;

    function __construct(){
        $connection = new data();
        $this->conn = $connection->startConnection();
		$this->venues = new venues();
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

			$getVenue = $this->venues->getVenue($vid);
			$tier = $getVenue['data']['venues']['tier'];
			$active = $getVenue['data']['venues']['active'];
			
			if($tier == 1){
				return array("data" => array("created" => 0, "message" => "SORRY, DEALS ARE UNAVAILABLE ON THE FREE ACCOUNT.<br /><br />"));
			}
			
			if($active == 0){
				return array("data" => array("created" => 0, "message" => "SORRY, YOUR ACCOUNT IS NOT ACTIVE AT THE MOMENT.<br /><br />
											Please make sure your payments are up to date. If you believe this to be an error please contact 
											theteam@dealchasr.co.uk"));
			}
		
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