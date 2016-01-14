<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER . "/sendmail/PHPMailerAutoload.php");
include_once(CLASSFOLDER . "/sendmail/phpmailer.php");
include_once(CLASSFOLDER . "/sendmail/smtp.php");
//require 'PHPMailer/PHPMailerAutoload.php';
 
$mail = new PHPMailer;
$mail->SMTPDebug = 4;   
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Username = 'prabhakarindia2006@gmail.com';
$mail->Password = 'prabhaprofit121085';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->From = 'prabhakarindia2006@gmail.com';
$mail->FromName = 'Prabhakar';
$mail->addAddress('prabhakarindia2006@gmail.com', 'prabhakar M');
 
$mail->addReplyTo('prabhakarindia2006@gmail.com', 'prabhakar');
       
$mail->WordWrap = 50;
$mail->isHTML(true);
$mail->SingleTo = true;
 
$mail->Subject = 'Using PHPMailer';
$mail->Body    = 'Hi I am using PHPMailer library to sent SMTP mail from localhost';

$val = $mail->send();
echo "mail return val::".$val;
if(!val) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
 
echo 'Message has been sent';

?>