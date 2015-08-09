<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	if(!empty($entity['communityid'])){

		$duplicate=$this->internalDB->queryFirstRow("select id from events where  name='".$entity['name']."' AND id!=".$entity['communityid']);
		if(!empty($duplicate))
			return array("Exception"=>"Specified community already exists" );


		isset($entity['name'])?$updateObject['name']=$entity['name']:'';
		isset($entity['zone'])?$updateObject['zone_id']=$entity['zone']:''; 
		isset($entity['state'])?$updateObject['state_id']=$entity['state']:'';
		$this->internalDB->update('communities',$updateObject,"id=%i",$entity['communityid']);
		return array('Id'=>$entity['communityid'] );	
	}
	else{

		$duplicate=$this->internalDB->queryFirstRow("select id from communities where  name='".$entity['name']."'");
		if(!empty($duplicate))
			return array('Exception'=>"Specified community already exists" );		
		
		isset($entity['name'])?$updateObject['name']=$entity['name']:'';
		isset($entity['zone'])?$updateObject['zone_id']=$entity['zone']:''; 
		isset($entity['state'])?$updateObject['state_id']=$entity['state']:'';
		$updateObject['created_on']=$today;
		$updateObject['is_deleted']=0;
		$this->internalDB->insert('communities',$updateObject);
		return array('Id'=>$this->internalDB->insertId() );

	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>