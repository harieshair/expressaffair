	<?php
	class ritualclass{	
		public $internalDB;		
	function ritualclass($db) // Constructor 
	{
		$this->internalDB=$db;
	}
	/* -----------------------------------------------------------------------------*/
	function updateRitual($entity,$serviceIds)
	{
		$response =include 'events/saverituals.php'	;	
		return $response;
	}

	function saveRitualServices($ritualId,$services){
		$returnvalue=include 'events/saveritualservices.php';
		return $returnvalue;
	}

	function getallRitualLists($pages,$rows,$searchobj){
		$searchobj=($searchobj!=null)?json_decode($searchobj):null;
		$returnvalue=include 'events/getallrituals.php';
		return $returnvalue;
	}
	
	function getTotalRituals($obj)
	{
		$searchobj=($obj!=null)?json_decode($obj):null;
		$returnvalue=include 'events/gettotalrituals.php';
		return $returnvalue;
	}
	function getRitualById($ritualId){
		$ritualdata= $this->internalDB->queryFirstRow("SELECT * FROM rituals where id=$ritualId");
		return $ritualdata;
	}
	function archiveritual(){

	}
	function deleteritual(){

	}	
	function getAllRitualNames(){
		$returnvalue=include 'events/getallritualnames.php';
		return $returnvalue;		
	}
	function updateRitualMenu(){
		include 'events/updateritualmenu.php';		
	}

	function GetAllServicesByRitualId($ritualId){
		$returnvalue=include 'events/getallservicesbyritualid.php';
		return $returnvalue;
	}
}