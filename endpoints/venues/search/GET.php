<?php
include "classes/venues/venues.php";

$venues = new venues();

if(isset($_GET['search'])){
	echo json_encode($venues->searchVenues($_GET['search']));
	exit;
} else {
	echo json_encode(array("message" => "Missing Required Data", "code" => 0));
	exit;
}