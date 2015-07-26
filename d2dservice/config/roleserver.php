<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
session_start();
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/role.php");
$role = new roleclass();

//ob_start("ob_gzhandler");
switch($_POST['action']){
/*--------------------------------------------------------------*/
case "saverole":
if(!empty($_POST['rolename'])){
	$response= $role->CreateRole($_POST['rolename']);
	 print_r(json_encode($response));
}
else{
	print_r(json_encode($response['Exception']="Please specify role name"));
}
break;
}