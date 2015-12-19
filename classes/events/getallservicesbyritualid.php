<?php
		$ritualServices= $this->internalDB->query("SELECT cv.id,cv.catalog_value FROM catalog_value cv inner join r_services es on es.service_id=cv.id where es.ritual_id= $ritualId" );
		return $ritualServices;
?>