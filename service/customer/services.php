<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/dbconnection.php");
class customerservice {
	public $internalDB=null;
	function customerservice($db){
$this->internalDB=$db;
	}
/*------------------------------Events ---------------*/
	function GetAllEventNames(){
		include_once(CLASSFOLDER."/events.php");
		$events = new eventclass($this->internalDB);
		return $events->getAllEventNames();
	}
	function GetAllEvents($page,$rows,$earchobj){
		include_once(CLASSFOLDER."/events.php");
		$events = new eventclass($this->internalDB);
		return $events->getalleventlists($page,$rows,$earchobj);
	}
	function GetAllServicesByEventId($eventId){
		include_once(CLASSFOLDER."/events.php");
		$events = new eventclass($this->internalDB);
		return $events->GetAllServicesByEventId($eventId);
	}
	function GetAllRitualsByEventId($eventId){
		include_once(CLASSFOLDER."/events.php");
		$events = new eventclass($this->internalDB);
		return $events->GetAllRitualsByEventId($eventId);
	}
	/*------------------------------Vendor Data---------------*/
	function GetAllVendorServices($serviceId,$locationId){
		include_once(CLASSFOLDER."/vendor.php");
		$events = new vendorclass($this->internalDB);
		return $events->getAllVendorServices($serviceId,$locationId);
	}

	/*------------------------------Customer Data---------------*/
	function GetCustomerById($customerId){
		include_once(CLASSFOLDER."/customer.php");
		$customer = new customerclass($this->internalDB);
		return $customer->getCustomerById($customerId);	
	}

	/*------------------------------Community Data---------------*/
	function GetAllCommunityNames(){
		include_once(CLASSFOLDER."/communities.php");
		$community = new communityclass($this->internalDB);
		return $community->getAllCommunityNames();
	}

	/*------------------------------Ritual Data---------------*/
	function GetAllRitualTitles(){
		include_once(CLASSFOLDER."/rituals.php");
		$rituals = new ritualclass($this->internalDB);
		return $rituals->getAllRitualNames();
	}

	/*------------------------------Catalog Data---------------*/
	function GetCatalogValuesByMasterName($masternames){
		include_once(CLASSFOLDER."/catalogs.php");
		$catalog = new catalogclass($this->internalDB);
		return $catalog->GetAllCatalogValues($masternames);
	}
	function getCatalogValueById($catalogId){
		include_once(CLASSFOLDER."/catalogs.php");
		$catalog = new catalogclass($this->internalDB);
		return $catalog->getCatalogValuesById($catalogId);
	}
	function GetAllCatalogValuesByMasterNames($masternames){
		include_once(CLASSFOLDER."/catalogs.php");
		$catalog = new catalogclass($this->internalDB);
		return $catalog->GetAllCatalogValuesByMasterNames($masternames);
	}


	/*------------------------------Attachment Data---------------*/
	function GetAllAttachnmentsByEntityId($entityId){
		include_once(CLASSFOLDER."/attachments.php");
		$attachment = new attachmentclass($this->internalDB);
		$entitytype=new EntityType();
		return $attachment->getallattachments($entityId,$entitytype->getkey("Event"));
	}


	
}