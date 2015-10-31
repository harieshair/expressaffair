<?php	
$wherecondition=" where title is not null AND entityid=".$vendorid." AND entity_type=".$this->EntityType->getkey("Vendor");
$sql="SELECT * FROM contacts ".$wherecondition;
return $this->internalDB->query("$sql ORDER BY id DESC ");
?>