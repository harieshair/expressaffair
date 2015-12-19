<?php
$sql="SELECT vs.id,vs.locations,vs.vendor_id,vs.title,vs.description,vs.price,a.file_path,vs.service_id FROM  v_services vs 
inner join attachments a on vs.id=a.entity_id where  vs.service_id= $serviceId AND a.entity_type=4 and a.file_type=0 ";
$sql.=!empty($locationId)?" AND vs.locations=$locationId ":'';
return $this->internalDB->query($sql);
?>