<?php
	$page = $page == "" ? 0 : $page-1;
	$start=$page * $rows;	
$sql = "SELECT count(id) as total FROM customers ";
$wherecondition=" where email is not null ";
if($searchobj!=null){
	$wherecondition .=(!empty($searchobj->name))?" AND name LIKE '%".$searchobj->name."%' ":'';  
	$wherecondition .=(isset($searchobj->status))?" AND status=".intval($searchobj->userstatus):'';
	$wherecondition .=(!empty($searchobj->email))?" AND email='".$searchobj->email."'":'';
	$wherecondition .=(!empty($searchobj->location))?" AND location='".$searchobj->location."'":'';
}
if(isset($page) && isset($rows))
	$limit=" LIMIT $start, $rows ";
$totalrows = $this->internalDB->queryFirstField($sql.$wherecondition);
$resultSet['totlaRows']=$totalrows;
if($totalrows>0) {
	$sql="SELECT id,email,name,city,contact_number,created_on FROM customers ".$wherecondition." ORDER BY id DESC" .$limit;
	$resultSet['items']= $this->internalDB->query($sql);
	return 	$resultSet;
}
else return null;
?>