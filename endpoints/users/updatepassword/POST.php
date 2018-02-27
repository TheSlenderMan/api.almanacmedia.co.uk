<?php
include "classes/users/users.php";

if(isset($_POST['password']) && isset($_POST['email'])){
    try{
        $users = new users();
        echo json_encode($users->updatePassword($_POST['password'], $_POST['email']));
        exit;
    } catch (Exception $e) {
        echo json_encode(array("message" => $e->getMessage(), "code" => 1));
        exit;
    }
} else {
    echo json_encode(array("message" => "Missing required data.", "code" => 1));
    exit;
}