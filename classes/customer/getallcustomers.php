<?php	
$sql = "SELECT count(id) as total FROM customers ";
$wherecondition=" where email is not null ";
if($searchobj!=null){
	$wherecondition .=(!empty($searchobj->name))?" AND name LIKE '%".$searchobj->name."%' ":'';  
	$wherecondition .=(isset($searchobj->status))?" AND status=".intval($searchobj->userstatus):'';
	$wherecondition .=(!empty($searchobj->email))?" AND email='".$searchobj->email."'":'';
	$wherecondition .=(!empty($searchobj->location))?" AND location='".$searchobj->location."'":'';
}
$totalusers = $this->internalDB->queryFirstField($sql.$wherecondition);
if($totalusers>0) {
	$pages=ceil($totalusers/$rows);
	$page = $page == "" ? 0 : $page-1;
	$start=$page * $rows;
	$sql="SELECT id,name,location FROM customers ".$wherecondition;
	return $this->internalDB->query("$sql ORDER BY id DESC LIMIT $start, $rows");	
}
else return null;
?>