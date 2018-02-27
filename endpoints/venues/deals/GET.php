<?php
include "classes/vouchers/vouchers.php";

if(isset($_GET['venueID'])){
    try{
        $vouchers = new vouchers();
        echo json_encode($vouchers->getDealsByVenueId($_GET['venueID']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data", "code" => 1));
    exit;
}

