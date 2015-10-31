<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(SERVERFOLDER."/customer/services.php");
$customerService=new customerservice($dbconnection->dbconnector);
$cityCatalogs=$customerService->GetCatalogValuesByMasterName('City');
$stateCatalogs=$customerService->GetCatalogValuesByMasterName('State');
?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-3"><h2> Login</h2><?php include "default/loginform.php"; ?></div>
			<div class="col-sm-6"><h2>Sign Up!</h2><?php include "default/signupform.php"; ?></div>
		</div>
	</div>
</section>
 <?php 
 include "scripts/login.php"; 
 include "scripts/signup.php";
 ?>