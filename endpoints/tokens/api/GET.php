<?php
include "classes/tokens/tokens.php";

$t = new tokens();
if(isset($_GET['client'])){
	echo json_encode($t->getNewToken($_GET['client']));
	exit;
} else {
	echo json_encode(array("message" => "Missing Required Data"));
	exit;
}