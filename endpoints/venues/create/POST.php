<?php
include "classes/venues/venues.php";

if(isset($_POST['vName']) && isset($_POST['vEmail']) && isset($_POST['vWeb']) && isset($_POST['vCont']) && isset($_POST['vAOne'])
	 && isset($_POST['vATwo']) && isset($_POST['vCity']) && isset($_POST['vCounty']) && isset($_POST['vCountry'])
  && isset($_POST['vPostCode']) && isset($_POST['tier']) && isset($_POST['owner'])){
    try{
        $venues = new venues();
        echo json_encode($venues->createVenue($_POST['vName'], $_POST['vEmail'], $_POST['vWeb'], $_POST['vCont'], $_POST['vAOne'], 
		$_POST['vATwo'], $_POST['vCity'], $_POST['vCounty'], $_POST['vCountry'], $_POST['vPostCode'], $_POST['tier'], 
		$_POST['owner']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data.", "code" => 1));
    exit;
}