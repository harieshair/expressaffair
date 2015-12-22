<?php

include_once(CLASSFOLDER . "/enums/commonenums.php");

class customerclass {

    public $internalDB;

    function customerclass($db) { // Constructor 
        $this->internalDB = $db;
    }

    function getCustomerId($email, $pwd) {
        $resultSet = $this->internalDB->queryFirstField("SELECT id FROM customers WHERE email='$email' AND password='" . md5($pwd) . "'");
        return !empty($resultSet) ? $resultSet : 0;
    }

    function saveCustomer($entity) {
        $response = include 'customer/savecustomer.php';
        return $response;
    }

    function IsEmailExists($emailId) {
        $duplicateEmail = $this->internalDB->queryFirstField("select id from customers where email='$emailId'");
        return !empty($duplicateEmail) ? true : false;
    }

    function getAllCustomers($page, $rows, $obj) {
        $searchobj = ($obj != null) ? json_decode($obj) : null;
        $response = include 'customer/getallcustomers.php';
        return $response;
    }

    function getCustomerById($customerid) {
        $response = include 'customer/getcustomerbyid.php';
        return $response;
    }

    public function sendCreateUserNotification($mailid, $name, $password) {
        include_once(CLASSFOLDER . '/sendmail/sendmail.php');
        $response = include "users/notifycreateuser.php";
        return $response;
    }

    public function sendForgetPasswordNotification($mailid, $password) {
        $result = include "users/notifypasswordchange.php";
    }

    public function getCustomerAttachments($customerid) {
        $this->entityType = new EntityType;
        $resultSet = $this->internalDB->queryFirstRow("SELECT * from attachments WHERE entity_id =$customerid and entity_type=" . $this->entityType->getkey(CUSTOMER));
        return $resultSet;
    }

    function saveattachments($entity) {
        $this->entityType = new EntityType;
        $entity['entity_type'] = $this->entityType->getkey(CUSTOMER);

        include_once(CLASSFOLDER . "/attachments.php");
        $attachment = new attachmentclass();
        return $attachment->updateattachments($entity);
    }

    function removeAttachment($attachmentid) {
        include_once(CLASSFOLDER . "/attachments.php");
        $attachment = new attachmentclass();
        return $attachment->removeAttachment($$attachmentid);
    }

    function checkcartserviceavailability($cartDetails) {
        $response = include "customer/checkcartserviceavailability.php";
        return $response;
    }

    function removeCartedItem($cartId, $customerId) {
        $this->internalDB->query("DELETE FROM carts where customer_id=$customerId and id=$cartId");
        return 1;
    }

    function getEntityItems($entity, $location) {
        $response = include "customer/getentityitems.php";
        return $response;
    }

}