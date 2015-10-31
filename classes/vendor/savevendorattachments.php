<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	if(!empty($entity['primarykey'])){

		$oldEntity=$this->internalDB->queryFirstRow("SELECT * FROM vendor_attachments WHERE id=".$entity['primarykey']);
		$entity['attachment_id']=$oldEntity['attachment_id'];
		$entity['entity_id']=$oldEntity['vendor_id'];
		$response=$this->saveattachments($entity,"Vendor");
		$updateObject['attachment_id']=$response["Id"];
		isset($entity['selectedservice'])?$updateObject['services']=implode(',',$entity['selectedservice']):'';
		isset($entity['description'])?$updateObject['description']=$entity['description']:'';
		$this->internalDB->update('vendor_attachments',$updateObject,"id=%i",$entity['primarykey']);
		return array('Id'=>$entity['primarykey'] );	
	}
	else{
		$entity['entity_id']=$entity['vendor_id'];
		$response=$this->saveattachments($entity,"Vendor");
		$updateObject['attachment_id']=$response["Id"];
		isset($entity['selectedservice'])?$updateObject['services']=implode(',',$entity['selectedservice']):'';
		isset($entity['vendor_id'])?$updateObject['vendor_id']=$entity['vendor_id']:'';
		isset($entity['description'])?$updateObject['description']=$entity['description']:'';
		$updateObject['created_on']=$today;
		$updateObject['is_deleted']=0;
		$this->internalDB->insert('vendor_attachments',$updateObject);
		return array('Id'=>$this->internalDB->insertId() );

	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>