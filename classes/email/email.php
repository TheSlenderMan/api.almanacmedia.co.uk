<?php

class email {

    private $to;
    private $body;
    private $subject;
    private $headers = "From: DealChasr <theteam@dealchasr.co.uk>" . "\r\n";

    function __construct($to){
        $this->to = $to;
        $this->headers .= "MIME-Version: 1.0" . "\r\n";
        $this->headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        $this->headers .= "X-Priority: 3\r\n";
        $this->headers .= "X-Mailer: PHP". phpversion() ."\r\n";
        $this->headers .= "Reply-To: DealChasr <theteam@dealchasr.co.uk>\r\n";
        $this->headers .= "Return-Path: DealChasr <theteam@dealchasr.co.uk>\r\n";
    }

    public function setBody($body){
        $this->body = $body;
    }

    public function setSubject($subject){
        $this->subject = $subject;
    }

    public function executeMail(){
        mail($this->to, $this->subject, $this->body, $this->headers);
    }
}