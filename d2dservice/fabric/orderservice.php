<?php
include_once($_SERVER['DOCUMENT_ROOT']."/d2dconfig.php");
session_start();
include_once(CLASSFOLDER."/fabric.php");
$fabric = new FabricClass();
if(isset($_SESSION['userdata']))
{
$logroleid=$_SESSION['usertype'];
$loguserid=$_SESSION['userid'];
}
else
{
	$logroleid='';
	$loguserid='';
}

switch($_POST['action'])
{
/*--------------------------------------------------------*/
case "SaveOrder":

	if(isset($_POST['OrderData']){

		$OrderData=$_POST['OrderData'];
		parse_str($OrderData, $data);
		$OrderId=$fabric->SaveOrder($data);
		if(!empty($data['id']))
			$OrderId=$data['id'];
		if($OrderId!=0){
			if(isset($_POST['yarn_details'])){
				parse_str($_POST['yarn_details'], $data);				
				$fabricId=$fabric->SaveYarnRequirements($data,$OrderId);
			}
			if(isset($_POST['size_details'])){
				parse_str($_POST['size_details'], $data);				
				$fabric->SaveSizeRequirements($data,$OrderId);
			}
			if(isset($_POST['accessories_details'])){
				parse_str($_POST['accessories_details'], $data);				
				$fabric->SaveOtherAccessories($data,$OrderId);
			}			
		}
	}

break;
/*-------------------ForgetPassword---------------------*/
case "ForgetPassword":
$emailid=$_POST['usermailid'];
$resultuser=$user->internalDB->queryFirstRow("SELECT id,name,status  FROM users WHERE email='$emailid' ");
if(!empty($resultuser)){
	if($resultuser['status']==0)
		echo "Login credentials disabled, Please contact application administrator.";
	else{
	$newpassword= substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 10 );
	$newpassword_enc= md5($newpassword);
	$user->internalDB->query("UPDATE users SET password='$newpassword_enc' WHERE id=".$resultuser['id']);	
	$user->sendForgetPasswordNotification($emailid,$resultuser['name'],$newpassword);	
	echo 1;
	}
}
else
echo "Given e-mail does not exists";
break;
/*-------------------Check user Emial---------------------*/
case "chkcreateuseremailexists":

$emailid=$_POST['useremail'];
$userid=$_POST['userid'];
$sql_chk="SELECT id FROM users where email='$emailid' ";
$sql_chk.=!empty($userid)?" AND id!='$userid'":'';
$sql_chk1 =$user->internalDB->queryFirstField($sql_chk);
  	if(!empty($sql_chk1))
		echo $sql_chk1; //already exist

	else
		echo "0"; // Not Exists

break;


/*-------------------Create User--------------*/
case "createupdateuser":

$userid=$_POST['userid'];
$userobject=isset($_POST['userobject'])?json_decode($_POST['userobject']):null;
$inviteuser =isset($P_POST['inviteuserbymail'])?true:false;
try{
$rowaffected='';
if($userobject!=null){
//// update user here
$updatedate = date('Y-m-d H:i:s');
	if(!empty($userid)){
		$existinguser=$user->internalDB->queryFirstField("SELECT version FROM users where id=$userid");
		$adminusertable=$user->internalDB->update("users", array(
		"version"=>$existinguser['version']+1,
		"login_name"=>isset($userobject->loginname)?$userobject->loginname:null,
		"name"=>isset($userobject->username)?$userobject->username:null,
		"email"=>isset($userobject->emailid)?$userobject->emailid:null,
		"phone"=>isset($userobject->contactnumber)?$userobject->contactnumber:null,
		"usertype"=>isset($userobject->typeofuser)?$userobject->typeofuser:null,
		"status"=>isset($userobject->userstatus)?$userobject->userstatus:null,
		"employeeid"=>isset($userobject->employeeid)?$userobject->employeeid:null,
		"updated_on"=>$updatedate),"id=%i",$userid);
		$rowaffected = $user->internalDB->affectedRows();
		$user->createlog("Update User Details of $userobject->username");
	}

///// insert user here
	else{
		$password=md5("password@123");
		$adminusertable=$user->internalDB->insert("users", array(
		"version"=>0,
		"login_name"=>isset($userobject->loginname)?$userobject->loginname:null,
		"password"=>$password,
		"name"=>isset($userobject->username)?$userobject->username:null,
		"email"=>isset($userobject->emailid)?$userobject->emailid:null,
		"phone"=>isset($userobject->contactnumber)?$userobject->contactnumber:null,
		"usertype"=>isset($userobject->typeofuser)?$userobject->typeofuser:null,
		"status"=>isset($userobject->userstatus)?$userobject->userstatus:null,
		"employeeid"=>isset($userobject->employeeid)?$userobject->employeeid:null,
		"updated_on"=>$updatedate));
		$rowaffected=$user->internalDB->insertId();
		$user->createlog("Inserted User Details of $userobject->username");
		if($rowaffected!=0 &&  $inviteuser)
			$status=$user->sendCreateUserNotification($userobject->emailid,$userobject->username,$userobject->loginname,"password@123");
		}
}
if($rowaffected>0  )
	echo $rowaffected;
else 
echo '0';
}
catch(Exception $ex)
{
	return $ex->getMessage();
}
break;
/*----------------------Search Users--------------*/
	case "searchusers":
		$searchobject=!empty($_POST['searchCriteria'])?$_POST['searchCriteria']:null;
		$rows=$_POST['rows'];
		$page=$_POST['page'];
		$user->showAllUsers($page,$rows,$searchobject);
	break;
	
	/*---------------------------------*/
	case "setrolepermissions":
	
		$checkedvalues=$_POST['checkedvalues'];
		$roleid=$_POST['roleid'];
		$actionid=explode(",",$checkedvalues);
		$rssql=$user->internalDB->query("delete from role_access where role_id=$roleid ");
		foreach($actionid as $actionlist)
		{
			$user->internalDB->insert('role_access', array(
								'role_id' => $roleid,
								'action_id' => $actionlist 
									));
		}
		$user->createlog("Updated Role Permission for $roleid ");
		echo "<span class=\"label label-success\">Saved Successfully</span>";
	break;
	case 'chkuseremail':

  $emailid = trim($_POST['useremail']);
  $sql_chk1 =$user->internalDB->queryFirstField("SELECT candidate_id FROM candidate where candidate_email='$emailid' ");
  	if($sql_chk1!='')
	{
		echo $sql_chk1; //already exist
	}
	else
	{ 
		echo "0"; //avaliable
	}	
break;
/*---------------------------------*/
case "createnewrole":
$rolename=$_POST['rolename'];
$status=(!empty($rolename))?$user->createNewRole($rolename):"Role Name is missing";
echo $status;
break;	
}
?>