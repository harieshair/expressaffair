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
		isset($entity['images'])?$updateObject['images']=$entity['images']:'';
		$this->internalDB->update('events',$updateObject,"id=%i",$entity['eventid']);
		return array('Id'=>$entity['eventid'] );	
	}
	else{

		$duplicate=$this->internalDB->queryFirstRow("select id from events where  name='".$entity['eventname']."'");
		if(!empty($duplicate))
			return array('Exception'=>"Specified event name already exists" );

		
		isset($entity['eventname'])?$updateObject['name']=$entity['eventname']:'';
		isset($entity['description'])?$updateObject['description']=$entity['description']:''; 
		isset($entity['icons'])?$updateObject['icons']=$entity['icons']:'';
		isset($entity['images'])?$updateObject['images']=$entity['images']:'';
		$updateObject['created_on']=$today;
		$updateObject['is_deleted']=0;
		$this->internalDB->insert('events',$updateObject);
		return array('Id'=>$this->internalDB->insertId() );

	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>