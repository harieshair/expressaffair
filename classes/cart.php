	<?php
	include_once(CLASSFOLDER."/enums/bookingenums.php");
	class cartclass {

		public $internalDB;	
		
	function cartclass($db) // Constructor 
	{
		$this->internalDB=$db;
	}
	
	function AddToCart($entity)
	{
		$returnValue=include "cart/addtocart.php";
		return $returnValue;
	}
	function geAlltMyCartItems($customerId){
		$itemArray = array();
		$itemArray=array('Exception'=>"",'Items'=>null);
		$selectCount="SELECT count(vs.id) ";
		$joinclause=" FROM  v_services vs inner join carts c on vs.id=c.v_service_id ";
		$where=" where vs.service_id is not null and c.customer_id = $customerId ";	
		
		
		$totalItem= $this->internalDB->queryFirstField($selectCount.$joinclause.$where);	
		
		if($totalItem>0){
			
			$selectclause="SELECT c.location_id as locationId,vs.title,vs.description,vs.price,concat('".HTTPAPPLICATIONROOT.'/'."',vs.master_image) as filePath ,vs.service_id as serviceId ,c.id as cartId ";
			$orderby=" order by c.created_on desc ";		
			
			$items= $this->internalDB->query($selectclause.$joinclause.$where.$orderby);	

		//Get already booked service ids
			/*$sqlbookedservice="SELECT vservice_id FROM booking_days ";
			if(!empty($searchObj->eventFrom))
			{
				$searchObj->eventFrom=str_replace("/","-",$searchObj->eventFrom);
				$searchObj->eventFrom=date('Y-m-d',strtotime($searchObj->eventFrom));		
			}	
			if(!empty($searchObj->eventTo))
			{
				$searchObj->eventTo=str_replace("/","-",$searchObj->eventTo);
				$searchObj->eventTo=date('Y-m-d',strtotime($searchObj->eventTo));		
			}	
			if(!empty($searchObj->eventFrom) && !empty($searchObj->eventTo))
				$sqlbookedservice.=" where booking_date between '$searchObj->eventFrom' and '$searchObj->eventTo' ";
			else if(!empty($searchObj->eventFrom))
				$sqlbookedservice.=" where booking_date = '$searchObj->eventFrom' ";
			else if(!empty($searchObj->eventTo))
				$sqlbookedservice.=" where booking_date = '$searchObj->eventTo' ";

			$bookedVendorServiceIds=$this->internalDB->queryFirstColumn($sqlbookedservice); */
			//Get all city catalogs
			$catalogarray=array();
			$catalogvalues=$this->internalDB->query("SELECT id,catalog_value FROM catalog_value c where catalogmaster_id in (select id from catalog_master where name in ('City'))"); 
			foreach($catalogvalues as $catalog)
				$catalogarray[$catalog['id']]=$catalog['catalog_value'];
			for ($i=0; $i < $totalItem; $i++) { 
				$items[$i]['city']=$catalogarray[$items[$i]['locationId']];
				/*if (in_array($items[$i]['id'], $bookedVendorServiceIds)) 
					$items[$i]['isBooked']=true;
				else
					$items[$i]['isBooked']=false;*/
			}				
			$itemArray['Items']=$items;
		}		
		return $itemArray;
	}	
	
	function GetCartItemById($cartId){	
		
	}
	function GetAllCartItems($customerId){

	}	
}