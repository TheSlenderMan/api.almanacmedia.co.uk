<?php
include "classes/venues/venues.php";

$venues = new venues();
if(isset($_POST['state']) && isset($_POST['id'])){
	echo json_encode($venues->changeAccountStatus($_POST['state'], $_POST['id']));
	exit;
} else {
	echo json_encode(array("changed" => 0, "message" => "Missing Required Data"));
	exit;
}