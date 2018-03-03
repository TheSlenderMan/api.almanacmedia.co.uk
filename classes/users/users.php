<?php
include "classes/database/data.php";
include "classes/email/email.php";
include "classes/content/content.php";

class users{

    private $conn;
    private $email;
    private $content;

    function __construct(){
        $connection = new data();
        $this->conn = $connection->startConnection();
        $this->content = new content();
    }

    public function createUser($name, $email, $password){
        if(empty($name)){
            Throw new Exception("Full Name not supplied.");
        }
        if(empty($email)){
            Throw new Exception("Email not supplied.");
        }
        if(empty($password)){
            Throw new Exception("Password not supplied.");
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return array("data" => array("message" => "PLEASE ENTER A CORRECT EMAIL ADDRESS", "created" => 0));
        }

        $email = strtolower($email);

        if($this->checkUserExists($email)){
            return array("data" => array("message" => "USER ALREADY REGISTERED", "created" => 0));
        }

        $salt = $this->createSalt();

        $hash = $this->createHash($password, $salt);

        try{
            $insertUser = $this->conn->prepare("INSERT INTO ds_users (fullName, email, passwordHash, saltHash, userType) VALUES (:fname, :email, :passwordHash, :saltHash, 'user')");
            $insertUser->bindParam(':fname', $name);
            $insertUser->bindParam(':email', $email);
            $insertUser->bindParam(':passwordHash', $hash);
            $insertUser->bindParam(':saltHash', $salt);

            if($insertUser->execute()){
                $this->email = new email($email);
                $this->email->setBody($this->content->getContent("SIGNUP"));
                $this->email->setSubject("Welcome to DealChasr!");
                $this->email->executeMail();
                return array("data" => array("created" => 1, "userID" => $this->conn->lastInsertId()));
            } else {
                Throw new Exception(json_encode($insertUser->errorInfo()));
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }

    }

    public function loginUser($email, $pass, $type){
        try{
            $user = $this->getUserByEmail($email, $type);

            if($user['data']['found'] == 1){
                $salt = $user['data']['user']['saltHash'];
                $hash = $user['data']['user']['passwordHash'];

                $checkedHash = $this->createHash($pass, $salt);

                if($checkedHash == $hash){
                    return array("loggedIn" => 1, "userID" => $user['data']['user']['id']);
                } else {
                    return array("loggedIn" => 0, "message" => "INCORRECT PASSWORD");
                }
            } else {
                return array("loggedIn" => 0, "message" => "INCORRECT EMAIL ADDRESS");
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

    public function getUserByEmail($email, $type) {
        try{
            $getUser = $this->conn->prepare("SELECT * FROM ds_users WHERE email = :email AND (userType = :userType || userType = 'admin')");
            $getUser->bindParam(":email", strtolower($email));
            $getUser->bindParam(":userType", strtolower($type));
            $getUser->execute();

            $user = $getUser->fetchAll();

            if(empty($user)){
                return array("data" => array("found" => 0, "message" => "No users found"));
            } else {
                return array("data" => array("found" => 1, "user" => $user[0]));
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

    public function resetPassword($email){
        if(empty($email)){
            Throw new Exception("No email address supplied.");
        }

        if($this->checkUserExists($email)){

            $date = date("Y-m-d");
            $code = sha1($date . $email);

            $addCode = $this->conn->prepare("INSERT INTO ds_reset (code, email) VALUES (:code, :email)");
            $addCode->bindParam(":code", $code);
            $addCode->bindParam(":email", $email);
            if($addCode->execute()){
                $this->email = new email($email);
                $this->email->setBody($this->content->getContent("RESET", array("email" => $email, "code" => $code)));
                $this->email->setSubject("Reset your DealChasr password");
                $this->email->executeMail();

                return array("reset" => 1);
            } else {
                return array("message" => "SORRY, SOMETHING WENT WRONG. PLEASE TRY AGAIN.");
            }
        } else {
            return array("message" => "SORRY, WE CAN'T FIND THAT EMAIL ADDRESS.");
        }
    }

    public function validateCode($code, $email){
        try{
            $validate = $this->conn->prepare("SELECT * FROM ds_reset WHERE code = :code AND email = :email AND used = 0");
            $validate->bindParam(":code", $code);
            $validate->bindParam(":email", $email);
            $validate->execute();

            $result = $validate->fetch();
            if(empty($result)){
                return 0;
            } else {
                $inValLink = $this->conn->prepare("UPDATE ds_reset SET used = 1 WHERE code = :code AND email = :email");
                $inValLink->bindParam(":code", $code);
                $inValLink->bindParam(":email", $email);
                $inValLink->execute();
                return 1;
            }
        } catch (Exception $e){
            return 0;
;        }
    }

    public function updatePassword($pass, $email){
        if(empty($pass)){
            Throw new Exception("Password was not supplied.");
        }
        try{
            $salt = $this->createSalt();
            $hash = $this->createHash($pass, $salt);

            $updatePassword = $this->conn->prepare("UPDATE ds_users SET passwordHash = :passwordHash, saltHash = :saltHash
                                                    WHERE email = :email");
            $updatePassword->bindParam(':passwordHash', $hash);
            $updatePassword->bindParam(':saltHash', $salt);
            $updatePassword->bindParam(':email', $email);

            if($updatePassword->execute()){
                $this->email = new email($email);
                $this->email->setBody($this->content->getContent("PASSWORDCHANGED"));
                $this->email->setSubject("Your DealChasr Password has Changed!");
                $this->email->executeMail();
                return array("updated" => 1);
            } else {
                Throw new Exception(json_encode($updatePassword->errorInfo()));
            }
        } catch (Exception $e){
            Throw new Exception($e->getMessage());
        }
    }

    private function checkUserExists($email) {
        try{
            $getUser = $this->conn->prepare("SELECT * FROM ds_users WHERE email = :email");
            $getUser->bindParam(":email", $email);
            $getUser->execute();

            if(empty($getUser->fetchAll())){
                return false;
            } else {
                return true;
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

    private function createSalt($max = 15){
        $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
        $i = 0;
        $salt = "";
        while ($i < $max) {
            $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
            $i++;
        }
        return $salt;
    }

    private function createHash($p, $s){
        return sha1(sha1($p . $s));
    }

    public function getVouchers($uid){
        try{
            $getVouchers = $this->conn->prepare("SELECT u.userID, u.voucherID, v.id, ve.vName, v.active, v.venueID, v.voucherCount,
                                                        v.endDate, v.voucherDescription, d.dealName,
                                                        vt.voucherName FROM ds_redemptions AS u
                                                        JOIN ds_vouchers AS v ON
                                                        u.voucherID = v.id
                                                        JOIN ds_voucher_type AS vt ON
                                                        vt.id =  v.voucherTypeID
                                                        JOIN ds_venues AS ve ON ve.id = v.venueID
                                                        JOIN ds_deal_types AS d ON d.id = v.dealType
                                                        WHERE u.userID = :uid");

            $getVouchers->bindParam(":uid", $uid);
            $getVouchers->execute();

            $vouchers = $getVouchers->fetchAll();

            if(empty($vouchers)){
                return array();
            } else {
                return $vouchers;
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

    public function getDeals($uid){
        try{
            $getDeals = $this->conn->prepare("SELECT u.userID, u.dealID, d.id, d.active, d.venueID, d.dealDate, d.dealTypeID,
                                                        d.dealDescription, d.daily, de.dealName, d.dealTitle, d.recurring, v.vName
                                                        FROM ds_imgoing AS u
                                                        JOIN ds_deals AS d
                                                        ON d.id = u.dealID
                                                        JOIN ds_deal_types AS de ON
                                                        de.id =  d.dealTypeID
                                                        JOIN ds_venues AS v ON v.id = d.venueID
                                                        WHERE u.userID = :uid
                                                        AND d.active = 1");

            $getDeals->bindParam(":uid", $uid);
            $getDeals->execute();

            $deals = $getDeals->fetchAll();

            if(empty($deals)){
                return array();
            } else {
                return $deals;
            }
        } catch (Exception $e) {
            Throw new Exception($e->getMessage());
        }
    }

}