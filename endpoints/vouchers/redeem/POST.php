<?php
include "classes/vouchers/vouchers.php";

if(isset($_POST['userID']) && isset($_POST['voucherID'])){
    try{
        $vouchers = new vouchers();
        echo json_encode($vouchers->redeemVoucher($_POST['userID'], $_POST['voucherID']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data.", "code" => 1));
    exit;
}