<?php
include "classes/notifications/notifications.php";

$n = new notifications();
if(isset($_POST['type']) && isset($_POST['tog']) && isset($_POST['uid'])){
    try{
        echo json_encode($n->updateSettings($_POST['uid'], $_POST['type'], $_POST['tog']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("FCM" => false));
        exit;
    }
} else {
    echo json_encode(array("FCM" => false));
    exit;
}