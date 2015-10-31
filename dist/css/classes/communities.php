	<?php
	class communityclass  {	
	public $internalDB;		
	function communityclass($db) // Constructor 
	{
		$this->internalDB=$db;
		//$this->EventVisibility=new EventVisibilityType;
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
	function getAllCommunityNames(){
		$communitynames=array();
		$resultset= $this->internalDB->query("SELECT id,name FROM communities" );
		foreach ($resultset as $row) {
			$communitynames[$row['id']]=$row['name'];
		}
		return $communitynames;
	}
	function getTotalCommunities($searchobj){
		$searchobj=($searchobj!=null)?json_decode($searchobj):null;
		$returnvalue=include 'community/gettotalcommunities.php';
		return $returnvalue;
	}
	
	function getSelectedState($communityid){
			$selectedState= $this->internalDB->queryFirstColumn("SELECT state_id FROM community_locations where community_id=$communityid");
	return $selectedState;
	}		
	function getSelectedZone($communityid){
			$selectedZone= $this->internalDB->queryFirstColumn("SELECT zone_id FROM community_locations where community_id=$communityid");
	return $selectedZone;
	}
}