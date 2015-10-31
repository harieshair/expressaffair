<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	$duplicate=$this->internalDB->queryFirstRow("select id from carts where  AND service_id=$serviceId AND v_service_id=$v_serviceId AND customer_id=$customerId");
		if(!empty($duplicate))
			return ;
		
		$updateObject['service_id']=$serviceId;
		$updateObject['v_service_id']=$v_serviceId; 
		$updateObject['customer_id']=$customerId;		
		$updateObject['created_on']=$today;
		$this->internalDB->insert('carts',$updateObject);
		return $this->internalDB->insertId();
	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );
}
?>