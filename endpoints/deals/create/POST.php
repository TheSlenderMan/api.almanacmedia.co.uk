<?php
include "classes/deals/deals.php";

if(isset($_POST['userID']) && isset($_POST['venueID']) && isset($_POST['dealID']) && isset($_POST['dealTitle'])
    && isset($_POST['dealDescription']) && isset($_POST['dealDate']) && isset($_POST['dealTime']) && isset($_POST['recurring'])
    && isset($_POST['daily'])){
    try{
        $deals = new deals();
        echo json_encode($deals->createDeal($_POST['userID'], $_POST['venueID'], $_POST['dealID'], $_POST['dealTitle']
            , $_POST['dealDescription'], $_POST['dealDate'], $_POST['dealTime'], $_POST['recurring'], $_POST['daily']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data.", "code" => 1));
    exit;
}