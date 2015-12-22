<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	if(!empty($entity['vendorid'])){

		$duplicate=$this->internalDB->queryFirstRow("select id from vendor where  title='".$entity['title']."' AND id!=".$entity['vendorid']);
		if(!empty($duplicate))
			return array("Exception"=>"Specified vendor name already exists" );

		isset($entity['email'])?$updateObject['email']=$entity['email']:''; 
		isset($entity['title'])?$updateObject['title']=$entity['title']:''; 
		isset($entity['contactperson'])?$updateObject['contact_person']=$entity['contactperson']:'';
		isset($entity['contactnumber1'])?$updateObject['contact_number1']=$entity['contactnumber1']:'';	
		isset($entity['contactnumber2'])?$updateObject['contact_number2']=$entity['contactnumber2']:'';	
		isset($entity['address1'])?$updateObject['address1']=$entity['address1']:'';
		isset($entity['address2'])?$updateObject['address2']=$entity['address2']:'';		
		isset($entity['city'])?$updateObject['city']=$entity['city']:'';
		isset($entity['state'])?$updateObject['state']=$entity['state']:'';
		isset($entity['pincode'])?$updateObject['pincode']=$entity['pincode']:'';
		$this->internalDB->update('vendor',$updateObject,"id=%i",$entity['vendorid']);
		return array('Id'=>$entity['vendorid']);	
	}
	else{

		$duplicate=$this->internalDB->queryFirstRow("select id from vendor where  title='".$entity['title']."'");
		if(!empty($duplicate))
			return array('Exception'=>"Specified vendor name already exists" );

		isset($entity['email'])?$updateObject['email']=$entity['email']:''; 
		isset($entity['title'])?$updateObject['title']=$entity['title']:''; 
		isset($entity['contactperson'])?$updateObject['contact_person']=$entity['contactperson']:'';
		isset($entity['contactnumber1'])?$updateObject['contact_number1']=$entity['contactnumber1']:'';	
		isset($entity['contactnumber2'])?$updateObject['contact_number2']=$entity['contactnumber2']:'';	
		isset($entity['address1'])?$updateObject['address1']=$entity['address1']:'';
		isset($entity['address2'])?$updateObject['address2']=$entity['address2']:'';		
		isset($entity['city'])?$updateObject['city']=$entity['city']:'';
		isset($entity['state'])?$updateObject['state']=$entity['state']:'';
		isset($entity['pincode'])?$updateObject['pincode']=$entity['pincode']:'';	
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