<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
session_start();
include_once(CLASSFOLDER."/vendor.php");
$vendor = new vendorclass();
switch($_POST['action'])
{
/*--------------------------------------------------------*/
case "savevendor":
	if(isset($_POST['vendordetails'])){

		parse_str($_POST['vendordetails'], $data);
		$vendorId=$vendor->savevendor($data);
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
}
?>