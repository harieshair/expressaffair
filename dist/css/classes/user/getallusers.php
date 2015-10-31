<?php	
$sql = "SELECT count(id) as total FROM users ";
$wherecondition=" where login_name is not null ";
if($searchobj!=null){
	$wherecondition .=(!empty($searchobj->loginname))?" AND login_name LIKE '%".$searchobj->loginname."%' ":'';  
	$wherecondition .=(isset($searchobj->usertype))? " AND usertype=".intval($searchobj->usertype):'';
	$wherecondition .=(!empty($searchobj->username))?" AND name LIKE '%".$searchobj->username."%' ":''; 
	$wherecondition .=(isset($searchobj->userstatus))?" AND status=".intval($searchobj->userstatus):'';
	$wherecondition .=(!empty($searchobj->emailid))?" AND email='".$searchobj->emailid."'":'';
}
$totalusers = $this->internalDB->queryFirstField($sql.$wherecondition);
if($totalusers>0) {
	$pages=ceil($totalusers/$rows);
	$page = $page == "" ? 0 : $page-1;
	$start=$page * $rows;
	$sql="SELECT * FROM users ".$wherecondition;
	return $this->internalDB->query("$sql ORDER BY id DESC LIMIT $start, $rows");	
}
else return null;
?>