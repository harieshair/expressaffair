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
	function geAllMyCartItems($customerId){
		$returnValue=include "cart/getallmycartitems.php";
		return $returnValue;
	}	
	
	function GetCartItemById($cartId){	
		
	}
	function GetAllCartItems($customerId){

	}	
}