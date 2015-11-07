<?php
if(!isset($_SESSION)){session_start();}
$activeMenu="rituals";
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(SERVERFOLDER."/customer/services.php");
$customerService=new customerservice($dbconnection->dbconnector);
$customerService->GetAllQueryStrings();
if(isset($_SESSION['CUSTOMERID']))
{
	$customerService->searchObj->customerId=$_SESSION['CUSTOMERID']; 	
	$customerData = $customerService->GetCustomerById($customerService->searchObj->customerId); 
}
empty($customerService->searchObj->locationId)?$customerService->searchObj->locationId=(isset($_SESSION['LOCATION'])?$_SESSION['LOCATION']:null):'';
$Services=$customerService->GetAllServicesByRitualId($customerService->searchObj->ritualId);
$Rituals=$customerService->GetAllRitualsByEventId($customerService->searchObj->eventId);
$Citys=$customerService->GetAllCatalogValuesByMasterNames('City');
 $ServiceCategory=$customerService->GetCatalogValuesByMasterName('Service Category');
/*$communityNames=$customerService->GetAllCommunityNames();
*/
include "static/title.php" ;
?>
<body class="app-body">
	<?php
	include "static/itemheader.php" ;	
	include "events/showcase.php" ;
	include "static/footer.php";
	?>
	<script src="../plugins/jQuery/jQuery.validate.min.js"></script>
	<script src="../plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
	<script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="js/ajax-loader.js"></script>
	<script src="js/event-items.js" type="text/javascript"></script>
	<?php include "scripts/events.php" ; ?>
</body>
</html>