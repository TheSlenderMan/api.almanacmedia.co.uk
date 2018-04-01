<?php

class content{

    public $content;

    function __construct(){

    }

    public function getContent($type, $params = array()){
        switch ($type){
            case "SIGNUP":
                $this->content = '<body style="margin:0;" >
					<div style="width:100%;text-align:center;margin:0;font-family:Helvetica;font-weight:100;">
						<div style="font-size:10px;width:calc(100% - 50px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding-left:20px;" >
						<br /><br />
							<span style="" ><a href="http://dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >DEALCHASR HOME</a></span>
							<span style="" ><a href="http://dealchasr.co.uk/become-a-partner" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >BECOME A PARTNER</a></span>
							<span style="" ><a href="http://my.dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PARTNER LOGIN</a></span><br /><br />
							<span style="" ><a href="http://dealchasr.co.uk/terms-and-conditions" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >TERMS OF USE</a></span>
							<span style="" ><a href="http://dealchasr.co.uk/privacy-policy" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PRIVACY POLICY</a></span>
						</div>
						<div style="width:100%;background-image:url(http://img.almanacmedia.co.uk/cocktail.jpg); background-size:cover;background-repeat:no-repeat;
						background-position:center;height:250px" >
							<img style="margin:25px 0 0 0;" src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="150" height="150" />
						</div>
						<div style="width:100%;background-color:#f9a603;text-align:center;margin-top:-50px;" >
						<br /><br />
							<img style="width:180px;height:180px;color:white !important;fill: rgb(255,255,255) !important;"
							 src="http://img.almanacmedia.co.uk/pin.png" />
							<h1 style="color:#fff;font-size:38px;" >WELCOME TO THE FAMILY</h1>
							<span style="color:#fff;font-size:18px;" >LETS CHASE SOME DEALS</span><br /><br />
							<a href="http://dealchasr.co.uk" >
								<div style="display:inline-block;width:200px;height:50px;border:2px solid #fff;color:#fff;line-height:50px;font-weight:bold;" >
									WEBSITE
								</div>
							</a>
							<br /><br />
						</div>
						<div style="width:calc(100% - 60px);background-color:#fff;color:#000;font-size:14px;padding:30px;text-align:left;" >
							Hi there,<br /><br />
							Thank you for signing up to DealChasr. You are now free to go and chase some great deals and vouchers on our app, recieve the latest vouchers 
							and get the latest scoop on pubs, bars and venues in your area.<br /><br />
							Need some help? Find all the help you need at our website <a href="http://dealchasr.co.uk" style="color:#f9a603;font-weight:bold;" >http://dealchasr.co.uk</a><br /><br />
							Happy Chasing!<br />
							<span style="color:#f9a603;font-size:18px;font-weight:bold;" >The DealChasr Team</span>
						</div>
						<div style="width:calc(100% - 30px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding:10px 10px 10px 20px;" >
								<div style="float:left;" >
									<span style="font-weight:bold;" >GET THE APP NOW</span><br />
									<img src="http://img.almanacmedia.co.uk/google-play-badge.png" width="100" />
									<img src="http://img.almanacmedia.co.uk/app-store-badge.png" width="100" />
								</div>
								<div style="float:right;" >
									<span style="font-weight:bold;" >LETS GET SOCIAL</span><br />
									<a href="" ><img src="http://img.almanacmedia.co.uk/facebook-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/twitter-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/instagram-icon.png" style="width:20px;margin-top:5px;" /></a>
								</div>
								<div style="clear:both;" ></div>
								<div style="width:100%; font-size:10px;color:#fff;text-align:center;" >
								Please do not reply to this email. This mail box is not monitored and you will receive no reply.<br /><br />
									copyright &copy; 2018 DealChasr<br />
									Brighton, England
								</div>
							</div>
					</div>
				</body>';
                break;
			case "SIGNUPVENUE":
                $this->content = '<body style="margin:0;" >
						<div style="width:100%;text-align:center;margin:0;font-family:Helvetica;font-weight:100;">
							<div style="font-size:10px;width:calc(100% - 50px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding-left:20px;" >
							<br /><br />
								<span style="" ><a href="http://dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >DEALCHASR HOME</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/become-a-partner" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >BECOME A PARTNER</a></span>
								<span style="" ><a href="http://my.dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PARTNER LOGIN</a></span><br /><br />
								<span style="" ><a href="http://dealchasr.co.uk/terms-and-conditions" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >TERMS OF USE</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/privacy-policy" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PRIVACY POLICY</a></span>
							</div>
							<div style="width:100%;background-image:url(http://img.almanacmedia.co.uk/cocktail.jpg); background-size:cover;background-repeat:no-repeat;
							background-position:center;height:250px" >
								<img style="margin:25px 0 0 0;" src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="150" height="150" />
							</div>
							<div style="width:100%;background-color:#f9a603;text-align:center;margin-top:-50px;" >
							<br /><br />
								<img style="width:180px;height:180px;color:white !important;fill: rgb(255,255,255) !important;"
							 src="http://img.almanacmedia.co.uk/pin.png" />
								<h1 style="color:#fff;font-size:38px;" >WELCOME TO THE FAMILY</h1>
								<span style="color:#fff;font-size:18px;" >LETS CREATE SOME DEALS</span><br /><br />
								<a href="http://my.dealchasr.co.uk" >
									<div style="display:inline-block;width:200px;height:50px;border:2px solid #fff;color:#fff;line-height:50px;font-weight:bold;" >
										PARTNER PORTAL
									</div>
								</a>
								<br /><br />
							</div>
							<div style="width:calc(100% - 60px);background-color:#fff;color:#000;font-size:14px;padding:30px;text-align:left;" >
								Hi there, <br /><br />
								Thank you for signing up as a DealChasr Partner.<br /><br />
								Your account has been created and you can log into <a style="color:#f9a603;text-decoration:none;" href="http://my.dealchasr.co.uk" >my.dealchasr.co.uk</a>
								 right away, however, in order for your venue to show up on our public facing app you need to validate your email address using the 
								link below. <br /><br />
								Validate Your Email Address Here<br /><br />
								<a href="http://my.dealchasr.co.uk/app/validate/?token=' . $params[1] . '&email=' . $params[0] . '&vid=' . $params[2] . '" >http://my.dealchasr.co.uk/app/validate/?token=' . $params[1] . '&email=' . $params[0] . '&vid=' . $params[2] . '</a>
								<br/><br/>
								The link above will expire in 12 hours. If your link has expired then you can log into the partner portal and resend a validation email.<br /><br />
								If you have any queries about using DealChasr you can get us on theteam@dealchasr.co.uk<br/><br/>
								Cheers,<br />
								<span style="color:#f9a603;font-size:18px;font-weight:bold;" >The DealChasr Team</span>
							</div>
							<div style="width:calc(100% - 30px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding:10px 10px 10px 20px;" >
								<div style="float:left;" >
									<span style="font-weight:bold;" >GET THE APP NOW</span><br />
									<img src="http://img.almanacmedia.co.uk/google-play-badge.png" width="100" />
									<img src="http://img.almanacmedia.co.uk/app-store-badge.png" width="100" />
								</div>
								<div style="float:right;" >
									<span style="font-weight:bold;" >LETS GET SOCIAL</span><br />
									<a href="" ><img src="http://img.almanacmedia.co.uk/facebook-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/twitter-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/instagram-icon.png" style="width:20px;margin-top:5px;" /></a>
								</div>
								<div style="clear:both;" ></div>
								<div style="width:100%; font-size:10px;color:#fff;text-align:center;" >
								Please do not reply to this email. This mail box is not monitored and you will receive no reply.<br /><br />
									copyright &copy; 2018 DealChasr<br />
									Brighton, England
								</div>
							</div>
						</div>
					</body>';
                break;
			case "VENUEINTRO":
                $this->content = '<body style="margin:0;" >
						<div style="width:100%;text-align:center;margin:0;font-family:Helvetica;font-weight:100;">
							<div style="font-size:10px;width:calc(100% - 50px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding-left:20px;" >
							<br /><br />
								<span style="" ><a href="http://dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >DEALCHASR HOME</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/become-a-partner" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >BECOME A PARTNER</a></span>
								<span style="" ><a href="http://my.dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PARTNER LOGIN</a></span><br /><br />
								<span style="" ><a href="http://dealchasr.co.uk/terms-and-conditions" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >TERMS OF USE</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/privacy-policy" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PRIVACY POLICY</a></span>
							</div>
							<div style="width:100%;background-image:url(http://img.almanacmedia.co.uk/cocktail.jpg); background-size:cover;background-repeat:no-repeat;
							background-position:center;height:250px" >
								<img style="margin:25px 0 0 0;" src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="150" height="150" />
							</div>
							<div style="width:100%;background-color:#f9a603;text-align:center;margin-top:-50px;" >
							<br /><br />
								<img style="width:180px;height:180px;color:white !important;fill: rgb(255,255,255) !important;"
							 src="http://img.almanacmedia.co.uk/help.png" />
								<h1 style="color:#fff;font-size:38px;" >A HELPFUL HAND</h1>
								<span style="color:#fff;font-size:18px;" >LETS GET YOU STARTED</span><br /><br />
								<br /><br />
							</div>
							<div style="width:calc(100% - 60px);background-color:#fff;color:#000;font-size:14px;padding:30px;text-align:left;" >
								<img src="http://img.almanacmedia.co.uk/welcome-info.png" style="width:100%;" /><br /><br /><br />
								Cheers,<br />
								<span style="color:#f9a603;font-size:18px;font-weight:bold;" >The DealChasr Team</span>
							</div>
							<div style="width:calc(100% - 30px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding:10px 10px 10px 20px;" >
								<div style="float:left;" >
									<span style="font-weight:bold;" >GET THE APP NOW</span><br />
									<img src="http://img.almanacmedia.co.uk/google-play-badge.png" width="100" />
									<img src="http://img.almanacmedia.co.uk/app-store-badge.png" width="100" />
								</div>
								<div style="float:right;" >
									<span style="font-weight:bold;" >LETS GET SOCIAL</span><br />
									<a href="" ><img src="http://img.almanacmedia.co.uk/facebook-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/twitter-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/instagram-icon.png" style="width:20px;margin-top:5px;" /></a>
								</div>
								<div style="clear:both;" ></div>
								<div style="width:100%; font-size:10px;color:#fff;text-align:center;" >
								Please do not reply to this email. This mail box is not monitored and you will receive no reply.<br /><br />
									copyright &copy; 2018 DealChasr<br />
									Brighton, England
								</div>
							</div>
						</div>
					</body>';
                break;
            case "VOUCHERREDEEMED":
                $this->content = '<body style="margin:0;" >
						<div style="width:100%;text-align:center;margin:0;font-family:Helvetica;font-weight:100;">
							<div style="font-size:10px;width:calc(100% - 50px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding-left:20px;" >
							<br /><br />
								<span style="" ><a href="http://dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >DEALCHASR HOME</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/become-a-partner" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >BECOME A PARTNER</a></span>
								<span style="" ><a href="http://my.dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PARTNER LOGIN</a></span><br /><br />
								<span style="" ><a href="http://dealchasr.co.uk/terms-and-conditions" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >TERMS OF USE</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/privacy-policy" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PRIVACY POLICY</a></span>
							</div>
							<div style="width:100%;background-image:url(http://img.almanacmedia.co.uk/cocktail.jpg); background-size:cover;background-repeat:no-repeat;
							background-position:center;height:250px" >
								<img style="margin:25px 0 0 0;" src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="150" height="150" />
							</div>
							<div style="width:100%;background-color:#f9a603;text-align:center;margin-top:-50px;" >
							<br /><br />
								<img style="width:180px;height:180px;color:white !important;fill: rgb(255,255,255) !important;"
							 src="http://img.almanacmedia.co.uk/voucher.png" />
								<h1 style="color:#fff;font-size:38px;" >VOUCHER REDEEMED</h1>
								<span style="color:#fff;font-size:18px;" >YOU HAVE A GREAT DEAL</span><br /><br />
								<br /><br />
							</div>
							<div style="width:calc(100% - 60px);background-color:#fff;color:#000;font-size:14px;padding:30px;text-align:left;" >
								<span style="color:#F9A603;font-size:18px;font-weight:bold;" >Hi ' . $params[0] . ',</span><br/><br/>
								You redeemed a new voucher!
								<br/><Br/>
								To see your new voucher just go to MY VOUCHERS in the app!<br/>
								Do not forget to get to the venue before the voucher expires!
								<br/><br/>
								Enjoy your deal!<br/><br/><br/>
								<span style="color:#f9a603;font-size:18px;font-weight:bold;" >The DealChasr Team</span>
							</div>
							<div style="width:calc(100% - 30px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding:10px 10px 10px 20px;" >
								<div style="float:left;" >
									<span style="font-weight:bold;" >GET THE APP NOW</span><br />
									<img src="http://img.almanacmedia.co.uk/google-play-badge.png" width="100" />
									<img src="http://img.almanacmedia.co.uk/app-store-badge.png" width="100" />
								</div>
								<div style="float:right;" >
									<span style="font-weight:bold;" >LETS GET SOCIAL</span><br />
									<a href="" ><img src="http://img.almanacmedia.co.uk/facebook-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/twitter-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/instagram-icon.png" style="width:20px;margin-top:5px;" /></a>
								</div>
								<div style="clear:both;" ></div>
								<div style="width:100%; font-size:10px;color:#fff;text-align:center;" >
								Please do not reply to this email. This mail box is not monitored and you will receive no reply.<br /><br />
									copyright &copy; 2018 DealChasr<br />
									Brighton, England
								</div>
							</div>
						</div>
					</body>';
                break;
			case "VOUCHERREDEEMEDVENUE":
                $this->content = '<body style="margin:0;" >
						<div style="width:100%;text-align:center;margin:0;font-family:Helvetica;font-weight:100;">
							<div style="font-size:10px;width:calc(100% - 50px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding-left:20px;" >
							<br /><br />
								<span style="" ><a href="http://dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >DEALCHASR HOME</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/become-a-partner" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >BECOME A PARTNER</a></span>
								<span style="" ><a href="http://my.dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PARTNER LOGIN</a></span><br /><br />
								<span style="" ><a href="http://dealchasr.co.uk/terms-and-conditions" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >TERMS OF USE</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/privacy-policy" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PRIVACY POLICY</a></span>
							</div>
							<div style="width:100%;background-image:url(http://img.almanacmedia.co.uk/cocktail.jpg); background-size:cover;background-repeat:no-repeat;
							background-position:center;height:250px" >
								<img style="margin:25px 0 0 0;" src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="150" height="150" />
							</div>
							<div style="width:100%;background-color:#f9a603;text-align:center;margin-top:-50px;" >
							<br /><br />
								<img style="width:180px;height:180px;color:white !important;fill: rgb(255,255,255) !important;"
							 src="http://img.almanacmedia.co.uk/voucher.png" />
								<h1 style="color:#fff;font-size:38px;" >VOUCHER REDEEMED</h1>
								<span style="color:#fff;font-size:18px;" >ONE OF YOUR VOUCHERS HAS BEEN REDEEMED</span><br /><br />
								<br /><br />
							</div>
							<div style="width:calc(100% - 60px);background-color:#fff;color:#000;font-size:14px;padding:30px;text-align:left;" >
								<span style="color:#F9A603;font-size:18px;font-weight:bold;" >Hi ' . $params[3] . ',</span><br/><br/>
								One of your vouchers has been redeemed! The voucher is on its way to your venue!
								<br/><Br/>
								<span style="color:#F9A603;font-size:18px;font-weight:bold;" >' . $params[2] . ' ' . $params[1] . '</span><br/><br/>
								<span style="color:#F9A603;font-size:14px;font-weight:bold;" >' . $params[0] . '</span><br/><br/>
								<br/><br/>
								Thanks!<br/><br/><br/>
								<span style="color:#f9a603;font-size:18px;font-weight:bold;" >The DealChasr Team</span>
							</div>
							<div style="width:calc(100% - 30px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding:10px 10px 10px 20px;" >
								<div style="float:left;" >
									<span style="font-weight:bold;" >GET THE APP NOW</span><br />
									<img src="http://img.almanacmedia.co.uk/google-play-badge.png" width="100" />
									<img src="http://img.almanacmedia.co.uk/app-store-badge.png" width="100" />
								</div>
								<div style="float:right;" >
									<span style="font-weight:bold;" >LETS GET SOCIAL</span><br />
									<a href="" ><img src="http://img.almanacmedia.co.uk/facebook-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/twitter-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/instagram-icon.png" style="width:20px;margin-top:5px;" /></a>
								</div>
								<div style="clear:both;" ></div>
								<div style="width:100%; font-size:10px;color:#fff;text-align:center;" >
								Please do not reply to this email. This mail box is not monitored and you will receive no reply.<br /><br />
									copyright &copy; 2018 DealChasr<br />
									Brighton, England
								</div>
							</div>
						</div>
					</body>';
                break;
            case "RESET":
                $this->content = '<body style="margin:0;" >
						<div style="width:100%;text-align:center;margin:0;font-family:Helvetica;font-weight:100;">
							<div style="font-size:10px;width:calc(100% - 50px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding-left:20px;" >
							<br /><br />
								<span style="" ><a href="http://dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >DEALCHASR HOME</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/become-a-partner" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >BECOME A PARTNER</a></span>
								<span style="" ><a href="http://my.dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PARTNER LOGIN</a></span><br /><br />
								<span style="" ><a href="http://dealchasr.co.uk/terms-and-conditions" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >TERMS OF USE</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/privacy-policy" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PRIVACY POLICY</a></span>
							</div>
							<div style="width:100%;background-image:url(http://img.almanacmedia.co.uk/cocktail.jpg); background-size:cover;background-repeat:no-repeat;
							background-position:center;height:250px" >
								<img style="margin:25px 0 0 0;" src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="150" height="150" />
							</div>
							<div style="width:100%;background-color:#f9a603;text-align:center;margin-top:-50px;" >
							<br /><br />
								<img style="width:180px;height:180px;color:white !important;fill: rgb(255,255,255) !important;"
							 src="http://img.almanacmedia.co.uk/help.png" />
								<h1 style="color:#fff;font-size:38px;" >RESET PASSWORD</h1>
								<span style="color:#fff;font-size:18px;" >HERE IS YOUR RESET LINK</span><br /><br />
								<br /><br />
							</div>
							<div style="width:calc(100% - 60px);background-color:#fff;color:#000;font-size:14px;padding:30px;text-align:left;" >
								Please click on the link below to reset your password. Please note once used this link will expire.
								<br/><Br/>
								<a href="http://password.dealchasr.co.uk/reset/newpassword.php?code=' . $params['code'] . '&email=' . $params['email'] . '" >
									http://password.dealchasr.co.uk/reset/newpassword.php?code=' . $params['code'] . '&email=' . $params['email'] . '
								</a>
								<br/><br/>
								Thanks!<br/><br/><br/>
								<span style="color:#f9a603;font-size:18px;font-weight:bold;" >The DealChasr Team</span>
							</div>
							<div style="width:calc(100% - 30px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding:10px 10px 10px 20px;" >
								<div style="float:left;" >
									<span style="font-weight:bold;" >GET THE APP NOW</span><br />
									<img src="http://img.almanacmedia.co.uk/google-play-badge.png" width="100" />
									<img src="http://img.almanacmedia.co.uk/app-store-badge.png" width="100" />
								</div>
								<div style="float:right;" >
									<span style="font-weight:bold;" >LETS GET SOCIAL</span><br />
									<a href="" ><img src="http://img.almanacmedia.co.uk/facebook-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/twitter-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/instagram-icon.png" style="width:20px;margin-top:5px;" /></a>
								</div>
								<div style="clear:both;" ></div>
								<div style="width:100%; font-size:10px;color:#fff;text-align:center;" >
								Please do not reply to this email. This mail box is not monitored and you will receive no reply.<br /><br />
									copyright &copy; 2018 DealChasr<br />
									Brighton, England
								</div>
							</div>
						</div>
					</body>';
                break;
            case "PASSWORDCHANGED":
                $this->content = '<body style="margin:0;" >
						<div style="width:100%;text-align:center;margin:0;font-family:Helvetica;font-weight:100;">
							<div style="font-size:10px;width:calc(100% - 50px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding-left:20px;" >
							<br /><br />
								<span style="" ><a href="http://dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >DEALCHASR HOME</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/become-a-partner" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >BECOME A PARTNER</a></span>
								<span style="" ><a href="http://my.dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PARTNER LOGIN</a></span><br /><br />
								<span style="" ><a href="http://dealchasr.co.uk/terms-and-conditions" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >TERMS OF USE</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/privacy-policy" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PRIVACY POLICY</a></span>
							</div>
							<div style="width:100%;background-image:url(http://img.almanacmedia.co.uk/cocktail.jpg); background-size:cover;background-repeat:no-repeat;
							background-position:center;height:250px" >
								<img style="margin:25px 0 0 0;" src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="150" height="150" />
							</div>
							<div style="width:100%;background-color:#f9a603;text-align:center;margin-top:-50px;" >
							<br /><br />
								<img style="width:180px;height:180px;color:white !important;fill: rgb(255,255,255) !important;"
							 src="http://img.almanacmedia.co.uk/help.png" />
								<h1 style="color:#fff;font-size:38px;" >PASSWORD CHANGED</h1>
								<span style="color:#fff;font-size:18px;" >YOU CAN NOW LOG IN</span><br /><br />
								<br /><br />
							</div>
							<div style="width:calc(100% - 60px);background-color:#fff;color:#000;font-size:14px;padding:30px;text-align:left;" >
								We are just letting you know your password has been changed.
								<br/><Br/>
								If you think this has been changed in error then please contact us on theteam@dealchasr.co.uk.
								</a>
								<br/><br/>
								Happy Chasing!<br/><br/><br/>
								<span style="color:#f9a603;font-size:18px;font-weight:bold;" >The DealChasr Team</span>
							</div>
							<div style="width:calc(100% - 30px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding:10px 10px 10px 20px;" >
								<div style="float:left;" >
									<span style="font-weight:bold;" >GET THE APP NOW</span><br />
									<img src="http://img.almanacmedia.co.uk/google-play-badge.png" width="100" />
									<img src="http://img.almanacmedia.co.uk/app-store-badge.png" width="100" />
								</div>
								<div style="float:right;" >
									<span style="font-weight:bold;" >LETS GET SOCIAL</span><br />
									<a href="" ><img src="http://img.almanacmedia.co.uk/facebook-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/twitter-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/instagram-icon.png" style="width:20px;margin-top:5px;" /></a>
								</div>
								<div style="clear:both;" ></div>
								<div style="width:100%; font-size:10px;color:#fff;text-align:center;" >
								Please do not reply to this email. This mail box is not monitored and you will receive no reply.<br /><br />
									copyright &copy; 2018 DealChasr<br />
									Brighton, England
								</div>
							</div>
						</div>
					</body>';
                break;
			case "INVOICE":
				$this->content = '<body style="margin:0;" >
						<div style="width:100%;text-align:center;margin:0;font-family:Helvetica;font-weight:100;">
							<div style="font-size:10px;width:calc(100% - 50px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding-left:20px;" >
							<br /><br />
								<span style="" ><a href="http://dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >DEALCHASR HOME</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/become-a-partner" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >BECOME A PARTNER</a></span>
								<span style="" ><a href="http://my.dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PARTNER LOGIN</a></span><br /><br />
								<span style="" ><a href="http://dealchasr.co.uk/terms-and-conditions" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >TERMS OF USE</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/privacy-policy" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PRIVACY POLICY</a></span>
							</div>
							<div style="width:100%;background-image:url(http://img.almanacmedia.co.uk/cocktail.jpg); background-size:cover;background-repeat:no-repeat;
							background-position:center;height:250px" >
								<img style="margin:25px 0 0 0;" src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="150" height="150" />
							</div>
							<div style="width:100%;background-color:#f9a603;text-align:center;margin-top:-50px;" >
							<br /><br />
								<img style="width:180px;height:180px;color:white !important;fill: rgb(255,255,255) !important;"
							 src="http://img.almanacmedia.co.uk/invoice.png" />
								<h1 style="color:#fff;font-size:38px;" >YOUR INVOICE</h1>
								<span style="color:#fff;font-size:18px;" >REDEMPTIONS THIS MONTH & SUBSCRIPTION</span><br /><br />
								<br /><br />
							</div>
							<div style="width:calc(100% - 60px);background-color:#fff;color:#000;font-size:14px;padding:30px;text-align:left;" >
								Hi there, <br /><br />
								Your DealChasr invoice is now ready.
								<br/><br/>
								<span style="color:#F9A603;font-size:18px;font-weight:bold;" >' . $params[1] . ' REDEMPTIONS THIS MONTH</span><br /><br />
								<span style="color:#F9A603;font-size:18px;font-weight:bold;" >&pound;' . sprintf('%0.2f', $params[0]) . ' TOTAL</span><br /><br />
								<br/><br/>
								Invoices are payable within 3 days of this email.
								<br /><br />
								<a href="http://my.dealchasr.co.uk/app/" style="color:#F9A603;font-size:14px;font-weight:bold;" >VIEW YOUR INVOICE HERE</a><br /><br />
								Thanks!<br/><br/><br/>
								<span style="color:#f9a603;font-size:18px;font-weight:bold;" >The DealChasr Team</span>
							</div>
							<div style="width:calc(100% - 30px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding:10px 10px 10px 20px;" >
								<div style="float:left;" >
									<span style="font-weight:bold;" >GET THE APP NOW</span><br />
									<img src="http://img.almanacmedia.co.uk/google-play-badge.png" width="100" />
									<img src="http://img.almanacmedia.co.uk/app-store-badge.png" width="100" />
								</div>
								<div style="float:right;" >
									<span style="font-weight:bold;" >LETS GET SOCIAL</span><br />
									<a href="" ><img src="http://img.almanacmedia.co.uk/facebook-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/twitter-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/instagram-icon.png" style="width:20px;margin-top:5px;" /></a>
								</div>
								<div style="clear:both;" ></div>
								<div style="width:100%; font-size:10px;color:#fff;text-align:center;" >
								Please do not reply to this email. This mail box is not monitored and you will receive no reply.<br /><br />
									copyright &copy; 2018 DealChasr<br />
									Brighton, England
								</div>
							</div>
						</div>
					</body>';
                break;
			case "OVERDUEINVOICE":
				$this->content = '<body style="margin:0;" >
						<div style="width:100%;text-align:center;margin:0;font-family:Helvetica;font-weight:100;">
							<div style="font-size:10px;width:calc(100% - 50px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding-left:20px;" >
							<br /><br />
								<span style="" ><a href="http://dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >DEALCHASR HOME</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/become-a-partner" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >BECOME A PARTNER</a></span>
								<span style="" ><a href="http://my.dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PARTNER LOGIN</a></span><br /><br />
								<span style="" ><a href="http://dealchasr.co.uk/terms-and-conditions" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >TERMS OF USE</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/privacy-policy" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PRIVACY POLICY</a></span>
							</div>
							<div style="width:100%;background-image:url(http://img.almanacmedia.co.uk/cocktail.jpg); background-size:cover;background-repeat:no-repeat;
							background-position:center;height:250px" >
								<img style="margin:25px 0 0 0;" src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="150" height="150" />
							</div>
							<div style="width:100%;background-color:#f9a603;text-align:center;margin-top:-50px;" >
							<br /><br />
								<img style="width:180px;height:180px;color:white !important;fill: rgb(255,255,255) !important;"
							 src="http://img.almanacmedia.co.uk/invoice.png" />
								<h1 style="color:#fff;font-size:38px;" >YOUR INVOICE</h1>
								<span style="color:#fff;font-size:18px;" >YOUR CURRENT INVOICE IS OVERDUE</span><br /><br />
								<br /><br />
							</div>
							<div style="width:calc(100% - 60px);background-color:#fff;color:#000;font-size:14px;padding:30px;text-align:left;" >
								Hi there, <br /><br />
								<span style="color:#F9A603;font-size:18px;font-weight:bold;" >&pound;' . sprintf('%0.2f', $params[0]) . ' TOTAL</span><br /><br />
								<br/><br/>
								If you do not make a full payment on your invoice your account may be suspended.<br /><br />
								Click below to pay now!
								<br /><br />
								<a href="http://my.dealchasr.co.uk/app/" style="color:#F9A603;font-size:14px;font-weight:bold;" >VIEW YOUR INVOICE HERE</a><br /><br />
								Thanks,<br/><br/><br/>
								<span style="color:#f9a603;font-size:18px;font-weight:bold;" >The DealChasr Team</span>
							</div>
							<div style="width:calc(100% - 30px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding:10px 10px 10px 20px;" >
								<div style="float:left;" >
									<span style="font-weight:bold;" >GET THE APP NOW</span><br />
									<img src="http://img.almanacmedia.co.uk/google-play-badge.png" width="100" />
									<img src="http://img.almanacmedia.co.uk/app-store-badge.png" width="100" />
								</div>
								<div style="float:right;" >
									<span style="font-weight:bold;" >LETS GET SOCIAL</span><br />
									<a href="" ><img src="http://img.almanacmedia.co.uk/facebook-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/twitter-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/instagram-icon.png" style="width:20px;margin-top:5px;" /></a>
								</div>
								<div style="clear:both;" ></div>
								<div style="width:100%; font-size:10px;color:#fff;text-align:center;" >
								Please do not reply to this email. This mail box is not monitored and you will receive no reply.<br /><br />
									copyright &copy; 2018 DealChasr<br />
									Brighton, England
								</div>
							</div>
						</div>
					</body>';
                break;
			case "PAYMENTCLEARED": 
				$this->content = '<body style="margin:0;" >
						<div style="width:100%;text-align:center;margin:0;font-family:Helvetica;font-weight:100;">
							<div style="font-size:10px;width:calc(100% - 50px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding-left:20px;" >
							<br /><br />
								<span style="" ><a href="http://dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >DEALCHASR HOME</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/become-a-partner" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >BECOME A PARTNER</a></span>
								<span style="" ><a href="http://my.dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PARTNER LOGIN</a></span><br /><br />
								<span style="" ><a href="http://dealchasr.co.uk/terms-and-conditions" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >TERMS OF USE</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/privacy-policy" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PRIVACY POLICY</a></span>
							</div>
							<div style="width:100%;background-image:url(http://img.almanacmedia.co.uk/cocktail.jpg); background-size:cover;background-repeat:no-repeat;
							background-position:center;height:250px" >
								<img style="margin:25px 0 0 0;" src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="150" height="150" />
							</div>
							<div style="width:100%;background-color:#f9a603;text-align:center;margin-top:-50px;" >
							<br /><br />
								<img style="width:180px;height:180px;color:white !important;fill: rgb(255,255,255) !important;"
							 src="http://img.almanacmedia.co.uk/invoice.png" />
								<h1 style="color:#fff;font-size:38px;" >YOUR INVOICE</h1>
								<span style="color:#fff;font-size:18px;" >PAYMENT CLEARED</span><br /><br />
								<br /><br />
							</div>
							<div style="width:calc(100% - 60px);background-color:#fff;color:#000;font-size:14px;padding:30px;text-align:left;" >
								Hi there, <br /><br />
								Your DealChasr invoice is now cleared.
								<br/><Br/>
								<span style="color:#F9A603;font-size:18px;font-weight:bold;" >AMOUNT PAID &pound;' . sprintf('%0.2f', $params['amount']) . '</span><br /><br />
								<br/><br/>
								You will receive a PayPal receipt shortly.
								<br /><br />
								<a href="http://my.dealchasr.co.uk/app/" style="color:#F9A603;font-size:14px;font-weight:bold;" >VIEW YOUR INVOICE HERE</a><br /><br />
								Thanks!<br/><br/><br/>
								<span style="color:#f9a603;font-size:18px;font-weight:bold;" >The DealChasr Team</span>
							</div>
							<div style="width:calc(100% - 30px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding:10px 10px 10px 20px;" >
								<div style="float:left;" >
									<span style="font-weight:bold;" >GET THE APP NOW</span><br />
									<img src="http://img.almanacmedia.co.uk/google-play-badge.png" width="100" />
									<img src="http://img.almanacmedia.co.uk/app-store-badge.png" width="100" />
								</div>
								<div style="float:right;" >
									<span style="font-weight:bold;" >LETS GET SOCIAL</span><br />
									<a href="" ><img src="http://img.almanacmedia.co.uk/facebook-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/twitter-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/instagram-icon.png" style="width:20px;margin-top:5px;" /></a>
								</div>
								<div style="clear:both;" ></div>
								<div style="width:100%; font-size:10px;color:#fff;text-align:center;" >
								Please do not reply to this email. This mail box is not monitored and you will receive no reply.<br /><br />
									copyright &copy; 2018 DealChasr<br />
									Brighton, England
								</div>
							</div>
						</div>
					</body>';
				break;
			case "PARTPAYMENT": 
				$this->content = '<body style="margin:0;" >
						<div style="width:100%;text-align:center;margin:0;font-family:Helvetica;font-weight:100;">
							<div style="font-size:10px;width:calc(100% - 50px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding-left:20px;" >
							<br /><br />
								<span style="" ><a href="http://dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >DEALCHASR HOME</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/become-a-partner" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >BECOME A PARTNER</a></span>
								<span style="" ><a href="http://my.dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PARTNER LOGIN</a></span><br /><br />
								<span style="" ><a href="http://dealchasr.co.uk/terms-and-conditions" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >TERMS OF USE</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/privacy-policy" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PRIVACY POLICY</a></span>
							</div>
							<div style="width:100%;background-image:url(http://img.almanacmedia.co.uk/cocktail.jpg); background-size:cover;background-repeat:no-repeat;
							background-position:center;height:250px" >
								<img style="margin:25px 0 0 0;" src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="150" height="150" />
							</div>
							<div style="width:100%;background-color:#f9a603;text-align:center;margin-top:-50px;" >
							<br /><br />
								<img style="width:180px;height:180px;color:white !important;fill: rgb(255,255,255) !important;"
							 src="http://img.almanacmedia.co.uk/invoice.png" />
								<h1 style="color:#fff;font-size:38px;" >YOUR INVOICE</h1>
								<span style="color:#fff;font-size:18px;" >PAYMENT MADE</span><br /><br />
								<br /><br />
							</div>
							<div style="width:calc(100% - 60px);background-color:#fff;color:#000;font-size:14px;padding:30px;text-align:left;" >
								Hi there, <br /><br />
								Your DealChasr invoice is now cleared.
								<br/><Br/>
								<span style="color:#F9A603;font-size:18px;font-weight:bold;" >AMOUNT PAID &pound;' . sprintf('%0.2f', $params['amount']) . '</span><br /><br />
								<br/><br/>
								You will receive a PayPal receipt shortly.
								<br /><br />
								<a href="http://my.dealchasr.co.uk/app/" style="color:#F9A603;font-size:14px;font-weight:bold;" >VIEW YOUR INVOICE HERE</a><br /><br />
								Thanks!<br/><br/><br/>
								<span style="color:#f9a603;font-size:18px;font-weight:bold;" >The DealChasr Team</span>
							</div>
							<div style="width:calc(100% - 30px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding:10px 10px 10px 20px;" >
								<div style="float:left;" >
									<span style="font-weight:bold;" >GET THE APP NOW</span><br />
									<img src="http://img.almanacmedia.co.uk/google-play-badge.png" width="100" />
									<img src="http://img.almanacmedia.co.uk/app-store-badge.png" width="100" />
								</div>
								<div style="float:right;" >
									<span style="font-weight:bold;" >LETS GET SOCIAL</span><br />
									<a href="" ><img src="http://img.almanacmedia.co.uk/facebook-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/twitter-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/instagram-icon.png" style="width:20px;margin-top:5px;" /></a>
								</div>
								<div style="clear:both;" ></div>
								<div style="width:100%; font-size:10px;color:#fff;text-align:center;" >
								Please do not reply to this email. This mail box is not monitored and you will receive no reply.<br /><br />
									copyright &copy; 2018 DealChasr<br />
									Brighton, England
								</div>
							</div>
						</div>
					</body>';
				break;
			case "ACCOUNTUPGRADE":
				$this->content = '<body style="margin:0;" >
						<div style="width:100%;text-align:center;margin:0;font-family:Helvetica;font-weight:100;">
							<div style="font-size:10px;width:calc(100% - 50px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding-left:20px;" >
							<br /><br />
								<span style="" ><a href="http://dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >DEALCHASR HOME</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/become-a-partner" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >BECOME A PARTNER</a></span>
								<span style="" ><a href="http://my.dealchasr.co.uk" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PARTNER LOGIN</a></span><br /><br />
								<span style="" ><a href="http://dealchasr.co.uk/terms-and-conditions" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >TERMS OF USE</a></span>
								<span style="" ><a href="http://dealchasr.co.uk/privacy-policy" style="color:#fff;font-weight:bold;text-decoration:none;margin-right:20px;" >PRIVACY POLICY</a></span>
							</div>
							<div style="width:100%;background-image:url(http://img.almanacmedia.co.uk/cocktail.jpg); background-size:cover;background-repeat:no-repeat;
							background-position:center;height:250px" >
								<img style="margin:25px 0 0 0;" src="http://img.almanacmedia.co.uk/dealchasrlogo.png" width="150" height="150" />
							</div>
							<div style="width:100%;background-color:#f9a603;text-align:center;margin-top:-50px;" >
							<br /><br />
								<img style="width:180px;height:180px;color:white !important;fill: rgb(255,255,255) !important;"
							 src="http://img.almanacmedia.co.uk/help.png" />
								<h1 style="color:#fff;font-size:38px;" >ACCOUNT UPGRADE</h1>
								<span style="color:#fff;font-size:18px;" >NEW TIER</span><br /><br />
								<br /><br />
							</div>
							<div style="width:calc(100% - 60px);background-color:#fff;color:#000;font-size:14px;padding:30px;text-align:left;" >
								Hi there, <br /><br />
								Thanks for upgrading your account!
								<br/><Br/>
								<span style="color:#F9A603;font-size:18px;font-weight:bold;" >YOU ARE NOW ON THE ' . $params[0] . ' TIER</span><br /><br />
								<br/><br/>
								If you feel this is an error please contact theteam@dealchasr.co.uk.
								<br /><br /><br />
								Thanks!<br/><br/><br/>
								<span style="color:#f9a603;font-size:18px;font-weight:bold;" >The DealChasr Team</span>
							</div>
							<div style="width:calc(100% - 30px);background-color:#f9a603;color:#fff;height:100px;text-align:left;padding:10px 10px 10px 20px;" >
								<div style="float:left;" >
									<span style="font-weight:bold;" >GET THE APP NOW</span><br />
									<img src="http://img.almanacmedia.co.uk/google-play-badge.png" width="100" />
									<img src="http://img.almanacmedia.co.uk/app-store-badge.png" width="100" />
								</div>
								<div style="float:right;" >
									<span style="font-weight:bold;" >LETS GET SOCIAL</span><br />
									<a href="" ><img src="http://img.almanacmedia.co.uk/facebook-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/twitter-icon.png" style="width:20px;margin-top:5px;" /></a> 
									<a href="" ><img src="http://img.almanacmedia.co.uk/instagram-icon.png" style="width:20px;margin-top:5px;" /></a>
								</div>
								<div style="clear:both;" ></div>
								<div style="width:100%; font-size:10px;color:#fff;text-align:center;" >
									Please do not reply to this email. This mail box is not monitored and you will receive no reply.<br /><br />
									copyright &copy; 2018 DealChasr<br />
									Brighton, England
								</div>
							</div>
						</div>
					</body>';
				break;
            default:
                $this->content = "";
                break;
        }

        return $this->content;
    }
}