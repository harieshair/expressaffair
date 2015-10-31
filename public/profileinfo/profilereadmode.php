<?php
if(empty($customerService)){
if(!isset($_SESSION)){session_start();}
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
<div class="col-sm-6" style="border-style: none; ">   <label> Name   :  </label>      <?php echo $customerData["name"]; ?></div>
      <div class="col-sm-6" style="border-style: none; "> <label>Email   : </label>      <?php echo $customerData["email"]; ?> </div>
      <div class="col-sm-6" style="border-style: none; "> <label>Phone   : </label>      <?php echo $customerData["contact_number"]; ?> </div>
     <div class="col-sm-6" style="border-style: none; ">  <label>City    :  </label>      <?php echo $customerService->getCatalogValueById($customerData["city"]); ?></div>
    <div class="col-sm-6" style="border-style: none; ">   <label>State   :  </label>     <?php echo $customerService->getCatalogValueById($customerData["state"]); ?></div>
    <div class="col-sm-6" style="border-style: none; ">   <label>Address : </label>    <?php echo $customerData["address"];?></div>
    <a href="javascript:void()" onclick="fun_edit_save_cancel();" class="btn btn-default pull-left"  id="btn_editprofile">Edit</a>
</div>