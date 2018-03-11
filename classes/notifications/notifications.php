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
			'to'  => '/topics/' . $this->topic,
			'notification'          => $msg
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
}
?>