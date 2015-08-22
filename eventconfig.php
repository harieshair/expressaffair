<?php
$rootfolder="";	
define("ROOTFOLDER", $_SERVER['DOCUMENT_ROOT'].$rootfolder); 
define("CLASSFOLDER", ROOTFOLDER."/classes");
define("VIEWFOLDER", ROOTFOLDER."/pages");
define("UPLOADFOLDER", ROOTFOLDER."/uploaderfolder");
define("SERVERFOLDER", ROOTFOLDER."/service");
define("IMAGEFOLDER", ROOTFOLDER."/images");
define("CSSFOLDER", ROOTFOLDER."/css");	
define("JSFOLDER", ROOTFOLDER."/js");																							
define("HTTPAPPLICATIONROOT", "http://".$_SERVER['HTTP_HOST']);									
?>