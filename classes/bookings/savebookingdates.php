<?php
$bookingdates=array();
$begin = new DateTime($datefrom);
$end = new DateTime($dateto);
$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
foreach($daterange as $date){
	$bookingdates[]=array(
		"booking_id"=>$bookingId,
		"vservice_id"=>$vserviceId,
		"booking_date"=>$date->format("Y-m-d H:i:s"));
}
$bookingdates[]=array(
	"booking_id"=>$bookingId,
	"vservice_id"=>$vserviceId,
	"booking_date"=>$dateto);
$this->internalDB->insert('booking_dates',$bookingdates);
?>