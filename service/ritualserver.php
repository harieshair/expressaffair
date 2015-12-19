<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/rituals.php");
$ritual = new ritualclass($dbconnection->dbconnector);

//ob_start("ob_gzhandler");
switch($_POST['action']){
/*--------------------------------------------------------------*/
	case "saveritual":
	if(!empty($_POST['ritualdetails'])){
		$params = array();
		parse_str($_POST['ritualdetails'], $params);
		$serviceids=(isset($_POST['serviceids']) && !empty($_POST['serviceids']))?$_POST['serviceids']:null;
		$response= $ritual->updateRitual($params,$serviceids);
		if(empty($response["Exception"]))
			$response['Message']="Ritual details updated successfully";		
		echo json_encode($response);
	}
	else{
		$response['Exception']="Please specify valid details";
echo json_encode($response);
}
break;
}