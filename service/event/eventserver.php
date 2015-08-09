<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
session_start();
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/events.php");
$events = new eventclass();

//ob_start("ob_gzhandler");
switch($_POST['action']){
/*--------------------------------------------------------------*/
	case "saveevents":
	if(!empty($_POST['eventdetails'])){
		$params = array();
		parse_str($_POST['eventdetails'], $params);
		$response= $events->updateevent($params);
		if(empty($response["Exception"]))
			$response['Message']="Event details updated successfully";		
		echo json_encode($response);
	}
	else{
		$response['Exception']="Please specify valid event details";
echo json_encode($response);
}
break;
}