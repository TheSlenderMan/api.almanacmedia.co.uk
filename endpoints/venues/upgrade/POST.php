<?php
include "classes/venues/venues.php";

if(isset($_POST['venueID']) && isset($_POST['oldTier']) && isset($_POST['newTier']) && isset($_POST['email'])){
    try{
        $venues = new venues();
        echo json_encode($venues->upgradeAccount($_POST['venueID'], $_POST['oldTier'], $_POST['newTier'], $_POST['email']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1, "upgraded" => 0));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data.", "code" => 1, "upgraded" => 0));
    exit;
}