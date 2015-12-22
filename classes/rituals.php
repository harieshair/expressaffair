	<?php
        include_once(CLASSFOLDER."/enums/commonenums.php");
	class ritualclass{	
		public $internalDB;
                public $entityType;
	function ritualclass($db) // Constructor 
	{
		$this->internalDB=$db;
                $this->entityType=new EntityType();
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
        function getAttachmentByFileName($fileName,$ritualId){

		$sql="SELECT id FROM attachments a WHERE entity_id=$ritualId AND file_name='$fileName' AND entity_type=".$this->entityType->getkey(RITUAL);
 		return $this->internalDB->queryFirstField($sql);	
	}
        function getRitualAttachments($ritualId){
		$sql="SELECT a.id,a.file_type, a.file_name, a.file_path ,a.is_profile_file";
 		$sql.=" FROM attachments a WHERE a.entity_id=$ritualId AND a.entity_type=".$this->entityType->getkey(RITUAL);
 		return $this->internalDB->queryFirstRow($sql);	
	}
        function saveattachments($entity){
		$entity['entity_type']=$this->entityType->getkey(RITUAL);		
		include_once(CLASSFOLDER."/attachments.php");
		$attachment=new attachmentclass($this->internalDB);
                $entity['is_profile_file']=1;
		return $attachment->updateattachments($entity);
	}
	
		function removeAttachments($entityId,$fileNames){
		include_once(CLASSFOLDER."/attachments.php");
		$attachment=new attachmentclass($this->internalDB);
		return $attachment->removeEntityFilesNotExistsInGivenList($entityId,$this->entityType->getkey(RITUAL),$fileNames);
	}
}