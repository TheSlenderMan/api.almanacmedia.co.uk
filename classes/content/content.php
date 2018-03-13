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
			case "VOUCHERREDEEMEDVENUE":
                $this->content = '<div style="width:100%;text-align:center;">
                                    <img src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="200" height="200" /><br /><br/>
                                    <span style="color:#F9A603;font-size:18px;font-weight:bold;" >HI ' . $params[3] . '!</span><br/><br/>
                                    One of your vouchers has been redeemed! The voucher is on its way to your venue!
                                    <br/><Br/>
                                    <span style="color:#F9A603;font-size:18px;font-weight:bold;" >' . $params[2] . ' ' . $params[1] . '</span><br/><br/>
									<span style="color:#F9A603;font-size:14px;font-weight:bold;" >' . $params[0] . '</span><br/><br/>
									Remember, when you are presented with your voucher, to hit validate on their phone.
                                    <br/><br/>
                                    Thanks!<br/><br/><br/>
                                    <span style="color:#F9A603;font-size:26px;font-weight:bold;" >THE TEAM @ DEALCHASR</span><br/><br/>
                                    </div>';
                break;
            case "RESET":
                $this->content = '<div style="width:100%;text-align:center;">
                                    <img src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="200" height="200" /><br /><br/>
                                    <span style="color:#F9A603;font-size:18px;font-weight:bold;" >HERE IS YOUR PASSWORD RESET LINK!</span><br/><br/>
                                    Please click on the link below to reset your password. Please note once used this link will expire.
                                    <br/><Br/>
                                    <a href="http://password.dealchasr.co.uk/reset/newpassword.php?code=' . $params['code'] . '&email=' . $params['email'] . '" >
                                        http://password.dealchasr.co.uk/reset/newpassword.php?code=' . $params['code'] . '&email=' . $params['email'] . '
                                    </a>
                                    <br/><br/>
                                    Thanks!<br/><br/><br/>
                                    <span style="color:#F9A603;font-size:26px;font-weight:bold;" >THE TEAM @ DEALCHASR</span><br/><br/>
                                    </div>';
                break;
            case "PASSWORDCHANGED":
                $this->content = '<div style="width:100%;text-align:center;">
                                    <img src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="200" height="200" /><br /><br/>
                                    <span style="color:#F9A603;font-size:18px;font-weight:bold;" >YOUR PASSWORD HAS CHANGED</span><br/><br/>
                                    We are just letting you know your password has been changed.
                                    <br/><Br/>
                                    If you think this has been changed in error then please contact us on theteam@dealchasr.co.uk.
                                    </a>
                                    <br/><br/>
                                    Happy Chasing!<br/><br/><br/>
                                    <span style="color:#F9A603;font-size:26px;font-weight:bold;" >THE TEAM @ DEALCHASR</span><br/><br/>
                                    </div>';
                break;
			case "INVOICE":
				$this->content = '<div style="width:100%;text-align:center;">
                                    <img src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="200" height="200" /><br /><br/>
                                    <span style="color:#F9A603;font-size:18px;font-weight:bold;" >YOUR DEAL CHASR INVOICE: ' . $params[3] . '</span><br/><br/>
                                    Your DealChasr invoice is now ready.
                                    <br/><Br/>
                                    <span style="color:#F9A603;font-size:18px;font-weight:bold;" >' . $params[1] . ' REDEMPTIONS THIS MONTH</span><br /><br />
									<span style="color:#F9A603;font-size:18px;font-weight:bold;" >&pound;' . sprintf('%0.2f', $params[0]) . ' TOTAL</span><br /><br />
                                    <br/><br/>
									Invoices are payable within 3 days of this email.
									<br /><br />
									<a href="http://my.dealchasr.co.uk/app/" style="color:#F9A603;font-size:14px;font-weight:bold;" >VIEW YOUR INVOICE HERE</a><br /><br />
                                    Thanks!<br/><br/><br/>
                                    <span style="color:#F9A603;font-size:26px;font-weight:bold;" >THE TEAM @ DEALCHASR</span><br/><br/>
                                    </div>';
                break;
			case "OVERDUEINVOICE":
				$this->content = '<div style="width:100%;text-align:center;">
                                    <img src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="200" height="200" /><br /><br/>
                                    <span style="color:#F9A603;font-size:18px;font-weight:bold;" >YOUR DEAL CHASR INVOICE IS OVER DUE!</span><br/><br/>
                                    <br/><Br/>
									<span style="color:#F9A603;font-size:18px;font-weight:bold;" >&pound;' . sprintf('%0.2f', $params[0]) . ' TOTAL</span><br /><br />
                                    <br/><br/>
									If you do not make a full payment on your invoice your account may be suspended.<br /><br />
									Click below to pay now!
									<br /><br />
									<a href="http://my.dealchasr.co.uk/app/" style="color:#F9A603;font-size:14px;font-weight:bold;" >VIEW YOUR INVOICE HERE</a><br /><br />
                                    Thanks,<br/><br/><br/>
                                    <span style="color:#F9A603;font-size:26px;font-weight:bold;" >THE TEAM @ DEALCHASR</span><br/><br/>
                                    </div>';
                break;
			case "PAYMENTCLEARED": 
				$this->content = '<div style="width:100%;text-align:center;">
                                    <img src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="200" height="200" /><br /><br/>
                                    <span style="color:#F9A603;font-size:18px;font-weight:bold;" >THANK YOU FOR YOUR RECENT PAYMENT</span><br/><br/>
                                    Your DealChasr invoice is now cleared.
                                    <br/><Br/>
                                    <span style="color:#F9A603;font-size:18px;font-weight:bold;" >AMOUNT PAID &pound;' . sprintf('%0.2f', $params['amount']) . '</span><br /><br />
                                    <br/><br/>
									You will receive a PayPal receipt shortly.
									<br /><br />
									<a href="http://my.dealchasr.co.uk/app/" style="color:#F9A603;font-size:14px;font-weight:bold;" >VIEW YOUR INVOICE HERE</a><br /><br />
                                    Thanks!<br/><br/><br/>
                                    <span style="color:#F9A603;font-size:26px;font-weight:bold;" >THE TEAM @ DEALCHASR</span><br/><br/>
                                    </div>';
				break;
			case "PARTPAYMENT": 
				$this->content = '<div style="width:100%;text-align:center;">
                                    <img src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="200" height="200" /><br /><br/>
                                    <span style="color:#F9A603;font-size:18px;font-weight:bold;" >THANK YOU FOR YOUR RECENT PAYMENT</span><br/><br/>
                                    <br/><Br/>
                                    <span style="color:#F9A603;font-size:18px;font-weight:bold;" >AMOUNT PAID &pound;' . sprintf('%0.2f', $params['amount']) . '</span><br /><br />
                                    <br/><br/>
									You will receive a PayPal receipt shortly.
									<br /><br />
									<a href="http://my.dealchasr.co.uk/app/" style="color:#F9A603;font-size:14px;font-weight:bold;" >VIEW YOUR INVOICE HERE</a><br /><br />
                                    Thanks!<br/><br/><br/>
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