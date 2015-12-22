<?php
return $this->internalDB->query("SELECT * FROM attachments WHERE entity_id =$entityid AND entity_type=$entitytype order by id desc");