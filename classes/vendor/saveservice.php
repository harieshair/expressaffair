<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	if(!empty($entity['serviceid'])){

		$duplicate=$this->internalDB->queryFirstRow("select id from vendor_services where  title='".$entity['title']."' AND vendor_id !="
			.$entity['vendor_id']." AND id!=".$entity['serviceid']);
		if(!empty($duplicate))
			return array("Exception"=>"Specified service title already exists" );

		isset($entity['title'])?$updateObject['title']=$entity['title']:'';
		isset($entity['selectedevent'])?$updateObject['events']=implode(',',$entity['selectedevent']):'';
		isset($entity['selectedzone'])?$updateObject['zones']=implode(',',$entity['selectedzone']):''; 
		isset($entity['selectedlocation'])?$updateObject['locations']=implode(',',$entity['selectedlocation']):''; 
		isset($entity['selectedstate'])?$updateObject['states']=implode(',',$entity['selectedstate']):''; 
		$this->internalDB->update('vendor_services',$updateObject,"id=%i",$entity['serviceid']);
		return array('Id'=>$entity['serviceid'] );	
	}
	else{

		$duplicate=$this->internalDB->queryFirstRow("select id from vendor_services where  title='".$entity['title']."' AND vendor_id !="
			.$entity['vendorid']);
		if(!empty($duplicate))
			return array('Exception'=>"Specified service title already exists" );

		isset($entity['title'])?$updateObject['title']=$entity['title']:'';
		isset($entity['selectedevent'])?$updateObject['services']=implode(',',$entity['selectedevent']):'';
		isset($entity['selectedzone'])?$updateObject['zones']=implode(',',$entity['selectedzone']):''; 
		isset($entity['selectedlocation'])?$updateObject['locations']=implode(',',$entity['selectedlocation']):''; 
		isset($entity['selectedstate'])?$updateObject['states']=implode(',',$entity['selectedstate']):''; 
		isset($entity['vendorid'])?$updateObject['vendorid']=$entity['vendorid']:'';	
		$updateObject['created_on']=$today;
		$updateObject['is_deleted']=0;
		$this->internalDB->insert('vendor_services',$updateObject);
		return array('Id'=>$this->internalDB->insertId() );

	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>