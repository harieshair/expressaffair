<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/role.php");
$role = new roleclass($dbconnection->dbconnector);

//ob_start("ob_gzhandler");
switch($_POST['action']){
/*--------------------------------------------------------------*/
case "saverole":
if(!empty($_POST['rolename'])){
	$response= $role->CreateRole($_POST['rolename']);
	 echo json_encode($response);
}
else{
	echo json_encode($response['Exception']="Please specify role name");
}
break;
}