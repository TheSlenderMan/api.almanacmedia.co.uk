<?php
include "classes/venues/venues.php";


try{
    $venues = new venues();
    if(isset($_GET['userID'])){
        $uid = $_GET['userID'];
    } else {
        $uid = false;
    }
    echo json_encode($venues->getVenue($_GET['VID'], $uid));
    exit;
} catch (Exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "code" => 1));
    exit;
}
