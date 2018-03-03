<?php
include "classes/venues/venues.php";


try{
    $venues = new venues();
    echo json_encode($venues->getVenue($_GET['VID']));
    exit;
} catch (Exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "code" => 1));
    exit;
}
