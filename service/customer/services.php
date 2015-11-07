<?php
include_once(CLASSFOLDER."/dbconnection.php");
include_once(CLASSFOLDER."/searchobject.php");
class customerservice {
	public $internalDB=null;
	public $searchObj=null;
	function customerservice($db){
		$this->internalDB=$db;
		$this->searchObj=new searchobject();
	}
	function GetAllQueryStrings(){
		$this->searchObj->ritualId=isset($_GET['r'])?$_GET['r']:(isset($_GET['ritualId'])?$_GET['ritualId']:null);
		$this->searchObj->eventTo= isset($_GET['et'])?$_GET['et']:null;
		$this->searchObj->eventFrom= isset($_GET['ef'])?$_GET['ef']:null;
		$this->searchObj->eventId= isset($_GET['e'])?$_GET['e']:(isset($_GET['eventId'])?$_GET['eventId']:0);
		$this->searchObj->serviceId= isset($_GET['s'])?$_GET['s']:null;
		$this->searchObj->locationId= isset($_GET['l'])?$_GET['l']:0;
		$this->searchObj->orderBy= isset($_GET['oby'])?$_GET['oby']:null;
		$this->searchObj->max= isset($_GET['ma'])?$_GET['ma']:null;
		$this->searchObj->start= isset($_GET['st'])?$_GET['st']:null;
		$this->searchObj->customerId= isset($_GET['c'])?$_GET['c']:null;
		$this->searchObj->vserviceId= isset($_GET['vsi'])?$_GET['vsi']:null;
		$this->searchObj->packages= isset($_GET['pac'])?$_GET['pac']:null;
		$this->searchObj->priceMinimum= isset($_GET['prm'])?$_GET['prm']:null;
		$this->searchObj->priceMaximum= isset($_GET['prmax'])?$_GET['prmax']:null;
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
		if(empty($eventId))
			return null;
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
	function GetAllServicesByRitualId($ritualId){
		include_once(CLASSFOLDER."/rituals.php");
		$rituals = new ritualclass($this->internalDB);
		return $rituals->GetAllServicesByRitualId($ritualId);
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

	/*----------------booking data-----------------------*/
	function geAlltMyCartItems($customerId){
		include_once(CLASSFOLDER."/cart.php");
		$cart = new cartclass($this->internalDB);
		return $cart->geAlltMyCartItems($customerId);	

	}

	
}