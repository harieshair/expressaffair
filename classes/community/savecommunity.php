<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	if(!empty($entity['communityid'])){

		$duplicate=$this->internalDB->queryFirstRow("SELECT id FROM events WHERE  name='".$entity['name']."' AND id!=".$entity['communityid']);
		if(!empty($duplicate))
			return array("Exception"=>"Specified community already exists" );

		isset($entity['name'])?$updateObject['name']=$entity['name']:'';
		$this->internalDB->update('communities',$updateObject,"id=%i",$entity['communityid']);
		$communityId=$entity['communityid'];

	}
	else{

		$duplicate=$this->internalDB->queryFirstRow("SELECT id FROM communities WHERE  name='".$entity['name']."'");
		if(!empty($duplicate))
			return array('Exception'=>"Specified community already exists" );		

		isset($entity['name'])?$updateObject['name']=$entity['name']:'';
		$updateObject['created_on']=$today;
		$updateObject['is_deleted']=0;
		$this->internalDB->insert('communities',$updateObject);
		$communityId=$this->internalDB->insertId() ;
		
	}
	include 'updatecommunitylocation.php';	
	include CLASSFOLDER."/events/savecommunityevents.php";
	

	return array('Id'=>$communityId);
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>