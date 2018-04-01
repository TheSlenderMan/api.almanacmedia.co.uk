<?php
include "classes/venues/venues.php";

$venue = new venues();

//error_reporting(E_ALL); // or E_STRICT
//ini_set("display_errors",1);
//ini_set("memory_limit","1024M");
    if (is_uploaded_file($_FILES['venueheader']['tmp_name'])) {
        try{
            $uploads_dir = '../img.samprior.co.uk/';
            $tmp_name = $_FILES['venueheader']['tmp_name'];
            $pic_name = $_FILES['venueheader']['name'];
            if(!is_dir('../img.samprior.co.uk/dealchasr/' . $_GET['venueName'])){
                mkdir('../img.samprior.co.uk/dealchasr/' . $_GET['venueName'], 0777);
            }
            if(move_uploaded_file($tmp_name, $uploads_dir . "dealchasr/" . $_GET['venueName'] . '/' . $pic_name)){
                echo json_encode($venue->updateImage($_GET['id'], "http://img.almanacmedia.co.uk/dealchasr/" . $_GET['venueName'] . '/' . $pic_name));
                exit;
            } else {
                echo "Something wrong with move_file.";
                exit;
            }
        } catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
    } else if(isset($_POST['vDescription']) && isset($_POST['vWebsite']) && isset($_POST['vOpenHours']) && isset($_POST['vContact'])
    && isset($_POST['vAddressOne']) && isset($_POST['vAddressTwo']) && isset($_POST['vAddressCity']) && isset($_POST['vAddressCounty'])
        && isset($_POST['vAddressCountry']) && isset($_POST['vAddressPostCode']) && isset($_POST['vEmail']) && isset($_POST['vid']) && isset($_POST['rEmail'])){
        echo json_encode($venue->updateDetails($_POST['vDescription'],$_POST['vWebsite'],$_POST['vOpenHours'],$_POST['vContact']
            ,$_POST['vAddressOne'],$_POST['vAddressTwo'],$_POST['vAddressCity'],$_POST['vAddressCounty']
            ,$_POST['vAddressCountry'],$_POST['vAddressPostCode'], $_POST['vEmail'], $_POST['vid'], $_POST['rEmail']));
        exit;
    } else {
        echo json_encode(array("updated" => 0, "message" => "Missing Required Data"));
        exit;
    }