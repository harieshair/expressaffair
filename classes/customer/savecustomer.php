<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	$userId="";
	if(!empty($entity['entity_id'])){

		$duplicate=$this->internalDB->queryFirstRow("select * from customers where  email='".$entity['email']."' AND id!=".$entity['entity_id']);
		if(!empty($duplicate))
			return array("Exception"=>"Specified email already exists" );

		$oldEntity=$this->internalDB->queryFirstRow("select * from customers where id=".$entity['entity_id']);

		if(!empty($entity['file_name'])){
			$this->removeAttachment($oldEntity['photo_id']);
			$response=$this->saveattachments($entity);		
		}

		isset($entity['email'])?$updateObject['email']=$entity['email']:'';
		isset($entity['phone'])?$updateObject['contact_number']=$entity['phone']:''; 
		isset($entity['name'])?$updateObject['name']=$entity['name']:'';
		isset($entity['status'])?$updateObject['status']=$entity['status']:'';
		isset($entity['city'])?$updateObject['city']=$entity['city']:'';
		isset($entity['state'])?$updateObject['state']=$entity['state']:'';
		isset($entity['address'])?$updateObject['address']=$entity['address']:'';
		$updateObject['updated_on']=$today;

		$this->internalDB->update('customers',$updateObject,"id=%i",$entity['entity_id']);
		$customerid= $entity['entity_id'];	
	}
	else{

		$duplicate=$this->internalDB->queryFirstRow("select * from customers where  email='".$entity['email']."'");
		if(!empty($duplicate))
			return array('Exception'=>"Specified login name already exists" );

		isset($entity['email'])?$updateObject['email']=$entity['email']:'';
		isset($entity['signuppassword'])?$updateObject['password']=md5($entity['signuppassword']):''; 
		isset($entity['phone'])?$updateObject['contact_number']=$entity['phone']:''; 
		isset($entity['name'])?$updateObject['name']=$entity['name']:'';
		isset($entity['status'])?$updateObject['status']=$entity['status']:'';
		isset($entity['city'])?$updateObject['city']=$entity['city']:'';
		isset($entity['state'])?$updateObject['state']=$entity['state']:'';
		isset($entity['address'])?$updateObject['address']=$entity['address']:'';
		$updateObject['created_on']=$today;
		$this->internalDB->insert('customers',$updateObject);
		$customerid= $this->internalDB->insertId();
	}
	return array("Id"=>$customerid);
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>