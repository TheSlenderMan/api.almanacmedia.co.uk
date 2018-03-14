<?php
include "classes/users/users.php";

if(isset($_POST['fullName']) && isset($_POST['email']) && isset($_POST['password'])){
	if(isset($_POST['type'])){
		$type = $_POST['type'];
	} else {
		$type = 'user';
	}
    try{
        $users = new users();
        echo json_encode($users->createUser($_POST['fullName'], $_POST['email'], $_POST['password'], $type));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data.", "code" => 1));
    exit;
}