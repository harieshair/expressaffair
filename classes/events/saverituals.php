<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	if(!empty($entity['ritualid'])){

		$duplicate=$this->internalDB->queryFirstRow("select id from rituals where  title='".$entity['title']."' AND id!=".$entity['ritualid']);
		if(!empty($duplicate))
			return array("Exception"=>"Specified Contact title already exists" );

		isset($entity['description'])?$updateObject['description']=$entity['description']:'';
		isset($entity['title'])?$updateObject['title']=$entity['title']:'';	
		isset($serviceIds)?$updateObject['services']=$serviceIds:'';		
		$this->internalDB->update('rituals',$updateObject,"id=%i",$entity['ritualid']);

		//Save rituals services
		!empty($serviceIds)?$this->saveRitualServices($entity['ritualid'],$serviceIds):'';

		//Update pulic ritual menu
		$this->updateRitualMenu();
		return array('Id'=>$entity['ritualid'] );	
	}
	else{

		$duplicate=$this->internalDB->queryFirstRow("SELECT id FROM rituals WHERE  title='".$entity['title']."' ");
		if(!empty($duplicate))
			return array('Exception'=>"Specified ritual already exists" );

		isset($entity['description'])?$updateObject['description']=$entity['description']:'';
		isset($entity['title'])?$updateObject['title']=$entity['title']:'';	
		isset($serviceIds)?$updateObject['services']=$serviceIds:'';		
		$updateObject['created_on']=$today;
		$updateObject['is_deleted']=0;
		$this->internalDB->insert('rituals',$updateObject);		
		$entity['entity_id']=$this->internalDB->insertId();

		//Save rituals services
		!empty($serviceIds)?$this->saveRitualServices($entity['entity_id'],$serviceIds):'';

		//Update pulic ritual menu
		$this->updateRitualMenu();

		return array('Id'=>$this->internalDB->insertId() );

	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>