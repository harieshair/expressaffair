<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/publicclass.php");
$publicobj = new publicclass($dbconnection->dbconnector);
switch($_POST['action']){
	case "getAllRitualsForHome":
	$response= $publicobj->getAllRitualsForHome();
	echo json_encode($response);
	break;
}