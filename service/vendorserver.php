<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/common.php");
include_once(CLASSFOLDER."/vendor.php");
$vendor = new vendorclass($dbconnection->dbconnector);
switch($_POST['action'])
{
	/*--------------------------------------------------------*/
	case "savevendorbasics":
	if(!empty($_POST['vendordetails'])){
		$params = array();
		parse_str($_POST['vendordetails'], $params);
		$response= $vendor->updatevendorbasics($params);
		if(empty($response["Exception"]))
			$response['Message']="Vendor Profile details updated successfully";		
		echo json_encode($response);
	}
	else{
		$response['Exception']="Please specify valid vendor details";
		echo json_encode($response);
	}
	break;
	/*--------------------------------------------------------*/
	case "savevendorcontacts":
	if(!empty($_POST['contactdetails'])){
		$params = array();
		parse_str($_POST['contactdetails'], $params);
		$response= $vendor->updatevendorcontacts($params);
		if(empty($response["Exception"]))
			$response['Message']="Contacts saved successfully";		
		echo json_encode($response);
	}
	else{
		$response['Exception']="Please specify valid contact details";
		echo json_encode($response);
	}
	break;
	/*--------------------------------------------------------*/
	case "savevendorportfolios":
	if(!empty($_POST['portfoliodetails'])){
		$params = array();
		parse_str($_POST['portfoliodetails'], $params);
		$response= $vendor->updatevendorportfolios($params);
		if(empty($response["Exception"]))
			$response['Message']="Portfolio saved successfully";		
		echo json_encode($response);
	}
	else{
		$response['Exception']="Please specify valid portfolio details";
		echo json_encode($response);
	}
	break;
	case "savevendorservices":
	if(!empty($_POST['servicedetails'])){
		$params = array();
		parse_str($_POST['servicedetails'], $params);
		$response= $vendor->updatevendorservices($params);
		if(empty($response["Exception"]))
			$response['Message']="Service saved successfully";		
		echo json_encode($response);
	}
	else{
		$response['Exception']="Please specify valid service details";
		echo json_encode($response);
	}
	break;
	case "savevendorattachments":
	if(!empty($_POST['attachmentdetails'])){
		$params = array();
		parse_str($_POST['attachmentdetails'], $params);
		$response= $vendor->updatevendorattachments($params);
		if(empty($response["Exception"]))
			$response['Message']="Attachment uploaded successfully";		
		echo json_encode($response);
	}
	else{
		$response['Exception']="Please specify valid attachment details";
		echo json_encode($response);
	}
	break;
	
}
?>