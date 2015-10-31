<?php	
$sql = "SELECT count(id) as total FROM communities ";
$wherecondition=" where name is not null ";
if($searchobj!=null){
	
}
$totlacommunities = $this->internalDB->queryFirstField($sql.$wherecondition);
 return $totlacommunities;
?>