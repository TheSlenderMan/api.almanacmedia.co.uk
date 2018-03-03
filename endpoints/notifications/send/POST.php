<?php
include "classes/notifications/notifications.php";

if(isset($_POST['nTitle']) && isset($_POST['nMessage']) && isset($_POST['nTopic'])){
    $notifications = new notifications();
    $notifications->setTitle($_POST['nTitle']);
    $notifications->setMessage($_POST['nMessage']);
    $notifications->setTopic($_POST['nTopic']);
    echo json_encode(array("sent" => $notifications->sendNotification()));
} else {
    echo json_encode(array("message" => "Missing Required Data.", "code" => 1));
    exit;
}