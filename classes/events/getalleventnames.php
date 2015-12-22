<?php
$eventnames=array();
$resultset= $this->internalDB->query("SELECT id,name FROM events" );
foreach ($resultset as $row) {
	$eventnames[$row['id']]=$row['name'];
}
return $eventnames;
?>