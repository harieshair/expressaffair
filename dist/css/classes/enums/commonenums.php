
<?php
/* define area*/
define("VENDOR", "Vendor"); 
define("CUSTOMER", "Customer");
define("COMMUNITY", "Community");
define("IMAGE","Image");
define("VIDEO","Video");
define("DOCUMENT","Document");
define("EXCEL","Excel");
define("AUDIO","Audio");
define("ICON","Icon");
define("NONE","None");
define("USER","USER");
define("EVENT","Event");
define("VENDORSERVICE","VendorService");

class EntityType{
	public function getlists(){
		return array(
			"0"=>CUSTOMER,
			"1"=>VENDOR,
			"2"=>USER,
			"3"=>EVENT,	
			"4"=>VENDORSERVICE,
			"5"=>NONE,	
			);	
	}
	public function getvalue($id)
	{
		$value="";
		switch($id)
		{
			case "0":
			$value=CUSTOMER;
			break;
			case "1":
			$value=VENDOR;
			break;
			case "2":
			$value=USER;
			break;
			case "3":
			$value=EVENT;
			break;
			case "4":
			$value=VENDORSERVICE;
			break;
			case "5":
			$value=NONE;
			break;
		}
		return $value;
	}
	public function getkey($value)
	{
		$key="";
		switch($value)
		{
			case CUSTOMER:
			$key=0;
			break;
			case VENDOR:
			$key=1;
			break;			
			case USER:
			$key=2;
			break;
			case EVENT:
			$key=3;
			break;
			case VENDORSERVICE:
			$key=4;
			break;
			case NONE:
			$key=5;
			break;
		}
		return $key;
	}
}
class AttachmentType{
	public function getlists(){
		return array(
			"0"=>IMAGE,
			"1"=>VIDEO,
			"2"=>DOCUMENT,
			"3"=>EXCEL,
			"4"=>AUDIO,
			"5"=>ICON
			);	
	}
	public function getvalue($id)
	{
		$value="";
		switch($id)
		{
			case "0":
			$value=IMAGE;
			break;
			case "1":
			$value=VIDEO;
			break;
			case "2":
			$value=DOCUMENT;
			break;
			case "3":
			$value=EXCEL;
			break;
			case "4":
			$value=AUDIO;
			break;
			case "5":
			$value=ICON;
			break;
		}
		return $value;
	}
	public function getkey($value)
	{
		$key="";
		switch($value)
		{
			case IMAGE:
			$key=0;
			break;
			case VIDEO:
			$key=1;
			break;			
			case DOCUMENT:
			$key=2;
			break;
			case EXCEL:
			$key=3;
			break;
			case AUDIO:
			$key=4;
			break;
			case ICON:
			$key=5;
			break;
		}
		return $key;
	}
}

?>
