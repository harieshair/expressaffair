<?php
$itemArray = array();
$itemArray=array('Exception'=>"",'Items'=>null);
$selectCount="SELECT count(vs.id) ";
$joinclause=" FROM  v_services vs inner join carts c on vs.id=c.v_service_id ";
$where=" where vs.service_id is not null and c.customer_id = $customerId ";	


$totalItem= $this->internalDB->queryFirstField($selectCount.$joinclause.$where);	

if($totalItem>0){

	$selectclause="SELECT c.location_id as locationId,vs.title,vs.description,c.v_service_id,vs.price,vs.service_category,
	c.event_id,c.ritual_id,c.event_from,c.event_to,vs.review,c.created_on,
	concat('".HTTPAPPLICATIONROOT.'/'."',vs.master_image) as filePath ,vs.service_id as serviceId ,c.id as cartId ";
	$orderby=" order by c.created_on desc ";		

	$items= $this->internalDB->query($selectclause.$joinclause.$where.$orderby);	
       

			//Get all city catalogs
	$catalogarray=array();
	$catalogvalues=$this->internalDB->query("SELECT id,catalog_value FROM catalog_value c where catalogmaster_id in (select id from catalog_master where name in ('City', 'Service Category','Services'))"); 
	foreach($catalogvalues as $catalog)
		$catalogarray[$catalog['id']]=$catalog['catalog_value'];
        
	for ($i=0; $i < $totalItem; $i++) { 
		$items[$i]['city']=!empty($items[$i]['locationId'])?$catalogarray[$items[$i]['locationId']]:"";
		$items[$i]['service']=$catalogarray[$items[$i]['serviceId']];
		$items[$i]['category']=!empty($items[$i]['serviceId'])?$catalogarray[$items[$i]['serviceId']]:null;				
	}				
	$itemArray['Items']=$items;
}		
return $itemArray;
?>