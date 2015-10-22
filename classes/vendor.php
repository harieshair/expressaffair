	<?php
	
	include_once(CLASSFOLDER."/enums/commonenums.php");
	class vendorclass {	
	public $internalDB;		
	function vendorclass($db) // Constructor 
	{
		$this->internalDB=$db;
		$this->EntityType=new EntityType;
		$this->AttachmentType=new AttachmentType;
	}
	/* -----------------------------------------------------------------------------*/
	function updatevendorbasics($entity)
	{
		$response =include 'vendor/updatevendorbasics.php'	;	
		return $response;
	}
	function updatevendorcontacts($entity)
	{
		$response =include 'vendor/savevendorcontacts.php'	;	
		return $response;
	}
	function updatevendorportfolios($entity)
	{
		$response =include 'vendor/savevendorportfolio.php'	;	
		return $response;
	}
	function updatevendorservices($entity)
	{
		$response =include 'vendor/saveservice.php'	;	
		return $response;
	}
	function updatevendorattachments($entity)
	{
		$entity['entity_type']=$this->EntityType->getkey("Vendor");
		$response =include 'vendor/savevendorattachments.php';	
		return $response;
	}
	function updatevendorservice($entity)
	{		
		$response =include 'vendor/saveservice.php';	
		return $response;
	}
	function saveattachments($entity,$entitytype){	
		$entity['entity_type']=$this->EntityType->getkey($entitytype);		
		include_once(CLASSFOLDER."/attachments.php");
		$attachment=new attachmentclass($this->internalDB);
		return $attachment->updateattachments($entity);
	}

	function getAttachmentByFileName($fileName,$vendorServiceId,$entitytype){
		$sql="SELECT id FROM attachments a WHERE entity_id=$vendorServiceId AND file_name='$fileName' AND entity_type='".$this->EntityType->getkey($entitytype)."'";
		return $this->internalDB->queryFirstField($sql);	
	}
	
	

	
	function getallvendorlists($pages,$rows,$searchobj){
		$searchobj=($searchobj!=null)?json_decode($searchobj):null;
		$returnvalue=include 'vendor/getallvendors.php';
		return $returnvalue;
	}	
	function getTotalVendors($obj)
	{
		$searchobj=($obj!=null)?json_decode($obj):null;
		$returnvalue=include 'vendor/gettotalvendors.php';
		return $returnvalue;
	}
	function getvendorbyid($vendorid){
		return $this->internalDB->queryFirstRow("SELECT * FROM vendor where id=$vendorid");
		
	}
	/*---------------------------------------------------------------*/
	function getallvendorcontactsbyvendorid($vendorid){
		$response =include 'vendor/getallvendorcontacts.php'	;	
		return $response;
	}

	function getcontactsbyid($contactid){
		return $this->internalDB->queryFirstRow("SELECT * FROM contacts WHERE title IS NOT NULL AND id=$contactid");	
	}
	function deleteVendorContacts($contactId,$vendorId){
		return $this->internalDB->query("SELECT * FROM contacts WHERE title IS NOT NULL AND id=$contactid");
	}
	function getallvendorportfolio($vendorid){
		$response =include 'vendor/getallportfolios.php'	;	
		return $response;
	}
	function getportfoliobyid($portfolioid){
		return $this->internalDB->queryFirstRow("SELECT * FROM portfolios WHERE id=$portfolioid");		
	}
	function getAllVendorServicesByVendorId($vendorid){
		return $this->internalDB->query("SELECT * FROM v_services WHERE vendor_id=$vendorid");	
	}
	function getAllVendorServices($serviceId,$locationId){
		$sql="SELECT vs.id,vs.locations,vs.vendor_id,vs.title,vs.description,vs.price,a.file_path FROM  v_services vs 
		inner join attachments a on vs.id=a.entity_id where  vs.service_id= $serviceId AND a.entity_type=4 and a.file_type=0 ";
		$sql.=!empty($locationId)?" AND vs.locations=$locationId ":'';
		return $this->internalDB->query($sql);	
	}
	function getvendorservicebyid($serviceid){
		return $this->internalDB->queryFirstRow("SELECT * FROM v_services WHERE id=$serviceid");		
	}
	function getallvendorattachments($vendorid){
		
		$sql="SELECT v.id, v.vendor_id, v.attachment_id, v.description, v.services,a.file_type, a.file_name, a.file_path";
		$sql.=" FROM vendor_attachments v,  attachments a WHERE a.id=v.attachment_id AND v.vendor_id=$vendorid AND a.entity_type=".$this->EntityType->getkey("Vendor");
		return $this->internalDB->query($sql);	
	}
	function getvendorattachment($objectid){
		$sql="SELECT v.id, v.vendor_id, v.attachment_id, v.description, v.services,a.file_type, a.file_name, a.file_path";
		$sql.=" FROM vendor_attachments v,  attachments a WHERE a.id=v.attachment_id AND v.id=$objectid";
		return $this->internalDB->queryFirstRow($sql);	
	}
	function getAllAttachmentsByEntityId($entityId,$entityType){
		$sql="SELECT a.file_type, a.file_name, a.file_path";
		$sql.=" FROM attachments a WHERE a.entity_id=$entityId AND a.entity_type=".$this->EntityType->getkey($entityType);
		return $this->internalDB->query($sql);	
	}

	function removeAttachments($entityId,$fileNames,$entitytype){		
		include_once(CLASSFOLDER."/attachments.php");
		$attachment=new attachmentclass($this->internalDB);
		return $attachment->removeEntityFilesNotExistsInGivenList($entityId,$this->EntityType->getkey($entitytype),$fileNames);
	}
}