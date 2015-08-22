<?php	
$sql = "SELECT count(id) as total FROM vendor ";
$wherecondition=" where name is not null ";
if($searchobj!=null){
	
}
$totalvendors = $this->internalDB->queryFirstField($sql.$wherecondition);
 return $totalvendors;
?>