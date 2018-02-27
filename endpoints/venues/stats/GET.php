<?php
include "classes/venues/venues.php";


try{
    $venues = new venues();
    if(isset($_GET['vid'])){
        echo json_encode($venues->getVenueStats($_GET['vid']));
        exit;
    } else {
        echo json_encode(array("message" => "Missing Venue ID"));
        exit;
    }

} catch (Exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "code" => 1));
    exit;
}