<?php
include "classes/vouchers/vouchers.php";

if(isset($_POST['userID']) && isset($_POST['voucherID']) && isset($_POST['vlat']) && isset($_POST['vlong'])){
    try{
        $vouchers = new vouchers();
        echo json_encode($vouchers->redeemVoucher($_POST['userID'], $_POST['voucherID'], $_POST['vlat'], $_POST['vlong']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data.", "code" => 1));
    exit;
}