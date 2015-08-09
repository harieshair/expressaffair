<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
session_start();
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/communities.php");
$community = new communityclass();

//ob_start("ob_gzhandler");
switch($_POST['action']){
/*--------------------------------------------------------------*/
	case "savecommunity":
	if(!empty($_POST['communitydetails'])){
		$params = array();
		parse_str($_POST['communitydetails'], $params);
		$eventids=isset($_POST['communitydetails'])?$_POST['communitydetails']:null;
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