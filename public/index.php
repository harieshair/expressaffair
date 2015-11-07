<?php
if(!isset($_SESSION)){session_start();}
$activeMenu="home";
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(SERVERFOLDER."/customer/services.php");
$customerService=new customerservice($dbconnection->dbconnector);
if(isset($_SESSION['CUSTOMERID']))
{
	$CustomerId=$_SESSION['CUSTOMERID']; 
	$LocationId=isset($_SESSION['LOCATION'])?$_SESSION['LOCATION']:0;
	$customerData = $customerService->GetCustomerById($CustomerId); 
}
/*$communityNames=$customerService->GetAllCommunityNames();

$hallCatalogs=$customerService->GetCatalogValuesByMasterName('HallType');
$locationCatalogs=$customerService->GetCatalogValuesByMasterName('City');*/

include "static/title.php" ;
?>

<body>	
	<?php	
	include "static/header.php";
	include "static/home.php";
	include "static/footer.php";
	?>	
	<script src="js/affair-page-loader.js"></script>
</body>
</html>