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
        
        function saveRitualServices($ritualid,$services){
		$returnvalue=include 'events/saveritualservices.php';
		return $returnvalue;
	}
        
        function GetAllServicesByRitualsId($ritualId) {
                $eventServices= $this->internalDB->query("SELECT cv.id,cv.catalog_value FROM catalog_value cv inner join r_services es on es.serviceId=cv.id where es.ritualId= $ritualId" );
		return $eventServices;
	}
	/*---------------------------------------------------------------*/
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
		$ritualnames=array();
		$resultset= $this->internalDB->query("SELECT id,title FROM rituals" );
		foreach ($resultset as $row) {
			$ritualnames[$row['id']]=$row['title'];
		}
		return $ritualnames;
	}
	function updateRitualMenu(){
	include 'events/updateritualmenu.php';		
}
}