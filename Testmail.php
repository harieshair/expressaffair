?<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER . "/sendmail/Testsendmail.php");
/*$sendmail = new sendmailclass();

$from_address = "prabhakarindia2006@gmail.com";
$from_name = "Prabhakar";
$subject = "Test";
$html_message = "this is test mail";
$toname = "prabhakarindia2006";
$tomailid = "prabhakarindia2006@gmail";
$sendmail->sendHtmlEMail($from_address, $from_name, $toname, $tomailid, $subject, $html_message, $html_message);
*/


/* Instantiate Object
-------------------------------------------------------------------*/
	//$mailer = new SendMail ( MSG_TXT );
        $mailer = new SendMail ( MSG_HTML + MSG_TXT );
	$mailer->setSMTP ( 'smtp.gmail.com' , '465' , 'prabhakarindia2006@gmail.com' , 'prabhaprofit121085' ) ;
            
        
/* Set Basics, like sender, recipient (receiver), a CC, and the subject
-------------------------------------------------------------------*/
	$mailer->setSender('Prabhakar','prabhakarindia2006@gmail.com');
	$mailer->setReceiver('senthil','hariesh.air@gmail.com');
	//$mailer->addCC('you','pretendnamethatdoesntexist@hotmail.com');
	$mailer->subject = 'This is a test message.';
/* Set the actual message, both HTML and TXT
-------------------------------------------------------------------*/
	// Load the HTML template
	//$template_file = fopen ( 'mail_template.html' , 'r' );
	
	/*$template = '';
	while (!feof ($template_file)) {
		$template .= fgets ($template_file);
	}
	fclose ($template_file); */
	
	$msg = <<<MSG
this is text test mail in php
MSG;
	
	/*$mailer->reparseMail ( $template , array (
		'name'=>'Jason Vertucio',
		'email'=>'m@jasonvertucio.com',
		'phone'=>'(212) 555-1212',
		'message'=>$msg
	));*/
	
	//$mailer->setHtmlMessage($template);
	$mailer->setTextMessage(nl2br($msg));
		// Note that this will actually show you all the HTML 
		// tags and is NOT a good way of performing the task
		echo "msg:::".var_dump($msg);
/* Actually send the message!
-------------------------------------------------------------------*/
	// Uncomment the following line and enter your information to send an email using SMTP.
	// $mailer->setSMTP( server , port (25 or 26) , username , password );
	$result = $mailer->send();
	
?>

