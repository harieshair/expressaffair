<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/communities.php");
$community = new communityclass($dbconnection->dbconnector);

//ob_start("ob_gzhandler");
switch($_POST['action']){
/*--------------------------------------------------------------*/
	case "savecommunity":
	if(!empty($_POST['communitydetails'])){
		$params = array();
		parse_str($_POST['communitydetails'], $params);
		//print_r($params);
		$eventids=(isset($_POST['eventids']) && !empty($_POST['eventids']))?explode(',',$_POST['eventids']):null;
		$response= $community->updatecommunity($params,$eventids);
		if(empty($response["Exception"]))
			$response['Message']="Community details updated successfully";		
		echo json_encode($response);
	}
	else{
		$response['Exception']="Please specify valid community details";
echo json_encode($response);
}
break;
}