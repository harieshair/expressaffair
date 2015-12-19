<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	
	$duplicate=$this->internalDB->queryFirstRow("select id from carts where service_id=$entity->serviceId AND v_service_id=$entity->v_serviceId AND customer_id=$entity->customerId");
	if(!empty($duplicate))
		return ;

	$updateObject['service_id']=$entity->serviceId;
	$updateObject['v_service_id']=$entity->v_serviceId; 
	$updateObject['customer_id']=$entity->customerId;		
	$updateObject['created_on']=$today;	
	if(!empty($entity->eventFrom) || !empty($entity->eventTo)){
		if(!empty($entity->eventFrom))
		{
			$eventfrom=explode('/',$entity->eventFrom);
			$updateObject['event_from']= $eventfrom[2].'-'.$eventfrom[0].'-'.$eventfrom[1].' 00:00:00';		
		}	

		if(!empty($entity->eventTo))
		{
			$eventto=explode('/',$entity->eventTo);
			$updateObject['event_to']= $eventto[2].'-'.$eventto[0].'-'.$eventfrom[1].' 00:00:00';	
		}
		else
			$updateObject['event_to']=$eventfrom[2].'-'.$eventfrom[0].'-'.$eventfrom[1].' 00:00:00';
	}
	
	isset($entity->eventId)?$updateObject['event_id']=$entity->eventId:"";
	isset($entity->ritualId)?$updateObject['ritual_id']=$entity->ritualId:"";
	isset($entity->locationId)?$updateObject['location_id']=$entity->locationId:"";
	$this->internalDB->insert('carts',$updateObject);
	$entityId=$this->internalDB->insertId();
	return array('Id'=>$entityId);
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );
}
?>