<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/events.php");
$events = new eventclass($dbconnection->dbconnector);

//ob_start("ob_gzhandler");
switch($_POST['action']){
/*--------------------------------------------------------------*/
	case "saveevents":
	if(!empty($_POST['eventdetails'])){
		$params = array();
		parse_str($_POST['eventdetails'], $params);
		$ritualids=(isset($_POST['ritualids']) && !empty($_POST['ritualids']))?$_POST['ritualids']:null;
		$serviceids=(isset($_POST['serviceids']) && !empty($_POST['serviceids']))?$_POST['serviceids']:null;
		$response= $events->updateevent($params,$ritualids,$serviceids);
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