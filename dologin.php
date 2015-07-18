<?php
session_start();
/*if($user->IsValidTenant())
{

	$loginname=htmlspecialchars($_POST['username'],ENT_QUOTES);
	$password=$_POST['password'];
	$isAmsLogin=$_POST['is_ams_login'];
	if(!$isAmsLogin){
		$passwordencoded=md5($password);
		$adminuser_id='';
		$result = $user->GetLoginDetails($loginname,$passwordencoded);
		$adminuser_id=$result['id'];
		$adminusername=$result['name'];
		$adminuseremail=$result['email'];
		$adminusertype=$result['usertype'];

		//if username exists
		if($adminuser_id!="")
		{
			//now set the session from here if needed
			$_SESSION['hpadminuserid']= $adminuser_id;
			$_SESSION['hpadminuseruname']= $adminusername; 
			$_SESSION['hpadminuseremail'] = $adminuseremail;
			$_SESSION['hpadminusertype']=$adminusertype;
			$_SESSION['hpadminroleaccess']=$user->getlistAccesstoPagefromUserRole($adminusertype);
			$_SESSION['hpadminpassword']=$passwordencoded;
			$_SESSION['hpadminloginstatus']="HPAdminLoggedIn";
			$_SESSION['MicrositeAlias']=$alias;
			$_SESSION['start'] = time(); // taking now logged in time
			$_SESSION['expire'] = $_SESSION['start'] + (18* 60) ;

			$user->createlog("User $adminusername Logged In");
			updateloginlog($adminuser_id,$user,commonclass::GetIP());
			//include_once(CLASSFOLDER."/catalogs.php"); 
	//		$catalog=new  catalogclass($alias);
	//		$catalog->saveCatalogValuesIntoCache();
			echo 'yes';	
		}
		else
		{ 
			$_SESSION['hpadminuserid']= '';
			$_SESSION['hpadminuseruname'] = '';
			$_SESSION['hpadminuseremail'] = '';
			$_SESSION['hpadminpassword']='';
			$_SESSION['hpadminusertype']='';
			$_SESSION['hpadminloginstatus']="LoggedOut";
			echo "<span class=\"label label-important\">Username / Password incorrect !</span>"; 
		}
	}
	else{
		include_once("doAmsLogin.php");
	}
}
else
{
	echo "<span class=\"label label-important\">Client does not exist (or) service stopped! </span>"; 
}


	function updateloginlog($adminuser_id,$user,$ip)
	{
		$loginTime = date('Y-m-d H:i:s');;
		$sql_update_login = "update users set lastlogin = '$loginTime',lastloginip='$ip' where id = $adminuser_id";
		$updatevalue= $user->internalDB->query($sql_update_login);
		return $updatevalue;
		}

		*/
		echo 'yes';	
?>