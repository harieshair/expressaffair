<?php

include_once(CLASSFOLDER . "/dbconnection.php");
include_once(CLASSFOLDER . "/searchobject.php");
include_once(CLASSFOLDER . "/customerservice.php");

class customerservice {

    public $internalDB = null;
    public $searchObj = null;
    public $customer = null;

    function customerservice($db) {
        $this->internalDB = $db;
        $this->searchObj = new searchobject();
        $this->customer = new customerserviceclass($this->internalDB);
    }

    function GetAllQueryStrings() {
        $this->searchObj->ritualId = isset($_GET['r']) ? base64_decode($_GET['r']) : (isset($_GET['ritualId']) ? $_GET['ritualId'] : null);
        $this->searchObj->eventTo = isset($_GET['et']) ? base64_decode($_GET['et']) : null;
        $this->searchObj->eventFrom = isset($_GET['ef']) ? base64_decode($_GET['ef']) : null;
        $this->searchObj->eventId = isset($_GET['e']) ? base64_decode($_GET['e']) : (isset($_GET['eventId']) ? $_GET['eventId'] : 0);
        $this->searchObj->serviceId = isset($_GET['s']) ? base64_decode($_GET['s']) : null;
        $this->searchObj->locationId = isset($_GET['l']) ? base64_decode($_GET['l']) : 0;
        $this->searchObj->orderBy = isset($_GET['oby']) ? base64_decode($_GET['oby']) : null;
        $this->searchObj->max = isset($_GET['ma']) ? base64_decode($_GET['ma']) : null;
        $this->searchObj->start = isset($_GET['st']) ? base64_decode($_GET['st']) : null;
        $this->searchObj->customerId = isset($_GET['c']) ? base64_decode($_GET['c']) : null;
        $this->searchObj->vserviceId = isset($_GET['vsi']) ? base64_decode($_GET['vsi']) : null;
        $this->searchObj->packages = isset($_GET['pac']) ? base64_decode($_GET['pac']) : null;
        $this->searchObj->priceMinimum = isset($_GET['prm']) ? base64_decode($_GET['prm']) : null;
        $this->searchObj->priceMaximum = isset($_GET['prmax']) ? base64_decode($_GET['prmax']) : null;
    }

    /* ------------------------------Events --------------- */

    function GetAllEventNames() {
        return $this->customer->getAllEventNames();
    }

    function GetAllEvents($page, $rows, $earchobj) {
        return $this->customer->getalleventlists($page, $rows, $earchobj);
    }

    function GetAllServicesByEventId($eventId) {
        return $this->customer->GetAllServicesByEventId($eventId);
    }

    function GetAllRitualsByEventId($eventId) {
        if (empty($eventId))
            return null;
        return $this->customer->GetAllRitualsByEventId($eventId);
    }

    /* ------------------------------Vendor Data--------------- */

    function GetAllVendorServices($serviceId, $locationId) {
        return $this->customer->getAllVendorServices($serviceId, $locationId);
    }

    function getServiceItemDetailsByvServiceId($vserviceId, $locationId) {
        return $this->customer->getServiceItemDetailsByvServiceId($vserviceId, $locationId);
    }

    /* ------------------------------Customer Data--------------- */

    function GetCustomerById($customerId) {
        return $this->customer->getCustomerById($customerId);
    }

    /* ------------------------------Community Data--------------- */

    function GetAllCommunityNames() {
        return $this->customer->getAllCommunityNames();
    }

    /* ------------------------------Ritual Data--------------- */

    function GetAllRitualTitles() {
        return $this->customer->getAllRitualNames();
    }

    function GetAllServicesByRitualId($ritualId) {
        return $this->customer->GetAllServicesByRitualId($ritualId);
    }

    /* ------------------------------Catalog Data--------------- */

    function GetCatalogValuesByMasterName($masternames) {
        return $this->customer->GetAllCatalogValues($masternames);
    }

    function getCatalogValueById($catalogId) {
        return $this->customer->getCatalogValuesById($catalogId);
    }

    function GetAllCatalogValuesByMasterNames($masternames) {
        return $this->customer->GetAllCatalogValuesByMasterNames($masternames);
    }

    /* ------------------------------Attachment Data--------------- */

    function GetAllAttachnmentsByEntityId($entityId) {
        return $this->customer->getallattachments($entityId);
    }

    /* ------------------Service Item Data -------------------------- */

    function geAlltMyCartItems($customerId) {
        return $this->customer->geAllMyCartItems($customerId);
    }

    function getEntityItems($entity, $location) {
        return $this->customer->getEntityItems($entity, $location);
    }
    function getEntityCounts() {
        return $this->customer->getEntityCounts();
    }

    function closehtmltags($html) {
        $returnvalue = include_once("closehtmltags.php");
        return $returnvalue;
    }

    function getRatings($review) {
        $rating = "";
        switch ($review) {
            case 1:
                $rating.='<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                break;
            case 2:
                $rating.='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                break;
            case 3:
                $rating.='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                break;
            case 4:
                $rating.='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
                break;
            case 5:
                $rating.='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
                break;
            default:
                $rating.='<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
                break;
        }
        return $rating;
    }

}