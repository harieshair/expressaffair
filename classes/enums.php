
<?php
/* define area*/
define("VENDOR", "Vendor"); 
define("SUPERADMIN", "Super Admin");
define("ADMIN", "Admin");
define("CUSTOMER", "Customer");
define("ACTIVE", "Active");
define("INACTIVE", "InActive");
define("COMMUNITY", "Community");
define("IMAGE","Image");
define("VIDEO","Video");
define("DOCUMENT","Document");
define("EXCEL","Excel");
define("AUDIO","Audio");
define("ICON","Icon");

class TypeOfUser {
	public  function getlists()
	{
		return array(
			"1"=>SUPERADMIN,
			"2"=>ADMIN,			
			"3"=>VENDOR,
			"4"=>CUSTOMER
			);		
	}
	
	public  function getvalue($id)
	{

		$casevalue=(string)$id;
		switch($casevalue)
		{
			case '1':
			$value=SUPERADMIN;
			break;
			case '2':
			$value= ADMIN;
			break;		
			case '3':
			$value=VENDOR;
			break;
			case '4':
			$value=CUSTOMER;
			break;

		}
		return $value;
	}
}

class UserStatus{
	public  function getlists()
	{
		return array(
			"0"=>ACTIVE,
			"1"=>INACTIVE,
			);		
	}
	
	public function getvalue($id)
	{
		$value="";
		switch($id)
		{
			case "0":
			$value=ACTIVE;
			break;
			case "1":
			$value=INACTIVE;
			break;
		}
		return $value;
	}
}

class EntityType{
	public function getlists(){
		return array(
			"0"=>CUSTOMER,
			"1"=>VENDOR		
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
		}
		return $key;
	}
}
class AttachmentType{
	public function getlists(){
		return array(
			"Image"=>IMAGE,
			"Video"=>"VIDEO",
			"Document"=>"DOCUMENT",
			"Excel"=>"EXCEL",
			"Audio"=>"AUDIO",
			"Icon"=>"ICON"
			);	
	}
}

?>
