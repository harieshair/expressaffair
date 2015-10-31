<?php
if(!isset($_SESSION)){session_start();}
$activeMenu="events";
$eventid= $_GET['eventid'];
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
$Services=$customerService->GetAllServicesByEventId($eventid);
$Rituals=$customerService->GetAllRitualsByEventId($eventid);
$Citys=$customerService->GetAllCatalogValuesByMasterNames('City');
$ServiceCategory=$customerService->GetCatalogValuesByMasterName('Service Category');


include "static/title.php" ;
?>
<body class="app-body">
	<?php
	include "static/header.php" ;	
	include "events/showcase.php" ;
	include "static/footer.php";
	?>
	<script src="../plugins/jQuery/jQuery.validate.min.js"></script>
	<script src="../plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
	<script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
	<script src="../plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="js/ajax-loader.js"></script>
	<?php include "scripts/events.php" ; ?>
</body>
</html>