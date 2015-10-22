<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
session_start();
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/customer.php");
$customer = new customerclass($dbconnection->dbconnector);

switch($_POST['action']){
	/*--------------------------------------------------------------*/
	case "savecustomer":
	if(!empty($_POST['signupdetails'])){
		$params = array();
		parse_str($_POST['signupdetails'], $params);
		$response=$customer->saveCustomer($params);
		if(empty($response['Exception']) && !empty($response['Id'])){
			$_SESSION['CUSTOMERID']= $response['Id'];	
				$_SESSION['start'] = time(); // taking now logged in time
				$_SESSION['expire'] = $_SESSION['start'] + (1*60) ;
				echo 1;	
			}
			else echo 0;
		}
		else{
			echo 0;
		}
		break;

		case "isemailavailable":
		if(!empty($_POST['username'])){
			$response=$customer->IsEmailExists($_POST['username']);
			echo ($response)?1:0;		
		}
		else{
			echo 0;
		}
		break;

		case "getintoaccount":
		if(!empty($_POST['logindetails'])){
			$params = array();
			parse_str($_POST['logindetails'], $params);
			if(empty($params['email']) || empty($params['password']))
			{
				echo 0;
				return;
			}
			$response=$customer->getCustomerId($params['email'],$params['password']);
			if(!empty($response)){
				$_SESSION['CUSTOMERID']= $response;	
				$_SESSION['start'] = time(); // taking now logged in time
				$_SESSION['expire'] = $_SESSION['start'] + (1*60) ;
				echo 1;	
				break;
			}
			echo 0;		
		}
		else{
			echo 0;
		}
		break;
	}