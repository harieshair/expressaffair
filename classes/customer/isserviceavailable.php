<?php
$sqlStatement="SELECT count(*) from booking_dates ";
	$wherCondition= " WHERE ";
	if(!empty($cartDetails['vserviceid']))
		$wherCondition.=" vservice_id =".$cartDetails['vserviceid'];
	
	if(!empty($cartDetails['eventdatefrom']))
	{
		$cartDetails['eventdatefrom']=str_replace("/","-",$cartDetails['eventdatefrom']);
		$cartDetails['eventdatefrom']=date('Y-m-d',strtotime($cartDetails['eventdatefrom']));		
	}	
	if(!empty($cartDetails['eventdateto']))
	{
		$cartDetails['eventdateto']=str_replace("/","-",$cartDetails['eventdateto']);
		$cartDetails['eventdateto']=date('Y-m-d',strtotime($cartDetails['eventdateto']));		
	}	
	if(!empty($cartDetails['eventdatefrom']) && !empty($cartDetails['eventdateto']))
		$wherCondition.=" AND booking_date between '".$cartDetails['eventdatefrom']."' AND '".$cartDetails['eventdateto']."'" ;
	else if(!empty($cartDetails['eventdatefrom']) && empty($cartDetails['eventdateto']))
		$wherCondition.=" AND  booking_date = '".$cartDetails['eventdatefrom']."'";
	$bookingCount= $this->internalDB->queryFirstField($sqlStatement.$wherCondition);
	return !empty($bookingCount)?true:false;
?>