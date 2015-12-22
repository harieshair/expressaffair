<?php
return $this->internalDB->queryFirstRow("SELECT * FROM attachments WHERE entity_id =$entityid AND entity_type=$entitytype and is_profile_file=1 order by id desc");