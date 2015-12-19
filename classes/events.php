	<?php
	include_once(CLASSFOLDER."/enums/commonenums.php");
	class eventclass
	{		
		public $internalDB;	
		public $entityType;
	function eventclass($db) // Constructor 
	{			
		$this->internalDB=$db;
		$this->entityType=new EntityType();
	}
	/* -----------------------------------------------------------------------------*/
	function updateevent($entity,$ritualIds,$serviceIds)
	{
		$response =include 'events/saveevents.php'	;	
		return $response;
	}
	/*---------------------------------------------------------------*/
	function getalleventlists($pages,$rows,$searchobj){		
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
		$returnvalue=include 'events/getalleventnames.php';
		return $returnvalue;
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
		$returnvalue=include 'events/getallservicesbyeventid.php';
		return $returnvalue;
	}
	function GetAllRitualsByEventId($eventId){
		$returnvalue=include 'events/getallritualsbyeventid.php';
		return $returnvalue;	
	}
	function getAllEventAttachments($eventid){
		$sql="SELECT a.id,a.file_type, a.file_name, a.file_path ,a.is_profile_file";
 		$sql.=" FROM attachments a WHERE a.entity_id=$eventid AND a.entity_type=".$this->entityType->getkey("Event");
 		return $this->internalDB->query($sql);	
	}
	function getAttachmentByFileName($fileName,$eventId){

		$sql="SELECT id FROM attachments a WHERE entity_id=$eventId AND file_name='$fileName' AND entity_type=".$this->entityType->getkey("Event");
 		return $this->internalDB->queryFirstField($sql);	
	}
	function saveattachments($entity){
		$entity['entity_type']=$this->entityType->getkey(EVENT);		
		include_once(CLASSFOLDER."/attachments.php");
		$attachment=new attachmentclass($this->internalDB);
		return $attachment->updateattachments($entity);
	}
	function saveprofileFile($entityid,$fileName){	
			$updateObject=array("is_profile_file"=>0);
			$this->internalDB->update('attachments',$updateObject,
				"entity_id=%i and entity_type=%i",$entityid,$fileName,$this->entityType->getkey(EVENT));
			$updateObject=array("is_profile_file"=>1);
			$this->internalDB->update('attachments',$updateObject,
				"entity_id=%i  and file_name=%s and entity_type=%i",$entityid,$fileName,$this->entityType->getkey(EVENT));			
	}
		function removeAttachments($entityId,$fileNames){
		include_once(CLASSFOLDER."/attachments.php");
		$attachment=new attachmentclass($this->internalDB);
		return $attachment->removeEntityFilesNotExistsInGivenList($entityId,$this->entityType->getkey(EVENT),$fileNames);
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