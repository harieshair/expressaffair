<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
session_start();
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/cart.php");
$cart = new cartclass($dbconnection->dbconnector);

switch($_POST['action']){
	/*--------------------------------------------------------------*/
	case "aditemtocart":
	if(!empty($_POST['itemdata'])){
		$entity=getRequestParameters();
		$response=$cart->AddToCart($entity);
		if(empty($response['Exception']) && !empty($response['Id'])){			
			echo $response['Id'];	
		}
		else echo 0;
	}
	else{
		echo $response['Exception'];
	}	
	break;
}

function getRequestParameters(){
	$request=json_decode($_POST['itemdata']);
	$entity="";
	$entity->customerId=!empty($request->c)?$request->c:null;
	$entity->locationId=!empty($request->l)?$request->l:null;
	$entity->eventId=!empty($request->e)?$request->e:null;
	$entity->ritualId=!empty($request->r)?$request->r:null;
	$entity->serviceId=!empty($request->s)?$request->s:null;
	$entity->eventFrom=!empty($request->ef)?$request->ef:null;
	$entity->eventTo=!empty($request->et)?$request->et:null;
	$entity->v_serviceId=!empty($request->vsi)?$request->vsi:null;
	return $entity;
}
