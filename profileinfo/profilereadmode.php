<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
if(empty($customerService)){
	include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
	include_once(SERVERFOLDER."/customer/services.php");
	$customerService=new customerservice($dbconnection->dbconnector);
	if(isset($_SESSION['CUSTOMERID']))
	{
		$CustomerId=$_SESSION['CUSTOMERID']; 
		$customerData = $customerService->GetCustomerById($CustomerId); 

	}
}

?>
<div class="signup-form"> 
 <form>
	<div class="row" >
		<div class="col-sm-3"><label class="control-label  pull-right"> Name   :  </label></div>
		<div class="col-sm-9"> <span>     <?php echo $customerData["name"]; ?></span></div>
	</div>
	<div class="row" >
		<div class="col-sm-3"> <label class="control-label pull-right">Email: </label></div>
		<div class="col-sm-9"> <span>    <?php echo $customerData["email"]; ?></span> </div>
	</div>
	<div class="row" >
		<div class="col-sm-3"> <label class="control-label  pull-right">Phone: </label></div>
		<div class="col-sm-9">  <span>  <?php echo $customerData["contact_number"]; ?></span> </div>
	</div>
	<div class="row" >
		<div class="col-sm-3">  <label class="control-label  pull-right">City:  </label> </div>
		<div class="col-sm-9"> <span>    <?php echo $customerService->getCatalogValueById($customerData["city"]); ?></span></div>
	</div>
	<div class="row" >
		<div class="col-sm-3">  <label class="control-label  pull-right">State:  </label> </div>
		<div class="col-sm-9"><span>    <?php echo $customerService->getCatalogValueById($customerData["state"]); ?></span></div>
	</div>
	<div class="row" > 
		<div class="col-sm-3">  <label class="control-label  pull-right">Address: </label> </div>
		<div class="col-sm-9"> <span>  <?php echo $customerData["address"];?></span></div>
	</div>
	<div class="row signup-form pull-right" >
		<a href="javascript:void(0)"   class="btn btn-default pull-left" onclick="fun_edit_save_cancel();"  id="btn_editprofile">Edit</a>
		
	</div>
	</form>
</div>