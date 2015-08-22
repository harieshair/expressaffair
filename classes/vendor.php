	<?php
	include_once(CLASSFOLDER."/dbconnection.php");	
	include_once(CLASSFOLDER."/enums.php");
	$dbconnect=null;
	class vendorclass extends dbconnection {		
	function vendorclass() // Constructor 
	{
		parent::__construct();
		$this->EntityType=new EntityType;
	}
	/* -----------------------------------------------------------------------------*/
	function updatevendorbasics($entity)
	{
		$response =include 'vendor/updatevendorbasics.php'	;	
		return $response;
	}
	function updatevendorcontacts($entity)
	{
		$response =include 'vendor/savevendorcontacts.php'	;	
		return $response;
	}
	function updatevendorportfolios($entity)
	{
		$response =include 'vendor/savevendorportfolio.php'	;	
		return $response;
	}
	function updatevendorservices($entity)
	{
		$response =include 'vendor/saveservice.php'	;	
		return $response;
	}
	function updatevendorattachments($entity)
	{
		$entity['entity_type']=$this->EntityType->getkey("Vendor");
		$response =include CLASSFOLDER.'attachment/saveattachment.php';	
		return $response;
	}
	function updatevendorservice($entity)
	{		
		$response =include 'vendor/saveservice.php';	
		return $response;
	}
	function getallvendorlists($pages,$rows,$searchobj){
		$searchobj=($searchobj!=null)?json_decode($searchobj):null;
		$returnvalue=include 'vendor/getallvendors.php';
		return $returnvalue;
	}	
	function getTotalVendors($obj)
	{
		$searchobj=($obj!=null)?json_decode($obj):null;
		$returnvalue=include 'vendor/gettotalvendors.php';
		return $returnvalue;
	}
	function getvendorbyid($vendorid){
		return $this->internalDB->queryFirstRow("SELECT * FROM vendor where id=$vendorid");
		
	}
	/*---------------------------------------------------------------*/
	function getallvendorcontactsbyvendorid($vendorid){
		$response =include 'vendor/getallvendorcontacts.php'	;	
		return $response;
	}

	function getcontactsbyid($contactid){
		return $this->internalDB->queryFirstRow("SELECT * FROM contacts WHERE title IS NOT NULL AND id=$contactid");	
	}
	function getallvendorportfolio($vendorid){
		$response =include 'vendor/getallportfolios.php'	;	
		return $response;
	}
	function getportfoliobyid($portfolioid){
		return $this->internalDB->queryFirstRow("SELECT * FROM portfolios WHERE id=$portfolioid");		
	}
	function getallvendorservices($vendorid){
		return $this->internalDB->query("SELECT * FROM vendor_services WHERE vendor_id=$vendorid");	
	}
	function getvendorservicebyid($serviceid){
		return $this->internalDB->queryFirstRow("SELECT * FROM vendor_services WHERE id=$serviceid");		
	}
}