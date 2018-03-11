<?php
include "classes/invoices/invoices.php";

$invoices = new invoices();

if(isset($_POST['id']) && isset($_POST['note'])){
	echo json_encode($invoices->updateNote($_POST['id'], $_POST['note']));
	exit;
} else {
	echo json_encode(array("message" => "Missing required Data.", "code" => 0));
	exit;
}