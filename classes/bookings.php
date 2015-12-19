	<?php
	include_once(CLASSFOLDER."/enums/bookingenums.php");
	class bookingclass {

		public $internalDB;	
		
	function bookingclass($db) // Constructor 
	{
		$this->internalDB=$db;
	}
	
	function SaveBookings($entity,$booker)
	{
		$returnValue=include "bookings/savebookings.php";
		return $returnValue;
	}
	function SaveBookingDates($datefrom,$dateto,$bookingId,$vserviceId){
		include "bookings/savebookingdates.php";
	}
	function getVendorIdByVserviceid($vserviceid){
		$resultField=$this->internalDB->queryFirstField("SELECT vendor_id from v_services where id=$vserviceid");
		return $resultField;
	}
	
	function GetBookingById(){	
	}
	function GetCustomerBookings(){

	}
	function GetBookingsByDateRange($fromDate,$toDate,$vendorId){
		//$serchObject="$fromDate,$toDate,$vendorId,$CustomerId,$servixeId";

	}
}