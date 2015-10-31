<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	$duplicate=$this->internalDB->queryFirstRow("select id from carts where  AND service_id=$entity->serviceid AND v_service_id=$entity->v_serviceId AND customer_id=$entity->customerId");
		if(!empty($duplicate))
			return ;
		
		$updateObject['service_id']=$entity->serviceId;
		$updateObject['v_service_id']=$entity->v_serviceId; 
		$updateObject['customer_id']=$entity->customerId;		
		$updateObject['created_on']=$today;
		$updateObject['event_from']=$entity->eventfrom;
		$updateObject['event_to']=$entity->eventto;
		$this->internalDB->insert('carts',$updateObject);
		return $this->internalDB->insertId();
	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );
}
?>