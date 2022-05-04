<?php

require 'C:\wamp64\www\projet\phpmailer\includes\Exception.php';
require 'C:\wamp64\www\projet\phpmailer\includes\SMTP.php';
require 'C:\wamp64\www\projet\phpmailer\includes\PHPMailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

//name spaces




//Instance
$mail= new PHPMailer();

//Set mailer to use smtp
$mail->isSMTP();

//define host smtp
$mail->Host = "smtp.gmail.com";
//
$mail->SMTPAuth ="true";
//
$mail->SMTPSecure ="tls";
//
$mail->Port ="587";
//
$mail->Username ="mehdi572500@gmail.com";
//
$mail->Password = "";
$mail->Subject = "sujet";
$mail->setFrom("mehdi572500@gmail.com");
$mail->isHTML(true);

$mail->Body = $_SESSION['body']; 
$mail->addAddress($emailc);
if ($mail->Send()) {
    echo "email envoyé";
}   else{
    echo "Erreur";
}
$mail->smtpClose();
?>