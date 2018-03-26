<?php
include "classes/tokens/tokens.php";

$t = new tokens();
if(isset($_POST['client']) && isset($_POST['refreshToken'])){
	echo json_encode($t->refreshToken($_POST['refreshToken'], $_POST['client']));
	exit;
} else {
	echo json_encode(array("message" => "Missing Required Data"));
	exit;
}