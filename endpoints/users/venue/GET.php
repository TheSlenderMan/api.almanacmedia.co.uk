<?php
include "classes/venues/venues.php";


try{
    $venues = new venues();
    if(isset($_GET['userID'])){
        $uid = $_GET['userID'];
    } else {
        echo json_encode(array("message" => "No USER ID supplied", "code" => 1));
        exit;
    }
    echo json_encode($venues->getVenueByUser($uid));
    exit;
} catch (Exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "code" => 1));
    exit;
}