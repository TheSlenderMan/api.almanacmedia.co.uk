<?php
include "classes/database/data.php";

class invoices{
	
	private $conn;
	
	function __construct(){
		$connection = new data();
        $this->conn = $connection->startConnection();
	}
	
	public function getInvoice($iid){
		if(empty($iid)){
			Throw new Exception("Invoice ID Missing");
		}
		try{
			$getInvoice = $this->conn->prepare("SELECT i.id, i.invoicePaid, i.invoiceSent, i.venueID, i.amount,
												i.redemptions, i.invoiceDate, i.cancelled, i.cancelDate, i.note, i.promo,
												v.vName, v.vEmail, v.vAddressOne, v.vAddressTwo, v.vCityTown, v.vCounty,
												v.vCountry, v.vPostCode, v.tier, v.active
												FROM ds_invoices AS i
												JOIN ds_venues AS v
												ON v.id = i.venueID
												WHERE i.id = :iid");
			$getInvoice->bindParam(":iid", $iid);
			$getInvoice->execute();
			$invoice = $getInvoice->fetch();
			
			$getPayments = $this->conn->prepare("SELECT * FROM ds_payments WHERE invoiceID = :iid");
			$getPayments->bindParam(":iid", $iid);
			$getPayments->execute();
			$payments = $getPayments->fetchAll();
			
			foreach($payments AS $p => $pv){
				$payments[$p]['grossPaid'] = sprintf('%0.2f', $payments[$p]['grossPaid']);
			}
			
			$invoice['payments'] = $payments;
			
			$invoice['amount'] = sprintf('%0.2f', $invoice['amount']);
			return array("data" => array("invoice" => $invoice));
		} catch (Exception $e){
			Throw new Exception($e->getMessage());
		}
	}
	
	public function getDueInvoices(){
		try{
			$getInvoices = $this->conn->prepare("SELECT i.id, i.amount, i.subscription, i.note, v.vName, v.vEmail
												FROM ds_invoices AS i 
												JOIN ds_venues AS v
												ON v.id = i.venueID
												WHERE invoicePaid = 0
												AND invoiceSent = 1
												AND cancelled = 0");
			$getInvoices->execute();
			$invoices = $getInvoices->fetchAll();
			
			foreach($invoices AS $k => $v){
				$getPayments = $this->conn->prepare("SELECT * FROM ds_payments WHERE invoiceID = :iid");
				$getPayments->bindParam(":iid", $v['id']);
				$getPayments->execute();
				$payments = $getPayments->fetchAll();
				
				$total = ($invoices[$k]['amount'] + $invoices[$k]['subscription']);
				$invoices[$k]['amount'] = sprintf('%0.2f', $total);
				$invoices[$k]['payments'] = $payments;
			}
			
			return array("data" => array("invoices" => $invoices));
		} catch(Exception $e) {
			Throw new Exception($e->getMessage());
		}
	}
	
	public function cancelInvoice($iid){
		if(empty($iid)){
			Throw new Exception("Invoice ID not supplied");
		}
		try{
			$cancelInvoice = $this->conn->prepare("UPDATE ds_invoices SET cancelled = 1, cancelDate = NOW() WHERE id = :iid");
			$cancelInvoice->bindParam(":iid", $iid);
			$cancelInvoice->execute();
			return array("data" => array("cancelled" => 1));
		} catch (Exception $e) {
			Throw new Exception($e->getMessage());
		}
	}
	
	public function markAsPaid($iid){
		if(empty($iid)){
			Throw new Exception("Invoice ID not supplied");
		}
		try{
			$cancelInvoice = $this->conn->prepare("UPDATE ds_invoices SET invoicePaid = 1 WHERE id = :iid");
			$cancelInvoice->bindParam(":iid", $iid);
			$cancelInvoice->execute();
			return array("data" => array("paid" => 1));
		} catch (Exception $e) {
			Throw new Exception($e->getMessage());
		}
	}
	
	public function updateNote($iid, $note){
		if(empty($iid)){
			Throw new Exception("Invoice ID not supplied");
		}
		if(empty($note)){
			Throw new Exception("Invoice Note not supplied");
		}
		try{
			$cancelInvoice = $this->conn->prepare("UPDATE ds_invoices SET note = :note WHERE id = :iid");
			$cancelInvoice->bindParam(":iid", $iid);
			$cancelInvoice->bindParam(":note", $note);
			$cancelInvoice->execute();
			return array("data" => array("note" => 1));
		} catch (Exception $e) {
			Throw new Exception($e->getMessage());
		}
	}
}