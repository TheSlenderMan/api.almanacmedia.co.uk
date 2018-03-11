<?php
include "classes/invoices/invoices.php";

$invoice = new invoices();
if(isset($_GET['iid'])){
	echo json_encode($invoice->getInvoice($_GET['iid']));
	exit;
} else {
	echo json_encode(array("message" => "Missing Required Data", "code" => 0));
	exit;
}