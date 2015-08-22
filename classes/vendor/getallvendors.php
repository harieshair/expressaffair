<?php	

$wherecondition=" where name is not null ";
if($searchobj!=null){
	
}
	$pages = $pages == "" ? 0 : $pages-1;
	$start=$pages * $rows;
	$sql="SELECT * FROM vendor ".$wherecondition;
	return $this->internalDB->query("$sql ORDER BY id DESC LIMIT $start, $rows");	

?>