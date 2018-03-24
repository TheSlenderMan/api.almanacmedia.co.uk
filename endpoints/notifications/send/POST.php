<?php
include "classes/notifications/notifications.php";

if(isset($_POST['nTitle']) && isset($_POST['nMessage'])){
    try{
        $notifications = new notifications();
        echo json_encode(array("sent" => $notifications->sendToAllGlobal($_POST['nTitle'], $_POST['nMessage'])));
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1));
        exit;
    }

    /*$notifications->setTitle($_POST['nTitle']);
    $notifications->setMessage($_POST['nMessage']);
    $notifications->setTopic($_POST['nTopic']);
    echo json_encode(array("sent" => $notifications->sendNotification()));*/
} else {
    echo json_encode(array("message" => "Missing Required Data.", "code" => 1));
    exit;
}