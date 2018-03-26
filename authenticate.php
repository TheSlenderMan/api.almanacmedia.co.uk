<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: DSUid, DSUtoken, DSToken, DSRefresh, Authorization, Content-Type, Content-Disposition, Content-Range, Origin, Error-Reporting');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT');

if($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    exit;
}

include_once "classes/settings/settings.php";
$conn = new PDO('mysql:dbname=' . DS_DATABASE_NAME . ';host=' . DS_DATABASE_HOST, DS_DATABASE_USERNAME, DS_DATABASE_PASSWORD);

$fullPath = explode('?', $_SERVER['REQUEST_URI']);
$token = explode(':', $_SERVER['REDIRECT_REDIRECT_HTTP_AUTHORIZATION']);


if(!isset($_SERVER['HTTP_DSTOKEN'])){
	echo json_encode(array("message" => "No API Token Has Been Supplied", "code" => "5"));
	exit;
}

$apikey = $_SERVER['HTTP_DSTOKEN'];

if($apikey == 'GAIN' && $fullPath[0] != '/tokens/api'){
	echo json_encode(array("message" => "Incorrect API Token Supplied", "code" => "5"));
	exit;
}

if($apikey == 'REFRESH' && $fullPath[0] != '/tokens/refresh'){
	echo json_encode(array("message" => "Incorrect API Token Supplied", "code" => "5"));
	exit;
}

if($apikey == 'REFRESH' && $fullPath[0] == '/tokens/refresh'){
	if(!isset($_SERVER['HTTP_DSREFRESH']) || !$_SERVER['HTTP_DSREFRESH']){
		echo json_encode(array("message" => "No Refresh Token Has Been Supplied", "code" => "5"));
		exit;
	}
}

if(!empty($apikey)){
	if($apikey != "GAIN" && $apikey != "REFRESH"){
		$c = $conn->prepare("SELECT * FROM ds_tokens WHERE token = :t");
		$c->bindParam(":t", $apikey);
		$c->execute();
		$ts = $c->fetch(PDO::FETCH_ASSOC);
		if(empty($ts)){
			echo json_encode(array("message" => "API Token does not exist", "code" => "5"));
			exit;
		} else {
			$expires = strtotime($ts['expires']) * 1000;
			$now = time() * 1000;
			if($expires < $now && $token[1] != 3){
				echo json_encode(array("message" => "Token Expired", "code" => "8"));
				exit;
			}
		}
	}
} else {
	echo json_encode(array("message" => "No API Token Has Been Supplied", "code" => "5"));
	exit;
}

if(!isset($_SERVER['HTTP_DSUID'])){
	echo json_encode(array("message" => "No User ID Supplied", "code" => "9"));
	exit;
}

if(!isset($_SERVER['HTTP_DSUTOKEN'])){
	echo json_encode(array("message" => "No User Token Supplied", "code" => "9"));
	exit;
}

$uid = $_SERVER['HTTP_DSUID'];
$uit = $_SERVER['HTTP_DSUTOKEN'];

if(!empty($uid) && !empty($uit)){
	if($uid != 'LOGIN' && $uit != 'TOKEN' && $fullPath[0] != '/tokens/refresh' && $fullPath[0] != '/tokens/api' && $fullPath[0] != '/users/login'){
		$gt = $conn->prepare("SELECT * FROM ds_login_token WHERE userID = :u AND token = :t");
		$gt->bindParam(":u", $uid);
		$gt->bindParam(":t", $uit);
		$gt->execute();
		$gts = $gt->fetch(PDO::FETCH_ASSOC);
		if(empty($gts)){
			echo json_encode(array("message" => "Logout", "code" => "9"));
			exit;
		}
		$uexpires = strtotime($gts['expires']) * 1000;
		$unow = time() * 1000;
		if($uexpires < $unow && $token[1] != 3){
			echo json_encode(array("message" => "Logout", "code" => "9"));
			exit;
		}
	}
} else {
	echo json_encode(array("message" => "No User Token or ID Supplied", "code" => "9"));
	exit;
}


$auth = false;
if(isset($_SERVER['REDIRECT_REDIRECT_HTTP_AUTHORIZATION'])){
    if($token[0] == DS_API_TOKEN){
        $auth = true;
    } else {
        header("HTTP/1.1 403 Forbidden");
        echo json_encode(array("message" => "Use Unauthorized. Please contact webmaster/developer.", "code" => "5"));
		exit;
    }
} else {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(array("message" => "Use Unauthorized. Please contact webmaster/developer.", "code" => "5"));
	exit;
}

if($auth){
    $PATH = "endpoints/" . $fullPath[0] . "/" . $_SERVER['REQUEST_METHOD'] . ".php";

    if(is_file($PATH)){
        try{
            include $PATH;
        } catch (Exception $e) {
            echo json_encode(array("message" => $e->getMessage(), "code" => "4"));
			exit;
        }
    } else {
        header("HTTP/1.1 404 Not Found");
        echo json_encode(array("message" => "This endpoint does not exist.", "code" => "4"));
		exit;
    }
}

