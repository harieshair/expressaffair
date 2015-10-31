	<?php
	include_once(CLASSFOLDER."/enums/bookingenums.php");
	class cartclass {

		public $internalDB;	
		
	function cartclass($db) // Constructor 
	{
		$this->internalDB=$db;
	}
	
	function AddToCart($serviceId,$v_serviceId,$customerId)
	{
		include "cart/addtocart.php";
	}
	
	function GetCartItemById($cartId){	
	}
	function GetAllCartItems($customerId){

	}	
}