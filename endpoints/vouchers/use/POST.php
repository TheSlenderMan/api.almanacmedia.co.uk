<?php
include "classes/vouchers/vouchers.php";

$v = new vouchers();

if(isset($_POST['userID']) && isset($_POST['voucherID']) && isset($_POST['activeDate'])){
    try{
        echo json_encode($v->useVoucher($_POST['userID'], $_POST['voucherID'], $_POST['activeDate']));
        exit;
    } catch (Exception $e){
        echo json_encode(array("message" => $e->getMessage()));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required Data"));
    exit;
}