<?php
include "classes/database/data.php";
include "classes/email/email.php";
include "classes/content/content.php";

class venues{

    private $conn;
	private $email;
	private $content;

    function __construct(){
        $connection = new data();
        $this->conn = $connection->startConnection();
		$this->content = new content();
    }
	
	public function createVenue($vName, $vEmail, $vWeb, $vCont, $vAOne, $vATwo, $vCity, $vCounty, $vCountry, $vPostCode, $tier, 
		$owner){
		if(empty($vName)){
			Throw new Exception("Missing Venue Name");
		}
		if(empty($vEmail)){
			Throw new Exception("Missing Venue Email");
		}
		if(!filter_var($vEmail, FILTER_VALIDATE_EMAIL)){
            return array("data" => array("message" => "PLEASE ENTER A CORRECT EMAIL ADDRESS", "created" => 0));
        }
		if(empty($vWeb)){
			Throw new Exception("Missing Venue Website");
		}
		if(empty($vCont)){
			Throw new Exception("Missing Venue Contact Number");
		}
		if(empty($vAOne)){
			Throw new Exception("Missing Venue Address One");
		}
		if(empty($vCity)){
			Throw new Exception("Missing Venue City");
		}
		if(empty($vCounty)){
			Throw new Exception("Missing Venue County");
		}
		if(empty($vCountry)){
			Throw new Exception("Missing Venue Country");
		}
		if(empty($vPostCode)){
			Throw new Exception("Missing Venue Post Code");
		}
		
		$vEmail = strtolower($vEmail);

        $parsed = parse_url($vWeb);
        if (empty($parsed['scheme'])) {
            $vWeb = 'http://' . ltrim($vWeb, '/');
        }
		
		if($this->checkVenueExists($vName, $vEmail, $vCont, $vWeb)){
			return array("data" => array("message" => "Venue already exists.", "created" => 0));
		}
		
		$tokenString = sha1($vEmail) . time() . $vName;
		$token       = md5($tokenString);

        try{
            $insertVenue = $this->conn->prepare("INSERT INTO ds_venues (vName, vWebsite, vContact, vEmail, vAddressOne,
												vAddressTwo, vCityTown, vCounty, vCountry, vPostCode, owner, tier) 
												VALUES (:name, :web, :cont, :email, :a1, :a2, :city, :county, :country, :post,
												:owner, :tier)");
            $insertVenue->bindParam(':name', $vName);
            $insertVenue->bindParam(':web', $vWeb);
            $insertVenue->bindParam(':cont', $vCont);
            $insertVenue->bindParam(':email', $vEmail);
			$insertVenue->bindParam(':a1', $vAOne);
			$insertVenue->bindParam(':a2', $vATwo);
			$insertVenue->bindParam(':city', $vCity);
			$insertVenue->bindParam(':county', $vCounty);
			$insertVenue->bindParam(':country', $vCountry);
			$insertVenue->bindParam(':post', $vPostCode);
			$insertVenue->bindParam(':owner', $owner);
			$insertVenue->bindParam(':tier', $tier);

            if($insertVenue->execute()){
				$vid = $this->conn->lastInsertId();
				
				$expires = strtotime("+1 day");
				$val = $this->conn->prepare("INSERT INTO ds_email_validation (ekey, email, expires, vid) VALUES (:key, :email, :expires, :vid)");
				$val->bindParam(":key", $token);
				$val->bindParam(":email", $vEmail);
				$val->bindParam(":expires", $expires);
				$val->bindParam(":vid", $vid);
				
				if($val->execute()){
					$this->email = new email($vEmail);
					$this->email->setBody($this->content->getContent("SIGNUPVENUE", array($vEmail, $token, $vid)));
					$this->email->setSubject("Welcome to DealChasr!");
					$this->email->executeMail();
					return array("data" => array("created" => 1, "venueID" => $vid));
				} else {
					Throw new Exception(json_encode($val->errorInfo()));
				}
            } else {
                Throw new Exception(json_encode($insertVenue->errorInfo()));
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
	}
	
	public function resendValidation($email, $vid){
		if(empty($email)){
			Throw new Exception("Missing Email Address.");
		}
		if(empty($vid)){
			Throw new Exception("Missing Venue ID.");
		}
		
		$tokenString = sha1($email) . time() . $vid;
		$token       = md5($tokenString);
		
		$expires = strtotime("+1 day");
		$val = $this->conn->prepare("INSERT INTO ds_email_validation (ekey, email, expires, vid) VALUES (:key, :email, :expires, :vid)");
		$val->bindParam(":key", $token);
		$val->bindParam(":email", $email);
		$val->bindParam(":expires", $expires);
		$val->bindParam(":vid", $vid);
		
		if($val->execute()){
			$this->email = new email($email);
			$this->email->setBody($this->content->getContent("SIGNUPVENUE", array($email, $token, $vid)));
			$this->email->setSubject("Welcome to DealChasr!");
			$this->email->executeMail();
			return array("sent" => 1);
		} else {
			Throw new Exception(json_encode($val->errorInfo()));
		}
	}
	
	private function checkVenueExists($vName, $vEmail, $vCont, $vWeb){
		try{
			$findVenue = $this->conn->prepare("SELECT * FROM ds_venues
												WHERE vName = :vName
												AND vContact = :vCont
												AND vWebsite = :vWeb
												AND vEmail = :vEmail");
			$findVenue->bindParam(":vName", $vName);
			$findVenue->bindParam(":vCont", $vCont);
			$findVenue->bindParam(":vWeb", $vWeb);
			$findVenue->bindParam(":vEmail", $vEmail);
			$findVenue->execute();
			$venues = $findVenue->fetchAll();
			if(count($venues) > 0){
				return true;
			} else {
				return false;
			}
		} catch (Exception $e) {
			Throw new Exception($e->getMessage());
		}
	}

    public function getVenues(){
        try{
            $getVenues = $this->conn->prepare("SELECT * FROM ds_venues WHERE active = 1 AND validated = 1");
            $getVenues->execute();

            $venues = $getVenues->fetchAll();

            foreach($venues as $k => $v){
				$vouchCount = $this->getVouchers($v['id']);
				$dealCount = $this->getDeals($v['id']);
				if(count($vouchCount) == 0 && count($dealCount) == 0 && $v['tier'] == 1){
					unset($venues[$k]);
					continue;
				} else if($v['tier'] == 2 || $v['tier'] == 3){
					$venues[$k]['vouchers'] = $vouchCount;
					$venues[$k]['deals'] = $dealCount;
				}
            }
			
			$venues = array_values($venues);

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
	
	public function usedThisMonth($vid){
		try{
			$getVs = $this->conn->prepare('SELECT id, voucherCount FROM ds_vouchers WHERE venueID = :vid
											AND created >= DATE(LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH)
											AND created < DATE(LAST_DAY(CURDATE()) + INTERVAL 1 DAY)');
			$getVs->bindParam(":vid", $vid);
			$getVs->execute();
			
			$vRes = $getVs->fetchAll();
			
			$getDs = $this->conn->prepare('SELECT id FROM ds_deals WHERE venueID = :vid
											AND created >= DATE(LAST_DAY(CURDATE()) + INTERVAL 1 DAY - INTERVAL 1 MONTH)
											AND created < DATE(LAST_DAY(CURDATE()) + INTERVAL 1 DAY)');
			$getDs->bindParam(":vid", $vid);
			$getDs->execute();
			
			$dRes = $getDs->fetchAll();
			
			$vResCount = 0;
			foreach($vRes As $k => $v){
				$vResCount = ($vResCount + $v['voucherCount']);
			}
			
			$total = ($vResCount + count($dRes));
			
			return $total;
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
			
			$used = $this->usedThisMonth($venues['id']);
			$totalUsed = $used;
			$tier = $venues['tier'];
			
			if($tier == 1){
				$tierOneLimit = 50;
				$totalRemaining = ($tierOneLimit - $totalUsed);
				$venues['totalUsed'] = $totalUsed;
				$venues['totalRemaining'] = $totalRemaining;
			} else {
				$venues['totalUsed'] = $totalUsed;
				$venues['totalRemaining'] = 'unlimited';
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

    public function updateDetails($vdesc, $vweb, $vopen, $vcont, $vaone, $vatwo, $vacity, $vacounty, $vacountry, $vapostcode, $vemail){
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
		if(empty($vemail)){
            Throw new Exception("Email is Missing");
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

        $parsed = parse_url($vweb);
        if (empty($parsed['scheme'])) {
            $vweb = 'http://' . ltrim($vweb, '/');
        }

        try{
            $update = $this->conn->prepare("UPDATE ds_venues SET vDescription = :vdesc, vWebsite = :vweb,
                                            vOpenHours = :vopen, vContact = :vcont, vEmail = :email, vAddressOne = :vaone,
                                            vAddressTwo = :vatwo, vCityTown = :vacity, vCounty = :vacounty,
                                            vCountry = :vacountry, vPostCode = :vapostcode");
            $update->bindParam(":vdesc", $vdesc);
            $update->bindParam(":vweb", $vweb);
            $update->bindParam(":vopen", $vopen);
            $update->bindParam(":vcont", $vcont);
			$update->bindParam(":email", $vemail);
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
			
			$stats['invoices'] = $this->getInvoices($vid);

            return $stats;
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }

    }
	
	public function getInvoices($vid){
		if(empty($vid)){
			Throw new Exception("No Venue ID Was Supplied.");
		}
		try{
			$invoices = $this->conn->prepare("SELECT * FROM ds_invoices WHERE venueID = :vid ORDER BY invoiceDate DESC LIMIT 5");
			$invoices->bindParam(":vid", $vid);
			$invoices->execute();
			$data = $invoices->fetchAll();
			return $data;
		} catch (Exception $e) {
			Throw new Exception($e->getMessage());
		}
	}
	
	public function searchVenues($str){
		try{
			$search = $this->conn->prepare("SELECT * FROM ds_venues WHERE id LIKE :str || vEmail LIKE :str2");
			$search->bindValue(":str", "%" . $str . "%");
			$search->bindValue(":str2", "%" . $str . "%");
			$search->execute();
			$results = $search->fetchAll();
			
			if(count($results) > 0){
				$data = $results[0];
			
				$vInfo = $this->conn->prepare("SELECT vt.voucherName, dt.dealName, v.id, (SELECT COUNT(id) FROM ds_redemptions WHERE voucherID = v.id) AS redemptionCount
												FROM ds_vouchers AS v
												JOIN ds_redemptions AS r
												ON v.id = r.voucherID
												JOIN ds_voucher_type AS vt
												ON vt.id = v.voucherTypeID
												JOIN ds_deal_types AS dt
												ON dt.id = v.dealType
												WHERE v.active = 1
												AND v.endDate > NOW()
												AND v.venueID = :vid
												GROUP BY v.id");
				$vInfo->bindParam(":vid", $data['id']);
				$vInfo->execute();
				$data['vouchers'] = $vInfo->fetchAll();
				
				if($data['tier'] == 1){
					$data['tier_string'] = "FREE TIER";
				} else if($data['tier'] == 2) {
					$data['tier_string'] = "PRO TIER";
				} else if($data['tier'] == 3) {
					$data['tier_string'] = "PREMIUM TIER";
				} else {
					$data['tier_string'] = "UNKNOWN TIER (CONTACT SUPPORT)";
				}
				
				return array("data" => array("results" => $data));
			} else {
				return array("data" => array("results" => array()));
			}
			
		} catch (Exception $e) {
			Throw new Exception($e->getMessage());
		}
	}

	public function changeAccountStatus($state, $id){
		if(empty($state)){
			Throw new Exception("Account State not Supplied.");
		}
		if(empty($id)){
			Throw new Exception("Venue ID not supplied.");
		}
		try{
			if($state == "DEACTIVATE"){
				$s = 0;
			} else {
				$s = 1;
			}
			$update = $this->conn->prepare("UPDATE ds_venues SET active = :active WHERE id = :vid");
			$update->bindParam(":active", $s);
			$update->bindParam(":vid", $id);
			$update->execute();
			return array("changed" => 1, "message" => "Account Updated");
		} catch (Exception $e) {
			Throw new Exception($e->getMessage());
		}
	}
	
	public function upgradeAccount($vid, $old, $new, $email){
		if(empty($vid)){
			Throw new Exception("Missing Venue ID");
		}
		if(empty($old)){
			Throw new Exception("Missing Old Tier");
		}
		if(empty($new)){
			Throw new Exception("Missing New Tier");
		}
		if(empty($email)){
			Throw new Exception("Missing Email");
		}
		
		if($old != $new){
			try{
				$upgrade = $this->conn->prepare("UPDATE ds_venues SET tier = :tier WHERE id = :vid");
				$upgrade->bindParam(":vid", $vid);
				$upgrade->bindParam(":tier", $new);
				if($upgrade->execute()){
					if($new == 1){
						$tierStr = "FREE";
					} else if($new == 2) {
						$tierStr = "PRO";
					} else {
						$tierStr = "PREMIUM";
					}
					$email = new email($email);
					$email->setBody($this->content->getContent("ACCOUNTUPGRADE", array($tierStr)));
					$email->setSubject("Account Upgrade - DealChasr");
					$email->executeMail();
					
					return array("upgraded" => 1);
				} else {
					Throw new Exception("There was a problem upgrading your account.");
				}
			} catch (Exception $e) {
				Throw new Exception($e->getMessage());
			}
		} else {
			Throw new Exception("Tiers are the same");
		}
	}
}