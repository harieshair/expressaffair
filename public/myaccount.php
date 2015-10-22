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
}
$Citys=$customerService->GetCatalogValuesByMasterName('City');
/*$communityNames=$customerService->GetAllCommunityNames();
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>X Affair</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/prettyPhoto.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/express.css" rel="stylesheet">
</head><!--/head-->
<body>
	<header id="header"><!--header-->
		<?php 
		include "default/myprofile.php" ;
		include "static/navbar.php" ;				
		?>
	</header><!--/header-->
	<?php	
	include "profileinfo/profile.php" ;
	include "static/footer.php";
	?>	
</body>
</html>