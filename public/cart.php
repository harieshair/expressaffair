<?php
if(!isset($_SESSION)){session_start();}
$activeMenu="home";
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(SERVERFOLDER."/customer/services.php");
$customerService=new customerservice($dbconnection->dbconnector);
if(isset($_SESSION['CUSTOMERID']))
{
	$CustomerId=$_SESSION['CUSTOMERID']; 
	$customerData = $customerService->GetCustomerById($CustomerId);
	if(isset($_SESSION['LOCATION']))
		$LocationId=$_SESSION['LOCATION'];
	else
		$_SESSION['LOCATION']=$LocationId=$customerData['city'] ;
}
include "static/title.php" ;
?>
<body class="app-body">
<header id="header"><!--header-->
	<div id="myprofile-content">
		<?php 
		include PUBLICFOLDER."/default/myprofile.php" ; ?>
	</div>
	
	</header><!--/header-->
	<?php	
	include "bookings/mycart.php" ;
	include "static/footer.php";
	?>
	<script src="js/affair-page-loader.js"></script>
</body>
</html>