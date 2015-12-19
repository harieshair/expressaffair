<?php
	$catalogarray=array();
	$catalogvalues=$this->internalDB->query("SELECT id,catalog_value FROM catalog_value c where catalogmaster_id in (select id from catalog_master where name in ('".implode("','", explode(',', $masternames))."'))"); 
	foreach($catalogvalues as $catalog)
		$catalogarray[$catalog['id']]=$catalog['catalog_value'];
	return $catalogarray;
?>