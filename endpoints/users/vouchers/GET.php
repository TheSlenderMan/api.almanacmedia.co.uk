<?php
include "classes/users/users.php";

try{
    $vouchers = new users();
    echo json_encode($vouchers->getVouchers($_GET['userID']));
    exit;
} catch (Exception $e) {
    echo json_encode(array("message" => $e->getMessage(), "code" => 1));
    exit;
}