<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	if(!empty($entity['eventid'])){

		$duplicate=$this->internalDB->queryFirstRow("select id from events where  name='".$entity['eventname']."' AND id!=".$entity['eventid']);
		if(!empty($duplicate))
			return array("Exception"=>"Specified event name already exists" );

		isset($entity['eventname'])?$updateObject['name']=$entity['eventname']:'';
		isset($entity['description'])?$updateObject['description']=$entity['description']:''; 
		isset($entity['icons'])?$updateObject['icons']=$entity['icons']:'';
		isset($entity['file_name'])?$updateObject['images']=$entity['file_name']:'';
		isset($ritualIds)?$updateObject['rituals']=$ritualIds:''; 
		isset($serviceIds)?$updateObject['services']=$serviceIds:''; 
		$this->internalDB->update('events',$updateObject,"id=%i",$entity['eventid']);

		$entity['entity_id']=$entity['eventid'];
		
		//Save Event Rituals and services
		!empty($ritualIds)?$this->saveEventRituals($entity['entity_id'],$ritualIds):'';
		!empty($serviceIds)?$this->saveEventServices($entity['entity_id'],$serviceIds):'';
		
		//Update pulic event menu
		$this->updateEventMenu();

		

		//Add New Attachments
		if(!empty($entity['file_name'])){
			//Remove removeAttachments
			$this->removeAttachments($entity['eventid'],$entity['file_name']);
			
			$files=explode(",",$entity['file_name']);
			foreach ($files as $file) {
				$oldFileId=$this->getAttachmentByFileName($file,$entity['eventid']);
				if(empty($oldFileId)){
					$entity['file_name']=$file;
					$response=$this->saveattachments($entity);
				}
			}	
		}
		return array('Id'=>$entity['eventid'] );	
	}
	else{

		$duplicate=$this->internalDB->queryFirstRow("select id from events where  name='".$entity['eventname']."'");
		if(!empty($duplicate))
			return array('Exception'=>"Specified event name already exists" );

		
		isset($entity['eventname'])?$updateObject['name']=$entity['eventname']:'';
		isset($entity['description'])?$updateObject['description']=$entity['description']:''; 
		isset($entity['icons'])?$updateObject['icons']=$entity['icons']:'';
		isset($entity['file_name'])?$updateObject['images']=$entity['file_name']:'';
		isset($ritualIds)?$updateObject['rituals']=$ritualIds:''; 
		isset($serviceIds)?$updateObject['services']=$serviceIds:''; 
		$updateObject['created_on']=$today;
		$updateObject['is_deleted']=0;
		$this->internalDB->insert('events',$updateObject);
		$entity['entity_id']=$this->internalDB->insertId();

		//Save Event Rituals and services
		!empty($ritualIds)?$this->saveEventRituals($entity['entity_id'],$ritualIds):'';
		!empty($serviceIds)?$this->saveEventServices($entity['entity_id'],$serviceIds):'';


		if(!empty($entity['file_name'])){
			$files=explode(",",$entity['file_name']);
			foreach ($files as $file) {
				$entity['file_name']=$file;
				$response=$this->saveattachments($entity);
			}	
		}
		//Update pulic event menu
		$this->updateEventMenu();

		return array('Id'=>$entity['entity_id'] );

	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>