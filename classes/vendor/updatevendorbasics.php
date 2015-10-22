<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	if(!empty($entity['vendorid'])){

		$duplicate=$this->internalDB->queryFirstRow("select id from vendor where  name='".$entity['name']."' AND id!=".$entity['vendorid']);
		if(!empty($duplicate))
			return array("Exception"=>"Specified vendor name already exists" );


		isset($entity['name'])?$updateObject['name']=$entity['name']:'';
		isset($entity['email'])?$updateObject['email']=$entity['email']:''; 
		isset($entity['title'])?$updateObject['title']=$entity['title']:''; 
		isset($entity['location'])?$updateObject['location']=$entity['location']:'';
		isset($entity['startedyear'])?$updateObject['startedyear']=$entity['startedyear']:'';
		isset($entity['leadby'])?$updateObject['leadby']=$entity['leadby']:'';		
		$this->internalDB->update('vendor',$updateObject,"id=%i",$entity['vendorid']);
		return array('Id'=>$entity['vendorid']);	
	}
	else{

		$duplicate=$this->internalDB->queryFirstRow("select id from vendor where  name='".$entity['name']."'");
		if(!empty($duplicate))
			return array('Exception'=>"Specified vendor name already exists" );

		isset($entity['name'])?$updateObject['name']=$entity['name']:'';
		isset($entity['email'])?$updateObject['email']=$entity['email']:''; 
		isset($entity['title'])?$updateObject['title']=$entity['title']:''; 
		isset($entity['location'])?$updateObject['location']=$entity['location']:'';
		isset($entity['startedyear'])?$updateObject['startedyear']=$entity['startedyear']:'';
		isset($entity['leadby'])?$updateObject['leadby']=$entity['leadby']:'';		
		$updateObject['created_on']=$today;
		$updateObject['is_deleted']=0;
		$this->internalDB->insert('vendor',$updateObject);
		return array('Id'=>$this->internalDB->insertId() );

	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>