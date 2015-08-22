<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
  if(!empty($entity['attachmentid'])){    
    isset($entity['file_type'])?$updateObject['file_type']=$entity['file_type']:'';
     isset($entity['file_name'])?$updateObject['file_name']=$entity['file_name']:'';
    isset($entity['file_path'])?$updateObject['file_path']=$entity['file_path']:'';
    isset($entity['extension'])?$updateObject['extension']=$entity['extension']:''; 
    $this->internalDB->update('attachments',$updateObject,"id=%i",$entity['attachmentid']);
    return array('Id'=>$entity['attachmentid'] );  
  }
  else{
    isset($entity['entity_id'])?$updateObject['entity_id']=$entity['entity_id']:'';
    isset($entity['file_type'])?$updateObject['file_type']=$entity['file_type']:'';
    isset($entity['entity_type'])?$updateObject['entity_type']=$entity['entity_type']:''; 
     isset($entity['file_name'])?$updateObject['file_name']=$entity['file_name']:'';
    isset($entity['file_path'])?$updateObject['file_path']=$entity['file_path']:'';
    isset($entity['extension'])?$updateObject['extension']=$entity['extension']:''; 
     $updateObject['created_on']=$today;
     $updateObject['created_by']=1;
    $updateObject['is_deleted']=0;
    $this->internalDB->insert('attachments',$updateObject);
    return array('Id'=>$this->internalDB->insertId() );

  }
}
catch(Exception $ex){
  return array('Exception'=>$ex->getMessage() );

}
?>