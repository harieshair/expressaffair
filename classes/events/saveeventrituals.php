<?php
$updateObject=array();
try{
	if(!empty($rituals)){
		$oldritualIds=$this->internalDB->queryFirstColumn("select ritual_id from e_rituals where  event_id =$eventId ");
		$ritualsToCreate=explode(',',$rituals);
		if(!empty($oldritualIds) && count($oldritualIds)>0){
			$ritualIdsToRemove=array_diff($oldritualIds, $ritualsToCreate);
			$ritualsToCreate=array_diff($ritualsToCreate,$oldritualIds);
			if(!empty($ritualIdToRemove) && count($ritualIdToRemove)>0){
				$this->internalDB->query("DELETE FROM e_rituals where  event_id =$eventId  
					and  ritual_id in (".implode(',',$ritualIdToRemove.")"));

			}
		}
		if(!empty($ritualsToCreate) && count($ritualsToCreate)>0){
			foreach ($ritualsToCreate as $ritualId) {

				$updateObject[]=array(
					"ritual_id"=>$ritualId,"event_id"=>$eventId
					);
			}
			if($updateObject!=array())
				$this->internalDB->insert('e_rituals',$updateObject);
		}
	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>