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
	
	if(!empty($entity->eventTo) && empty($entity->eventFrom))
		$entity->eventFrom=$entity->eventTo;
	if(!empty($entity->eventFrom))
	{
		$entity->eventFrom=str_replace("/","-",$entity->eventFrom);
		$entity->eventFrom=date('Y-m-d H:i:s',strtotime($entity->eventFrom));
		$updateObject['event_from']=$entity->eventFrom;
	}	

	if(!empty($entity->eventto))
	{
		$entity->eventTo=str_replace("/","-",$entity->eventTo);
		$entity->eventTo=date('Y-m-d H:i:s',strtotime($entity->eventTo));
		$updateObject['event_to']=$entity->eventto;
	}
	else
		$updateObject['event_to']=$entity->eventFrom;
	
	isset($entity->eventid)?$updateObject['event_id']=$entity->eventId:"";
	isset($entity->ritualid)?$updateObject['ritual_id']=$entity->ritualId:"";
	isset($entity->locationId)?$updateObject['location_id']=$entity->locationId:"";
	$this->internalDB->insert('carts',$updateObject);
	$entityId=$this->internalDB->insertId();
	return array('Id'=>$entityId);
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );
}
?>