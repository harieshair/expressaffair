<?php
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/enums.php");
$dbconnect=null;
class userclass extends dbconnection {

/*-------------------------------------------------------------*/
function userclass() // Constructor 
{
	 parent::__construct();
	$this->TypeOfUser=new TypeOfUser;
	$this->UserStatus=new UserStatus;
}
/* -----------------------------------------------------------------------------*/
function GetLoginDetails($uname,$pwd)
{
	$user= $this->internalDB->queryFirstRow("SELECT * FROM users WHERE login_name='$uname' AND password='$pwd' AND status=0");
	return $user;
}
/*----------------------------------------------------------------------------*/
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
	$returnData=include 'user/saveuser.php';

}
/*---------------------------------------------------------------*/
 function showAllUsers($page,$rows,$obj)
{
	$searchobj=($obj!=null)?json_decode($obj):null;
	$returnvalue=include 'user/getallusers.php';
	echo $returnvalue;
}
/*-------------------------------------------ShowUserManagementPagination------------*/

	 function ShowUserManagementPagination($totcount,$page,$rows)
	{
		$returnvalue=include 'user/user_pagination.php';
		return $returnvalue;	
	}
	
	
/*----------------------getuser byId---------------------------*/
	 function getuserbyid($userid)
	{		
		$userdata= $this->internalDB->queryFirstRow("SELECT id,name,login_name,phone,email,usertype,status,
		employeeid,password FROM users where id=$userid");
		return $userdata;
	}
/*----------------------getuser byId---------------------------*/
	 function getUserTypeNameFromid($id)
	{	
		$userdata= $this->internalDB->queryFirstField("select user_role_name from user_role where user_role_id=$id");
		return $userdata;
	}

/*----------------------------------------------------------------------------*/
function getlistAccesstoPagefromUserRole($userrole)
{
	$results= $this->internalDB->query("select action_id from role_access where role_id =$userrole ");
	$value='';
	foreach($results as $col)
	{
		$value[]=$col['action_id'];	
	}
	return $value;
}
/*----------------------------------------------------------------------------*/
public function IsValidTenant()
	{
		return !empty($this->CLIENTID)?true:false;
	}
/*----------------------------------------------------------------------------*/
	public function GetAllInterviewerListToSelectBox()
	{
		$sql=$this->internalDB->query("select id,name from users where usertype =(SELECT user_role_id FROM user_role where user_role_name='Interviewer') and status=1");
		$optionresult='';
		if($sql!='')
		{
			foreach($sql as $interviewers)
			{
				$optionresult.='<option value="'.$interviewers['id'].'">'.$interviewers['name'].'</option>';
			}
		}
		return $optionresult;
		
	}
	

/*----------------------------------------------------------------------------*/
function getTenantIDByAlias($alias)
{
$tenantid=$this->tenantDB->query("SELECT id FROM client where alias='$alias' and is_deleted=0");
return $tenantid;
}
/*----------------------------------------------------------*/
public function sendCreateUserNotification($mailid,$name,$loginid,$password){
	include_once(CLASSFOLDER.'/rpoconstants.php');
	include_once(CLASSFOLDER.'/sendmail/sendmail.php');
	$result=include "users/notifycreateuser.php";
	return $result;
}


/*-------------------------------------------------------------*/
public function sendForgetPasswordNotification($mailid,$username,$password){
	$result=include "users/notifypasswordchange.php";
}

/*----------------------------------------------------------------------------*/
}
?>