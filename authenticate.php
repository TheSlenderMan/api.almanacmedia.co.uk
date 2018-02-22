<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Authorization, Content-Type, Content-Disposition, Content-Range, Origin, Error-Reporting');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT');

if($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    exit;
}

include_once "classes/settings/settings.php";

$auth = false;
if(isset($_SERVER['REDIRECT_REDIRECT_HTTP_AUTHORIZATION'])){
    $token = $_SERVER['REDIRECT_REDIRECT_HTTP_AUTHORIZATION'];
    if($token == DS_API_TOKEN){
        $auth = true;
    } else {
        header("HTTP/1.1 403 Forbidden");
        echo json_encode(array("message" => "Use Unauthorized. Please contact webmaster/developer.", "code" => "5"));
    }
} else {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(array("message" => "Use Unauthorized. Please contact webmaster/developer.", "code" => "5"));
}

if($auth){
    $fullPath = explode('?', $_SERVER['REQUEST_URI']);

    $PATH = "endpoints/" . $fullPath[0] . "/" . $_SERVER['REQUEST_METHOD'] . ".php";

    if(is_file($PATH)){
        try{
            include $PATH;
        } catch (Exception $e) {
            echo json_encode(array("message" => $e->getMessage(), "code" => "4"));
        }
    } else {
        header("HTTP/1.1 404 Not Found");
        echo json_encode(array("message" => "This endpoint does not exist.", "code" => "4"));
    }
}

