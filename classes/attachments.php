<?php
	include_once(CLASSFOLDER."/dbconnection.php");	
	include_once(CLASSFOLDER."/enums.php");
	$dbconnect=null;
	class attachmentclass extends dbconnection {		
	function attachmentclass() // Constructor 
	{
		parent::__construct();
		$this->attachmenttype=new AttachmentType;
		$this->entitytype=new EntityType;
	}
	/* -----------------------------------------------------------------------------*/
	function updateattachments($entity)
	{
		$response =include 'attachment/saveattachment.php'	;	
		return $response;
	}
	function getallattachments($entityid,$entitytype){
		return $this->internalDB->query("SELECT * FROM attachments WHERE entity_id =$entityid AND entity_type=$entitytype ");	
	}	
		function getattachmentbyid($attachmentid){
		return $this->internalDB->queryFirstRow("SELECT * FROM attachments WHERE id=$attachmentid");		
	}
}