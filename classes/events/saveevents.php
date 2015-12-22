<?php

$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today = date("y-m-d H:i:s", $temp);
$updateObject = array();
$returnValue = array();
try {
    if (!empty($entity['eventid'])) {

        $duplicate = $this->internalDB->queryFirstRow("select id from events where  name='" . $entity['eventname'] . "' AND id!=" . $entity['eventid']);
        if (!empty($duplicate))
            return array("Exception" => "Specified event name already exists");

        isset($entity['eventname']) ? $updateObject['name'] = $entity['eventname'] : '';
        isset($entity['description']) ? $updateObject['description'] = $entity['description'] : '';
        isset($entity['icons']) ? $updateObject['icons'] = $entity['icons'] : '';
        isset($entity['file_name']) ? $updateObject['images'] = $entity['file_name'] : '';
        isset($ritualIds) ? $updateObject['rituals'] = $ritualIds : '';
        isset($serviceIds) ? $updateObject['services'] = $serviceIds : '';
        $this->internalDB->update('events', $updateObject, "id=%i", $entity['eventid']);
        $returnValue['Id'] = $entity['eventid'];
    }
    else {

        $duplicate = $this->internalDB->queryFirstRow("select id from events where  name='" . $entity['eventname'] . "'");
        if (!empty($duplicate))
            return array('Exception' => "Specified event name already exists");


        isset($entity['eventname']) ? $updateObject['name'] = $entity['eventname'] : '';
        isset($entity['description']) ? $updateObject['description'] = $entity['description'] : '';
        isset($entity['icons']) ? $updateObject['icons'] = $entity['icons'] : '';
        isset($entity['file_name']) ? $updateObject['images'] = $entity['file_name'] : '';
        isset($ritualIds) ? $updateObject['rituals'] = $ritualIds : '';
        isset($serviceIds) ? $updateObject['services'] = $serviceIds : '';
        $updateObject['created_on'] = $today;
        $updateObject['is_deleted'] = 0;
        $this->internalDB->insert('events', $updateObject);
        $returnValue['Id'] = $this->internalDB->insertId();
    }
    $entity['entity_id'] = $returnValue['Id'];
    //Save Event Rituals and services
    !empty($ritualIds) ? $this->saveEventRituals($returnValue['Id'], $ritualIds) : '';
    !empty($serviceIds) ? $this->saveEventServices($returnValue['Id'], $serviceIds) : '';

    //Update pulic event menu
    //$this->updateEventMenu();
    //Add New Attachments
    if (!empty($entity['file_name'])) {

        //Remove removeAttachments
        if (!empty($entity['eventid'])) {
            $this->removeAttachments($returnValue['Id'], $entity['file_name']);
        }

        $files = explode(",", $entity['file_name']);
        foreach ($files as $file) {
            $oldFileId = $this->getAttachmentByFileName($file, $returnValue['Id']);
            if (empty($oldFileId)) {
                $entity['file_name'] = $file;
                $response = $this->saveattachments($entity);
            }
        }
        if (isset($entity['rd_ismasterimage']))
            $this->saveprofileFile($returnValue['Id'], $entity['rd_ismasterimage']);
    }
    return $returnValue;
} catch (Exception $ex) {
    return array('Exception' => $ex->getMessage());
}