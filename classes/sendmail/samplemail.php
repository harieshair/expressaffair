<?php

include_once(CLASSFOLDER . '/sendmail/sendmail.php');
$sendmail = new sendmailclass();

$from_address = "expressaffair@expressaffair.com";
$from_name = "adminservice";
$subject = "Test";
$html_message = "test";
$sendmail->sendHtmlEMail($from_address, $from_name, $toname, $tomailid, $subject, $html_message, $html_message);
