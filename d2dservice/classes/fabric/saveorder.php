<?php
	$today = commonclass::to_ist(commonclass::to_gmt(time()));
	$today=date("y-m-d H:i:s",$candidate_registered_on);
if($data['orderid']!=0)
{
	try{
	$orderid=$data['id'];
	$candobj=$this->internalDB->queryFirstRow("select * from d_order where id=".$orderid);
	
	$datatoupdate=array();
	!empty($data['name'])?$datatoupdate['name']=trim($data['name']):'';
	!empty($data['season'])?$datatoupdate['season']=trim($data['season']):'';	
	!empty($data['mercandiser'])?$datatoupdate['mercandiser']=trim($data['mercandiser']):'';
	!empty($data['quantity'])?$datatoupdate['quantity']=trim($data['quantity']):'';
	!empty($data['gsm'])?$datatoupdate['gsm']=trim($data['gsm']):'';
	!empty($data['excess_percent'])?$datatoupdate['excess_percent']=trim($data['excess_percent']):'';
	!empty($data['delivery_date'])?$datatoupdate['delivery_date']=commonclass::cleandate($data['delivery_date']):'';	
	!empty($data['order_date'])?$datatoupdate['order_date']=commonclass::cleandate($data['order_date']):'';	
	!empty($data['delivery_type'])?$datatoupdate['delivery_type']=$data['delivery_type']:'';	
	$datatoupdate['modified_on']=$today;
	
	$candidatetable=$this->internalDB->update('d_order',$datatoupdate,"id=%i",$orderid);
	$affectedrows=$this->internalDB->affectedRows();

		if($affectedrows>=0){
			$this->createlog("Order  $orderid updated");
		return 1;
		}
	}
	catch(Exception $ex){
		return getMessage();
	}
}
else
{
	$candidate_registered_ip  = commonclass::GetIP();
	
	$insertData=array();	
	!empty($data['name'])?$insertData['name']=trim($data['name']):'';
	!empty($data['season'])?$insertData['season']=trim($data['season']):'';	
	!empty($data['mercandiser'])?$insertData['mercandiser']=trim($data['mercandiser']):'';
	!empty($data['quantity'])?$insertData['quantity']=trim($data['quantity']):'';
	!empty($data['gsm'])?$insertData['gsm']=trim($data['gsm']):'';
	!empty($data['excess_percent'])?$insertData['excess_percent']=trim($data['excess_percent']):'';
	!empty($data['delivery_date'])?$insertData['delivery_date']=commonclass::cleandate($data['delivery_date']):'';	
	!empty($data['order_date'])?$insertData['order_date']=commonclass::cleandate($data['order_date']):'';	
	!empty($data['delivery_type'])?$insertData['delivery_type']=$data['delivery_type']:'';	
	$insertData['created_on']=$today;
	
		$insertOrder=$this->internalDB->insert('d_order',$insertData);
		$affectedid=$this->internalDB->insertId();
		$this->createlog("Candidate  $affectedid created");
		return $affectedid;
	}

?>