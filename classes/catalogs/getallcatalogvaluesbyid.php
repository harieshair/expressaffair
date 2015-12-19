<?php
	if(!empty($catalogid)){
		$ret=$this->internalDB->queryFirstField("select catalog_value from catalog_value where id=$catalogid");
		return $ret;
	}
	return '';
?>