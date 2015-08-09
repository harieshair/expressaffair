<?php
if(!empty($eventids) && count($eventids)>0){

//Check if visibility configured already	
	$wherecondition=" WHERE event_id in (".implode(",",$eventids).")";
	if(!empty($zoneids)
	$wherecondition=" AND 
}

?>