	<?php
	$catalogvalues=$this->internalDB->query("SELECT id,catalog_value FROM catalog_value c where catalogmaster_id=(select id from catalog_master where name='$mastername')"); 
	return $catalogvalues;
	?>