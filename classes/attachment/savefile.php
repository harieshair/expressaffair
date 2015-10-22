<?php
$sourcepath=ROOTFOLDER."/uploadfolder/".trim($filename);
if(file_exists ($sourcepath)){
	$targetLocation="attachments/";
	if(isset($entitytype)){
		switch($entitytype){
			case 0:
			$targetLocation.="customer/";
			break;
			case 1:
			$targetLocation.="vendor/";
			break;
			case 2:
			$targetLocation.="user/";
			break;
			case 3:
			$targetLocation.="event/";
			break;
			default:
			$targetLocation.="others/";
			break;
		}
		$targetLocation.=$entityid."/";
	}

	switch($fileType){
		case 0:
		case 5:
		$targetLocation.="images/";
		break;
		case 1:
		case 4:
		$targetLocation.="media/";
		break;
		case 2:
		case 3:
		$targetLocation.="docs/";
		break;			
		default:
		$targetLocation.="others/";
		break;
	}

	$this->makedirectory(ROOTFOLDER."/".$targetLocation);
	$destinationpath = ROOTFOLDER."/".$targetLocation."/".$filename;

	if (file_exists($destinationpath))
		unlink($destinationpath);
	rename(rtrim($sourcepath),rtrim($destinationpath));
	return  $targetLocation."/".$filename;
}
return null;
?>