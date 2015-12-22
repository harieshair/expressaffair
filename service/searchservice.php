<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/searchservice.php");
include_once(CLASSFOLDER."/searchobject.php");
$searchservice = new searchservices($dbconnection->dbconnector);
$searchObj=new searchobject();

$req= file_get_contents( "php://input" );
$request=json_decode($req);
if(!empty($request)){
	$request=getPOstPatrameters($request,$searchObj);
	$response=$searchservice->getServicesBySearchOption($request);
	echo json_encode($response);	
}
else{
	echo json_encode(array("Exception"=>"Empty filter options"));
}
/*----------------------------------------------*/
function getPOstPatrameters($request,$searchobj){
	$searchobj->ritualId=!empty($request->r)?$request->r:null;
	$searchobj->eventTo= !empty($request->et)?$request->et:null;
	$searchobj->eventFrom= !empty($request->ef)?$request->ef:null;
	$searchobj->eventId= !empty($request->e)?$request->e:null;
	$searchobj->serviceId= !empty($request->s)?$request->s:null;
	$searchobj->locationId= !empty($request->l)?$request->l:null;
	$searchobj->orderBy= !empty($request->oby)?$request->oby:null;
	$searchobj->max= !empty($request->ma)?$request->ma:null;
	$searchobj->start= isset($request->st)?$request->st:null;
	$searchobj->customerId= !empty($request->c)?$request->c:null;
	$searchobj->vserviceId= !empty($request->vsi)?$request->vsi:null;
	$searchobj->packages= !empty($request->pac)?$request->pac:null;
	$searchobj->priceMinimum= !empty($request->prm)?$request->prm:null;
	$searchobj->priceMaximum= !empty($request->prmax)?$request->prmax:null;
	return $searchobj;
}