<?php
include "classes/invoices/invoices.php";

$invoices = new invoices();
try{
	echo json_encode($invoices->getDueInvoices());
	exit;
} catch (Exception $e){
	echo json_encode(array("message" => $e, "code" => 0));
	exit;
}