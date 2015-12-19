<?php
include_once(CLASSFOLDER."/enums/commonenums.php");
class attachmentclass {	
public $internalDB;		
	function attachmentclass($db) // Constructor 
	{
		$this->internalDB=$db;
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
		$response =include 'attachment/getallattachments.php';	
		return $response;
	}	
	function getattachmentbyid($attachmentid){
		return $this->internalDB->queryFirstRow("SELECT * FROM attachments WHERE id=$attachmentid");		
	}
	function makedirectory($directorypath){
		if (!file_exists($directorypath)) {
			mkdir($directorypath, 0777, true);
		}
	}
	function savefile($filename,$fileType,$entitytype,$entityid){
		$response =include 'attachment/savefile.php'	;	
		return $response;
	}
	function removefile($filepath){
		$targetpath=ROOTFOLDER."/".$filepath;

		if (file_exists($targetpath))
			unlink($targetpath);

	}
	function removeEntityFilesNotExistsInGivenList($entity_id,$entity_type,$commaSeperatedFileNames){
		$fileNames=explode(",",$commaSeperatedFileNames);
		$filesNotExists=$this->internalDB->queryFirstColumn("SELECT file_path FROM attachments WHERE entity_id=$entity_id AND entity_type=$entity_type and file_name not in ('" . implode("','", $fileNames). "')");
		if(!empty($filesNotExists) && count($filesNotExists)>0){
			foreach ($filesNotExists as $filePath) {	
				$targetpath=ROOTFOLDER."/".$filePath;
				if (file_exists($targetpath))
					unlink($targetpath);
			}		
		$this->internalDB->queryFirstColumn("DELETE FROM attachments WHERE entity_id=$entity_id 
			AND entity_type=$entity_type and file_name not in ('".implode("','",$fileNames)."')");
		}
	}
	function getExtensionOfFile($filename){
		return pathinfo($filename, PATHINFO_EXTENSION);
	}
}