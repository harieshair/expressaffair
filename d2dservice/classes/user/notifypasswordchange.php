<?php
	include_once(CLASSFOLDER."/rpoconstants.php");
	$notify=$this->tenantDB->queryFirstRow("SELECT nc.id,nc.from_address,subject,message,from_name,message_location from notifications_configured  nc inner join  notifications n on n.id=nc.notification_id  where n.name='".NOTIFYFORGETPASSWORD."' AND nc.client_id=$this->CLIENTID ");  
	if(isset($notify['id'])){
		include_once(CLASSFOLDER.'/sendmail/sendmail.php');
		$sendmail=new sendmailclass();
		
		$from_address=$notify['from_address'];
		$from_name=$notify['from_name'];
		$subject=$notify['subject'];
		$location= $notify['message_location'];
		$html_message=include ROOTFOLDER."/".$location;
		$sendmail->sendHtmlEMail($from_address, $from_name, $username, $mailid, $subject, $html_message, $html_message);
	}