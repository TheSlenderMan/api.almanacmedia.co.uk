<?php
include "classes/venues/venues.php";

if(isset($_POST['email']) && isset($_POST['vid'])){
    try{
        $venues = new venues();
        echo json_encode($venues->resendValidation($_POST['email'], $_POST['vid']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1, "sent" => 0));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data.", "code" => 1, "sent" => 0));
    exit;
}