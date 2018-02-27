<?php
include "classes/vouchers/vouchers.php";

if(isset($_POST['userID']) && isset($_POST['venueID']) && isset($_POST['dealID']) && isset($_POST['voucherID'])
&& isset($_POST['voucherCount']) && isset($_POST['voucherDescription']) && isset($_POST['voucherTime'])){
    try{
        $vouchers = new vouchers();
        echo json_encode($vouchers->createVoucher($_POST['userID'], $_POST['venueID'], $_POST['dealID'], $_POST['voucherID']
            , $_POST['voucherCount'], $_POST['voucherDescription'], $_POST['voucherTime']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data.", "code" => 1));
    exit;
}