<?php 
$eventNames= $this->internalDB->query("SELECT id,name FROM events" );
$menuList='<ul role="menu" class="dropdown-menu">';
$dropdownlist='<option value="0">Choose</option>';
foreach ($eventNames as $eventName) { 
	$menuList.="<li><a href='events=".$eventName['id']."'>".$eventName['name']."</a></li>";
	$dropdownlist.='<option value="'.$eventName['id'].'">'.$eventName['name'].'</option>';
}

$menuList.='</ul>';
$eventmenufile = PUBLICFOLDER."/static/eventlist.php";
$handle = fopen($eventmenufile, 'w') or die('Cannot open file:  '.$eventmenufile);
fwrite($handle, $menuList);
fclose($handle);
$eventddfile = PUBLICFOLDER."/static/eventdropdown.php";
$handle = fopen($eventddfile, 'w') or die('Cannot open file:  '.$eventddfile);
fwrite($handle, $dropdownlist);
fclose($handle);
