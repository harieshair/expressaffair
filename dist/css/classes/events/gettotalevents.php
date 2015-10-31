<?php	
$sql = "SELECT count(id) as total FROM events ";
$wherecondition=" where name is not null ";
if($searchobj!=null){
	$wherecondition .=(!empty($searchobj->loginname))?" AND login_name LIKE '%".$searchobj->loginname."%' ":'';  
	$wherecondition .=(isset($searchobj->usertype))? " AND usertype=".intval($searchobj->usertype):'';
	$wherecondition .=(!empty($searchobj->username))?" AND name LIKE '%".$searchobj->username."%' ":''; 
	$wherecondition .=(isset($searchobj->userstatus))?" AND status=".intval($searchobj->userstatus):'';
	$wherecondition .=(!empty($searchobj->emailid))?" AND email='".$searchobj->emailid."'":'';
}
$totalevents = $this->internalDB->queryFirstField($sql.$wherecondition);
 return $totalevents;
?>