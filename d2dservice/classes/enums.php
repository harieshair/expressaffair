
<?php
 class TypeOfUser {
	public  function getlists()
	{
		$usertypearray	=array(
		"1"=>"Super Admin",
		"2"=>"Admin",
		"3"=>"Merchandiser",
		"4"=>"Vendor",
		"5"=>"Customer"
		);
	return $usertypearray;
	}
	
	public  function getvalue($id)
	{
	
	$casevalue=(string)$id;
		switch($casevalue)
		{
		case '1':
			$value="Super Admin";
			break;
		case '2':
			$value= "Admin";
			break;
		case '3':
			$value="Merchandiser";
			break;
		case '4':
			$value="Vendor";
			break;
		case '5':
		$value="Customer";
			break;

		}
		return $value;
	}
}

 class UserStatus{
public  function getlists()
	{
		$userstatusarray	=array(
		"0"=>"Active",
		"1"=>"Inactive",
		);
	return $userstatusarray;
	}
	
	public function getvalue($id)
	{
		$value="";
		switch($id)
		{
			case "0":
				$value="Active";
				break;
			case "1":
			$value="Inactive";
			break;
		}
		return $value;
	}
}
?>
