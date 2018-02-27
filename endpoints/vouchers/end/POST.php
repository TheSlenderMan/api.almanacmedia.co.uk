<?php
include "classes/vouchers/vouchers.php";

if(isset($_POST['venueID']) && isset($_POST['voucherID'])){
    try{
        $vouchers = new vouchers();
        echo json_encode($vouchers->deactivateVoucher($_POST['voucherID'], $_POST['venueID']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data", "code" => 1));
    exit;
}