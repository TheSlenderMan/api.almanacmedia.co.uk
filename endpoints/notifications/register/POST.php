<?php
include "classes/notifications/notifications.php";

$n = new notifications();
if(isset($_POST['uid']) && isset($_POST['did'])){
	try{
		echo json_encode($n->registerDevice($_POST['uid'], $_POST['did']));
		exit;
	} catch (Exception $e) {
		echo json_encode(array("FCM" => $e->getMessage()));
		exit;
	}
} else {
	echo json_encode(array("FCM" => "Missing required data"));
	exit;
}
