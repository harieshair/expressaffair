<?php
$updateObject=array();
try{
	if(!empty($services)){
		$oldserviceIds=$this->internalDB->queryFirstColumn("select service_id from r_services where  ritual_id =$ritualId ");
		$servicesToCreate=explode(',',$services);
		if(!empty($oldserviceIds) && count($oldserviceIds)>0){
			$serviceIdsToRemove=array_diff($oldserviceIds, $servicesToCreate);
			$servicesToCreate=array_diff($servicesToCreate,$oldserviceIds);
			if(!empty($serviceIdToRemove) && count($serviceIdToRemove)>0){
				$this->internalDB->query("DELETE FROM r_services where  ritual_id =$ritualId  
					and  service_id in (".implode(',',$serviceIdToRemove.")"));

			}
		}
		if(!empty($servicesToCreate) && count($servicesToCreate)>0){
			foreach ($servicesToCreate as $serviceId) {

				$updateObject[]=array(
					"service_id"=>$serviceId,"ritual_id"=>$ritualId
					);
			}
			if($updateObject!=array())
				$this->internalDB->insert('r_services',$updateObject);
		}
	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>