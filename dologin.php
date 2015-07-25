<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/d2dconfig.php");
include_once(CLASSFOLDER."/user.php");
include_once(CLASSFOLDER."/common.php");
$user=new userclass();
$loginname=htmlspecialchars($_POST['username'],ENT_QUOTES);
$password=$_POST['password'];
$passwordencoded=md5($password);
$adminuser_id='';
$result = $user->GetLoginDetails($loginname,$passwordencoded);
$adminuser_id=$result['id'];
$adminusername=$result['name'];		
			//if username exists
if(!empty($adminuser_id))
{
				//now set the session from here if needed
	$_SESSION['ADMINUSERID']= $adminuser_id;
	$_SESSION['ADMINUSERNAME']= $adminusername; 			
				$_SESSION['start'] = time(); // taking now logged in time
				$_SESSION['expire'] = $_SESSION['start'] + (18* 60) ;
				$user->createlog("User $adminusername Logged In");
				updateloginlog($adminuser_id,$user,commonclass::GetIP());
				echo 'yes';	
			}
			else
			{ 
				$_SESSION['ADMINUSERID']= '';
				$_SESSION['ADMINUSERNAME'] = '';			
				echo "<span class=\"label label-important\">Username / Password incorrect !</span>"; 
			}


			function updateloginlog($adminuser_id,$user,$ip)
			{
				$loginTime = date('Y-m-d H:i:s');;
				$sql_update_login = "update users set lastlogin = '$loginTime',lastloginip='$ip' where id = $adminuser_id";
				$updatevalue= $user->internalDB->query($sql_update_login);
				return $updatevalue;
			}
			?>
