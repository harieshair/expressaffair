<?php
$temp = commonclass::to_ist(commonclass::to_gmt(time()));
$today=date("y-m-d H:i:s",$temp);
$updateObject=array();
$updateCoordinator = array();
$updateEvent_statusObj = array();
try{
	$bookingbegin="";
	$bookingend="";
        $userId="";
	if(!empty($entity->eventFrom) || !empty($entity->eventTo)){
		if(!empty($entity->eventFrom))
		{
			$bookingbegin=$entity->eventFrom;
			if (strpos($entity->eventFrom, '/')!== false)
				$bookingbegin = DateTime::createFromFormat('m/d/Y', $entity->eventFrom)->format('Y-m-d');
			/*$entity->eventFrom=str_replace("/","-",$entity->eventFrom);
			$eventfrom=explode('-',$entity->eventFrom);
			$bookingbegin= $eventfrom[2].'-'.$eventfrom[0].'-'.$eventfrom[1];*/		
		}	

		if(!empty($entity->eventTo))
		{
			$bookingend=$entity->eventTo;
			if (strpos($entity->eventTo, '/') !== false)
				$bookingend = DateTime::createFromFormat('m/d/Y', $entity->eventTo)->format('Y-m-d');
			/*$entity->eventTo=str_replace("/","-",$entity->eventTo);
			$eventto=explode('-',$entity->eventTo);
			$bookingend= $eventto[2].'-'.$eventto[0].'-'.$eventto[1];	*/
		}
		else
			$bookingend=$bookingbegin;
	}
	$duplicateBookingSql="select count(id) from booking_dates where vservice_id=$entity->vserviceId  and ";
	$duplicateBookingSql.=" booking_date between '".$bookingbegin."' and '".$bookingend."' ";
	$duplicate=$this->internalDB->queryFirstField($duplicateBookingSql);

	if(!empty($duplicate))
		return array('Exception'=>"Already booked" );

	$updateObject['booking_from']=$bookingbegin." 00:00:00";
	$updateObject['booking_to']=$bookingend." 00:00:00";
	$updateObject['service_id']=$entity->serviceId;
	$updateObject['v_service_id']=$entity->vserviceId;
	$updateObject['vendor_id']=$this->getVendorIdByVserviceid($entity->vserviceId);
	$updateObject['customer_id']=$entity->customerId;		
	$updateObject['created_on']=$today;	
	
	
	isset($entity->eventId)?$updateObject['event_id']=$entity->eventId:"";
	isset($entity->ritualId)?$updateObject['ritual_id']=$entity->ritualId:"";
	isset($entity->locationId)?$updateObject['location_id']=$entity->locationId:"";

	//CustomerDetails
	isset($booker['cust_email'])?$updateObject['booking_email']=$booker['cust_email']:"";
	isset($booker['cust_contactnumber'])?$updateObject['contact_no']=$booker['cust_contactnumber']:"";
	isset($booker['cust_address'])?$updateObject['booking_address']=$booker['cust_address']:"";
	//Payment details
	/*payment_type
	paid_amount
	payment_mode
*/
	$this->internalDB->insert('bookings',$updateObject);
	$entityId=$this->internalDB->insertId();
	//Save payment Details

        // to get co-ordinator
        //if(!empty($entityId) ) {
        $booking_location_id = $this->internalDB->queryFirstField("SELECT location_id FROM bookings WHERE id=$entity->eventId");
        //echo "booking_location_id::".$booking_location_id;
        $co_ordinator_id = $this->internalDB->queryFirstField("SELECT user_id FROM coordinator co  INNER JOIN users u ON u.id=co.user_id WHERE u.city=$booking_location_id AND u.usertype=4 ORDER BY noof_events ASC LIMIT 1");
        //echo 'co-ordinateID::'.$co_ordinator_id;
               
        // save event_status - tbl
        $event_des = $this->internalDB->queryFirstField("SELECT name FROM events WHERE id=$entity->eventId");
        isset($entity->eventId)?$updateEvent_statusObj['event_id']=$entity->eventId:"";
        $updateEvent_statusObj['event_start_date']=$bookingbegin." 00:00:00";
	$updateEvent_statusObj['event_end_date']=$bookingend." 00:00:00";
        $updateEvent_statusObj['booking_id']=$entityId;
        $updateEvent_statusObj['event_description'] = $event_des;
        $updateEvent_statusObj['event_status'] = 1;
        $updateEvent_statusObj['coordinator_id'] = $co_ordinator_id;
      //  var_dump($updateEvent_statusObj);
        $this->internalDB->insert('event_status',$updateEvent_statusObj);
        
        // update coordinator - bookings tbl
        $updateCoordinator['coordinator_id'] = $co_ordinator_id;
        var_dump($updateCoordinator);
        $this->internalDB->update('bookings',$updateCoordinator,"id=%i",$entityId);
        
	//Save bookingdates
	$this->SaveBookingDates($updateObject['booking_from'],$updateObject['booking_to'],$entityId,$entity->vserviceId);
	return array('Id'=>$entityId);
        
        
        
}
catch(Exception $ex){
	return array('Exception'=>$ex->getMessage() );
}
?>