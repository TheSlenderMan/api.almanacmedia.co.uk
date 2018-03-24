<?php
include "classes/database/data.php";
class notifications{

	private $conn;
	private $message;
	private $topic;
	private $title;
	private $FBAPIKEY = "AIzaSyBV-1NFuEaJ5eKCl--PcPvL1XVsCvnTtGk";
	private $FBPROJECTNAME = "DealChasrAndroid";
	
	function __construct(){
		$connection = new data();
		$this->conn = $connection->startConnection();
	}
	
	public function setTitle($title){
		$this->title = $title;
	}
	
	public function setMessage($message){
		$this->message = $message;
	}
	
	public function setTopic($topic){
		$this->topic = $topic;
	}
	
	public function sendNotification(){
		$msg = array
		(
			'body'  => $this->message,
			'title'     => $this->title,
			'vibrate'   => 1,
			'sound'     => 1,
		);

		$fields = array
		(
			'to'  => $this->topic,
			'data'          => $msg
		);

		$headers = array
		(
			'Authorization: key=' . $this->FBAPIKEY,
			'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );

		$res = json_decode($result);
		if(isset($res->message_id)){
			$status = 'DELIVERED';
		} else {
			$status = 'FAILED';
		}

		try{
			$store = $this->conn->prepare("INSERT INTO ds_notifications (nTitle, nMessage, nTopic, nStatus) VALUES (:title, :message, :topic, :status)");
			$store->bindParam(":title", $this->title);
			$store->bindParam(":message", $this->message);
			$store->bindParam(":topic", $this->topic);
			$store->bindParam(":status", $status);
			$store->execute();
		} catch (Exception $e){
			Throw new Exception($e->getMessage());
		}
		return $res;
	}
	
	public function registerDevice($uid, $did){
		try{
			$u = $this->conn->prepare("SELECT d.userID, d.global, d.favourite FROM ds_notification_settings AS d WHERE userID = :uid");
			$u->bindParam(":uid", $uid);
			$u->execute();
			$ue = $u->fetchAll();
			
			if(count($ue) < 1){
				$n = $this->conn->prepare("INSERT INTO ds_notification_settings (userID, deviceID, global, favourite) VALUES (:u, :d, 1, 1)");
				$n->bindParam(":u", $uid);
				$n->bindParam(":d", $did);
				$n->execute();
				return array("FCM" => true, "global" => 1, "favourite" => 1);
			} else {
				$n = $this->conn->prepare("UPDATE ds_notification_settings SET deviceID = :d WHERE userID = :u");
				$n->bindParam(":u", $uid);
				$n->bindParam(":d", $did);
				$n->execute();
				return array("FCM" => true, "global" => $ue[0]['global'], "favourite" => $ue[0]['favourite']);
			}
		} catch (Exception $e) {
			Throw new Exception($e->getMessage());
		}
	}

	public function sendToAllGlobal($t, $m){
		try{
			$g = $this->conn->prepare("SELECT * FROM ds_notification_settings WHERE global = 1");
			$g->execute();
			$gs = $g->fetchAll();
			foreach($gs AS $k => $v){
				$this->setTitle($t);
				$this->setMessage($m);
				$this->setTopic($v['deviceID']);
				return $this->sendNotification();
			}
		} catch (Exception $e){
			Throw new Exception($e->getMessage());
		}
	}

	public function updateSettings($uid, $type, $tog){
		try{
			if($type == 'global'){
				$n = $this->conn->prepare("UPDATE ds_notification_settings AS d SET d.global = :g WHERE d.userID = :uu");
				$n->bindParam(":g", $tog);
				$n->bindParam(":uu", $uid);
				$n->execute();
			} else {
				$n = $this->conn->prepare("UPDATE ds_notification_settings AS d SET d.favourite = :g WHERE d.userID = :uu");
				$n->bindParam(":g", $tog);
				$n->bindParam(":uu", $uid);
				$n->execute();
			}
			return array("FCM" => true);
		} catch (Exception $e) {
			Throw new Exception($e->getMessage());
		}
	}
}
?>