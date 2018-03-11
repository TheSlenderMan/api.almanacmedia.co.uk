<?php
include "classes/invoices/invoices.php";

$invoices = new invoices();

if(isset($_POST['id'])){
	echo json_encode($invoices->markAsPaid($_POST['id']));
	exit;
} else {
	echo json_encode(array("message" => "Missing required Data.", "code" => 0));
	exit;
}