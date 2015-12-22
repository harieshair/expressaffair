<?php 
$rituals= $this->internalDB->query("SELECT id,title FROM rituals" );
$menuList='<ul role="menu" class="dropdown-menu">';

foreach ($rituals as $ritual) { 
	$menuList.="<li><a href='rituals=".$ritual['id']."'>".$ritual['title']."</a></li>";
}

$menuList.='</ul>';
$ritualmenufile = ROOTFOLDER."/static/rituallist.php";
$handle = fopen($ritualmenufile, 'w') or die('Cannot open file:  '.$ritualmenufile);
fwrite($handle, $menuList);
fclose($handle);