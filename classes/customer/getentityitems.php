<?php
$returnArray=[];
if(empty($entity)){
    return $returnArray;
}
    $pages = !empty($pages)? $pages-1 : 0;
    $rows = !empty($rows)? $rows:15;
$start = $pages * $rows;
switch($entity){
case "events":
$sql = "SELECT * FROM events ";
$returnArray['items']= $this->internalDB->query("$sql ORDER BY id DESC LIMIT $start, $rows ");
if(count($returnArray['items'])>0){
    $start=$start+$rows;
    $returnArray['remainings']= $this->internalDB->queryFirstField("SELECT count(*) FROM events ORDER BY id DESC LIMIT $start, $rows ");
}
   break;
case "activities":
    $sql = "SELECT * FROM rituals ";
$returnArray['items']= $this->internalDB->query("$sql ORDER BY id DESC LIMIT $start, $rows ");
if(count($returnArray['items'])>0){
    $start=$start+$rows;
    $returnArray['remainings']= $this->internalDB->queryFirstField("SELECT count(*) FROM rituals ORDER BY id DESC LIMIT $start, $rows ");
}
    break;
case "services":
   $returnArray['items']= $this->internalDB->query("SELECT count(distinct(vsl.location_id)) location,count(distinct(vs.vendor_id)) vendors,vs.service_id FROM v_services vs "
           . "inner join v_service_location vsl on vs.id=vsl.vservice_id group by vs.service_id;");    
    break;
case "packages":
    break;
case "partners":
    break;
case "contactus":
    break;
}
return $returnArray;