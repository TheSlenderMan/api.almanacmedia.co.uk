<?php

class content{

    public $content;

    function __construct(){

    }

    public function getContent($type, $params = array()){
        switch ($type){
            case "SIGNUP":
                $this->content = '<div style="width:100%;text-align:center;">
                                    <img src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="200" height="200" /><br /><br/>
                                    <span style="color:#F9A603;font-size:18px;font-weight:bold;" >WELCOME TO DEALCHASR!</span><br/><br/>
                                    We hope you enjoy deal chasing and get the most out of it!
                                    <br/><Br/>
                                    We have done our best to make sure the chasing is a great
                                    experience but just in case you need a little help do not hesitate
                                    to contact us with your name, email and enquiry.
                                    <br/><br/>
                                    You can get us on theteam@dealchasr.co.uk!<br/><br/><br/>
                                    <span style="color:#F9A603;font-size:26px;font-weight:bold;" >THE TEAM @ DEALCHASR</span><br/><br/>
                                    </div>';
                break;
            case "VOUCHERREDEEMED":
                $this->content = '<div style="width:100%;text-align:center;">
                                    <img src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="200" height="200" /><br /><br/>
                                    <span style="color:#F9A603;font-size:18px;font-weight:bold;" >HI ' . $params[0] . '!</span><br/><br/>
                                    You redeemed a new voucher!
                                    <br/><Br/>
                                    To see your new voucher just go to MY VOUCHERS in the app!<br/>
                                    Do not forget to get to the venue before the voucher expires!
                                    <br/><br/>
                                    Enjoy your deal!<br/><br/><br/>
                                    <span style="color:#F9A603;font-size:26px;font-weight:bold;" >THE TEAM @ DEALCHASR</span><br/><br/>
                                    </div>';
                break;
            default:
                $this->content = "";
                break;
        }

        return $this->content;
    }
}