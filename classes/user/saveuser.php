<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
$updateCoordinateObj = array();
try{
	$userId="";
	if(!empty($entity['entity_id'])){

		$duplicate=$this->internalDB->queryFirstRow("select * from users where  login_name='".$entity['login_name']."' AND id!=".$entity['entity_id']);
		if(!empty($duplicate))
			return array("Exception"=>"Specified login name already exists" );

		$oldEntity=$this->internalDB->queryFirstRow("select * from users where id=".$entity['entity_id']);

		if(!empty($entity['file_name'])){
			$response=$this->saveattachments($entity);
			$updateObject['photo_id']=$response['Id'];
		}
		else if(!empty($oldEntity['photo_id'])){
			$this->removeAttachment($oldEntity['photo_id']);
			$updateObject['photo_id']=null;
		}

		$updateObject['version']=++$oldEntity['version'];
		isset($entity['email'])?$updateObject['email']=$entity['email']:'';
		isset($entity['phone'])?$updateObject['phone']=$entity['phone']:''; 
		isset($entity['usertype'])?$updateObject['usertype']=$entity['usertype']:'';
		isset($entity['name'])?$updateObject['name']=$entity['name']:'';
		isset($entity['status'])?$updateObject['status']=$entity['status']:'';
		isset($entity['employeeid'])?$updateObject['employeeid']=$entity['employeeid']:''; 
                isset($entity['address'])?$updateObject['address']=$entity['address']:'';
                 isset($entity['city'])?$updateObject['city']=$entity['city']:'';
                 isset($entity['state'])?$updateObject['state']=$entity['state']:'';
		isset($entity['roles'])?$updateObject['roles']=implode(',',$entity['roles']):''; 
		$updateObject['updated_on']=$today;

		$this->internalDB->update('users',$updateObject,"id=%i",$entity['entity_id']);
                
                 if($entity['usertype']=='4') {
                    
                    isset($entity['coord_explevel'])?$updateCoordinateObj['coord_explevel']=$entity['coord_explevel']:'';
                    isset($entity['is_third_party'])?$updateCoordinateObj['is_third_party']=$entity['is_third_party']:'';
                   // $updateCoordinateObj['user_id'] = $userId;
                    $this->internalDB->update('coordinator',$updateCoordinateObj,"user_id=%i",$entity['entity_id']);
                }
                
		$userId= $entity['entity_id'];	
		if(isset($entity['roles']))
			$this->saveRoles($entity['roles'],$userId);

	}
	else{

		$duplicate=$this->internalDB->queryFirstRow("select * from users where  login_name='".$entity['login_name']."'");
		if(!empty($duplicate))
			return array('Exception'=>"Specified login name already exists" );

		$updateObject['version']=1;
		isset($entity['login_name'])?$updateObject['login_name']=$entity['login_name']:'';
		isset($entity['password'])?$updateObject['password']=md5($entity['password']):''; 
		isset($entity['email'])?$updateObject['email']=$entity['email']:'';
		isset($entity['name'])?$updateObject['name']=$entity['name']:'';
		isset($entity['phone'])?$updateObject['phone']=$entity['phone']:''; 
		isset($entity['usertype'])?$updateObject['usertype']=$entity['usertype']:'';
		isset($entity['status'])?$updateObject['status']=$entity['status']:'';
		isset($entity['employeeid'])?$updateObject['employeeid']=$entity['employeeid']:''; 
		isset($entity['roles'])?$updateObject['roles']=implode(',',$entity['roles']):''; 
		$updateObject['updated_on']=$today;
                isset($entity['address'])?$updateObject['address']=$entity['address']:'';
                 isset($entity['city'])?$updateObject['city']=$entity['city']:'';
                 isset($entity['state'])?$updateObject['state']=$entity['state']:'';
		$this->internalDB->insert('users',$updateObject);
               $entity['entity_id']=$userId =$this->internalDB->insertId();
		 
                
                 if($entity['usertype']=='4') {
                    isset($entity['coord_explevel'])?$updateCoordinateObj['coord_explevel']=$entity['coord_explevel']:'';
                    isset($entity['is_third_party'])?$updateCoordinateObj['is_third_party']=$entity['is_third_party']:'';
                    $updateCoordinateObj['user_id'] = $userId;
                    $this->internalDB->insert('coordinator',$updateCoordinateObj);
                }
                
		if(!empty($entity['file_name'])){
			$response=$this->saveattachments($entity);
			$this->internalDB->update('users',array(
				'photo_id'=>$response['Id']
				),"id=%i",$userId);
		}
                if(!empty($entity['roles']))
		$this->saveRoles($entity['roles'],$userId);              
               
                
	}
	return array("Id"=>$userId);
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>