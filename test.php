<?php
include 'classes/notifications/notifications.php';

$n = new notifications();

$n->setTitle("Hi from DealChasr!");
$n->setMessage("We're just checking everything is OK!");
$n->setTopic('news');
echo $n->sendNotification();