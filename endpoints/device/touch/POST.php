<?php
include_once "classes/database/data.php";

$database = new data();
$conn = $database->startConnection();

if(isset($_POST['deviceID'])){

    $device = $_POST['deviceID'];
    $date   = date("Y-m-d H:i:s");

    try{
        $findDT = $conn->prepare("SELECT * FROM ds_device_touch WHERE deviceID = :device");
        $findDT->bindParam(":device", $device);
        $findDT->execute();

        if(empty($findDT->fetchAll())){
            $addDT = $conn->prepare("INSERT INTO ds_device_touch (deviceID, date) VALUES (:device, :date)");
            $addDT->bindParam(":device", $device);
            $addDT->bindParam(":date", $date);
            if($addDT->execute()){
                echo json_encode(array("data" => array("deviceTouched" => true, "continue" => true, "new" => true)));
                exit;
            } else {
                echo json_encode(array("message" => "Device Touch Failed - ADD - " . $addDT->errorInfo(), "code" => 1));
                exit;
            }
        } else {
            echo json_encode(array("data" => array("deviceTouched" => true, "continue" => true, "new" => false)));
            exit;
        }
    } catch(Exception $e){
        echo json_encode(array("message" => "Device Touch Failed - RETRIEVE - " . $e->getMessage(), "code" => 1));
        exit;
    }

} else {
    echo json_encode(array("message" => "No Device ID supplied.", "code" => 1));
    exit;
}