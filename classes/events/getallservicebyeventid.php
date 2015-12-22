<?php
$eventServices= $this->internalDB->query("SELECT cv.id,cv.catalog_value FROM catalog_value cv inner join e_services es on es.service_id=cv.id where es.event_id= $eventId" );
return $eventServices;
?>