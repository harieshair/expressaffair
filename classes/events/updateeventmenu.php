<?php 
$eventNames= $this->internalDB->query("SELECT id,name FROM events" );
$menuList='<ul role="menu" class="sub-menu">';

foreach ($eventNames as $eventName) { 
	$menuList.="<li><a href='".HTTPAPPLICATIONROOT."/public/event=".$eventName['id']."'>".$eventName['name']."</a></li>";
}

$menuList.='</ul>';
$eventmenufile = PUBLICFOLDER."/static/eventlist.php";
$handle = fopen($eventmenufile, 'w') or die('Cannot open file:  '.$eventmenufile);
fwrite($handle, $menuList);
fclose($handle);