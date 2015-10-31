<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
$savedPath="";
try{

  if(!empty($entity['attachment_id'])){  
    $oldEntity=$this->internalDB->queryFirstRow("SELECT * FROM attachments where id=$attachmentid");
    if($oldEntity['file_name']!=$entity['file_name']){
      $this->removefile($oldEntity['file_path']);
      $savedPath= $this->savefile($entity['file_name'],$entity['$file_type'],$oldEntity['entity_type'],$oldEntity['entity_id']);
    }

    isset($entity['file_type'])?$updateObject['file_type']=$entity['file_type']:'';
    isset($entity['file_name'])?$updateObject['file_name']=$entity['file_name']:'';
    !empty($savedPath)?$updateObject['file_path']=$savedPath:'';
    $updateObject['extension']=$this->getExtensionOfFile($entity['file_name']);
    $this->internalDB->update('attachments',$updateObject,"id=%i",$entity['attachmentid']);
    return array('Id'=>$entity['attachmentid'] );  
  }
  else{
    $savedPath= $this->savefile($entity['file_name'],$entity['file_type'],$entity['entity_type'],$entity['entity_id']);
    isset($entity['entity_id'])?$updateObject['entity_id']=$entity['entity_id']:'';
    isset($entity['file_type'])?$updateObject['file_type']=$entity['file_type']:'';
    isset($entity['entity_type'])?$updateObject['entity_type']=$entity['entity_type']:''; 
    isset($entity['file_name'])?$updateObject['file_name']=$entity['file_name']:'';
    !empty($savedPath)?$updateObject['file_path']=$savedPath:'';
    $updateObject['extension']=$this->getExtensionOfFile($entity['file_name']);
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