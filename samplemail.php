<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER . '/sendmail/sendmail.php');
$sendmail = new sendmailclass();

$from_address = "hariesh.air@gmail.com";
$from_name = "senthil";
$subject = "Test";
$html_message = "test";
$sendmail->sendHtmlEMail($from_address, $from_name, 'hariesh', 'hariesh.air@gmail.com', $subject, $html_message, $html_message);
echo 'ds';