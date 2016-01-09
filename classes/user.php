<?php
include_once(CLASSFOLDER."/enums/userenums.php");
class userclass{
public $internalDB;	
function userclass($db) // Constructor 
{
	$this->internalDB=$db;
	$this->TypeOfUser=new TypeOfUser;
	$this->UserStatus=new UserStatus;	
}

function GetLoginDetails($uname,$pwd)
{
	$resultSet= $this->internalDB->queryFirstRow("SELECT * FROM users WHERE login_name='$uname' AND password='$pwd' AND status=0");
	return $resultSet;
}

function CheckAccesstoPage($useractionarray,$pageid)
{
	if(in_array('26',$useractionarray))
		{ $val=true;	}
	else
	{ 
		if(in_array($pageid,$useractionarray))
			{ $val=true;		}
		else
			{  $val=false;	}
	}
	return $val;
}
function saveUser($entity){
	$response =include 'user/saveuser.php'	;	
	return $response;

}

function saveroles($roleids,$userid){

	$oldroles= $this->internalDB->queryFirstColumn("select role_id from user_role where user_id=$userid");
	if(!empty($roleids)){
		$removedroles = array_diff($oldroles, $roleids);
		if(!empty($removedroles) && count($removedroles)>0)
			$this->internalDB->query("DELETE  FROM user_role where role_id  in (".implode(',',$removedroles).") AND user_id =$userid");
		$newroles = array_diff($roleids,$oldroles);
		if(!empty($newroles) && count($newroles)>0){
			$updateobject=array();
			foreach ($newroles as $roleid) {
				$updateobject[]=array("role_id"=>$roleid,"user_id"=>$userid);
			}
			$this->internalDB->insert('user_role', $updateobject);
		}
	}
	else{
		$this->internalDB->query("DELETE  FROM user_role where  user_id =$userid");	
	}
}
function showAllUsers($page,$rows,$obj)
{
	$searchobj=($obj!=null)?json_decode($obj):null;
	$response=include 'user/getallusers.php';
	return $response;
}

function getTotalUsers($obj)
{
	$searchobj=($obj!=null)?json_decode($obj):null;
	$response=include 'user/gettotalusers.php';
	return $response;
}


function ShowUserManagementPagination($totcount,$page,$rows)
{
	$response=include 'user/user_pagination.php';
	return $response;	
}



function getuserbyid($userid)
{		
	$resultSet= $this->internalDB->queryFirstRow("SELECT u.id,u.name,u.login_name,u.phone,u.email,u.usertype,u.status,
		u.employeeid,u.password,u.photo_id,u.roles,u.address,u.city,u.state,c.coord_explevel,c.is_third_party FROM users u LEFT JOIN coordinator c ON u.id=c.user_id where u.id=$userid");
	return $resultSet;
}

function getUserTypeNameFromid($id)
{	
	$resultSet= $this->internalDB->queryFirstField("select user_role_name from user_role where user_role_id=$id");
	return $resultSet;
}


function getlistAccesstoPagefromUserRole($userrole)
{
	$resultSet= $internalDB->query("select action_id from role_access where role_id =$userrole ");
	$value='';
	foreach($resultSet as $col)
	{
		$value[]=$col['action_id'];	
	}
	return $value;
}


public function sendCreateUserNotification($mailid,$name,$loginid,$password){
	include_once(CLASSFOLDER.'/rpoconstants.php');
	include_once(CLASSFOLDER.'/sendmail/sendmail.php');
	$response=include "users/notifycreateuser.php";
	return $response;
}



public function sendForgetPasswordNotification($mailid,$username,$password){
	$result=include "users/notifypasswordchange.php";
}
public function getUserAttachments($userid){
	$this->entityType=new EntityType;
	$resultSet= $this->internalDB->queryFirstRow("SELECT * from attachments WHERE entity_id =$userid and entity_type=".$this->entityType->getkey(USER));
	return $resultSet;
}
public function getUserProfilePath($userid){
	$this->entityType=new EntityType;
	$resultSet= $this->internalDB->queryFirstField("SELECT file_path from attachments WHERE entity_id =$userid and entity_type=".$this->entityType->getkey(USER));
	return $resultSet;
}
function saveattachments($entity){
	$this->entityType=new EntityType;
	$entity['entity_type']=$this->entityType->getkey(USER);			

	include_once(CLASSFOLDER."/attachments.php");
	$attachment=new attachmentclass($this->internalDB);
	return $attachment->updateattachments($entity);
}
function removeAttachment($attachmentid){	
	include_once(CLASSFOLDER."/attachments.php");
	$attachment=new attachmentclass($this->internalDB);
	return $attachment->removeAttachment($$attachmentid);	
}
}
?>