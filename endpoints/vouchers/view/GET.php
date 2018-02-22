<?php
include "classes/vouchers/vouchers.php";


try{
    $vouchers = new vouchers();
    echo json_encode($vouchers->getVoucher($_GET['userID'], $_GET['voucherID']));
    exit;
} catch (Exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "code" => 1));
    exit;
}