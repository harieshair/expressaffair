<?php
		$today = commonclass::to_ist(commonclass::to_gmt(time()));
		$today=date("y-m-d H:i:s",$candidate_registered_on);
	foreach($yarndetails as $data){
		if($data['id']!=0)
		{
			try{
			$yarnid=$data['id'];
			$candobj=$this->internalDB->queryFirstRow("select * from d_yarn where id=".$yarnid);
			
			$datatoupdate=array();
			!empty($data['count'])?$datatoupdate['count']=trim($data['count']):'';
			!empty($data['color'])?$datatoupdate['color']=trim($data['color']):'';
			!empty($data['kgs'])?$datatoupdate['kgs']=trim($data['kgs']):'';
			!empty($orderId)?$datatoupdate['order_id']=trim($data['order_id']):'';
			$datatoupdate['modified_on']=$today;
			
			$candidatetable=$this->internalDB->update('d_yarn',$datatoupdate,"id=%i",$yarnid);
			$affectedrows=$this->internalDB->affectedRows();

			}
			catch(Exception $ex){
				return getMessage();
			}
		}
		else
		{
			$insertData=array();	
			!empty($data['count'])?$insertData['count']=trim($data['count']):'';
			!empty($data['color'])?$insertData['color']=trim($data['color']):'';
			!empty($data['kgs'])?$insertData['kgs']=trim($data['kgs']):'';
			!empty($orderId)?$insertData['order_id']=trim($data['order_id']):'';
			$insertData['created_on']=$today;
			
			$insertOrder=$this->internalDB->insert('d_yarn',$insertData);
			$affectedid=$this->internalDB->insertId();
			$this->createlog("Yarn  $affectedid created");
				
			}
		}
?>