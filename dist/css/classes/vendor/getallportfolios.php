<?php	
$wherecondition=" where entityid=".$vendorid." AND entity_type=".$this->EntityType->getkey("Vendor");
$sql="SELECT * FROM portfolios ";
return $this->internalDB->query("$sql ORDER BY id DESC ");
?>