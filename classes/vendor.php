	<?php
	include_once(CLASSFOLDER."/dbconnection.php");	
	$dbconnect=null;
	class vendorclass extends dbconnection {		
	function vendorclass() // Constructor 
	{
		parent::__construct();
	}
	/* -----------------------------------------------------------------------------*/
	function createvendor($vendordetails)
	{
		$response=array();		
		$oldRoleId=$this->internalDB->queryFirstField("SELECT id FROM roles where name ='$roleName'");		
		if($oldRoleId==null){
			$this->internalDB->insert('roles',array(
				'name'=>$roleName));
			$response['id']=$this->internalDB->insertId();
			return $response;
		}
		else{
			 $response['Exception']='Specified role name already exists';
			 return $response;
			}
	}
	/*---------------------------------------------------------------*/
	function showallvendor(){

	}
}