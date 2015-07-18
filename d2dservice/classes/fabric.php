<?php
	include_once(CLASSFOLDER."/dbconnection.php");
	$dbconnect=null;
	class FabricClass extends dbconnection {
		public $typeofuser;
		public $userstatus;


		function FabricClass($) // Constructor 
		{
			parent::__construct();	
		}

		function SaveOrder($data)
		{
			$returnvalue=include_once("fabric/saveorder.php");
			return $returnvalue;
		}
		function SaveYarnRequirements($data,$orderId)
		{	

			$returnvalue=include_once("fabric/saveyarn.php");
			return $returnvalue;		
		}
		function SaveSizeRequirements($data)
		{			
		}
		function SaveOtherAccessories($data)
		{			
		}

	}
?>