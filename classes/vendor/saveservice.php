<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	if(!empty($entity['serviceid'])){

		$duplicate=$this->internalDB->queryFirstRow("select id from v_services where  title='".$entity['title']."' AND vendor_id !="
			.$entity['vendor_id']." AND id!=".$entity['serviceid']);
		if(!empty($duplicate))
			return array("Exception"=>"Specified service title already exists" );

		isset($entity['title'])?$updateObject['title']=$entity['title']:'';
		isset($entity['price'])?$updateObject['price']=$entity['price']:'';
		isset($entity['description'])?$updateObject['description']=$entity['description']:'';
		isset($entity['selectedzone'])?$updateObject['zones']=implode(',',$entity['selectedzone']):''; 
		isset($entity['selectedservice'])?$updateObject['service_id']=$entity['selectedservice']:''; 
		isset($entity['selectedlocation'])?$updateObject['locations']=implode(',',$entity['selectedlocation']):''; 
		isset($entity['selectedstate'])?$updateObject['states']=implode(',',$entity['selectedstate']):''; 
		isset($entity['category'])?$updateObject['service_category']=$entity['category']:'';
		$this->internalDB->update('v_services',$updateObject,"id=%i",$entity['serviceid']);
		
		$entity['entity_id']=$entity['serviceid'];

		// Save vendor service locations
		$this->savevendorservicelocations($entity['entity_id'],implode(',',$entity['selectedlocation']));

		if(!empty($entity['file_name'])){
		//Remove removeAttachments
			$this->removeAttachments($entity['serviceid'], $entity['file_name'],"VendorService");

		//Add New Attachments
			$files=explode(",",$entity['file_name']);
			foreach ($files as $file) {
				$oldFileId=$this->getAttachmentByFileName($file,$entity['serviceid'],"VendorService");
				if(empty($oldFileId)){
					$entity['file_name']=$file;
					$response=$this->saveattachments($entity,"VendorService");
				}
			}	
		}
		return array('Id'=>$entity['serviceid'] );	
	}
	else{

		$duplicate=$this->internalDB->queryFirstRow("select id from v_services where  title='".$entity['title']."' AND vendor_id !="
			.$entity['vendor_id']);
		if(!empty($duplicate))
			return array('Exception'=>"Specified service title already exists" );

		isset($entity['title'])?$updateObject['title']=$entity['title']:'';
		isset($entity['price'])?$updateObject['price']=$entity['price']:'';
		isset($entity['description'])?$updateObject['description']=$entity['description']:'';
		isset($entity['selectedservice'])?$updateObject['service_id']=$entity['selectedservice']:''; 
		isset($entity['selectedzone'])?$updateObject['zones']=implode(',',$entity['selectedzone']):''; 
		isset($entity['selectedlocation'])?$updateObject['locations']=implode(',',$entity['selectedlocation']):''; 
		isset($entity['selectedstate'])?$updateObject['states']=implode(',',$entity['selectedstate']):''; 
		isset($entity['vendor_id'])?$updateObject['vendor_id']=$entity['vendor_id']:'';	
		isset($entity['category'])?$updateObject['service_category']=$entity['category']:'';
		$updateObject['created_on']=$today;
		$updateObject['is_deleted']=0;
		$this->internalDB->insert('v_services',$updateObject);
		$vendor_serviceId=$this->internalDB->insertId() ;
		
		$entity['entity_id']=$vendor_serviceId;

		// Save vendor service locations
		$this->savevendorservicelocations($entity['entity_id'],implode(',',$entity['selectedlocation']));


		if(!empty($entity['file_name'])){
			$files=explode(",",$entity['file_name']);
			foreach ($files as $file) {
				$entity['file_name']=$file;
				$response=$this->saveattachments($entity,VENDORSERVICE);
			}	
		}
		return array('Id'=>$vendor_serviceId );

	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>