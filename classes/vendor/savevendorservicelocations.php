<?php
$updateObject=array();
try{
	if(!empty($locations)){
		$oldlocationIds=$this->internalDB->queryFirstColumn("select location_id from v_service_location where  vservice_id =$vServiceId ");
		$locationsToCreate=explode(',',$locations);
		if(!empty($oldlocationIds) && count($oldlocationIds)>0){
			$locationIdsToRemove=array_diff($oldlocationIds, $locationsToCreate);
			$locationsToCreate=array_diff($locationsToCreate,$oldlocationIds);
			if(!empty($locationIdsToRemove) && count($locationIdsToRemove)>0){
				$this->internalDB->query("DELETE FROM v_service_location where  vservice_id =$vServiceId  
					and  location_id in (".implode(',',$locationIdsToRemove.")"));

			}
		}
		if(!empty($locationsToCreate) && count($locationsToCreate)>0){
			foreach ($locationsToCreate as $locationId) {

				$updateObject[]=array(
					"location_id"=>$locationId,"vservice_id"=>$vServiceId
					);
			}
			if($updateObject!=array())
				$this->internalDB->insert('v_service_location',$updateObject);
		}
	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>