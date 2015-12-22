<?php

include_once(CLASSFOLDER . "/enums/commonenums.php");

class customerserviceclass {

    public $internalDB;
    public $EntityType;

    function customerserviceclass($db) { // Constructor 
        $this->internalDB = $db;
        $this->EntityType = new EntityType;
    }

    function getAllEventNames() {
        $returnvalue = include 'events/getalleventnames.php';
        return $returnvalue;
    }

    function getalleventlists($pages, $rows, $searchobj) {
        $returnvalue = include 'events/getallevents.php';
        return $returnvalue;
    }

    function GetAllServicesByEventId($eventId) {
        $returnvalue = include 'events/getallservicebyeventid.php';
        return $returnvalue;
    }

    function GetAllRitualsByEventId($eventId) {
        $returnvalue = include 'events/getallritualsbyeventid.php';
        return $returnvalue;
    }

    function getAllVendorServices($serviceId, $locationId) {
        $response = include 'vendor/getallvendorservices.php';
        return $response;
    }

    function getServiceItemDetailsByvServiceId($vserviceId, $locationId) {
        $returnValue = include "vendor/getServiceItemDetails.php";
        return $returnValue;
    }

    function getCustomerById($customerid) {
        $response = include 'customer/getcustomerbyid.php';
        return $response;
    }

    function getAllCommunityNames() {
        $response = include 'community/getallcommunitynames.php';
        return $response;
    }

    function getAllRitualNames() {
        $returnvalue = include 'events/getallritualnames.php';
        return $returnvalue;
    }

    function GetAllServicesByRitualId($ritualId) {
        $returnvalue = include 'events/getallservicesbyritualid.php';
        return $returnvalue;
    }

    function GetAllCatalogValues($mastername) {
        $result = include "catalogs/returnallcatalogvalues.php";
        return $result;
    }

    function getCatalogValuesById($catalogid) {
        $result = include "catalogs/getallcatalogvaluesbyid.php";
        return $result;
    }

    function GetAllCatalogValuesByMasterNames($masternames) {
        $result = include "catalogs/getallcatalogvaluesbymastername.php";
        return $result;
    }

    function getallattachments($entityid) {
        $entitytype = $this->EntityType->getkey("Event");
        $response = include 'attachment/getallattachments.php';
        return $response;
    }
      function getProfileAttachmentByEntityId($entityid,$entityType) {
        $entitytype = $this->EntityType->getkey($entityType);
        $response = include 'attachment/getprofileattachment.php';
        return $response;
    }

    function geAllMyCartItems($customerId) {
        $returnValue = include "cart/getallmycartitems.php";
        return $returnValue;
    }

    function getEventNameById($eventId) {
        $returnValue = $this->internalDB->queryFirstField("SELECT name FROM events WHERE id=$eventId");
        return $returnValue;
    }

    function getRitualNameById($ritualId) {
        $returnValue = $this->internalDB->queryFirstField("SELECT title FROM rituals WHERE id=$ritualId");
        return $returnValue;
    }

    function getCatalogValueById($catalogValueId) {
        $returnValue = $this->internalDB->queryFirstField("SELECT catalog_value FROM catalog_value WHERE id=$catalogValueId");
        return $returnValue;
    }

    function getAllAttachmentsByEntityId($entityId, $entityType) {
        $returnValue = include "vendor/getallattachmentsbyentityid.php";
        return $returnValue;
    }

    function getVendorNameByVendorId($vendorId) {
        $returnValue = $this->internalDB->queryFirstField("SELECT title FROM vendor WHERE id=$vendorId");
        return $returnValue;
    }

    function getVendorNameByVendorServiceId($v_serviceId) {
        $vendorid = $this->internalDB->queryFirstField("SELECT vendor_id FROM v_services WHERE id=$v_serviceId");
        $vendorName = $this->getVendorNameByVendorId($vendorid);
        return $vendorName;
    }

    function IsAlreadyBookedCartedItem($cartDetails) {
        $response = include "customer/isserviceavailable.php";
        return $response;
    }
    function getEntityItems($entity, $location) {
       $response = include "customer/getentityitems.php";
        return $response;
    }
    function getEntityCounts(){
         $entityCounts = $this->internalDB->queryFirstRow("SELECT * FROM entity_counts");
         return $entityCounts;
    }

}