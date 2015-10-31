<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	if(!empty($entity['contactid'])){

		$duplicate=$this->internalDB->queryFirstRow("select id from contacts where  entity_type =".$this->EntityType->getkey("Vendor")
			." AND title='".$entity['title']."' AND id!=".$entity['contactid']);
		if(!empty($duplicate))
			return array("Exception"=>"Specified Contact title already exists" );

		isset($entity['contactperson'])?$updateObject['contactperson']=$entity['contactperson']:'';
		isset($entity['title'])?$updateObject['title']=$entity['title']:'';
		isset($entity['contactnumber1'])?$updateObject['contactnumber1']=$entity['contactnumber1']:'';	
		isset($entity['contactnumber2'])?$updateObject['contactnumber2']=$entity['contactnumber2']:'';	
		isset($entity['officenumber'])?$updateObject['officenumber']=$entity['officenumber']:'';		
		isset($entity['address1'])?$updateObject['address1']=$entity['address1']:'';
		isset($entity['address2'])?$updateObject['address2']=$entity['address2']:'';		
		isset($entity['city'])?$updateObject['city']=$entity['city']:'';
		isset($entity['state'])?$updateObject['state']=$entity['state']:'';
		isset($entity['pincode'])?$updateObject['pincode']=$entity['pincode']:'';
		$this->internalDB->update('contacts',$updateObject,"id=%i",$entity['contactid']);
		return array('Id'=>$entity['contactid'] );	
	}
	else{

		$duplicate=$this->internalDB->queryFirstRow("SELECT id FROM contacts WHERE  entity_type =".$this->EntityType->getkey("Vendor")
			." AND title='".$entity['title']."' ");
		if(!empty($duplicate))
			return array('Exception'=>"Specified Contact title already exists" );

		isset($entity['contactperson'])?$updateObject['contactperson']=$entity['contactperson']:'';
		isset($entity['title'])?$updateObject['title']=$entity['title']:'';
		isset($entity['vendorid'])?$updateObject['entityid']=$entity['vendorid']:''; 
		$updateObject['entity_type']=$this->EntityType->getkey("Vendor"); 
		isset($entity['contactnumber1'])?$updateObject['contactnumber1']=$entity['contactnumber1']:'';
		isset($entity['contactnumber2'])?$updateObject['contactnumber2']=$entity['contactnumber2']:'';
		isset($entity['officenumber'])?$updateObject['officenumber']=$entity['officenumber']:'';		
		isset($entity['address1'])?$updateObject['address1']=$entity['address1']:'';
		isset($entity['address2'])?$updateObject['address2']=$entity['address2']:'';
		isset($entity['city'])?$updateObject['city']=$entity['city']:'';
		isset($entity['state'])?$updateObject['state']=$entity['state']:'';
		isset($entity['pincode'])?$updateObject['pincode']=$entity['pincode']:'';
		$updateObject['created_on']=$today;
		$updateObject['is_deleted']=0;
		$this->internalDB->insert('contacts',$updateObject);
		return array('Id'=>$this->internalDB->insertId() );

	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>