<?php
$status=false;
	$notify=$this->tenantDB->queryFirstRow("SELECT nc.id,nc.from_address,subject,message,from_name from notifications_configured  nc 
	inner join  notifications n on n.id=nc.notification_id  where n.name='".NOTIFYCREATEUSER."' AND nc.client_id=$this->CLIENTID ");  
	if(isset($notify['id'])){
	  $sendmail=new sendmailclass();

	  $from_address=$notify['from_address'];
	  $from_name=$notify['from_name'];
	  $to_name=$name;
	  $to_address=$mailid;
	  $subject=$notify['subject'];
	  $html_message = "Hi ".$to_name.", <br /><br /> Your Login credential created for microsite,<br/> Please find the details below <br/>Link:xxxxxx<br/>LoginId:$loginid<br/>Password:$password";
	 $status=$sendmail->sendHtmlEMail($from_address, $from_name, $to_name, $to_address, $subject, $html_message, $html_message);
	  }
	  return $status;
      ?>