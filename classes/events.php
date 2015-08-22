	<?php
	include_once(CLASSFOLDER."/dbconnection.php");	
	$dbconnect=null;
	class eventclass extends dbconnection {		
	function eventclass() // Constructor 
	{
		parent::__construct();
	}
	/* -----------------------------------------------------------------------------*/
	function updateevent($entity)
	{
		$response =include 'events/saveevents.php'	;	
		return $response;
	}
	/*---------------------------------------------------------------*/
	function getalleventlists($pages,$rows,$searchobj){
		$searchobj=($searchobj!=null)?json_decode($searchobj):null;
		$returnvalue=include 'events/getallevents.php';
		return $returnvalue;
	}
	
	function getTotalEvents($obj)
	{
		$searchobj=($obj!=null)?json_decode($obj):null;
		$returnvalue=include 'events/gettotalevents.php';
		return $returnvalue;
	}
	function geteventbyid($eventid){
$eventdata= $this->internalDB->queryFirstRow("SELECT * FROM events where id=$eventid");
	return $eventdata;
	}
	function archiveevent(){

	}
	function deleteevent(){

	}
	function getAllEventNames(){
		$eventnames= $this->internalDB->query("SELECT id,name,icons FROM events" );
	return $eventnames;
	}
	function getSelectedEventByCommunityId($communityId){
		$selectedEventIds= $this->internalDB->queryFirstColumn("SELECT event_id FROM event_visibility WHERE community_id=$communityId group by event_id" );
	return $selectedEventIds;
	}
	
}