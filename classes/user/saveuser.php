<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
try{
	if(!empty($entity['user_id'])){

		$duplicate=$this->internalDB->queryFirstRow("select * from users where  login_name='".$entity['login_name']."' AND id!=".$entity['user_id']);
		if(!empty($duplicate))
			return array("Exception"=>"Specified login name already exists" );

		$oldEntity=$this->internalDB->queryFirstRow("select * from users where id=".$entity['user_id']);

		$updateObject['version']=++$oldEntity['version'];
		isset($entity['email'])?$updateObject['email']=$entity['email']:'';
		isset($entity['phone'])?$updateObject['phone']=$entity['phone']:''; 
		isset($entity['usertype'])?$updateObject['usertype']=$entity['usertype']:'';
		isset($entity['name'])?$updateObject['name']=$entity['name']:'';
		isset($entity['status'])?$updateObject['status']=$entity['status']:'';
		isset($entity['employeeid'])?$updateObject['employeeid']=$entity['employeeid']:''; 
		$updateObject['updated_on']=$today;
		isset($entity['photo'])?$updateObject['photo']=$entity['photo']:'';
		$this->internalDB->update('users',$updateObject,"id=%i",$entity['user_id']);
		return array('Id'=>$entity['user_id'] );	
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
		$updateObject['updated_on']=$today;
		isset($entity['photo'])?$updateObject['photo']=$entity['photo']:'';
		$this->internalDB->insert('users',$updateObject);
		return array('Id'=>$this->internalDB->insertId() );

	}
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );

}
?>