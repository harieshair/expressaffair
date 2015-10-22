	<?php
	class eventclass
	{		
		public $internalDB;	
	function eventclass($db) // Constructor 
	{
		$this->internalDB=$db;
	}
	/* -----------------------------------------------------------------------------*/
	function updateevent($entity,$ritualIds,$serviceIds)
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
		$eventnames=array();
		$resultset= $this->internalDB->query("SELECT id,name FROM events" );
		foreach ($resultset as $row) {
			$eventnames[$row['id']]=$row['name'];
		}
		return $eventnames;
	}

	function saveEventServices($eventId,$services){
		$returnvalue=include 'events/saveeventservices.php';
		return $returnvalue;
	}
	function saveEventRituals($eventId,$rituals){
		$returnvalue=include 'events/saveeventrituals.php';
		return $returnvalue;
	}

function updateEventMenu(){
	include 'events/updateeventmenu.php';		
}

	function getSelectedEventByCommunityId($communityId){
		$selectedEventIds= $this->internalDB->queryFirstColumn("SELECT event_id FROM event_visibility WHERE community_id=$communityId group by event_id" );
		return $selectedEventIds;
	}
	function GetAllServicesByEventId($eventId){
		$eventServices= $this->internalDB->query("SELECT cv.id,cv.catalog_value FROM catalog_value cv inner join e_services es on es.service_id=cv.id where es.event_id= $eventId" );
		return $eventServices;
	}
	function GetAllRitualsByEventId($eventId){
		$eventRituals= $this->internalDB->query("SELECT r.id,r.title FROM rituals r inner join e_rituals er on er.ritual_id=r.id where er.event_id=$eventId" );
		return $eventRituals;
	}
	function getAllEventAttachments($eventid){
			include_once(CLASSFOLDER."/enums/commonenums.php");
			$entityType=new EntityType();
		$sql="SELECT a.file_type, a.file_name, a.file_path";
 		$sql.=" FROM attachments a WHERE a.entity_id=$eventid AND a.entity_type=".$entityType->getkey("Event");
 		return $this->internalDB->query($sql);	
	}
	function getAttachmentByFileName($fileName,$eventId){
			include_once(CLASSFOLDER."/enums/commonenums.php");
			$entityType=new EntityType();
		$sql="SELECT id FROM attachments a WHERE entity_id=$eventId AND file_name='$fileName' AND entity_type=".$entityType->getkey("Event");
 		return $this->internalDB->queryFirstField($sql);	
	}
	function saveattachments($entity){
		include_once(CLASSFOLDER."/enums/commonenums.php");
			$entityType=new EntityType();
		$entity['entity_type']=$entityType->getkey(EVENT);		
		include_once(CLASSFOLDER."/attachments.php");
		$attachment=new attachmentclass($this->internalDB);
		return $attachment->updateattachments($entity);
	}
		function removeAttachments($entityId,$fileNames){
		include_once(CLASSFOLDER."/enums/commonenums.php");
		$entityType=new EntityType;
		
		include_once(CLASSFOLDER."/attachments.php");
		$attachment=new attachmentclass($this->internalDB);
		return $attachment->removeEntityFilesNotExistsInGivenList($entityId,$entityType->getkey(EVENT),$fileNames);
	}

	function closetags ( $html )
        {
        #put all opened tags into an array
        preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $html, $result );
        $openedtags = $result[1];
        #put all closed tags into an array
        preg_match_all ( "#</([a-z]+)>#iU", $html, $result );
        $closedtags = $result[1];
        $len_opened = count ( $openedtags );
        # all tags are closed
        if( count ( $closedtags ) == $len_opened )
        {
        return $html;
        }
        $openedtags = array_reverse ( $openedtags );
        # close tags
        for( $i = 0; $i < $len_opened; $i++ )
        {
            if ( !in_array ( $openedtags[$i], $closedtags ) )
            {
            $html .= "</" . $openedtags[$i] . ">";
            }
            else
            {
            unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
            }
        }
        return $html;
    }
}