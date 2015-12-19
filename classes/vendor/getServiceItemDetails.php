<?php
$response=array("Exception"=>"","Details"=>"","Attachments"=>"");
try{
	$sql="SELECT vs.vendor_id,v.title as vendorname, vs.title,vs.description,vs.price,vs.service_id, serv.catalog_value as service ,vs.service_category,vs.review
	FROM  v_services vs 	left join vendor v on v.id=vs.vendor_id  
	left join catalog_value serv on serv.id=vs.service_id where  vs.id= $vserviceId";
	$sql.=!empty($locationId)?" AND vs.locations=$locationId ":'';
	$response["Details"]=	$this->internalDB->queryFirstRow($sql);
	$response["Attachments"]=$this->getAllAttachmentsByEntityId($vserviceId,VENDORSERVICE);
}
catch(Exception $ex){
	$response["Exception"]=$ex->getMessage();
}
return $response;
?>