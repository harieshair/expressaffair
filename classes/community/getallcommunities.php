<?php	

$wherecondition=" where c.name is not null ";
if($searchobj!=null){
	
}
	$pages = $pages == "" ? 0 : $pages-1;
	$start=$pages * $rows;
	$sql="SELECT c.id,c.name,c.created_on,group_concat(cl.state_id) as states,group_concat(cl.zone_id) as zones FROM communities c
left join community_locations cl on cl.community_id=c.id ".$wherecondition ." group by c.id";
	return $this->internalDB->query("$sql ORDER BY id DESC LIMIT $start, $rows");	

?>