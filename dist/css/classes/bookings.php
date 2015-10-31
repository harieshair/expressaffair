	<?php
	include_once(CLASSFOLDER."/enums/bookingenums.php");
	class bookingclass {

		public $internalDB;	
		
	function bookingclass($db) // Constructor 
	{
		$this->internalDB=$db;
	}
	
	function SaveBookings($roleName)
	{
		
	}
	
	function GetBookingById(){	
	}
	function GetCustomerBookings(){

	}
	function GetBookingsByDateRange($fromDate,$toDate,$vendorId,){
		//$serchObject="$fromDate,$toDate,$vendorId,$CustomerId,$servixeId";

	}
}