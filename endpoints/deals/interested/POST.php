<?php
include "classes/deals/deals.php";

if(isset($_POST['userID']) && isset($_POST['voucherID'])){
    try{
        $deals = new deals();
        echo json_encode($deals->markInterested($_POST['userID'], $_POST['voucherID']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data.", "code" => 1));
    exit;
}