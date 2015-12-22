<?php
$sqlStatement="SELECT count(*) from booking_dates ";
	$wherCondition= " WHERE ";
	if(!empty($cartDetails['vserviceid']))
		$wherCondition.=" vservice_id =".$cartDetails['vserviceid'];
	
	if(!empty($cartDetails['eventdatefrom']))
	{
		$eventfrom=explode('/',$cartDetails['eventdatefrom']);
		$bookingbegin= $eventfrom[2].'-'.$eventfrom[0].'-'.$eventfrom[1];
	
	}	
	if(!empty($cartDetails['eventdateto']))
	{
		$eventto=explode('/',$cartDetails['eventdateto']);
		$bookingend= $eventto[2].'-'.$eventto[0].'-'.$eventto[1];
	}	
	if(!empty($bookingbegin) && !empty($bookingend))
		$wherCondition.=" AND booking_date between '".$bookingbegin."' AND '".$bookingend."'" ;
	else if(!empty($bookingbegin) && empty($bookingend))
		$wherCondition.=" AND  booking_date = '".$bookingbegin."'";
	$bookingCount= $this->internalDB->queryFirstField($sqlStatement.$wherCondition);
	return ($bookingCount>0)?0:1;
?>