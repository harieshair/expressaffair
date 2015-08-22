<?php 
	//Update part
	$updateObject=array();
	if(!empty($entity['selectedstate']) && count($entity['selectedstate'])>0)
	{
		$existingstate=$this->internalDB->queryFirstColumn("SELECT state_id FROM community_locations WHERE  community_id=$communityId " 
			."  AND state_id in (".implode(',',$entity['selectedstate']).")");
		$existingstate=empty($existingstate)?array():$existingstate;
		if(count($existingstate)>0)
		{
			/* delete uselected state */		
			$deletedstate = array_diff($existingstate, $entity['selectedstate']);
			if(!empty($deletedstate) && count($deletedstate)>0)
			{
				$this->internalDB->query("DELETE FROM community_locations WHERE  community_id=$communityId " 
					." AND state_id in (".implode(',',$deletedstate).")");
			}
		}
		/* state Ids to add */
		$statestoadd = array_diff($entity['selectedstate'],$existingstate);
		if(!empty($statestoadd) && count($statestoadd)>0)
		{
			foreach($statestoadd as $state){
				$updateObject[]=array(
					"state_id"=>$state,
					"zone_id"=>null,
					"community_id"=>$communityId
					);
			}
		}
	}
	else{
		$this->internalDB->query("DELETE FROM community_locations WHERE  community_id=$communityId AND state_id IS NOT NULL");
	}
	/* update community zone */

	if(!empty($entity['selectedzone']) && count($entity['selectedzone'])>0)
	{
		$existingzone=$this->internalDB->queryFirstColumn("SELECT zone_id FROM community_locations WHERE  community_id=$communityId " 
			."  AND zone_id in (".implode(',',$entity['selectedzone']).")");
		$existingzone=empty($existingzone)?array():$existingzone;
		if(count($existingzone)>0)
		{
			/* delete uselected state */		
			$deletedzone = array_diff($existingzone, $entity['selectedzone']);
			if(!empty($deletedzone) && count($deletedzone)>0)
			{
				$this->internalDB->query("DELETE FROM community_locations WHERE  community_id=$communityId " 
					." AND zone_id in (".implode(',',$deletedzone).")");
			}
		}
		/* state Ids to add */
		$zonestoadd = array_diff($entity['selectedzone'],$existingzone);
		if(!empty($zonestoadd) && count($zonestoadd)>0)
		{
			foreach($zonestoadd as $zone){
				$updateObject[]=array(
					"state_id"=>null,
					"zone_id"=>$zone,
					"community_id"=>$communityId
					);
			}
		}
	}
	else{
		$this->internalDB->query("DELETE FROM community_locations WHERE community_id=$communityId AND zone_id IS NOT NULL");
	}
	
	if(count($updateObject)>0)	{
		$this->internalDB->insert('community_locations',$updateObject);
	}	
?>