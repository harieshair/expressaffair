<?php
$updateObject=array();
try{
	if(!empty($services)){
		$oldserviceIds=$this->internalDB->queryFirstColumn("select service_id from e_services where  event_id =$eventId ");
		$servicesToCreate=explode(',',$services);
		if(!empty($oldserviceIds) && count($oldserviceIds)>0){
			$serviceIdsToRemove=array_diff($oldserviceIds, $servicesToCreate);
			$servicesToCreate=array_diff($servicesToCreate,$oldserviceIds);
			if(!empty($serviceIdToRemove) && count($serviceIdToRemove)>0){
				$this->internalDB->query("DELETE FROM e_services where  event_id =$eventId  
					and  service_id in (".implode(',',$serviceIdToRemove.")"));

			}
		}
		if(!empty($servicesToCreate) && count($servicesToCreate)>0){
			foreach ($servicesToCreate as $serviceId) {

				$updateObject[]=array(
					"service_id"=>$serviceId,"event_id"=>$eventId
					);
			}
			if($updateObject!=array())
				$this->internalDB->insert('e_services',$updateObject);
		}
	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>