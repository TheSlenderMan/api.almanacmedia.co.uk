<?php
include "classes/users/users.php";

if(isset($_POST['email']) && isset($_POST['password'])){
    try{
        $users = new users();
        echo json_encode($users->loginUser($_POST['email'], $_POST['password']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data.", "code" => 1));
    exit;
}