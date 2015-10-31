<?php
define("CASH", "Cash"); 
define("NETBANKING", "Net Banking");
define("DEBITCARD","Debit Card");
define("CREDITCARD","Credit Card");
define("CHECK","Check");
define("PREPAID","Prepaid");
define("CASHONDELIVERY","Cash on delivery");

class PaymentMode {
	public  function getlists()
	{
		return array(
			"1"=>CASH,
			"2"=>NETBANKING,			
			"3"=>DEBITCARD,
			"4"=>CREDITCARD,
			"5"=>CHECK
			);		
	}
	
	public  function getvalue($id)
	{
		$casevalue=(string)$id;
		switch($casevalue)
		{
			case '1':
			$value=CASH;
			break;
			case '2':
			$value= NETBANKING;
			break;		
			case '3':
			$value=DEBITCARD;
			break;
			case '4':
			$value=CREDITCARD;
			break;
			case '5':
			$value=CHECK;
			break;

		}
		return $value;
	}
}

class PaymentType{
	public  function getlists()
	{
		return array(
			"1"=>PREPAID,
			"2"=>CASHONDELIVERY,
			);		
	}
	
	public function getvalue($id)
	{
		$value="";
		switch($id)
		{
			case "1":
			$value=PREPAID;
			break;
			case "2":
			$value=CASHONDELIVERY;
			break;
		}
		return $value;
	}
}
?>