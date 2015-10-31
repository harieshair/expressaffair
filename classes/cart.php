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
		include "cart/addtocart.php";
	}
	
	function GetCartItemById($cartId){	
	}
	function GetAllCartItems($customerId){

	}	
}