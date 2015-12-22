<?php
$sql="SELECT a.id, a.file_type, a.file_name, a.file_path, a.is_profile_file";
$sql.=" FROM attachments a WHERE a.entity_id=$entityId AND a.entity_type=".$this->EntityType->getkey($entityType);
$sql.=" ORDER BY a.is_profile_file DESC ";
return $this->internalDB->query($sql);	
?>