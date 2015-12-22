<?php

/* require_once 'KLogger.php';
  $log = new KLogger ( "log.txt" , KLogger::DEBUG ); */
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today = date("y-m-d H:i:s", $temp);
$updateObject = array();
$returnValue = array();
try {
    if (!empty($entity['ritualid'])) {

        $duplicate = $this->internalDB->queryFirstRow("select id from rituals where  title='" . $entity['title'] . "' AND id!=" . $entity['ritualid']);
        if (!empty($duplicate))
            return array("Exception" => "Specified Contact title already exists");

        isset($entity['description']) ? $updateObject['description'] = $entity['description'] : '';
        isset($entity['title']) ? $updateObject['title'] = $entity['title'] : '';
        isset($serviceIds) ? $updateObject['services'] = $serviceIds : '';
        $this->internalDB->update('rituals', $updateObject, "id=%i", $entity['ritualid']);

        $returnValue['Id'] = $entity['ritualid'];
    }
    else {

        $duplicate = $this->internalDB->queryFirstRow("SELECT id FROM rituals WHERE  title='" . $entity['title'] . "' ");
        if (!empty($duplicate))
            return array('Exception' => "Specified ritual already exists");

        isset($entity['description']) ? $updateObject['description'] = $entity['description'] : '';
        isset($entity['title']) ? $updateObject['title'] = $entity['title'] : '';
        isset($serviceIds) ? $updateObject['services'] = $serviceIds : '';
        $updateObject['created_on'] = $today;
        $updateObject['is_deleted'] = 0;

        $this->internalDB->insert('rituals', $updateObject);
        $returnValue['Id'] = $this->internalDB->insertId();
    }
    $entity['entity_id']=$returnValue['Id'];
    //Save rituals services
    !empty($serviceIds) ? $this->saveRitualServices($returnValue['Id'], $serviceIds) : '';

    //Update pulic ritual menu
    $this->updateRitualMenu();
    //Add New Attachments
    if (!empty($entity['file_name'])) {
        //Remove removeAttachments
        $this->removeAttachments($returnValue['Id'], $entity['file_name']);

        $files = explode(",", $entity['file_name']);
        foreach ($files as $file) {
            $oldFileId = $this->getAttachmentByFileName($file, $returnValue['Id']);
            if (empty($oldFileId)) {
                $entity['file_name'] = $file;
                $response = $this->saveattachments($entity);
            }
        }
    }
    return $returnValue;
} catch (Exception $ex) {
    return array('Exception' => $ex->getMessage());
}