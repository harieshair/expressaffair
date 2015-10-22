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
	<script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
	<script src="../plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
	<script src="js/ajax-loader.js"></script>
	<script type="text/javascript">
		var locationId=0;
		$(function () {
			locationId=<?php echo isset($_SESSION['LOCATION'])?$_SESSION['LOCATION']:0; ?>;
         //Date range picker with time picker
         $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});           
     });
	</script>
</body>
</html>