	<?php
	include_once(CLASSFOLDER."/dbconnection.php");	
	$dbconnect=null;
	class communityclass extends dbconnection {		
	function communityclass() // Constructor 
	{
		parent::__construct();
	}
	/* -----------------------------------------------------------------------------*/
	function updatecommunity($entity,$eventids)
	{
		$response =include 'community/savecommunity.php'	;	
		return $response;
	}
	/*---------------------------------------------------------------*/
	function getallcommunityLists($pages,$rows,$searchobj){
		$searchobj=($searchobj!=null)?json_decode($searchobj):null;
		$returnvalue=include 'community/getallcommunities.php';
		return $returnvalue;

	}
	function getcommunitybyid($communityid){
		$eventdata= $this->internalDB->queryFirstRow("SELECT * FROM communities where id=$communityid");
	return $eventdata;

	}
	function archivecommunity(){

	}
	function deletecommunity(){

	}
	function getTotalCommunities($searchobj){
		$searchobj=($searchobj!=null)?json_decode($searchobj):null;
		$returnvalue=include 'community/gettotalcommunities.php';
		return $returnvalue;
	}
	
}