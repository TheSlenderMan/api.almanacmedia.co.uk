<?php
include "classes/vouchers/vouchers.php";

if(isset($_POST['venueID']) && isset($_POST['dealID'])){
    try{
        $vouchers = new vouchers();
        echo json_encode($vouchers->deactivateDeal($_POST['dealID'], $_POST['venueID']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data", "code" => 1));
    exit;
}