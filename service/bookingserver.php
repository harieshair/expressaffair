<?php
include_once(filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING)."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/bookings.php");

$booking = new bookingclass($dbconnection->dbconnector);

switch(filter_input(INPUT_POST, 'action')){
	/*--------------------------------------------------------------*/
	case "bookthisitem":
	if(!empty($_POST['itemdata']) && !empty($_POST['bookerdetails'])) {
		$bookerdetail=filter_input(INPUT_POST,'bookerdetails');
		parse_str($bookerdetail, $booker);
		if(empty($booker['cust_contactnumber'])){
			echo "Please specify valid contact number";
			return;
		}
		if(empty($booker['cust_email'])){
			echo "Please specify valid email";
			return;
		}
		if(empty($booker['cust_address'])){
			echo "Please specify valid address";
			return;
		}		
		include_once(CLASSFOLDER."/searchobject.php");
		$searchObj=new searchobject();
		$entity=getRequestParameters($searchObj);
		$response=$booking->SaveBookings($entity,$booker);
		if(empty($response['Exception']) && !empty($response['Id'])){			
			echo 1;	
		}
                else{ echo $response['Exception'];}
	}
	else{		echo $response['Exception'];	}	
	break;
}

function getRequestParameters($entity){
	$request=  json_decode(filter_input(INPUT_POST, 'itemdata'));
	$entity->customerId=!empty($request->c)?$request->c:null;
	$entity->locationId=!empty($request->l)?$request->l:null;
	$entity->eventId=!empty($request->e)?$request->e:null;
	$entity->ritualId=!empty($request->r)?$request->r:null;
	$entity->serviceId=!empty($request->s)?$request->s:null;
	$entity->eventFrom=!empty($request->ef)?$request->ef:null;
	$entity->eventTo=!empty($request->et)?$request->et:null;
	$entity->vserviceId=!empty($request->vsi)?$request->vsi:null;
	return $entity;
}
